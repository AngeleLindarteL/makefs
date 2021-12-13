<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tus recetas guardadas para despues cocinarlas!">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/png" sizes="96x96" href="views/favicon/makefslogo.png">
    <title>Tu biblioteca Makefs</title>
    <script src="../views/js/defineUrl.js"></script>
    <link href="../views/css/normalize.css" rel="stylesheet">
    <link href="../views/css/chef-index.css" rel="stylesheet">
    <link href="../views/css/header.css" rel="stylesheet">
    <link href="../views/css/footer.css" rel="stylesheet">
    <link href="../views/css/notifications.css" rel="stylesheet">
    <link href="../views/css/libraryNotif.css" rel="stylesheet">
    <link href="../views/css/libraryNotif.css" rel="stylesheet">
    <link href="../views/css/library.css" rel="stylesheet">
    <link href="../views/css/Darklibrary.css" rel="stylesheet">
    <link href="../views/css/DarkMenu.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/Preloader.css">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?php
        include("models/conexion.php");
        include("./views/components/sessionControl.php");
        include("./views/components/tokenControl.php");
        include("./views/components/test_inputs.php");
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
        echo "<script>const uid = $_GET[user]</script>";
    ?>
</head>
<body class="White">
    <?php
    include('./views/components/header.php');
    include('./views/components/menudesplegable.php');
    include('./views/components/preloader.php');
    ?>
    <div class="pile-waiting">
        <p>En pila</p>
    </div>
    <div class="bookshelf-notification">
        <img id="bookshelf-icon" src="../views/iconos/book.png" alt="guardados">
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-save-msg">bookshelf Notification</p></article>
        <a target="_blank" id="cancel-elimination" to_cancel="0">Deshacer</a>
    </div>
    <section id="confirm-section">
        <div class="confirmation-notification">
            <img id="confirm-recipe-img" src="../mediaDB/recipeImages/chef-10248165283_1190438111445388_6261601133517822199_n.jpg">
            <article>
                <h3>¿Deseas Eliminar el video de <span id="confirmation-chef-name">$user</span> de tu biblioteca?</h3>
                <p><b id="confirmation-recipe-title">$nombre</b> se eliminará de tu biblioteca, podrás recuperarlo con la notificación que aparecera en pantalla o guardandolo nuevamente</p>
                <div class="confirmation-triggers">
                    <button id="trigger-confirm" recipeDelId="0" recipePos="none">Si, lo quiero eliminar</button>
                    <button id="trigger-cancel">No, llevame de vuelta</button>
                </div>
            </article>
        </div>
    </section>
    <section id="bookshelf">
        <div class="makefsContainer bookshelf-container">
            <div class="saved-recipes-user-portrait">
                <a class="saved-recipes-user-img"><img src="../mediaDB/usersImg/<?php  echo $_SESSION["midpic"] ?>" alt="imagen de usuario" id="saved-user-img"></a>
            </div>
            <article class="saved-recipes-main-text">
                <h1 class="WhiteWellib">Bienvenido a tu biblioteca <?php echo $_SESSION["username"] ?></h1>
                <p class="WhiteRecipelib">Recetas guardadas: <b class="Whitevidsav"><?php echo $countSaveds?></b></p>
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
                            <a class="image-template" href="/recipe/$recipeid">
                                <img src="../mediaDB/recipeImages/$imagen" alt="imagen de receta">
                                <figure class="star-template WhiteStar"><img src="../views/img/hico-star-red.png" alt="estrellas"><b id="starCount">$average</b></figure>
                            </a>
                            <div class="next-text-recipe whiterecipet">
                                <img src="../mediaDB/usersImg/$midpic" alt="imagen de usuario">
                                <a href="./chef/$chefid" target="__blank">
                                     <h3 class='text-template'>$recetaname</h3>
                                     <p>$username</p>
                                        <p>$views Views</p>
                                    </a>
                            </div>
                            <button class="del-bookshelf" library_id="$recipeid" chefName="$username" recipeTitle="$recetaname" picDir="../mediaDB/recipeImages/$imagen" position_in_library="$i"></button>
                            </a>
                            
                        </div>
                        EOT;
                        $recipe = true;
                    }
                    if(empty($dataAll["recipeid"]) && empty($recipe)){
                        echo <<<EOT
                            <div id="notFoundRecipes">
                                <img src="../views/img/notFoundRecipes.png" alt="cookie">
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
                                    <img src="../mediaDB/recipeImages/$imagen" alt="imagen de receta">
                                    <figure class="star-template WhiteStar"><img src="../views/img/hico-star-red.png" alt="estrellas"><b id="starCount">$average</b></figure>
                                </a>
                                <div class="next-text-recipe whiterecipet">
                                    <img src="../mediaDB/usersImg/$midpic" alt="imagen de usuario">
                                    <a href="./chef-view.php?chef=$chefid" target="__blank">
                            EOT;
                                        echo "<h3 class='text-template'>$recetaname</h3>";
                                        echo "<p>$username</p>";
                            echo <<<EOT
                                            <p>$views Views</p>
                                        </a>
                                </div>
                                <button class="del-bookshelf" library_id="$recipeid" chefName="$username" recipeTitle="$recetaname" picDir="../mediaDB/recipeImages/$imagen" position_in_library="$i"></button>
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
    <?php
        include("./views/components/footer.php");
    ?>
    <script src="../views/js/DarkLoader.js"></script>
    <script src="../views/js/index.js"></script>
    <script src="../views/js/library.js"></script>
    <script src="../views/js/DarkModeLibrary.js"></script>
    <script src="../views/js/preloader.js"></script>
    <script src="../views/js/darkModeM.js"></script>
</body>
</html>