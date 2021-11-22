<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Recipe!</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/newRecipeCss.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <?php
        include('./components/sessionControl.php');
    ?>
    <?php include("./components/tokenControl.php") ?>
    <script>
        <?php echo "const chefid =".$_SESSION['chefid'] ?>
    </script>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <section id="newRecipeSection">
        <div class="makefsContainer containerNewRecipe">
            <div id="recipetittlediv">
                <input type="text" id="recipeTittle" maxlength="60" name="recipeTittle" placeholder="Titulo de Tu Receta">
                <button id="uploadBtn"><h2>Subir Receta</h2></button>
            </div>
            <div id="recipebodydiv">
                <div id="barraLateralNewRecipe">
                    <div id="menuIngredientesNewRecipe">
                        <h2 id="ingredientsTittle">INGREDIENTES<button class="lessInputBtn" id="lessIngrediens"></button><button id="addIngredientBtn"></button></h2>
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
                            <label for="eTipo">Tipo Comida<button class="lessInputBtn" id="lessEtiquetas"></button><button id="addEtiquetaBtn"></button></label>
                            
                        </div>
                    </div>
                </div>
                <div id="sectionNewRecipeMultimedia">
                    <div id="multimediaNewRecipe">
                        <div class="divMultimedia">
                            <label for="recipeVideo">
                                <img src="./img/addVideoRecipe.png" alt="">
                            </label>
                            <h4>Inserta tu video Preparacion</h4>
                            <input type="file" id="recipeVideo" class="inputfileNewRecipe" name="recipeVideo" accept="mp4" required> 
                        </div>
                        <div class="divMultimedia">
                            <label for="recipeImg">
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
                                <input type="text" class="minInicioInput steps" placeholder="minInicio">
                                <input type="text" class="minFinInput steps" placeholder="minFin">
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <div>

                </div>
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/newRecipe.js"></script>
    <script src="./js/axiosNewRecipe.js"></script>
</body>
</html>