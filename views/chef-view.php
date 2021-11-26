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
    <link href="./css/chef-view-change.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Chef view</title>
    <?php
        include('./components/sessionControl.php');
        include("./components/tokenControl.php");
        if (!isset($_GET["chef"]) || empty($_GET["chef"])){
            header("location: ./error.html");
            exit;
        }
        $chefId = $_GET["chef"];
        $conn = new Conexion();
        $conn = $conn->Conectar();
        $query = "SELECT * FROM chef INNER JOIN userm ON chef.userid = userm.userid WHERE chef.chefid = $chefId";
        try{
            $res = $conn->prepare($query);
            $res->execute();
            $res = $res->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            header("location: ./error.html");
            exit;
        }
        
        if(empty($res) || !isset($res)){
            header("location: ./error.html");
        }

        $query = "SELECT COUNT(*) FROM follows WHERE chefid = :chefid";
        try{
            $seguidores = $conn->prepare($query);
            $seguidores->execute(array(
                ":chefid"=>$res['chefid'],
            ));
            $seguidores = $seguidores->fetchColumn();
        }catch(Exception $e){
            header("location: ./error.html");
            exit;
        }
        echo <<<EOT
        <script>
            const chefid = $res[chefid];
            const id = $res[userid];
        </script>
        EOT;

        if($_SESSION["chefid"]==$res["chefid"]){
            $isTheChef = true;
        }else{
            $isTheChef = false;
        }

        if($res['verify']=="yes"){
            $isVerify = true;
        }else{
            $isVerify = false;
        }
    ?>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <section id="chef-view">
        <div class="makefsContainer chef-view-container">
            <div class="right-chef-view-menu">
                <div class="chef-char">
                    <div class="char-template">
                        <figure class="profile-pic">
                            <img class="profile-pic-img" src="../mediaDB/usersImg/<?php echo $res['midpic']; ?>">
                            <?php if($isTheChef){ echo "<a id='profile-edit'></a>";} ?>
                            <?php if($isVerify){ echo "<img class='verified' src='./img/chef-verified.png'>";} ?>
                            <div class="followers"><img src="./img/hico-followers.png"><p><?php echo $seguidores ?> subs</p></div>
                        </figure>
                        <article class="profile-chars">
                            <h2 id="chef-name"><?php echo $res["namem"]?></h2>
                            <p id="username-space-chef" >@<?php echo $res["username"]?></p>
                            <div class="summary-info">
                                <article><span></span><p>5.0 Valoración</p></article>
                                <article><span></span><p>11 Recetas</p></article>
                            </div>
                            <p class="description" id="description-space-chef"><?php echo $res["descript"]?></p>
                            <p id="contact-space-chef">Contacto: <?php echo $res["email"]?></p>
                            <ul class="chef-social-media">
                                <a href="<?php echo $res["facebook"] ?>" id="fbTxT" target="__blank"><img src="./img/user-facebook.png"></a>
                                <a href="<?php echo $res["instagram"] ?>" id="igTxT" target="__blank"><img src="./img/user-instagram.png"></a>
                                <a href="https://twitter.com" target="__blank"><img src="./img/user-twitter.png"></a>
                                <a href="<?php echo $res["youtube"] ?>" id="ytTxT" target="__blank"><img src="./img/user-youtube.png"></a>
                            </ul>
                        </article>
                    </div>
                </div>
                <?php
                    if($isTheChef){
                        echo <<<EOT
                            <div class="action-buttons-container">
                                <a href="./newRecipe.php" class="action-btn"><img src="./img/chef-add.png"><p>Añadir recetas</p></a>
                                <a class="action-btn"><img src="./img/chef-flag.png"><p>Reportes</p></a>
                                <button id="chef-config"></button>
                            </div>
                        EOT;
                    }
                ?>
            </div>
            <div class="edit-recipe-container">
                <?php
                    $recipesSQL = "SELECT * FROM recipe WHERE chefid = :chefid";
                    try{
                        $recipesSQL = $conn->prepare($recipesSQL);
                        $recipesSQL->execute(array(":chefid"=>$res['chefid']));
                    }catch(Exception $e){
                        echo "error video $e";
                        exit;
                    }
                    while($dataRecipes = $recipesSQL->fetch(PDO::FETCH_ASSOC)){
                        echo <<<EOT
                            <div class="recipe-template editable-recipe">
                                <a class="image-template" href="./ddr.php?video=$dataRecipes[recipeid]" target="__blank">
                                    <img src="../mediaDB/recipeImages/$dataRecipes[imagen]">
                                    <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                                </a>
                                <div class="next-text-recipe">
                                    <img src="../mediaDB/usersImg/$res[midpic]">
                                    <a href="./chef-view.php?chef=$res[chefid]" target="__blank">
                                        <h3 class="text-template">$dataRecipes[namer]</h3>
                                        <p>$res[username]</p>
                                        <p>10M Vistas</p>
                                    </a>
                                </div>
                        EOT;
                            if($isTheChef){ echo "<a class='edit-template'></a>";}
                        echo "</div>";
                        
                    }
                ?>
            </div>
        </div>
    </section>
    <section class="chefsContainer" id="changeInfoChef">
        <button id="profile-edit-close"></button>
        <div id="chefContainer">
            <div class="divChef-view" id="firstdiv-chef">
                <figure class="profile-pic-chef">
                        <img class="profile-pic-img-chef" src="../mediaDB/usersImg/<?php echo $res['midpic']; ?>">
                        <img class="verified-chef" src="./img/chef-verified.png">
                        <button id="profile-edit-photo"></button>
                </figure>
                <section class="divChef-view" id="cambiarFoto-chef">
                    <button id="profile-edit-close-chef2"></button>
                    <form action="" id="fotoChange-chef" method="POST">
                        <input type="file" class="updateFotoInput-chef" name="profilepic">
                        <input type="submit" name="changeFoto" id="submitFoto-chef" value="Cambiar foto">
                    </form>
                </section>
                <section class="divUser-view" id="cambiarPass-chef">
                    <button id="profile-close-passChange-chef"></button>
                    <form action="" id="passChange-chef" method="POST">
                        <h2>CAMBIAR CONTRASEÑA</h2>
                        <input type="text" class="passInput-chef" id="passAntiguaChef" placeholder="Tu contraseña Antigua">
                        <input type="text" class="passInput-chef" id="passNewChef" maxlength="150" placeholder="Contraseña Nueva">
                        <input type="submit" class="passInput-chef" id="changePassSend-chef" name="changePass" value="Actualizar Contraseña">
                    </form>
                </section>
                <section class="divUser-view" id="deleteAccountContainer-chef">
                    <button id="profile-close-deleteAccount-chef"></button>
                    <form action="../controllers/updateDataUsers/deleteUser.php" id="deleteAccount-chef" method="POST">
                        <h2>BORRAR CUENTA</h2>
                        <h3>Para eliminar tu cuenta verifica que eres tu, pon tu contraseña en el campo.</h3>
                        <input type="text" class="passInput-chef" placeholder="Contraseña" name="deleteUserPass">
                        <input type="submit" class="passInput-chef" id="deleteAccountbtn-chef" name="deleteUser" value="Borrar cuenta">
                    </form>
                </section>
                <article class="profile-chars-chef">
                    <h2 id="chef-name-changing"><?php echo $res["namem"]?></h2>
                    <p id="username-space-chef-changing" >@<?php echo $res["username"]?></p>
                    <p class="description" id="description-space-chef-changing"><?php echo $res["descript"]?></p>
                    <p id="contact-space-chef-changing">Contacto: <?php echo $res["email"]?></p>
                    <button id="pass-change">Cambiar Contraseña</button>
                </article>
            </div>
            <form class="divChef-view importantDataChef" action="" method="POST"> 
                    <div id="infoData-chef">
                        <div class="divInfoData-chef" id="tittle-info-chef">
                            <h2>Tu informacion.</h2>
                            <div class="editbtninfo">
                                <button id="profile-edit-chef"></button>
                                <button id="profile-delete-account-chef"></button>
                            </div>
                        </div>
                        <div class="divInfoData-chef" id="input-info-chef">
                            <div class="infodelchef">
                                <label for="name">Nombre:</label>
                                <input type="text" class="infoInputsChef" maxlength="59" id="name-chef" name="namem" value="<?php echo $res["namem"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="username">Username:</label>
                                <input type="text" class="infoInputsChef" maxlength="59" id="username-chef" name="username" value="<?php echo $res["username"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="email">Email:</label>
                                <input type="text" class="infoInputsChef" maxlength="69" id="email-chef" name="email" value="<?php echo $res["email"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="desc">Description:</label>
                                <input type="text" class="infoInputsChef" maxlength="99" id="descript-chef" name="descript" value="<?php echo $res["descript"]?>" disabled>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div id="socialMediaChef">
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-facebook.png" alt="">
                            <input type="text" class="infoInputsChef" id="fbinput-Chef" value="<?php echo $res["facebook"]?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-instagram.png" alt="">
                            <input type="text" class="infoInputsChef" id="iginput-Chef" value="<?php echo $res["instagram"]?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-twitter.png" alt="">
                            <input type="text" class="infoInputsChef" placeholder="Twitter/yourUser/" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-youtube.png" alt="">
                            <input type="text" class="infoInputsChef" id="ytinput-Chef" value="<?php echo $res["youtube"]?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef" id="updateInfo">
                                <input type="submit" value="Actualizar" name="updateSocialMedia" id="socialUpdateChef">
                        </div>
                </div>    
                </form>
                <p id="status-chef"></p>
        </div>
    </section>
    <?php
        include('./components/footer.php');
    ?>
    
    <script src="./js/index.js"></script>
    <script src="./js/chef-view.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/chageInfoUserChef.js"></script>
    <script src="./js/axiosChef.js"></script>
    <script src="./js/darkMode.js"></script>
    <script src="./js/upload_pic_chef.js"></script>
</body>
</html>