<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="96x96" href="../views/favicon/makefslogo.png">
        <link href="../../views/css/normalize.css" rel="stylesheet">
        <link href="../../views/css/chef-index.css" rel="stylesheet">
        <link href="../../views/css/header.css" rel="stylesheet">
        <link href="../../views/css/DarkModeIndex.css" rel="stylesheet">
        <link rel="stylesheet" href="../../views/css/footer.css">
        <link rel="stylesheet" href="../../views/css/DarkMenu.css">
        <link rel="stylesheet" href="../../views/css/Preloader.css">
        <meta name="description" content="Aprende a cocinar, realiza todo tipo de preparaciones">
        <meta name="robots" content="index, follow">

    <?php
        session_start();
        if (!isset($_GET["region"]) || !isset($_GET["type"])) {
            header("location: /");
        }
        include_once("models/conexion.php");
        $rConn = new Conexion();
        try {
            $rConn = $rConn->Conectar();
            $rConn->beginTransaction();

            $query = "SELECT 
            recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname,
            CAST(AVG(stars.star) AS DECIMAL(10,2)) AS rate,
            userm.minpic
            FROM recipe INNER JOIN userm ON userm.chefid = recipe.chefid INNER JOIN stars ON stars.recipeid = recipe.recipeid 
            WHERE convert_from(decode(recipe.tags, 'base64'), 'UTF8') LIKE :sel AND recipe.privater = FALSE GROUP BY (recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname, userm.minpic) LIMIT 20";

            $exec = $rConn->prepare($query);
            $exec->execute(array("sel"=>("%".$_GET["region"].ucfirst($_GET["type"])."%")));
            $exec = $exec->fetchAll(PDO::FETCH_ASSOC);
            
            $finalOrdering = array();

            function ordering($rate,$views){
                $viewRanges = [
                    [0,20],
                    [20,50],
                    [50,100],
                    [100,500],
                    [500,1000],
                    [1000,10000],
                    [10000, 20000],
                    [20000, 50000],
                    [50000, 100000],
                    [100000,1000000]
                ];
                $vscore = 0;
                $vrate = 0;
                for($i = 0; $i < sizeof($viewRanges); $i++){
                    if ($viewRanges[$i][0] <= $views && $viewRanges[$i][1] >= $views){
                        $vscore = ($i+1) * 100;
                        break;
                    }
                }
                try{
                    $vrate = (number_format($rate,2) / 0.5) * 100;
                }catch (DivisionByZeroError $e){
                    $vrate = 100;
                }
                return $vrate + $vscore;
            }

            foreach ($exec as $key => $val){
                array_push($finalOrdering,[
                    "recipeid"=>$val["recipeid"],
                    "chefid"=>$val["chefid"],
                    "namer"=>$val["namer"],
                    "rate"=>$val["rate"],
                    "views"=>$val["views"],
                    "chefname"=>$val["chefname"],
                    "imagen"=>$val["imagen"],
                    "chefpic"=>$val["minpic"],
                    "fscore"=> ordering($val["rate"], $val["views"])
                ]);
            }

            usort($finalOrdering, function ($item1, $item2) {
                return $item2['fscore'] <=> $item1['fscore'];
            });
            $response = json_decode(json_encode(["recipes"=>$finalOrdering]));
        } catch (Exception $e) {
            print_r($e);
            $rConn->rollBack();
        }
        if(isset($_SESSION["id"]) && $_SESSION["id"] != 0){
            include("views/components/tokenControl.php");
        }
        if(isset($_SESSION["errorRegister"])){
            unset($_SESSION["errorRegister"]);
        }

        if(isset($_SESSION["errorLog"])){
            unset($_SESSION["errorLog"]);
        }
        $name = $_GET["region"]." en ".$_GET["type"]; 
    ?>
    <title>Cocina sobre: <?php echo $_GET["type"]." de ".$_GET["region"]?></title>
</head>
<body class="White">
    <?php
        include('views/components/header.php');
        include('views/components/menudesplegable.php');
        include('views/components/preloader.php');
    ?>
    <section class="recipe-container" id="principal-recipes">
        <div class="makefsContainer recipe-body">
            <?php 
                include("views/components/test_inputs.php");
                
                echo "<h2 id='title-ctc'>¡Lo mejor de $name!</h2>";
            ?>
            <div class="general-recipes-container">
                <?php 
                foreach ($response->recipes as $key => $recipe) {
                    $recipe->rate = number_format($recipe->rate, 1);
                    $title = test_input($recipe->namer);
                    $chefname = test_input($recipe->chefname);
                    echo <<<EOT
                        <div class="recipe-template">
                            <a class="image-template" href="/recipe/$recipe->recipeid">
                                <img src="mediaDB/recipeImages/$recipe->imagen alt="recetas comida">
                                <figure class="star-template WhiteStar"><img src="../../views/img/hico-star-red.png" alt="estrellas de valoracion"><b id="starCount">$recipe->rate</b></figure>
                            </a>
                            <div class="next-text-recipe WhiteModeP">
                                <img src="../mediaDB/usersImg/$recipe->chefpic" alt="imagen de usuario">
                                <a href="/chef/$recipe->chefid">
                                    <h3 class="text-template">$title</h3>
                                    <p>$chefname</p>
                                    <p>$recipe->views Views</p>
                                </a>
                            </div>
                        </div>
                    EOT;
                    $recipe = true;
                }
                if(empty($recipe) && empty($recipe)){
                    echo <<<EOT
                        <div id="notFoundRecipes" class="Whitecookie">
                            <img src="../../views/img/notrecipesSearch.png" alt="noSeEncontraronRecetas">
                            <h3>No se han encontrado recetas con tu búsqueda.</h3>
                        </div>
                    EOT;
                }
                ?>
                <?php
                    include('views/components/categoriesMenu.php');
                ?>
            </div>
            
        </div>
    </section>
    <?php
        include('views/components/footer.php');
    ?>
    <script src="../../views/js/defineUrl.js"></script>
    <script src="../../views/js/index.js"></script>
    <script src="../../views/js/menuDesplegable.js"></script>
    <script src="../../views/js/darkModeIndex.js"></script>
    <script src="../../views/js/DarkLoader.js"></script>
    <script src="../../views/js/preloader.js"></script>
    <script src="../../views/js/DarkModeMenu.js"></script>
    <script src="../../views/js/responsiveCategoriesOutIndex.js"></script>
    </body>
</html>