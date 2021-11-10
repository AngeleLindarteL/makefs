<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Recipe!</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/newRecipeCss.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
</head>
<body>
    <?php
        include('./header.php');
        include('./menudesplegable.php');
    ?>
    <h1 class="tittle">NUEVA RECETA</h1>
    <h2 class="subtittle">LLena los campos y agrega tu receta!</h2>
    <section id="section-info">
        <div class="contenedor1 cont">
            <form class="formulario1">
                <label for="titulo" class="general">Titulo</label><br>
                <input type="text" id="titulo" placeholder="El titulo de tu receta"><br>
                <label for="categoria" class="general">Categoria de tu receta<span class="tooltip top">?<span class="tiptext">Elige la categoria donde se mostrará tu receta</span></span></label><br>
                <select id="categoria" name="Categoría">
                    <option value="Mexicana">Mexicana</option>
                    <option value="Tipica">Tipica</option>
                    <option value="Pastas">Pasta</option>
                    <option value="Saludable" selected>Saludable</option>
                    <option value="ComidaRapida">Comida Rapida</option>
                    <option value="Mar">Comida de Mar</option>
                    <option value="Sopas">Sopas</option>
                </select><br>
                <label for="ingrediente" class="general">Ingredientes</label><br>
                <input type="text" id="ingrediente" placeholder="Ingrediente">
                <button class = "addInput">+</button><br>
                <label class="general">Instrucciones<span class="tooltip top">?<span class="tiptext">Ingresa los pasos para la preparacion!</span></span></label>
                <br><br>
                <label for="instruccion" class="instlabel">Instruccion #1</label><br>
                <input type="text" id="instruccion" placeholder="Instruccion 1">
                <button class = "addInput">+</button><br>
            </form>
        </div>
        <div class="contenedor2 cont">
            <form class="formulario2">
                <label for="recipeVid" class="general" >Video de la Preparacion!</label>
                <div class="insrtmedia">
                    <p>Inserte el video de su Preparacion!</p>
                    <input type="file" class = "upload" id="recipeVid" name="recipeVid" accept="video/mp4" style="display: none;">
                    <label for="recipeVid">
                        <img class="selector_mul" src="/img/video.png" id="vid_input" alt="Subir Imagen">
                    </label>
                </div>
                <label for="recipeImg" class="general">Imagen de la Preparacion!</label>
                <div class="insrtmedia">
                    <p>Inserte la imagen de su Preparacion!</p>
                    <input type="file" class="upload" id="recipeImg" name="recipeImg" accept="image/png, image/jpeg" style="display: none;">
                    <label for="recipeImg">
                        <img class="selector_mul" src="/img/imagen.png" id="img_input" alt="Subir Foto">
                    </label>
                </div>
            </form>
        </div>
    </section>

</body>
    <script src="./js/index.js"></script>
    <script src="./js/menuDesplegable.js"></script>
</html>