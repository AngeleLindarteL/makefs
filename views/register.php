<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/makefslogo.png">
    <link href="./css/register.css" rel="stylesheet">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&family=Zen+Kaku+Gothic+New:wght@300&display=swap" rel="stylesheet">

    <title>Register - Makefs</title>
    <?php
        include('./components/sessionControlUnloged.php');
    ?>
</head>
<body>
    <header id="header">
        <div class="logocont">
            <h1>Makef's</h1>
        </div>
        <div class="titlecont">
            <img src="./img/makefs-logo.png" alt="logo makefs">
        </div>
        <div class="responsive-header">
            <h1>Makef's</h1>
        </div>
    </header>
    <section id="continfo">
        <div class="viewlogo">
            <img src="./img/makefsinvert.jpg" alt="img">
            <h6>makef's</h6>
        </div>
        <div class="formcont">
            <div class="info-form">
                <form action="../controllers/registerC.php" method="POST" class="form-done">
                    <a class="aback" href=""><img src="./iconos/second-back.svg" alt="backbtn"><h6>Volver</h6></a>
                    <h1>Registrate!</h1>
                    <h5 class="mainsubtitle">Nombre</h5>
                    <input class="inputtxt" type="text" name="realname">
                    <h5 class="mainsubtitle">Nombre de usuario</h5>
                    <input class="inputtxt" type="text" name="username">
                    <h5 class="mainsubtitle">Email</h5>
                    <input class="inputtxt" type="email" name="email">
                    <h5>Contraseña</h5>
                    <input class="inputtxt" type="password" name="pw">
                    <h5>Fecha de nacimiento</h5>
                    <input class="inputtxt" type="date" name="date">
                    <input type="submit" value="Registrarse" name="register" class="submitbtn">
                    <h4 class="aregister"><p>Ya tienes una cuenta?</p><span><a href=""> inicia sesion!</a></span></h4>
                </form>
            </div>
        </div>
    </section>
</body>
</html>