<?php
    if(isset($_SESSION["chefid"])){
        $userhome = "../views/chef-view.php";
    }else{
        $userhome = "../views/user-view.php";
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
        <div class="header_logreg">
            <a id="userlog">
                <img src="$_SESSION[pic]">
            </a>
            <ul id="user_selection" class="userSelectClose">
                <div class="userMiniInfo">
                    <img src="$_SESSION[pic]">
                    <div class="infoUser">
                        <h6>$_SESSION[username]</h6>
                        <p>$_SESSION[email]</p>
                    </div>
                </div>
                <a class="headlog_btn" href="$userhome" >
                    <img id="profileImg" class="headlog_ico first" src="./img/rhico-chef-white.png">
                    <p>Tu cuenta</p>
                </a>
                <a class="headlog_btn" href="">
                    <img class="headlog_ico first" src="./iconos/upload.png">
                    <p>subir contenido</p>
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
    EOT;
    echo "<script src='./js/homesave.js'></script>";
?>
