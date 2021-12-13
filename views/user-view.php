<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="views/favicon/makefslogo.png">
    <link href="views/css/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="views/css/chef-index.css">
    <link href="views/css/footer.css" rel="stylesheet">
    <link href="views/css/user-view.css" rel="stylesheet">
    <link href="views/css/header.css" rel="stylesheet">
    <link href="views/css/notifications.css" rel="stylesheet">
    <link href="views/css/DarkUser.css" rel="stylesheet">
    <link href="views/css/DarkMenu.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="description" content="Tu perfil Makefs, mira tu informacion personal y modificala">
    <meta name="robots" content="index, follow">
    <title>Perfil - Makefs</title>
    <?php
        include('views/components/sessionControl.php');
        include("views/components/tokenControl.php");
        if(isset($_SESSION["chefid"])){
            header("location: /chef");
        }
    ?>
    <script>
        <?php echo "const id =".$_SESSION['id'] ?>
    </script>
</head>
<body class="White">
    <?php
        include('views/components/header.php');
        include('views/components/menudesplegable.php');
        include("views/components/test_inputs.php");
    ?>
    <div class="makefs-notification">
        <figure class="makefs-notification-rep"></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">Mui bien eres bueno ya seaktualiso tufoto</p></article>
    </div>
    <section id="chef-view">
        <div class="makefsContainer userContainer">
            <div id="userNoChefContainer" class="WhiteChefcont">
                <div class="divUser-view" id="firstdiv">
                    <figure class="profile-pic-user">
                        <img class="profile-pic-img-user" src="mediaDB/usersImg/<?php echo $_SESSION['midpic']; ?>">
                        <button id="profile-edit"></button>
                    </figure>
                    <section class="divUser-view" id="cambiarFoto">
                        <button id="profile-edit-close-chef"></button>
                        <form id="fotoChange" class="WhitePhoto" method="POST">
                            <input type="file" class="updateFotoInput WhiteInPho" name="photo" accept="image/png, image/jpeg,image/jpg" />
                            <input type="submit" name="changeFoto" id="submitFoto" value="Cambiar foto">
                        </form>
                    </section>
                    <section class="divUser-view" id="cambiarPass">
                        <button id="profile-close-passChange"></button>
                        <form action="" id="passChange" class="Whiteform" method="POST">
                            <h2>CAMBIAR CONTRASEÑA</h2>
                            <input type="text" class="passInput" id="passAntigua" placeholder="Tu contraseña Antigua">
                            <input type="text" class="passInput" id="passNew" maxlength="150" placeholder="Contraseña Nueva">
                            <input type="submit" class="passInput" id="changePassSend" class="Whiteinput" name="changePass" value="Actualizar Contraseña">
                        </form>
                    </section>
                    <section class="divUser-view" id="deleteAccountContainer">
                        <button id="profile-close-deleteAccount"></button>
                        <form action="controllers/updateDataUsers/deleteUser.php" id="deleteAccount" method="POST">
                            <h2>BORRAR CUENTA</h2>
                            <h3>Esta decisión es permanente, ingresa tu contraseña para probar que eres tu.</h3>
                            <input type="text" class="passInput" placeholder="Contraseña" name="deleteUserPass">
                            <input type="submit" class="passInput" id="deleteAccountbtn" name="deleteUser" value="Borrar cuenta">
                        </form>
                    </section>
                    <section id="beaChef">
                        <button id="profile-close-bechef"></button>
                        <div id="beChefContainer">
                            <div id="tittleBeChef">
                                <h1>Conviertete en Chef!</h1>
                            </div>
                            <div id="subtittleBeChef">
                                <h3 class="warningh3">Lee detenidamente las condiciones que debes aceptar
                                    para volverte chef!
                                </h3>
                            </div>
                            <div id="makefsContract">
                                <p>
                                1- No subir contenido a la plataforma que no tenga relacion con la preparacion de recetas. <br>
                                2- Se respetuoso con la comunidad. <br>
                                3- Sube tus recetas siguiendo la forma determinada para que su subida sea la correcta en el modelo Makef's.
                                </p>
                            </div>
                            <div id="msgVidContract">
                                <p>Los videos que no estén acorde a la plataforma o que contengan contenido para adultos será eliminado.</p>
                            </div>
                            <div id="divBtnBeChef">
                                <button id="wantBeChefBtn"><h4>Acepto, ¡A Cocinar!</h4><img src="views/img/chefHatRed.png" alt=""></button>
                            </div>
                        </div>
                            
                    </section>
                    <article class="profile-chars-user">
                        <h2 id="user-name"><?php echo test_input($_SESSION["nombre"])?></h2>
                        <p id="username-space">@<?php echo test_input($_SESSION["username"])?></p>
                        <p class="description-user" id="descript-space"><?php echo test_input($_SESSION["description"])?></p>
                        <p id="contact-space">Contacto: <?php echo test_input($_SESSION["email"])?></p>
                        <button class="do-chef" id="btnChangePass">Cambiar Contraseña</button>
                        <button class="do-chef" id="beChefOpenBtn">Conviertete en chef!</button>
                    </article>
                </div>
                <form class="divUser-view importantDataUser" action="" method="POST"> 
                    <div id="socialMediaUser">
                        <div class="socialmediadiv">
                            <a href="<?php echo $_SESSION["facebook"] ?>" id="fbTxT-user" target="__blank"><img src="views/img/user-facebook.png"></a>
                            <input type="text" class="inputsToEnable" id="fbinput" value="<?php echo test_input($_SESSION["facebook"])?>" disabled>
                        </div>
                        <div class="socialmediadiv">
                            <a href="<?php echo $_SESSION["instagram"] ?>" id="igTxT-user" target="__blank"><img src="views/img/user-instagram.png"></a>
                            <input type="text" class="inputsToEnable" id="iginput" value="<?php echo test_input($_SESSION["instagram"])?>" disabled>
                        </div>
                        <div class="socialmediadiv">
                            <a href="<?php echo $_SESSION["twitter"] ?>" id="twTxt-user" target="__blank"><img src="views/img/user-twitter.png"></a>
                            <input type="text" class="inputsToEnable" id="twinput" value="<?php echo test_input($_SESSION["twitter"])?>" disabled>
                        </div>
                        <div class="socialmediadiv">
                            <a href="<?php echo $_SESSION["youtube"] ?>" id="ytTxT-user" target="__blank"><img src="views/img/user-youtube.png"></a>
                            <input type="text" class="inputsToEnable" id="ytinput" value="<?php echo test_input($_SESSION["youtube"])?>" disabled>
                        </div>
                        
                    </div>
                    <div id="infoData-User">
                        <div class="divInfoData-user" id="tittle-info">
                            <h2>Tu informacion.</h2>
                            <div class="editbtninfo">
                                <button id="profile-edit-user"></button>
                                <button id="profile-delete-account"></button>
                            </div>
                        </div>
                        <div class="divInfoData-user" id="input-info">
                            <div class="infodelusuario">
                                <label for="namem" class="Whitelabel">Nombre:</label>
                                <input type="text" class="inputsToEnable WhiteTexti" id="namem" name="namem" maxlength="59" value="<?php echo test_input($_SESSION["nombre"])?>" disabled>
                            </div>
                            <div class="infodelusuario">
                                <label for="username" class="Whitelabel">Username:</label>
                                <input type="text" class="inputsToEnable WhiteTexti" id="username" name="username" maxlength="59" value="<?php echo test_input($_SESSION["username"])?>" disabled>
                            </div>
                            <div class="infodelusuario">
                                <label for="email" class="Whitelabel">Email:</label>
                                <input type="text" class="inputsToEnable WhiteTexti" id="email" name="email" maxlength="69" value="<?php echo test_input($_SESSION["email"])?>" disabled>
                            </div>
                            <div class="infodelusuario">
                                <label for="desc" class="Whitelabel">Description:</label>
                                <input type="text" class="inputsToEnable WhiteTexti" id="descript" name="descript" maxlength="99" value="<?php echo test_input($_SESSION["description"])?>" disabled>
                            </div>
                            <div class="infodelusuario" id="updateInfo">
                                <input type="submit" value="Actualizar" name="updateSocialMedia" id="updateSocial">
                            </div>
                            <p id="status"></p>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
        include('views/components/footer.php');
    ?>
    <script src="views/js/defineUrl.js"></script>
    <script src="views/js/index.js"></script>
    <script src="views/js/chef-view.js"></script>
    <script src="views/js/menuDesplegable.js"></script>
    <script src="views/js/chageInfoUser.js"></script>
    <script src="views/js/upload_pic_user_view.js"></script>
    <script src="views/js/axiosUser.js"></script>
    <script src="views/js/DarkModeUser.js"></script>
    <script src="views/js/darkModeM.js"></script>
</body>
</html>