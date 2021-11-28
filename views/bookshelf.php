<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <title>Tu biblioteca</title>
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/chef-index.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <link href="./css/bookshelf.css" rel="stylesheet">
    <link href="./css/notifications.css" rel="stylesheet">
    <link href="./css/bookshelfnotif.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?php
        include("../models/conexion.php");
        include("./components/sessionControl.php");
        include("./components/tokenControl.php");
        include("./components/test_inputs.php");
        $ToCompareUserId = json_decode(decodeUserData($_SESSION["token"]));
        if (
            $ToCompareUserId->id != $_SESSION["id"] ||
            $ToCompareUserId->id != $_GET["user"] ||
            $_SESSION["id"] != $_GET["user"] ||
            empty($_GET["user"])
        ) {
            header("Location: ./error.html");
        }

        if($_SESSION["id"]==0 || empty($_SESSION["id"])){
            header("Location: ./error.html");
        } 
        $chefId = $_GET["user"];

        $conn = new Conexion;
        $conn = $conn -> Conectar();
        $consulta = "SELECT * FROM recipe INNER JOIN saveds ON recipe.recipeid = saveds.recipeid  INNER JOIN userm ON userm.chefid = recipe.chefid WHERE saveds.userid = $_SESSION[id] ORDER BY savedtime ASC";
        try{
         $saveds = $conn->prepare($consulta);
         $saveds->execute();
        }catch(Exception $e){
            echo $e;
        }

        $contar = "SELECT COUNT(saveid) FROM saveds WHERE userid = $_SESSION[id]";
        try{
            $countSaveds = $conn->prepare($contar);
            $countSaveds->execute();
            $countSaveds = $countSaveds->fetchColumn();
        }catch(Exception $e){
            echo $e;
        }
   
        $dataAll = $saveds -> fetchAll(PDO::FETCH_ASSOC);
    ?>
</head>
<body>
    <?php
    include('./components/header.php');
    include('./components/menudesplegable.php');
    ?>
    <section id="bookshelf">
        <div class="makefsContainer bookshelf-container">
            <div class="saved-recipes-user-portrait">
                <a class="saved-recipes-user-img"><img src="../mediaDB/usersImg/<?php  echo $_SESSION["midpic"] ?>" id="saved-user-img"></a>
            </div>
            <article class="saved-recipes-main-text">
                <h1>Bienvenido a tu biblioteca <?php echo $_SESSION["username"] ?></h1>
                <p>Recetas guardadas: <b><?php echo $countSaveds?></b></p>
            </article>
            <div class="saved-recipes-lastest">
                <h2>Tus ultimas recetas guardadas</h2>
                <div class="general-recipes-container lastest-saved-container">
                    <?php
                    for ($i=0; $i < sizeof($dataAll) ; $i++) { 
                        $recipeid = $dataAll[$i]['recipeid'];
                        $views = $dataAll[$i]['views'];
                        $imagen = $dataAll[$i]['imagen'];
                        $midpic = $dataAll[$i]['minpic'];
                        $chefid = $dataAll[$i]['chefid'];
                        $recetaname = test_input($dataAll[$i]['namer']);
                        $username = test_input($dataAll[$i]['username']);


                        if($i>2){
                            break;
                        }
                        $query = "SELECT AVG(star) FROM stars WHERE recipeid =$recipeid";
                        try{
                            $average = $conn->prepare($query);
                            $average->execute();
                            $average = $average->fetchColumn();
                            if (empty($average)){
                                $average = "0";
                            }
                            if(sizeof(explode(".",$average)) == 1){
                                $average = $average.".0";
                            }
                        }catch(Exception $e){
                            print_r($e);
                            exit;
                        }
                        echo <<< EOT
                        <div class="recipe-template">
                            <a class="image-template" href="./ddr.php?video=$recipeid" target="__blank">
                                <img src="../mediaDB/recipeImages/$imagen">
                                <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">$average</b></figure>
                            </a>
                            <div class="next-text-recipe">
                                <img src="../mediaDB/usersImg/$midpic">
                                <a href="./chef-view.php?chef=$chefid" target="__blank">
                        EOT;
                                    echo "<h3 class='text-template'>$recetaname</h3>";
                                    echo "<p>$username</p>";
                        echo <<<EOT
                                        <p>$views Views</p>
                                    </a>
                            </div>
                            </a>
                            
                        </div>
                        EOT;
                        $recipe = true;
                    }
                    if(empty($dataAll["recipeid"]) && empty($recipe)){
                        echo <<<EOT
                            <div id="notFoundRecipes">
                                <img src="./img/notFoundRecipes.png">
                                <h3>No tienes recetas aún! Empieza a guardar tus favoritas</h3>
                            </div>
                        EOT;
                    }
                    ?>
                    
                </div>
            </div>
            <?php
                if(sizeof($dataAll)>3){
            ?>

                <div class="saved-recipes-all">
                    <h2>Todas tus recetas guardadas</h2>
                    <div class="general-recipes-container lastest-saved-container">
                    <?php
                        
                        for ( $i=0 ; $i < sizeof($dataAll); $i++ ) { 
                            $recipeid = $dataAll[$i]['recipeid'];
                            $views = $dataAll[$i]['views'];
                            $imagen = $dataAll[$i]['imagen'];
                            $midpic = $dataAll[$i]['minpic'];
                            $chefid = $dataAll[$i]['chefid'];
                            $recetaname = test_input($dataAll[$i]['namer']);
                            $username = test_input($dataAll[$i]['username']);
                            if($i<=2){
                                continue;
                            }
                            $query = "SELECT AVG(star) FROM stars WHERE recipeid = $recipeid";
                            try{
                                $average = $conn->prepare($query);
                                $average->execute();
                                $average = $average->fetchColumn();
                                if (empty($average)){
                                    $average = "0";
                                }
                                if(sizeof(explode(".",$average)) == 1){
                                    $average = $average.".0";
                                }
                            }catch(Exception $e){
                                print_r($e);
                                exit;
                            }
                            echo <<< EOT
                            <div class="recipe-template">
                                <a class="image-template" href="./ddr.php?video=$recipeid" target="__blank">
                                    <img src="../mediaDB/recipeImages/$imagen">
                                    <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">$average</b></figure>
                                </a>
                                <div class="next-text-recipe">
                                    <img src="../mediaDB/usersImg/$midpic">
                                    <a href="./chef-view.php?chef=$chefid" target="__blank">
                            EOT;
                                        echo "<h3 class='text-template'>$recetaname</h3>";
                                        echo "<p>$username</p>";
                            echo <<<EOT
                                            <p>$views Views</p>
                                        </a>
                                </div>
                                </a>
                                
                            </div>
                            EOT;
                            $recipe = true;
                        }
                        
                    ?>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/darkMode.js"></script>
    <script src="./js/axiosSaveRecipe.js"></script>
    <?php
        include("./components/footer.php");
    ?>
</body>
</html>