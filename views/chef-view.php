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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Chef view</title>
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
        <div class="makefsContainer chef-view-container">
            <div class="right-chef-view-menu">
                <div class="chef-char">
                    <div class="char-template">
                        <figure class="profile-pic">
                            <img class="profile-pic-img" src="<?php echo $_SESSION['pic']; ?>">
                            <a id="profile-edit"></a>
                            <img class="verified" src="./img/chef-verified.png">
                            <div class="followers"><img src="./img/hico-followers.png"><p>10M</p></div>
                        </figure>
                        <article class="profile-chars">
                            <h2 id="chef-name"><?php echo $_SESSION["nombre"]?></h2>
                            <p id="username-space-chef" >@<?php echo $_SESSION["username"]?></p>
                            <div class="summary-info">
                                <article><span></span><p>5.0 Valoración</p></article>
                                <article><span></span><p>11 Recetas</p></article>
                            </div>
                            <p class="description" id="description-space-chef"><?php echo $_SESSION["description"]?></p>
                            <p id="contact-space-chef">Contacto: <?php echo $_SESSION["email"]?></p>
                            <ul class="chef-social-media">
                                <a href="<?php echo $_SESSION["facebook"] ?>" id="fbTxT" target="__blank"><img src="./img/user-facebook.png"></a>
                                <a href="<?php echo $_SESSION["instagram"] ?>" id="igTxT" target="__blank"><img src="./img/user-instagram.png"></a>
                                <a href="https://twitter.com" target="__blank"><img src="./img/user-twitter.png"></a>
                                <a href="<?php echo $_SESSION["youtube"] ?>" id="ytTxT" target="__blank"><img src="./img/user-youtube.png"></a>
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
                        <img class="profile-pic-img-chef" src="<?php echo $_SESSION['pic']; ?>">
                        <img class="verified-chef" src="./img/chef-verified.png">
                        <button id="profile-edit-photo"></button>
                </figure>
                <section class="divChef-view" id="cambiarFoto-chef">
                    <button id="profile-edit-close-chef2"></button>
                    <form action="" id="fotoChange-chef" method="POST">
                        <input type="file" class="updateFotoInput-chef" name="profilepic">
                        <input type="submit" name="changeFoto" id="submitFoto-chef" value="Cambiar foto">
                    </form>
                </section>
                <section class="divUser-view" id="cambiarPass-chef">
                    <button id="profile-close-passChange-chef"></button>
                    <form action="" id="passChange-chef" method="POST">
                        <h2>CAMBIAR CONTRASEÑA</h2>
                        <input type="text" class="passInput-chef" id="passAntiguaChef" placeholder="Tu contraseña Antigua">
                        <input type="text" class="passInput-chef" id="passNewChef" placeholder="Contraseña Nueva">
                        <input type="submit" class="passInput-chef" id="changePassSend-chef" name="changePass" value="Actualizar Contraseña">
                    </form>
                </section>
                <section class="divUser-view" id="deleteAccountContainer-chef">
                    <button id="profile-close-deleteAccount-chef"></button>
                    <form action="../controllers/updateDataUsers/deleteUser.php" id="deleteAccount-chef" method="POST">
                        <h2>BORRAR CUENTA</h2>
                        <h3>Para eliminar tu cuenta verifica que eres tu, pon tu contraseña en el campo.</h3>
                        <input type="text" class="passInput-chef" placeholder="Contraseña" name="deleteUserPass">
                        <input type="submit" class="passInput-chef" id="deleteAccountbtn-chef" name="deleteUser" value="Borrar cuenta">
                    </form>
                </section>
                <article class="profile-chars-chef">
                    <h2 id="chef-name-changing"><?php echo $_SESSION["nombre"]?></h2>
                    <p id="username-space-chef-changing" >@<?php echo $_SESSION["username"]?></p>
                    <p class="description" id="description-space-chef-changing"><?php echo $_SESSION["description"]?></p>
                    <p id="contact-space-chef-changing">Contacto: <?php echo $_SESSION["email"]?></p>
                    <button id="pass-change">Cambiar Contraseña</button>
                </article>
            </div>
            <form class="divChef-view importantDataChef" action="" method="POST"> 
                    <div id="infoData-chef">
                        <div class="divInfoData-chef" id="tittle-info-chef">
                            <h2>Tu informacion.</h2>
                            <button id="profile-edit-chef"></button>
                            <button id="profile-delete-account-chef"></button>
                        </div>
                        <div class="divInfoData-chef" id="input-info-chef">
                            <div class="infodelchef">
                                <label for="name">Nombre:</label>
                                <input type="text" class="infoInputsChef" id="name-chef" name="namem" value="<?php echo $_SESSION["nombre"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="username">Username:</label>
                                <input type="text" class="infoInputsChef" id="username-chef" name="username" value="<?php echo $_SESSION["username"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="email">Email:</label>
                                <input type="text" class="infoInputsChef" id="email-chef" name="email" value="<?php echo $_SESSION["email"]?>" disabled>
                            </div>
                            <div class="infodelchef">
                                <label for="desc">Description:</label>
                                <input type="text" class="infoInputsChef" id="descript-chef" name="descript" value="<?php echo $_SESSION["description"]?>" disabled>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div id="socialMediaChef">
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-facebook.png" alt="">
                            <input type="text" class="infoInputsChef" id="fbinput-Chef" value="<?php echo $_SESSION["facebook"]?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-instagram.png" alt="">
                            <input type="text" class="infoInputsChef" id="iginput-Chef" value="<?php echo $_SESSION["instagram"]?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-twitter.png" alt="">
                            <input type="text" class="infoInputsChef" placeholder="Twitter/yourUser/" disabled>
                        </div>
                        <div class="socialmediadiv-chef">
                            <img src="./img/user-youtube.png" alt="">
                            <input type="text" class="infoInputsChef" id="ytinput-Chef" value="<?php echo $_SESSION["youtube"]?>" disabled>
                        </div>
                        <div class="socialmediadiv-chef" id="updateInfo">
                                <input type="submit" value="Actualizar" name="updateSocialMedia" id="socialUpdateChef">
                        </div>
                </div>    
                </form>
                <p id="status-chef"></p>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/chef-view.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/chageInfoUserChef.js"></script>
    <script src="./js/axiosChef.js"></script>
</body>
</html>