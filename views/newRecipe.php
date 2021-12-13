<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crea una nueva receta para la comunidad!">
    <meta name="robots" content="index, follow">
    <title>Nueva Receta! Makefs</title>
    <link rel="stylesheet" href="views/css/chef-index.css">
    <link rel="stylesheet" href="views/css/normalize.css">
    <link rel="stylesheet" href="views/css/newRecipeCss.css">
    <link rel="stylesheet" href="views/css/footer.css">
    <link rel="stylesheet" href="views/css/header.css">
    <link href="views/css/notifications.css" rel="stylesheet">
    <link href="views/css/DarkRecipe.css" rel="stylesheet">
    <link href="views/css/DarkMenu.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="icon" type="image/png" sizes="96x96" href="views/favicon/makefslogo.png">
    <?php
        include('views/components/sessionControl.php');
        include("views/components/tokenControl.php");
        if(empty($_SESSION['chefid'])){
            // header("location: /error");
        }
        echo <<<EOT
            <script>
                const chefid =$_SESSION[chefid];
                const chefname = '$_SESSION[username]'; 
            </script>
        EOT;
    ?>
</head>
<body class="White">
    <?php
        include('views/components/header.php');
        include('views/components/menudesplegable.php');
    ?>
    <div class="makefs-notification">
        <figure class="makefs-notification-rep"></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">Mui bien eres bueno ya seaktualiso tufoto</p></article>
    </div>
    <div class="makefs-notification video-notifi">
        <figure class="makefs-notification-rep "></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg-video">Mui bien eres bueno ya seaktualiso tufoto</p></article>
    </div>
    <section id="newRecipeSection" class="WhiteSection">
        <div class="makefsContainer containerNewRecipe">
            <div id="recipetittlediv">
                <input required type="text" id="recipeTittle" class="Whiterecipetit" maxlength="60" name="recipeTittle" placeholder="Titulo de Tu Receta">
                <div id="madePrivate">
                    <input required type="checkbox" id="madePrivateBtn" value="true" name="madePrivateBtn"> 
                    <h3>Privado</h3>
                </div>
                <button id="uploadBtn"><h2>Subir Receta</h2></button>
            </div>
            <div id="recipebodydiv">
                <div id="barraLateralNewRecipe">
                    <div id="menuIngredientesNewRecipe">
                        <h2 id="ingredientsTittle" class="Whitemaintt">INGREDIENTES
                            <div class="btnplus">
                                <button class="lessInputBtn Whitemaintt" id="lessIngrediens"></button><button id="addIngredientBtn"></button>
                            </div>
                            </h2>
                        <div id="inputsLateralesNewRecipe">
                            <input required type="text" class="ingredient Whiterecipetit" name="ingredients" placeholder="Ingrediente">
                        </div>
                    </div>
                    <div id="etiquetasNewRecipe" class="Whitemaintt">
                        <div>
                            <h2>ETIQUETAS</h2>
                        </div>
                        <div id="selectsEtiquetasNewRecipe">
                            <label for="eRegiones">Region</label>
                            <select name="eRegiones" id="eRegiones" class="Whiterecipetit">
                                <option value="" hidden selected>Region</option>
                                <option value="latam">Latam</option>
                                <option value="asia">Asia</option>
                                <option value="norteA">Norte.A</option>
                                <option value="europa">Europa</option>
                                <option value="africa">Africa</option>
                                <option value="oceania">Oceania</option>
                            </select>
                            <label for="eTipo" id="foodsTittle">Tipo Comida
                                <div class="btnplus">

                                    <button class="lessInputBtn" id="lessEtiquetas"></button>
                                    <button id="addEtiquetaBtn"></button>
                                </div>
                            </label>
                            
                        </div>
                    </div>
                </div>
                <div id="sectionNewRecipeMultimedia">
                    <div id="multimediaNewRecipe">
                        <div class="divMultimedia" id="divUploadVideo">
                            <label for="recipeVideo"  id="btnVideoUpload">
                                <img class="Whiteimgr" src="views/img/addVideoRecipe.png" alt="agregar video">
                            </label>
                            <h4 class="Whitemaintt">Inserta tu video Preparacion</h4>
                            <input type="file" id="recipeVideo" class="inputfileNewRecipe" name="recipeVideo" accept="video/mp4, video/webm" required> 
                        </div>
                        <div class="divMultimedia" id="divUploadImg">
                            <label for="recipeImg"  id="btnImgUpload" class="Whiteimgr">
                                <img  src="views/img/imagen.png" alt="agregar imagen">
                            </label>
                            <h4 class="Whitemaintt">Inserta la imagen de tu receta</h4>
                            <input type="file" id="recipeImg" class="inputfileNewRecipe" name="recipeImg" accept=".jpg, .png" required> 
                        </div>
                    </div>
                    <div id="stepsNewRecipe">
                        <div id="tittlePasos" class="Whitemaintt Whiteline">
                            <div id="hatPasosyTxt">
                                <img src="views/img/chefHatRed.png" alt="chef hat">
                                <h2>Pasos</h2>
                            </div>
                            <div id="btnsSteps">
                                <button class="lessInputBtn" id="lessSteps"></button>
                                <button id="addStepBtn" class="Whitebtn"></button>
                            </div>
                            
                        </div>
                        <div id="inputsSteps">                            
                        </div>
                    </div>
                </div>
                <div>

                </div>
            </div>
        </div>
    </section>
    <?php
        include('views/components/footer.php');
    ?>
    <script src="views/js/defineUrl.js"></script>
    <script src="views/js/index.js"></script>
    <script src="views/js/menuDesplegable.js"></script>
    <script src="views/js/newRecipe.js"></script>
    <script src="views/js/axiosNewRecipe.js"></script>
    <script src="views/js/DarkModeRecipe.js"></script>
    <script src="views/js/DarkModeMenu.js"></script>
</body>
</html>