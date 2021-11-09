<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/makefslogo.png">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/chef-index.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/ddr.css" rel="stylesheet">
    <title>Receta</title>
</head>

<body>
    <?php
    include('./header.php');
    include_once('./menudesplegable.php');
    ?>
    <section id="recipe_section">
        <div class="recipe_container">
            <div class="makefs-media-player">
                <video poster="./test-imgs/elBhicho.jfif" id="source_video">
                    <source src="./test-imgs/videoPrueba.mp4" type="video/mp4" />
                    El navegador no soporta este video lol
                </video>
                <div class="in-panel-video" id="mkfv_controlls_big_panel">
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_backTo"></figure>
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_big_play"></figure>
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_afterTo"></figure>
                </div>
                <div class="makefs-video-controls">
                    <div class="makefs-video-progress">
                        <progress id="mkfs_video_progress_bar" min="0">
                            <span id="progress-bar"></span>
                        </progress>
                        <input type="range" id="mkfs_video_progress_select" min="0" value="0">
                    </div>
                    <button id="mkfv_controlls_play" class="makefs-video-control-button"></button>
                    <button id="mkfv_controlls_mute" class="makefs-video-control-button"></button>
                    <input type="range" name="volume-range" id="mkfv_controlls_volume" min="0" max="100">
                </div>
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/ddr.js"></script>
</body>

</html>