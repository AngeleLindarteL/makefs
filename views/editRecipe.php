<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edita tus recetas subidas a makefs">
    <meta name="robots" content="index, follow">
    <title>Editando Receta</title>
    <link rel="stylesheet" href="../views/css/normalize.css">
    <link rel="stylesheet" href="../views/css/chef-index.css">
    <link rel="stylesheet" href="../views/css/newRecipeCss.css">
    <link rel="stylesheet" href="../views/css/newRecipeEdit.css">
    <link rel="stylesheet" href="../views/css/header.css">
    <link rel="stylesheet" href="../views/css/footer.css">
    <link rel="stylesheet" href="../views/css/DarkEdit.css">
    <link rel="stylesheet" href="../views/css/DarkMenu.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <?php
        include('views/components/sessionControl.php');
        include("views/components/tokenControl.php");
        include("views/components/test_inputs.php");
        if (!isset($_GET["receta"]) || empty($_GET["receta"])){
            header("location: /error");
            exit;
        }
        $idRecipe = $_GET["receta"];
        $conn = new Conexion;
        $conn = $conn->Conectar();
        $consulta = "SELECT * FROM recipe WHERE recipeid = :ID";
        $data = $conn->prepare($consulta);
        $data->execute(array(":ID"=>$idRecipe));
        $data = $data->fetch(PDO::FETCH_ASSOC);

        if(empty($_SESSION["chefid"])){
            header("location: /error");
        }

        if($_SESSION["chefid"]!=$data["chefid"]){
            header("location: /error");
        }
        
        $nombreRecipe = $data["namer"];
        $region = $data["region"];
        $ingredients = json_decode(base64_decode($data["ingredients"]));
        $etiquetas = json_decode(base64_decode($data["tags"]));
        $steps = json_decode(base64_decode($data["steps"]));
        if($data["privater"]){
            $isPrivate = true;
        }else{
            $isPrivate = false;
        }
        echo <<<EOT
            <script>
                const chefid =$data[chefid]; 
                const recipeid =$idRecipe;
            </script>
        EOT;

    ?>
</head>
<body class="White">
    <?php
        include('views/components/header.php');
        include('views/components/menudesplegable.php');
    ?>
    <section id="newRecipeSection">
        <div class="makefsContainer containerNewRecipe">
            <div id="recipetittlediv2">
                <?php
                    echo <<<EOT
                        <input required type='text' id='recipeTittle' class='Whiterecipetit' maxlength='60' name='recipeTittle' value='$nombreRecipe'>
                        <div id="madePrivate">
                    EOT;
                        if($isPrivate){
                            echo "<input type='checkbox' checked id='madePrivateBtn' value='true' name='madePrivateBtn'>";
                        }else{
                            echo "<input type='checkbox' id='madePrivateBtn' value='true' name='madePrivateBtn'>";
                        }
                            
                    echo <<<EOT
                            <h3>Privado</h3>
                        </div>
                    EOT;
                ?>
                
                <div class="editbtndisplay">
                    <button id="uploadBtn2"><h2>Editar Receta</h2></button>
                    <button id="deleteRecipeBtn"><h2>Eliminar Receta</h2></button>
                </div>
            </div>
            <div id="deleteRecipeConfirm">
                <button id="close-deleteRecipe"></button>
                <div id="menuDeleteRecipe">
                    <h2>BORRAR RECETA</h2>
                    <h3>Seguro que quieres Borrar <?php echo test_input($nombreRecipe)?>?</h3>
                    <input required type="submit" class="passInput" id="deleteRecipe" name="deleteRecipe" value="Borrar receta">
                </div>
            </div>
            <div id="recipebodydiv">
                <div id="barraLateralNewRecipe">
                    <div id="menuIngredientesNewRecipe">
                        <h2 id="ingredientsTittle" class="Whitemaintt">INGREDIENTES
                            <div class="btnplus">
                                <button class="lessInputBtn" id="lessIngrediens"></button><button id="addIngredientBtn"></button>
                            </div>
                            </h2>
                        <div id="inputsLateralesNewRecipe">
                            <?php
                                foreach($ingredients as $ingredient){
                                    echo <<<EOT
                                        <input required type="text" class="ingredient Whiterecipetit" name="ingredients" value="$ingredient">
                                    EOT;
                                }
                            ?>
                        </div>
                    </div>
                    <div id="etiquetasNewRecipe" class="Whitemaintt">
                        <div>
                            <h2>ETIQUETAS</h2>
                        </div>
                        <div id="selectsEtiquetasNewRecipe">
                            <label for="eRegiones" class="Whiterecipetit">Region</label>
                            <select  id="eRegiones" class="Whiterecipetit" disabled>
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
                                        <select  class="etiFood Whiterecipetit">
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
                                        <select  class="etiFood Whiterecipetit">
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
                                        <select  class="etiFood Whiterecipetit">
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
                                        <select  class="etiFood Whiterecipetit">
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
                                        <select  class="etiFood Whiterecipetit">
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
                                        <select  class="etiFood Whiterecipetit">
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
                        <div id="tittlePasos" class="Whitemaintt">
                            <div id="hatPasosyTxt">
                                <img src="../views/img/chefHatRed.png" alt="chef hat">
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
                                    $minIn = explode(":",$step[1]);
                                    $minFn = explode(":",$step[2]);
                                    echo <<<EOT
                                    <div class="oneStepNewRecipe">
                                        <input type="text" class="stepTxtInput steps Whiterecipetit" placeholder="Paso" value="$step[0]">
                                        <div class="minInicioInput steps Whiterecipetit">
                                            <input type="number" class="min-in-input" value="$minIn[0]">
                                            <input type="number" class="min-in-input" value="$minIn[1]">
                                        </div>
                                        <div class="minFinInput steps Whiterecipetit">
                                            <input type="number" class="min-in-input" value="$minFn[0]">  
                                            <input type="number" class="min-in-input" value="$minFn[1]">
                                        </div>
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
    <div class="mini-reproductor MRShowing">
        <video controls="true" src="<?php echo "../mediaDB/recipeVideos/$data[video]"?>"></video>
        <button id="closeMRBtn">x</button>
    </div>
    <?php
        include('views/components/footer.php');
    ?>
    <script src="../views/js/index.js"></script>
    <script src="../views/js/menuDesplegable.js"></script>
    <script src="../views/js/editRecipe.js"></script>
    <script src="../views/js/axiosEditRecipe.js"></script>
    <script src="../views/js/mediaPlayer.js"></script>
    <script src="../views/js/DarkModeEdit.js"></script>
    <script src="../views/js/DarkModeMenu.js"></script>
</body>
</html>