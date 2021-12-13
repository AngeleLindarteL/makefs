<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="../views/favicon/makefslogo.png">
    <link href="../views/css/normalize.css" rel="stylesheet">
    <link href="../views/css/chef-index.css" rel="stylesheet">
    <link href="../views/css/header.css" rel="stylesheet">
    <link href="../views/css/chef-view-change.css" rel="stylesheet">
    <link href="../views/css/notifications.css" rel="stylesheet">
    <link href="../views/css/DarkModecss.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/DarkMenu.css">
    <link rel="stylesheet" href="../views/css/Preloader.css">
    <meta name="description" content="Perfil de chef!, mira las mejores recetas de nuestros chefs.">
    <meta name="robots" content="index, follow">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Makefs Perfil Chef!</title>
    <?php
        include("models/conexion.php");
        include("views/components/test_inputs.php");
        session_start();
        if (!isset($_GET["chef"]) || empty($_GET["chef"])){
            header("location: /error");
            exit;
        }

        if(empty($_SESSION['id'])){
            $_SESSION['id']=0;
            $_SESSION['chefid']=0;
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
            header("location: /error");
            exit;
        }
        
        if(empty($res) || !isset($res)){
            header("location: /error");
        }

        $query = "SELECT COUNT(*) FROM follows WHERE chefid = :chefid";
        try{
            $seguidores = $conn->prepare($query);
            $seguidores->execute(array(
                ":chefid"=>$res['chefid'],
            ));
            $seguidores = $seguidores->fetchColumn();
        }catch(Exception $e){
            header("location: /error");
            exit;
        }
        if($_SESSION["chefid"]==$res["chefid"]){
            $isTheChef = true;
        }else{
            $isTheChef = false;
        }

        if($isTheChef){
            include("views/components/tokenControl.php");
        }

        if($res['verify']=="yes"){
            $isVerify = true;
        }else{
            $isVerify = false;
        }
        $query = "SELECT * FROM follows WHERE chefid = :chefid AND followerid = :followerid";
        try{
            $follow = $conn->prepare($query);
            $follow->execute(array(
                ":chefid"=>$res['chefid'],
                ":followerid"=>$_SESSION['id']
            ));
            $follow = $follow->fetch(PDO::FETCH_ASSOC);
            if(isset($follow["idfollow"])){
                $followid = $follow["idfollow"];
            }else{
                $followid = null;
            }
        }catch(Exception $e){
            $followid = null;
            exit;
        }

        $query = "SELECT AVG(star) FROM stars INNER JOIN recipe ON stars.recipeid = recipe.recipeid WHERE chefid = :chefid";
        try{
            $averageGenn = $conn->prepare($query);
            $averageGenn->execute(array(":chefid"=>$res['chefid']));
            $averageGenn = $averageGenn->fetchColumn();
            if (empty($averageGenn)){
                $averageGenn = "0";
            }
            if(sizeof(explode(".",$averageGenn)) == 1){
                $averageGenn = $averageGenn.".0";
            }
        }catch(Exception $e){
            print_r($e);
            exit;
        }
        $recipesCount = "SELECT COUNT(recipeid) FROM recipe WHERE chefid = :chefid";
            try{
                $recipesCount = $conn->prepare($recipesCount);
                $recipesCount->execute(array(":chefid"=>$res['chefid']));
                $recipesCount = $recipesCount->fetchColumn();
            }catch(Exception $e){
                echo "error video $e";
                exit;
            }

        echo <<<EOT
        <script>
            const chefid = $res[chefid];
            const id = $res[userid];
            const followerid = $_SESSION[id];
        </script>
        EOT;

    ?>
</head>
<body class="White">
    <?php
        include('views/components/header.php');
        include('views/components/menudesplegable.php');
        include('views/components/preloader.php');
    ?>
    <div class="makefs-notification">
        <figure class="makefs-notification-rep"></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">Notificacion en espera...</p></article>
    </div>
    <section id="chef-view">
        <div class="makefsContainer chef-view-container">
            <div class="right-chef-view-menu">
                <div class="chef-char">
                    <div class="char-template">
                        <figure class="profile-pic">
                            <img class="profile-pic-img" src="../mediaDB/usersImg/<?php echo $res['midpic']; ?>" alt="imagen de usuario">
                            <?php if($isTheChef){ echo "<a id='profile-edit'></a>";} ?>
                            <?php if($isVerify){ echo "<img class='verified' src='../views/img/chef-verified.png' alt='verificacion'> ";} ?>
                            <div class="followers" ><img src="../views/img/hico-followers.png" alt="seguidores"><p id="followersSection" ><?php echo $seguidores ?></p></div>
                        </figure>
                        <article class="profile-chars">
                            
                            <h2 id="chef-name"><?php echo test_input($res["namem"]);?></h2>
                            <p id="username-space-chef" >@<?php echo test_input($res["username"])?></p>
                            <div class="summary-info">
                                <article><span></span><p><?php echo number_format($averageGenn,1)?> Valoración</p></article>
                                <article><span></span><p><?php echo $recipesCount?> Recetas</p></article>
                            </div>
                            <p class="description" id="description-space-chef"><?php echo test_input($res["descript"])?></p>
                            <p id="contact-space-chef">Contacto: <?php echo  test_input($res["email"])?></p>
                            <ul class="chef-social-media">
                                <a href="<?php echo test_input($res["facebook"]) ?>" id="fbTxT" target="__blank"><img src="../views/img/user-facebook.png" alt="facebookPage"></a>
                                <a href="<?php echo test_input($res["instagram"]) ?>" id="igTxT" target="__blank"><img src="../views/img/user-instagram.png" alt="instagramPage"></a>
                                <a href="<?php echo test_input($res["twitter"]) ?>" id="twTxt" target="__blank"><img src="../views/img/user-twitter.png" alt="twitterPage"></a>
                                <a href="<?php echo test_input($res["youtube"]) ?>" id="ytTxT" target="__blank"><img src="../views/img/user-youtube.png" alt="youtubeChannel"></a>
                            </ul>
                            <?php
                                if($_SESSION['id']==0){
                                    echo <<<EOT
                                        <button id='followUnloged'>seguir</button>
                                        <div id='unlogedFollowSect'>
                                            <button id="close-UnlogedFollow"></button>
                                            <div id='unlogedFollowDiv'>
                                                <h4>Para seguir a un usuario debes estar logueado!</h4>
                                                <button id="logRedirect">LogIn</button>
                                            </div>
                                        </div>
                                    EOT;
                                }else{
                                    if(!$isTheChef){
                                        if(isset($followid)){
                                            echo "<button id='follow-button'>siguiendo</button>";
                                        }else{
                                            echo "<button id='follow-button'>seguir</button>";
                                        }
                                    }
                                }
                            ?>
                            
                        </article>
                    </div>
                </div>
                <?php
                    if($isTheChef){
                        echo <<<EOT
                            <div class="action-buttons-container">
                                <a href="/newrecipe" class="action-btn"><img src="../views/img/chef-add.png" alt="agregar"><p>Añadir recetas</p></a>
                                <a class="action-btn"><img src="../views/img/chef-flag.png" alt="reportar"><p>Reportes</p></a>
                                <button id="chef-config"></button>
                            </div>
                        EOT;
                    }
                ?>
            </div>
            <div class="edit-recipe-container">
                <?php
                    if(!$isTheChef){
                        $recipesSQL = "SELECT recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname,CAST(AVG(stars.star) AS DECIMAL(10,1)) AS rate FROM recipe INNER JOIN stars ON stars.recipeid = recipe.recipeid WHERE recipe.chefid = :chefid AND recipe.privater = FALSE GROUP BY (recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname)";
                    }else{
                        $recipesSQL = "SELECT recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname,CAST(AVG(stars.star) AS DECIMAL(10,1)) AS rate FROM recipe INNER JOIN stars ON stars.recipeid = recipe.recipeid WHERE recipe.chefid = :chefid GROUP BY (recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname)";
                    }   
                    try{
                        $recipesSQL = $conn->prepare($recipesSQL);
                        $recipesSQL->execute(array(":chefid"=>$res['chefid']));
                    }catch(Exception $e){
                        echo "error video $e";
                        exit;
                    }
                    while($dataRecipes = $recipesSQL->fetch(PDO::FETCH_ASSOC)){
                        if($dataRecipes["privater"]){
                            $isPrivate = true;
                        }else{
                            $isPrivate = false;
                        }
                        echo <<<EOT
                            <div class="recipe-template editable-recipe">
                                <a class="image-template" href="/recipe/$dataRecipes[recipeid]">
                                    <img src="../mediaDB/recipeImages/$dataRecipes[imagen]" alt="imagen de receta">
                                    <figure class="star-template WhiteStar"><img src="../views/img/hico-star-red.png" alt="estrellas de receta"><b id="starCount">$dataRecipes[rate]</b></figure>
                                </a>
                                <div class="next-text-recipe WhiteModeP">
                                    <img src="../mediaDB/usersImg/$res[midpic]" alt="imagen de usuario">
                                    <a href="/chef/$res[chefid]">
                            EOT;
                                    echo "<h3 class='text-template'>".test_input($dataRecipes['namer'])."</h3>";
                                    echo "<p>".test_input($res['username'])."</p>";
                        echo <<<EOT
                                        <p>$dataRecipes[views] Views</p>
                                    </a>
                            </div>
                        EOT;
                            if($isTheChef){ echo "<a class='edit-template' href='/editrecipe/$dataRecipes[recipeid]' ></a>";}
                            if($isPrivate){ echo "<a class='private-template'></a>";}
                        echo "</div>";
                        $recipe = true;
                    }
                    if(empty($dataRecipes["recipeid"]) && empty($recipe)){
                        if($isTheChef){
                            echo <<<EOT
                                <div id="notFoundRecipes" class="WhiteBannerNone">
                                    <img src="../views/img/notFoundRecipes.png" alt="recetas no encontradas">
                                    <h3>No tienes recetas aún! Empieza a subir contenido!</h3>
                                </div>
                            EOT;
                        }else{
                            echo <<<EOT
                                <div id="notFoundRecipes">
                                    <img src="../views/img/notFoundRecipes.png" alt="recetas no encontradas">
                                    <h3>Este chef no tiene recetas!</h3>
                                </div>
                            EOT;
                        }
                    }
                   
                ?>
            </div>
        </div>
    </section>
    <section class="chefsContainer" id="changeInfoChef">
        <button id="profile-edit-close"></button>
        <div id="chefContainer" class="WhiteChefCont">
            <div class="divChef-view" id="firstdiv-chef">
                <figure class="profile-pic-chef" id="change-chef-info-pic">
                        <img class="profile-pic-img-chef" src="../mediaDB/usersImg/<?php echo $res['midpic']; ?>" alt="imagen de usuario">
                        <?php if($isVerify){ echo "<img class='verified' src='../views/img/chef-verified.png' alt='verificacion'> ";} ?>
                        <button id="profile-edit-photo"></button>
                </figure>
                <section class="divChef-view" id="cambiarFoto-chef">
                    <button id="profile-edit-close-chef2"></button>
                    <form action="" id="fotoChange-chef" class="WhitePhoto" method="POST">
                        <input type="file" accept="image/png, image/jpeg,image/jpg"class="updateFotoInput-chef WhiteInputPhoto" name="profilepic">
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
                    <form action="../controllers/updateDataUsers/deleteUser.php" id="deleteAccount-chef" class="WhiteDelete" method="POST">
                        <h2>BORRAR CUENTA</h2>
                        <h3>Para eliminar tu cuenta verifica que eres tu, pon tu contraseña en el campo.</h3>
                        <input type="text" class="passInput-chef" placeholder="Contraseña" name="deleteUserPass">
                        <input type="submit" class="passInput-chef" id="deleteAccountbtn-chef" name="deleteUser" value="Borrar cuenta">
                    </form>
                </section>
                <article class="profile-chars-chef">
                    <h2 id="chef-name-changing"><?php echo test_input($res["namem"])?></h2>
                    <p id="username-space-chef-changing" >@<?php echo test_input($res["username"])?></p>
                    <p class="description" id="description-space-chef-changing"><?php echo test_input($res["descript"])?></p>
                    <p id="contact-space-chef-changing">Contacto: <?php echo test_input($res["email"])?></p>
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
                            <div class="infodelchef whiteTitleInput">
                                <label for="name">Nombre:</label>
                                <input type="text" class="infoInputsChef" maxlength="59" id="name-chef" name="namem" value="<?php echo test_input($res["namem"])?>" disabled>
                            </div>
                            <div class="infodelchef whiteTitleInput">
                                <label for="username">Username:</label>
                                <input type="text" class="infoInputsChef" maxlength="59" id="username-chef" name="username" value="<?php echo test_input($res["username"])?>" disabled>
                            </div>
                            <div class="infodelchef whiteTitleInput">
                                <label for="email">Email:</label>
                                <input type="text" class="infoInputsChef" maxlength="69" id="email-chef" name="email" value="<?php echo test_input($res["email"])?>" disabled>
                            </div>
                            <div class="infodelchef whiteTitleInput">
                                <label for="desc">Description:</label>
                                <input type="text" class="infoInputsChef" maxlength="99" id="descript-chef" name="descript" value="<?php echo test_input($res["descript"])?>" disabled>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div id="socialMediaChef">
                        <div class="socialmediadiv-chef">
                            <img src="../views/img/user-facebook.png" alt="facebookPage">
                            <input type="text" class="infoInputsChef" id="fbinput-Chef" value="<?php echo test_input($res["facebook"])?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="../views/img/user-instagram.png" alt="instagramPage">
                            <input type="text" class="infoInputsChef" id="iginput-Chef" value="<?php echo test_input($res["instagram"])?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="../views/img/user-twitter.png" alt="twitterPage">
                            <input type="text" class="infoInputsChef" id="twinput-chef" value="<?php echo test_input($res["twitter"])?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="../views/img/user-youtube.png" alt="youtubeChannel">
                            <input type="text" class="infoInputsChef" id="ytinput-Chef" value="<?php echo test_input($res["youtube"])?>" disabled>
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
        if($_SESSION['id']!=0){
            echo <<<EOT
                <script src="../views/js/chageInfoUserChef.js"></script>
                <script src="../views/js/upload_pic_chef.js"></script>
                <script src="../views/js/axiosFollow.js"></script>
                <script src="../views/js/axiosChef.js"></script>
            EOT;
        }
    ?>
    
    <script src="../views/js/defineUrl.js"></script>
    <script src="../views/js/index.js"></script>
    <script src="../views/js/chef-view.js"></script>
    <script src="../views/js/menuDesplegable.js"></script>
    <script src="../views/js/followUnloged.js"></script>
    <script src="../views/js/darkMode.js"></script>
    <script src="../views/js/DarkLoader.js"></script>
    <script src="../views/js/DarkModeMenu.js"></script>
    <script src="../views/js/preloader.js"></script>
</body>
</html>