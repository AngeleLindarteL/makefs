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
    <link rel="stylesheet" href="./css/footer.css">
    <title>Inicio Makef's</title>
    <?php
        session_start();
        include("./components/tokenControl.php");
    ?>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
    ?>
    <section class="recipe-container" id="principal-recipes">
        <div class="makefsContainer recipe-body">
            <h2 id="title-ctc">Makef's</h2>
            <div class="general-recipes-container">
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
                        <img src="./test-imgs/pitsa.jpg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/cangreGOD.jfif">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                </div>
                <div class="recipe-template">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/XD.jfif">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/elBhicho.jfif">
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
                <div class="recipe-template">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/pitsa.jpg">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/cangreGOD.jfif">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                </div>
                <div class="recipe-template">
                    <a class="image-template" href="https://google.com" target="__blank">
                        <img src="./test-imgs/XD.jfif">
                        <figure class="star-template"><img src="./img/hico-star-red.png"><b id="starCount">5.0</b></figure>
                    </a>
                    <div class="next-text-recipe">
                        <img src="./test-imgs/elBhicho.jfif">
                        <a href="https://google.com" target="__blank">
                            <h3 class="text-template">Pollo broaster Makefsiano</h3>
                            <p>Angel Lindarte</p>
                            <p>10M Vistas</p>
                        </a>
                    </div>
                </div>
                <?php
                    include('./components/categoriesMenu.php');
                ?>
            </div>
            
        </div>
    </section>
    <?php
        include('./components/footer.php');
    ?>
    <script src="./js/index.js"></script>
    <script src="./js/categoriesmenu.js"></script>
    <script src="./js/menuDesplegable.js"></script>
    <script src="./js/darkMode.js"></script>
</body>
</html>