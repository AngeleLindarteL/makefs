<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/user-view.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Perfil</title>
    <?php
        include('./components/sessionControl.php');
    ?>
    <script>
        <?php echo "const id =".$_SESSION['id'] ?>
    </script>
    <?php include("./components/tokenControl.php") ?>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <section id="chef-view">
        <div class="makefsContainer userContainer">
            <div id="userNoChefContainer">
                <div class="divUser-view" id="firstdiv">
                    <figure class="profile-pic-user">
                            <img class="profile-pic-img-user" src="<?php echo $_SESSION['pic']; ?>">
                            <img class="verified-user" src="./img/chef-verified.png">
                            <button id="profile-edit"></button>
                    </figure>
                    <section class="divUser-view" id="cambiarFoto">
                        <button id="profile-edit-close-chef"></button>
                        <form action="" id="fotoChange" method="POST">
                            <input type="file" class="updateFotoInput" name="profilepic">
                            <input type="submit" name="changeFoto" id="submitFoto" value="Cambiar foto">
                        </form>
                    </section>
                    <section class="divUser-view" id="cambiarPass">
                        <button id="profile-close-passChange"></button>
                        <form action="" id="passChange" method="POST">
                            <h2>CAMBIAR CONTRASEÑA</h2>
                            <input type="text" class="passInput" placeholder="Tu contraseña Antigua">
                            <input type="text" class="passInput" placeholder="Contraseña Nueva">
                            <input type="submit" class="passInput" id="changePassSend" name="changePass" value="Actualizar Contraseña">
                        </form>
                    </section>
                    <section class="divUser-view" id="deleteAccountContainer">
                        <button id="profile-close-deleteAccount"></button>
                        <form action="" id="deleteAccount" method="POST">
                            <h2>BORRAR CUENTA</h2>
                            <h3>Para eliminar tu cuenta verifica que eres tu, pon tu contraseña en el campo.</h3>
                            <input type="text" class="passInput" placeholder="Contraseña">
                            <input type="submit" class="passInput" id="deleteAccountbtn" name="changePass" value="Borrar cuenta">
                        </form>
                    </section>
                    <article class="profile-chars-user">
                        <h2 id="user-name"><?php echo $_SESSION["nombre"]?></h2>
                        <p id="username-space">@<?php echo $_SESSION["username"]?></p>
                        <p class="description-user" id="descript-space"><?php echo $_SESSION["description"]?></p>
                        <p id="contact-space">Contacto: <?php echo $_SESSION["email"]?></p>
                        <button class="do-chef" id="btnChangePass">Cambiar Contraseña</button>
                        <button class="do-chef">Conviertete en chef!</button>
                    </article>
                </div>
                <form class="divUser-view importantDataUser" action="../controllers/updateDataUsers/updateSinAxios.php" method="POST"> 
                    <div id="socialMediaUser">
                        <div class="socialmediadiv">
                            <img src="./img/user-facebook.png" alt="">
                            <input type="text" class="inputsToEnable" placeholder="Facebook/yourUser/" disabled>
                        </div>
                        <div class="socialmediadiv">
                            <img src="./img/user-instagram.png" alt="">
                            <input type="text" class="inputsToEnable" placeholder="Instagram/yourUser/" disabled>
                        </div>
                        <div class="socialmediadiv">
                            <img src="./img/user-twitter.png" alt="">
                            <input type="text" class="inputsToEnable" placeholder="Twitter/yourUser/" disabled>
                        </div>
                        <div class="socialmediadiv">
                            <img src="./img/user-youtube.png" alt="">
                            <input type="text" class="inputsToEnable" placeholder="Youtube/yourUser/" disabled>
                        </div>
                        
                    </div>
                    <div id="infoData-User">
                        <div class="divInfoData-user" id="tittle-info">
                            <h2>Tu informacion.</h2>
                            <button id="profile-edit-user"></button>
                            <button id="profile-delete-account"></button>
                        </div>
                        <div class="divInfoData-user" id="input-info">
                            <div class="infodelusuario">
                                <label for="namem">Nombre:</label>
                                <input type="text" class="inputsToEnable" id="namem" name="namem" value="<?php echo $_SESSION["nombre"]?>" disabled>
                            </div>
                            <div class="infodelusuario">
                                <label for="username">Username:</label>
                                <input type="text" class="inputsToEnable" id="username" name="username" value="<?php echo $_SESSION["username"]?>" disabled>
                            </div>
                            <div class="infodelusuario">
                                <label for="email">Email:</label>
                                <input type="text" class="inputsToEnable" id="email" name="email" value="<?php echo $_SESSION["email"]?>" disabled>
                            </div>
                            <div class="infodelusuario">
                                <label for="desc">Description:</label>
                                <input type="text" class="inputsToEnable" id="descript" name="descript" value="<?php echo $_SESSION["description"]?>" disabled>
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
    <script src="./js/index.js"></script>
    <script src="./js/chef-view.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/chageInfoUser.js"></script>
    <script src="./js/axiosUser.js"></script>
</body>
</html>