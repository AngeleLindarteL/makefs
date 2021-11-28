<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu biblioteca</title>
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/chef-index.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <link href="./css/bookshelf.css" rel="stylesheet">
    <link href="./css/notifications.css" rel="stylesheet">
    <link href="./css/bookshelfnotif.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?php
        include("./components/sessionControl.php");
        include("./components/tokenControl.php");
        $ToCompareUserId = json_decode(decodeUserData($_SESSION["token"]));
        if (
            $ToCompareUserId->id != $_SESSION["id"] ||
            $ToCompareUserId->id != $_GET["user"] ||
            $_SESSION["id"] != $_GET["user"] ||
            empty($_GET["user"])
        ) {
            header("Location: ./error.html");
        }
    ?>
</head>
<body>
    <?php
    include('./components/header.php');
    include('./components/menudesplegable.php');
    ?>
    <section id="bookshelf">
        <div class="makefsContainer bookshelf-container">
            <div class="saved-recipes-user-portrait">
                <a class="saved-recipes-user-img"><img src="../mediaDB/usersImg/<?php  echo $_SESSION["midpic"] ?>" id="saved-user-img"></a>
            </div>
            <article class="saved-recipes-main-text">
                <h1>Bienvenido a tu biblioteca <?php echo $_SESSION["username"] ?></h1>
                <p>Recetas guardadas: <b>2</b></p>
            </article>
            <div class="saved-recipes-lastest">
                <h2>Tus ultimas recetas guardadas</h2>
                <div class="general-recipes-container lastest-saved-container">
                    <div class="recipe-template">
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
                    </div>
                    <div class="recipe-template">
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
                    </div>
                    <div class="recipe-template">
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
                    </div>
                </div>
            </div>
            <div class="saved-recipes-all">
                <h2>Todas tus recetas guardadas</h2>
                <div class="general-recipes-container lastest-saved-container">
                    <div class="recipe-template">
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
                    </div>
                    <div class="recipe-template">
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
                    </div>
                    <div class="recipe-template">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/darkMode.js"></script>
    <script src="./js/axiosSaveRecipe.js"></script>
    <?php
        include("./components/footer.php");
    ?>
</body>
</html>