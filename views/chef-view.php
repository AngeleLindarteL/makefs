<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/chef-index.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/chef-view-change.css" rel="stylesheet">
    <title>Chef view</title>
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
        <div class="makefsContainer chef-view-container">
            <div class="right-chef-view-menu">
                <div class="chef-char">
                    <div class="char-template">
                        <figure class="profile-pic">
                            <img class="profile-pic-img" src="../mediaDB/usersImg/makefsUser.png">
                            <a id="profile-edit"></a>
                            <img class="verified" src="./img/chef-verified.png">
                            <div class="followers"><img src="./img/hico-followers.png"><p>10M</p></div>
                        </figure>
                        <article class="profile-chars">
                            <h2 id="chef-name"><?php echo $_SESSION["username"]?></h2>
                            <div class="summary-info">
                                <article><span></span><p>5.0 Valoración</p></article>
                                <article><span></span><p>11 Recetas</p></article>
                                <form action="../controllers/loginC.php" method="POST">
                                    <input type="submit" name="cerrar_sesion"/>
                                </form>
                            </div>
                            <p class="description"><?php echo $_SESSION["description"]?> <br> Contacto: <?php echo $_SESSION["email"]?></p>
                            <ul class="chef-social-media">
                                <a href="https://facebook.com" target="__blank"><img src="./img/user-facebook.png"></a>
                                <a href="https://instagram.com" target="__blank"><img src="./img/user-instagram.png"></a>
                                <a href="https://twitter.com" target="__blank"><img src="./img/user-twitter.png"></a>
                                <a href="https://youtube.com" target="__blank"><img src="./img/user-youtube.png"></a>
                            </ul>
                        </article>
                    </div>
                </div>
                <div class="action-buttons-container">
                    <a class="action-btn"><img src="./img/chef-add.png"><p>Añadir recetas</p></a>
                    <a class="action-btn"><img src="./img/chef-flag.png"><p>Reportes</p></a>
                    <button id="chef-config"></button>
                </div>
            </div>
            <div class="edit-recipe-container">
                <div class="recipe-template editable-recipe">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/pollo.jpeg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/xd.jpg">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                    <a class="edit-template"></a>
                </div>
                <div class="recipe-template editable-recipe">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/pastarica.jpg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/xd.jpg">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pasta Casera hecha en casa con poc...</h3>
                            <p>Angel Lindarte</p>
                            <p>15,7K Vistas</p>
                        </a>
                    </div>
                    <a class="edit-template"></a>
                </div>
                <div class="recipe-template editable-recipe">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/pollo.jpeg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/xd.jpg">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                    <a class="edit-template"></a>
                </div>
                <div class="recipe-template editable-recipe">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/pollo.jpeg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/xd.jpg">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                    <a class="edit-template"></a>
                </div>
                <div class="recipe-template editable-recipe">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/pollo.jpeg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/xd.jpg">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                    <a class="edit-template"></a>
                </div>
                <div class="recipe-template editable-recipe">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/pollo.jpeg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/xd.jpg">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                    <a class="edit-template"></a>
                </div>
            </div>
            
        </div>
    </section>
    <section class="chefsContainer" id="changeInfoChef">
        <button id="profile-edit-close"></button>
        <div id="chefContainer">
            <div class="divChef-view" id="firstdiv-chef">
                <figure class="profile-pic-chef">
                        <img class="profile-pic-img-chef" src="../mediaDB/usersImg/makefsUser.png">
                        <img class="verified-chef" src="./img/chef-verified.png">
                        <button id="profile-edit-photo"></button>
                </figure>
                <!-- <section class="divChef-view" id="cambiarphoto">
                        <form action="" id="photoChange" method="POST">
                            <label for="profilepic"></label>
                            <input type="file" class="updatephotoInput" name="profilepic">
                            <input type="submit" name="changeFoto" id="submitphoto" value="cambiar foto">
                        </form>
                </section> --->
                <article class="profile-chars-chef">
                    <h2 id="chef-name"><?php echo $_SESSION["username"]?></h2>
                    <p class="description-chef">17 Años <br> <?php echo $_SESSION["description"]?> <br> Contacto: <?php echo $_SESSION["email"]?></p>
                    <button id="pass-change">Cambiar Contraseña</button>
                </article>
            </div>
            <form class="divChef-view importantDataChef" action="" method="POST"> 
                    <div id="infoData-chef">
                        <div class="divInfoData-chef" id="tittle-info-chef">
                            <h2>Tu informacion.</h2>
                            <button id="profile-edit-chef"></button>
                        </div>
                        <div class="divInfoData-chef" id="input-info-chef">
                            <div class="infodelchef">
                                <label for="name">Nombre:</label>
                                <input type="text" class="infoInputsChef" name="name" value="<?php echo $_SESSION["nombre"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="username">Username:</label>
                                <input type="text" class="infoInputsChef" name="username" value="<?php echo $_SESSION["username"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="email">Email:</label>
                                <input type="text" class="infoInputsChef" name="email" value="<?php echo $_SESSION["email"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="desc">Description:</label>
                                <input type="text" class="infoInputsChef" name="desc" value="<?php echo $_SESSION["description"]?>" disabled>
                            </div>
                            
                        </div>
                    </div>
                    <div id="socialMediaChef">
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-facebook.png" alt="">
                            <input type="text" class="infoInputsChef" placeholder="Facebook/yourUser/">
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-instagram.png" alt="">
                            <input type="text" class="infoInputsChef" placeholder="Instagram/yourUser/">
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-twitter.png" alt="">
                            <input type="text" class="infoInputsChef" placeholder="Twitter/yourUser/">
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-youtube.png" alt="">
                            <input type="text" class="infoInputsChef" placeholder="Youtube/yourUser/">
                        </div>
                        <div class="socialmediadiv-chef" id="updateInfo">
                                <input type="submit" value="Actualizar" name="updateSocialChef" id="socialUpdateChef">
                        </div>
                </div>    
                </form>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/chef-view.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/chageInfoUserChef.js"></script>
</body>
</html>