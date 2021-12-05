<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
        <link href="./css/normalize.css" rel="stylesheet">
        <link href="./css/chef-index.css" rel="stylesheet">
        <link href="./css/header.css" rel="stylesheet">
        <link href="./css/DarkModeIndex.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/footer.css">
        <link rel="stylesheet" href="./css/DarkMenu.css">
        <title>Inicio Makef's</title>
    <?php
        session_start();
        if (!isset($_SESSION["id"])){
            include_once("../models/conexion.php");
            $rConn = new Conexion();
            try {
                $rConn = $rConn->Conectar();
                $rConn->beginTransaction();

                $query = "SELECT * FROM recipe ORDER BY views ASC, recommendedt DESC LIMIT 20";
                $exec = $rConn->prepare($query);
                $exec->execute();
                $exec = $exec->fetchAll(PDO::FETCH_ASSOC);

                $orderQuery = "SELECT AVG(star) FROM stars WHERE recipeid = :rid";
                $updateQuery = "UPDATE recipe SET recommendedt = recommendedt + 1 WHERE recipeid = :rid";
                
                $finalOrdering = array();

                foreach ($exec as $key => $val){
                    $ordering = $rConn->prepare($orderQuery);
                    $updating = $rConn->prepare($updateQuery);
                    $ordering->execute(array("rid"=>$val["recipeid"]));
                    $updating->execute(array("rid"=>$val["recipeid"]));
                    $ordering = $ordering->fetchColumn();
                    if (empty($ordering)){
                        $ordering = 0;
                    }
                    array_push($finalOrdering,["id"=>$val["recipeid"],"stars"=>round($ordering,2)]);
                }

                usort($finalOrdering, function ($item1, $item2) {
                    return $item2['stars'] <=> $item1['stars'];
                });

                print_r($finalOrdering);
            } catch (Exception $e) {
                print_r($e);
                $rConn->rollBack();
            }
        }else{
            include("./components/tokenControl.php");
            $url = "http://127.0.0.1:5000/user/$_SESSION[id]/vr";

            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

            $viewed = curl_exec($ch);
            curl_close($ch);

            $rConn = new Conexion();
            $rConn = $rConn->Conectar();
            
            $viewed = json_decode($viewed)->ids;
            
            $numsViewed = array_map('intval',$viewed);
            $numsViewed = implode(",",$numsViewed);

            if(empty($numsViewed)){
                $numsViewed = 0;
            }

            $selectQuery = "SELECT 
            recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname,
            CAST(AVG(stars.star) AS DECIMAL(10,2)) AS rate 
            FROM recipe INNER JOIN stars ON stars.recipeid = recipe.recipeid 
            WHERE recipe.recipeid NOT IN ($numsViewed) AND recipe.privater = FALSE GROUP BY (recipe.recipeid,recipe.namer,recipe.status, recipe.duration, recipe.tags, recipe.region, recipe.privater, recipe.chefname)";

            try {
                $getR = $rConn->prepare($selectQuery);
                $getR->execute();
                $res = $getR->fetchAll(PDO::FETCH_ASSOC);
                $data = json_encode($res);
                $url = "http://127.0.0.1:5000/user/$_SESSION[id]";
    
                $ch = curl_init($url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch,CURLOPT_POST,true);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Content-type: application/json"
                ]);
    
                $response = json_decode(curl_exec($ch));
                curl_close($ch);

                if ($response->status == 200){
                    # code...
                }
                print_r($response);

            } catch (Exception $th) {
                print_r($th);
            }
        }
        if(isset($_SESSION["errorRegister"])){
            unset($_SESSION["errorRegister"]);
        }

        if(isset($_SESSION["errorLog"])){
            unset($_SESSION["errorLog"]);
        }
    ?>
</head>
<body class="White">
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <section class="recipe-container" id="principal-recipes">
        <div class="makefsContainer recipe-body">
            <h2 id="title-ctc"><?php echo "¡Bienvenido $_SESSION[nombre]! Tenemos Recomendaciones para tí - " ?>Makef's</h2>
            <div class="general-recipes-container">
                <?php 
                include("./components/test_inputs.php");
                foreach ($response->recipes as $key => $recipe) {
                    $recipe->rate = number_format($recipe->rate, 1);
                    $title = test_input($recipe->namer);
                    $chefname = test_input($recipe->chefname);
                    echo <<<EOT
                        <div class="recipe-template">
                            <a class="image-template" href="./ddr.php?video=$recipe->recipeid" target="__blank">
                                <img src="../mediaDB/recipeImages/$recipe->imagen">
                                <figure class="star-template WhiteStar"><img src="./img/hico-star-red.png"><b id="starCount">$recipe->rate</b></figure>
                            </a>
                            <div class="next-text-recipe WhiteModeP">
                                <img src="./test-imgs/xd.jpg">
                                <a href="https://google.com" target="__blank">
                                    <h3 class="text-template">$title</h3>
                                    <p>$chefname</p>
                                    <p>$recipe->views Views</p>
                                </a>
                            </div>
                        </div>
                    EOT;
                }
                ?>
                <?php
                    include('./components/categoriesMenu.php');
                ?>
            </div>
            
        </div>
    </section>
    <?php
        include('./components/footer.php');
    ?>
    <script src="./js/index.js"></script>
    <script src="./js/categoriesmenu.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/darkModeIndex.js"></script>
    <script src="./js/DarkModeMenu.js"></script>
    </body>
</html>