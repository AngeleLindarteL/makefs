<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/makefslogo.png">
    <link href="./css/register.css" rel="stylesheet">
    <link href="./css/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/notificationsLog.css">
    <link rel="stylesheet" href="./css/DarkRegister.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&family=Zen+Kaku+Gothic+New:wght@300&display=swap" rel="stylesheet">

    <title>Register - Makefs</title>
    <?php
        include('./components/sessionControlUnloged.php');
        include("./components/tokenControl.php");
    ?>
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
            <a href="./index.php"><img src="./img/makefsinvert.jpg" alt="img"></a>
            <h6>makef's</h6>
        </div>
        <div class="formcont">
            <div class="info-form">
                <form action="../controllers/registerC.php" method="POST" class="form-done WhiteForm">
                    <a class="aback" href="./index.php"><img class="Whiteimg"src="./iconos/second-back.svg" alt="backbtn"><h6 class="Whiteback">Volver</h6></a>
                    <h1 class="Whiteform">Registrate!</h1>
                    <h5 class="mainsubtitle Whiteform">Nombre</h5>
                    <input class="inputtxt Whiteinp" type="text" name="realname" maxlength="59" required>
                    <h5 class="mainsubtitle Whiteform">Nombre de usuario</h5>
                    <input class="inputtxt Whiteinp" type="text" name="username" maxlength="59" required>
                    <h5 class="mainsubtitle Whiteform">Email</h5>
                    <input class="inputtxt Whiteinp" type="email" name="email" maxlength="69" required>
                    <h5 class="Whiteform">Contraseña</h5>
                    <div class="confrpsw">
                        <input class="inputtxt Whiteinp" type="password" name="pw" maxlength="200" required>
                        <input class="inputtxt Whiteinp" type="password" name="pwconfirm" placeholder="Confirmar contraseña" required>
                    </div>
                    <h5 class="Whiteform">Fecha de nacimiento</h5>
                    <input class="inputtxt Whiteinp" min="1940-01-01" max="2006-12-30" type="date" name="date" required>
                    <input type="submit" value="Registrarse" name="register" class="submitbtn">
                    <h4 class="aregister Whiteform"><p>Ya tienes una cuenta?</p><span><a href="./login.php"> Inicia sesion!</a></span></h4>
                </form>
            </div>
        </div>
    </section>
    <?php
        if(isset($_SESSION["errorRegister"])){
            echo <<<EOT
                <script> const errorR = `$_SESSION[errorRegister]`</script>
                <div class="makefs-notification">
                    <figure class="makefs-notification-rep"></figure>
                    <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg"></p></article>
                </div>
                <script src="./js/registerNotifications.js"></script>
            EOT;
        }
    ?>
    <script src="./js/DarkRegister.js"></script>
</body>
</html>