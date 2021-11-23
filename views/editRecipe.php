<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Receta</title>
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
    <?php
        
        $idRecipe = 27;
        $conn = new Conexion;
        $conn = $conn->Conectar();
        $consulta = "SELECT * FROM recipe WHERE recipeid = :ID";
        $data = $conn->prepare($consulta);
        $data->execute(array(":ID"=>$idRecipe));
        $data = $data->fetch(PDO::FETCH_ASSOC);
        
        $nombreRecipe = $data["namer"];
        $region = $data["region"];
        $ingredients = json_decode(base64_decode($data["ingredients"]));
        $etiquetas = json_decode(base64_decode($data["tags"]));
        $steps = json_decode(base64_decode($data["steps"]));

    ?>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <section id="newRecipeSection">
        <div class="makefsContainer containerNewRecipe">
            <div id="recipetittlediv">
                <?php
                    echo "<input type='text' id='recipeTittle' maxlength='60' name='recipeTittle' value='$nombreRecipe'>";
                ?>
                <button id="uploadBtn2"><h2>Editar Receta</h2></button>
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
                            <?php
                                foreach($ingredients as $ingredient){
                                    echo <<<EOT
                                        <input type="text" class="ingredient" name="ingredients" value="$ingredient">
                                    EOT;
                                }
                            ?>
                        </div>
                    </div>
                    <div id="etiquetasNewRecipe">
                        <div>
                            <h2>ETIQUETAS</h2>
                        </div>
                        <div id="selectsEtiquetasNewRecipe">
                            <label for="eRegiones">Region</label>
                            <select name="eRegiones" id="eRegiones" disabled>
                                <option value="<?php echo $region;?>" selected><?php echo $region;?></option>
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
                            <?php
                                foreach($etiquetas as $etiqueta){
                                    if($region=="latam"){
                                        echo <<<EOT
                                        <select name="eRegiones" id="eRegiones">
                                            <option value="$etiqueta" hidden selected>$etiqueta</option>
                                            <option value="latamSopa">Sopa</option>
                                            <option value="latamVegana">Vegana</option>
                                            <option value="latamGourmet">Gourmet</option>
                                            <option value="latamPostres">Poster</option>
                                            <option value="latamCasero">Casero</option>
                                            <option value="latamTipica">Tipica</option>
                                        </select>
                                        EOT; 
                                    }elseif ($region=="asia") {
                                        echo <<<EOT
                                        <select name="eRegiones" id="eRegiones">
                                            <option value="$etiqueta" hidden selected>$etiqueta</option>
                                            <option value="asiaSopa">Sopa</option>
                                            <option value="asiaVegana">Vegana</option>
                                            <option value="asiaGourmet">Gourmet</option>
                                            <option value="asiaPostres">Poster</option>
                                            <option value="asiaCasero">Casero</option>
                                            <option value="asiaTipica">Tipica</option>
                                        </select>
                                        EOT; 
                                    }elseif ($region=="norteA") {
                                        echo <<<EOT
                                        <select name="eRegiones" id="eRegiones">
                                            <option value="$etiqueta" hidden selected>$etiqueta</option>
                                            <option value="norteSopa">Sopa</option>
                                            <option value="norteVegana">Vegana</option>
                                            <option value="norteGourmet">Gourmet</option>
                                            <option value="nortePostres">Poster</option>
                                            <option value="norteCasero">Casero</option>
                                            <option value="norteTipica">Tipica</option>
                                        </select>
                                        EOT; 
                                    }elseif ($region=="europa") {
                                        echo <<<EOT
                                        <select name="eRegiones" id="eRegiones">
                                            <option value="$etiqueta" hidden selected>$etiqueta</option>
                                            <option value="europaSopa">Sopa</option>
                                            <option value="europaVegana">Vegana</option>
                                            <option value="europaGourmet">Gourmet</option>
                                            <option value="europaPostres">Poster</option>
                                            <option value="europaCasero">Casero</option>
                                            <option value="europaTipica">Tipica</option>
                                        </select>
                                        EOT; 
                                    }elseif ($region=="africa") {
                                        echo <<<EOT
                                        <select name="eRegiones" id="eRegiones">
                                            <option value="$etiqueta" hidden selected>$etiqueta</option>
                                            <option value="africaSopa">Sopa</option>
                                            <option value="africaVegana">Vegana</option>
                                            <option value="africaGourmet">Gourmet</option>
                                            <option value="africaPostres">Poster</option>
                                            <option value="africaCasero">Casero</option>
                                            <option value="africaTipica">Tipica</option>
                                        </select>
                                        EOT; 
                                    }elseif ($region=="oceania") {
                                        echo <<<EOT
                                        <select name="eRegiones" id="eRegiones">
                                            <option value="$etiqueta" hidden selected>$etiqueta</option>
                                            <option value="oceaniaSopa">Sopa</option>
                                            <option value="oceaniaVegana">Vegana</option>
                                            <option value="oceaniaGourmet">Gourmet</option>
                                            <option value="oceaniaPostres">Poster</option>
                                            <option value="oceaniaCasero">Casero</option>
                                            <option value="oceaniaTipica">Tipica</option>
                                        </select>
                                        EOT; 
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="sectionEditRecipeMultimedia">
                    <div id="stepsEditRecipe">
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
                            <?php
                                foreach($steps as $step){
                                    echo <<<EOT
                                    <div class="oneStepNewRecipe">
                                        <input type="text" class="stepTxtInput steps" value="$step[0]">
                                        <input type="text" class="minInicioInput steps" value="$step[1]">
                                        <input type="text" class="minFinInput steps" value="$step[2]">
                                    </div>
                                    EOT;
                                }
                            ?>
                            
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
</body>
</html>