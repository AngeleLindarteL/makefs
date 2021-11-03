<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/chef-index.css" rel="stylesheet">
    <title>Inicio Makef's</title>
</head>
<body>
    <?php
        include('./header.php');
    ?>
    <div class="makefsContainer nav-bar-container nav-bar-hidden" id="nav-bar-ct">
        <nav id="nav-bar">
            <div class="searchNav">
                <input class="text" placeholder="Buscar">
                <button></button>
            </div>
            <h3>Categorias</h3>
            <ul>
                <li><a>Comida Mexicana</a></li>
                <li><a>Comida Tipica</a></li>
                <li><a>Comida Santandereana</a></li>
                <li><a>Comida Paisa</a></li>
                <li><a>Comida Tolimense</a></li>
                <li><a>Comida Italiana</a></li>
                <li><a>Comida Vegetariana</a></li>
            </ul>
        </nav>
    </div>
    <section class="recipe-container" id="principal-recipes">
        <div class="makefsContainer recipe-body">
            <h2 id="title-ctc"> RECETAS RECOMENDADAS</h2>
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
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
</body>
</html>