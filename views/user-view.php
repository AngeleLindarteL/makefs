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
    <title>Perfil</title>
    <?php
        include('./components/sessionControl.php');
    ?>
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
                            <img class="profile-pic-img-user" src="./test-imgs/xd.jpg">
                            <img class="verified-user" src="./img/chef-verified.png">
                            <button id="profile-edit"></button>
                    </figure>
                    <section class="divUser-view" id="cambiarFoto">
                        <form action="" id="fotoChange" method="POST">
                            <label for="profilepic"></label>
                            <input type="file" class="updateFotoInput" name="profilepic">
                            <input type="submit" name="changeFoto" id="submitFoto" value="cambiar foto">
                        </form>
                    </section>
                    <article class="profile-chars-user">
                        <h2 id="user-name">Angel Lindarte</h2>
                        <p class="description-user">17 Años <br> Chef y Software Engineer <br> Contacto: angel@angel.com</p>
                        <button id="do-chef">Cambiar Contraseña</button>
                        <button id="do-chef">Conviertete en chef!</button>
                    </article>
                </div>
                <form class="divUser-view importantDataUser" action="" method="POST"> 
                    <div id="socialMediaUser">
                        <div class="socialmediadiv">
                            <img src="./img/user-facebook.png" alt="">
                            <input type="text" placeholder="Facebook/yourUser/">
                        </div>
                        <div class="socialmediadiv">
                            <img src="./img/user-instagram.png" alt="">
                            <input type="text" placeholder="Instagram/yourUser/">
                        </div>
                        <div class="socialmediadiv">
                            <img src="./img/user-twitter.png" alt="">
                            <input type="text" placeholder="Twitter/yourUser/">
                        </div>
                        <div class="socialmediadiv">
                            <img src="./img/user-youtube.png" alt="">
                            <input type="text" placeholder="Youtube/yourUser/">
                        </div>
                        
                    </div>
                    <div id="infoData-User">
                        <div class="divInfoData-user" id="tittle-info">
                            <h2>Tu informacion.</h2>
                            <button id="profile-edit-user"></button>
                        </div>
                        <div class="divInfoData-user" id="input-info">
                            <div class="infodelusuario">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" >
                            </div>
                            <div class="infodelusuario">
                                <label for="username">Username:</label>
                                <input type="text" name="username" >
                            </div>
                            <div class="infodelusuario">
                                <label for="email">Email:</label>
                                <input type="text" name="email" >
                            </div>
                            <div class="infodelusuario" id="updateInfo">
                                <input type="submit" value="Actualizar" name="actualizar redes">
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/chef-view.js"></script>
    <script src="./js/menuDesplegable.js"></script>
</body>
</html>