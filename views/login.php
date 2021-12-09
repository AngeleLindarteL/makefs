<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/makefslogo.png">
    <link href="./css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/notificationsLog.css">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/DarkLogin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&family=Zen+Kaku+Gothic+New:wght@300&display=swap" rel="stylesheet">
    <meta name="description" content="Logueate en Makefs!">
    <meta name="robots" content="index, follow">
    <title>Login - Makefs</title>
    <?php
        include('./components/sessionControlUnloged.php');
    ?>
    <?php include("./components/tokenControl.php") ?>
</head>
<body class="White">
    <header id="header">
        <div class="logocont">
            <h1>Makef's</h1>
        </div>
        <div class="titlecont">
            <a href="./index.php">
              <img src="./img/makefs-logo.png" alt="logo makefs">
            </a>
        </div>
        <div class="responsive-header">
            <h1>Makef's</h1>
        </div>
    </header>
    <section id="continfo">
        <div class="viewlogo">
            <a href="./index.php"><img src="./img/makefsinvert.jpg" alt="logo makefs"></a>
            <h6>makef's</h6>
        </div>
        <div class="formcont">
            <div class="info-form">
                <form action="../controllers/loginC.php" method="POST" class="form-done">
                    <a class="aback" href="./index.php"><img class="Whiteimg" src="./iconos/second-back.svg" alt="backbtn"><h6 class="Whiteback">Volver</h6></a>
                    <h1 class="Whiteform">Inicia sesión</h1>
                    <h5 class="mainsubtitle Whiteform">Nombre de usuario</h5>
                    <input class="inputtxt Whiteinp" type="text" name="username" required>
                    <h5 class="Whiteform">Contraseña</h5>
                    <input class="inputtxt Whiteinp" type="password" name="pw" required>
                    <input type="submit" name="logeo" value="Ingresar" class="submitbtn">
                    <h4 class="aregister Whiteform"><p>No tienes una cuenta?</p><span><a href="./register.php"> Registrate!</a></span></h4>
                    <h4 class="aregister forgetpsw Whiteform"><p>Perdiste tu contraseña?</p><span><a href=""> Recuperala!</a></span></h4>

                </form>
            </div>
        </div>
    </section>
    <?php
        if(isset($_SESSION["errorLog"])){
            if($_SESSION["errorLog"] == 'user'){
                echo <<<EOT
                    <div class="makefs-notification">
                        <figure class="makefs-notification-rep"></figure>
                        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">Usuario inexistente o equivocado</p></article>
                    </div>
                EOT;
            }elseif($_SESSION["errorLog"] == 'contrasena'){
                echo <<<EOT
                    <div class="makefs-notification">
                        <figure class="makefs-notification-rep "></figure>
                        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">Contraseña equivocada</p></article>
                    </div>
                EOT;
            }
        }
    ?>
    <script src="./js/logNotifications.js"></script>
    <script src="./js/DarkLogin.js"></script>
</body>
</html>