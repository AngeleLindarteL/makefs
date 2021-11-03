<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="makefsContainer headerContainer">
        <div class="header_icons">
            <a class="headicons_ico" id="nav-menu-btn">
                <figure class="nav-btn-bar"></figure>
                <figure class="nav-btn-bar"></figure>
                <figure class="nav-btn-bar"></figure>
            </a>
            <a class="headicons_ico" href="#"><img src="./img/hico-translate.png" alt="Translate Button"></a>
            <a class="headicons_ico" href="#"><img src="./img/hico-light.png" alt="Theme Menu"></a>
            <a class="headicons_ico" href="#"><img src="./img/hico-home.png" alt="Home Menu"></a>
            <a class="headicons_ico" href="#"><img src="./img/hico-favorites.png" alt="Saved Menu"></a>
        </div>
        <div class="header_logo">
            <article class="headlogo_text">
                <h1>Makefs</h1>
                <h2>Making Chef's</h2>
            </article>
            <img class="headlogo_logo" src="./img/makefs-logo.png">
        </div>
        <div class="header_logreg">
            <a id="userlog">
                <img src="./img/hico-user.png">
            </a>
            <ul id="user_selection" class="userSelectClose">
                <div class="userMiniInfo">
                    <img src="./img/hico-user.png">
                    <div class="infoUser">
                        <h6>$nombre</h6>
                        <p>$email</p>
                    </div>
                </div>
                <a class="headlog_btn" href="">
                    <img class="headlog_ico first" src="./iconos/config.png">
                    <p>Tu cuenta</p>
                </a>
                <a class="headlog_btn" href="">
                    <img class="headlog_ico first" src="./iconos/upload.png">
                    <p>subir contenido</p>
                </a>
                <a class="headlog_btn" href="">
                    <img class="headlog_ico first" src="./iconos/home.png">
                    <p>Principal</p>
                </a>
                <a class="headlog_btn" href="">
                    <img class="headlog_ico first" src="./iconos/theme.png">
                    <p>Cambiar tema</p>
                </a>
                <a class="headlog_btn" href="">
                    <img class="headlog_ico first" src="./iconos/logout.png">
                    <p>Cerrar sesion</p>
                </a>
            </ul>
        </div>
    </div>
</header>
<script src="./js/index.js"></script>
</body>
</html>