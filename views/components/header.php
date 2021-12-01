<?php
    if(isset($_SESSION["chefid"])){
        $ischef = true;
        $userhome = "../views/chef-view.php?chef=$_SESSION[chefid]";
    }else{
        $userhome = "../views/user-view.php";
        $ischef = false;
    }
    if(isset($_SESSION['token'])){
        $isloged = true;
    }else{
        $isloged = false;
    }
    echo <<<EOT
    <header>
    <div class="makefsContainer headerContainer">
        <div class="header_icons">
            <a class="headicons_ico" id="nav-menu-btn">
                <figure class="nav-btn-bar"></figure>
                <figure class="nav-btn-bar"></figure>
                <figure class="nav-btn-bar"></figure>
            </a>
        </div>
            <div class="header_logo">
                <article class="headlogo_text">
                    <h1>Makefs</h1>
                    <h2>Making Chef's</h2>
                </article>
                <img class="headlogo_logo" src="./img/makefs-logo.png">
            </div>
    EOT;
        if($isloged){
            echo <<<EOT
                <div class="header_logreg">
                    <a id="userlog">
                        <img src="../mediaDB/usersImg/$_SESSION[minpic]">
                    </a>
                    <ul id="user_selection" class="userSelectClose">
                        <div class="userMiniInfo">
                            <img src="../mediaDB/usersImg/$_SESSION[minpic]">
                            <div class="infoUser">
                                <h6>$_SESSION[username]</h6>
                                <p>$_SESSION[email]</p>
                            </div>
                        </div>
                        <a class="headlog_btn" href="$userhome" >
                            <img id="profileImg" class="headlog_ico first" src="./img/rhico-chef-white.png">
                            <p>Tu cuenta</p>
                        </a>
            EOT;
                        if($ischef){
                            echo <<<EOT
                                <a class="headlog_btn" href="./newRecipe.php">
                                    <img class="headlog_ico first" src="./iconos/upload.png">
                                    <p>Subir contenido</p>
                                </a>
                            EOT;
                        }
                        if($_SESSION["rol"]=="administrador"){
                            echo <<<EOT
                                <a class="headlog_btn" href="./adminMakefs.php">
                                    <img class="headlog_ico first" src="./img/adminPanel.png">
                                    <p>Admin Panel</p>
                                </a>
                            EOT;
                        }
            echo <<<EOT
                        <a class="headlog_btn" id="tb" href="">
                            <img class="headlog_ico first" id="imgtb"  src="./iconos/moon.svg">
                            <p>Cambiar tema</p>
                        </a>
                        <form action="../controllers/loginC.php" method="POST" class="headlog_btn" id="cerrarstyle">
                        <a>
                            <img class="headlog_ico first" src="./iconos/logout.png">
                            <input type="submit" name="cerrar_sesion" id="close_session" value="Cerrar sesion"/>
                        </a>
                        </form>
                    </ul>
                </div>
            EOT;
        }else{
            echo <<<EOT
            <div class="header_logreg">
                <a id="userlog">
                    <img src="../views/img/hico-user.png">
                </a>
                <ul id="user_selection" class="userSelectClose">
                    <a class="headlog_btn" href="../views/register.php">
                        <img class="headlog_ico first" src="./img/registerIcon.png">
                        <p>Registrarse</p>
                    </a>
                    <a class="headlog_btn" href="../views/login.php">
                        <img class="headlog_ico first" src="./img/loginIcon.png">
                        <p>Iniciar Sesión</p>
                    </a>
                    <a class="headlog_btn" id="tb" href="">
                        <img class="headlog_ico first" id="imgtb"  src="./iconos/moon.svg">
                        <p>Cambiar tema</p>
                    </a>
                </ul>
            </div>
            EOT;
        }
    echo <<<EOT
        </div>
        </header>
        <script src='./js/homesave.js'></script>
        <script src='./js/headerindex.js'></script>
    EOT;
    
?>
