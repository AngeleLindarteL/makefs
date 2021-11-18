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
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <?php
        include('./components/sessionControl.php');
    ?>
    <?php include("./components/tokenControl.php") ?>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <section id="newRecipeSection">
        <div class="makefsContainer containerNewRecipe">
            <div id="recipetittlediv">
                <input type="text" maxlength="60" name="recipeTittle" placeholder="Titulo de Tu Receta">
            </div>
            <div id="recipebodydiv">
                <div id="barraLateralNewRecipe">
                    <div id="menuIngredientesNewRecipe">
                        <h2>INGREDIENTES<button>+</button></h2>
                        <div class="inputsLateralesNewRecipe">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            <input type="text" name="ingredients" placeholder="Ingrediente">
                            </div>
                    </div>
                    <div id="etiquetasNewRecipe">
                        <div>
                            <h2>ETIQUETAS</h2>
                        </div>
                        <div id="selectsEtiquetasNewRecipe">
                            <label for="eRegiones">Region</label>
                            <select name="eRegiones" id="eRegiones">
                                <option value="">Latam</option>
                                <option value="">Asia</option>
                                <option value="">Norte.A</option>
                                <option value="">Europa</option>
                                <option value="">Africa</option>
                                <option value="">Oceania</option>
                            </select>
                            <label for="eTipo">Tipo Comida<button>+</button></label>
                            
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div>
                            <img src="./img/camera.png" alt="">
                            <input type="file" name="recipeVideo" accept="mp4" required> 
                        </div>
                        <div>
                            <img src="./img/imagen.png" alt="">
                            <input type="file" name="recipeImg" accept=".jpg, .png" required> 
                        </div>
                    </div>
                    <div>
                        <div>
                            <img src="./img/chefHatRed.png" alt="">
                            <h2>Pasos</h2>
                        </div>
                        <div>
                            <div>
                                <input type="text" placeholder="Paso">
                                <input type="text" placeholder="minInicio">
                                <input type="text" placeholder="minFinalizacion">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <button id="profile-delete-account"></button>
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/menuDesplegable.js"></script>
</body>
</html>