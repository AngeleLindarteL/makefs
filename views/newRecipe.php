<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Recipe!</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/newRecipeCss.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">
    <link href="./css/notifications.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <?php
        include('./components/sessionControl.php');
        include("./components/tokenControl.php");
        if(empty($_SESSION['chefid'])){
            header("location: ./error.html");
        }
        echo <<<EOT
            <script>
                const chefid =$_SESSION[chefid];
                const chefname = '$_SESSION[username]'; 
            </script>
        EOT;
    ?>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <div class="makefs-notification">
        <figure class="makefs-notification-rep"></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">Mui bien eres bueno ya seaktualiso tufoto</p></article>
    </div>
    <div class="makefs-notification video-notifi">
        <figure class="makefs-notification-rep "></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg-video">Mui bien eres bueno ya seaktualiso tufoto</p></article>
    </div>
    <section id="newRecipeSection">
        <div class="makefsContainer containerNewRecipe">
            <div id="recipetittlediv">
                <input type="text" id="recipeTittle" maxlength="60" name="recipeTittle" placeholder="Titulo de Tu Receta">
                <div id="madePrivate">
                    <input type="checkbox" id="madePrivateBtn" value="true" name="madePrivateBtn"> 
                    <h3>Privado</h3>
                </div>
                <button id="uploadBtn"><h2>Subir Receta</h2></button>
            </div>
            <div id="recipebodydiv">
                <div id="barraLateralNewRecipe">
                    <div id="menuIngredientesNewRecipe">
                        <h2 id="ingredientsTittle">INGREDIENTES
                            <div class="btnplus">
                                <button class="lessInputBtn" id="lessIngrediens"></button><button id="addIngredientBtn"></button>
                            </div>
                            </h2>
                        <div id="inputsLateralesNewRecipe">
                            <input type="text" class="ingredient" name="ingredients" placeholder="Ingrediente">
                        </div>
                    </div>
                    <div id="etiquetasNewRecipe">
                        <div>
                            <h2>ETIQUETAS</h2>
                        </div>
                        <div id="selectsEtiquetasNewRecipe">
                            <label for="eRegiones">Region</label>
                            <select name="eRegiones" id="eRegiones">
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
                            <label for="recipeVideo" id="btnVideoUpload">
                                <img src="./img/addVideoRecipe.png" alt="">
                            </label>
                            <h4>Inserta tu video Preparacion</h4>
                            <input type="file" id="recipeVideo" class="inputfileNewRecipe" name="recipeVideo" accept="video/mp4, video/webm" required> 
                        </div>
                        <div class="divMultimedia" id="divUploadImg">
                            <label for="recipeImg" id="btnImgUpload">
                                <img src="./img/imagen.png" alt="">
                            </label>
                            <h4>Inserta la imagen de tu receta</h4>
                            <input type="file" id="recipeImg" class="inputfileNewRecipe" name="recipeImg" accept=".jpg, .png" required> 
                        </div>
                    </div>
                    <div id="stepsNewRecipe">
                        <div id="tittlePasos">
                            <div id="hatPasosyTxt">
                                <img src="./img/chefHatRed.png" alt="">
                                <h2>Pasos</h2>
                            </div>
                            <div id="btnsSteps">
                                <button class="lessInputBtn" id="lessSteps"></button>
                                <button id="addStepBtn"></button>
                            </div>
                            
                        </div>
                        <div id="inputsSteps">
                            <div class="oneStepNewRecipe">
                                <input type="text" class="stepTxtInput steps" placeholder="Paso">
                                <input type="number" class="minInicioInput steps" placeholder="minInicio">
                                <input type="number" class="minFinInput steps" placeholder="minFin">
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <div>

                </div>
            </div>
        </div>
    </section>
    <?php
        include('./components/footer.php');
    ?>
    <script src="./js/index.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/newRecipe.js"></script>
    <script src="./js/axiosNewRecipe.js"></script>
    <script src="./js/darkMode.js"></script>
</body>
</html>