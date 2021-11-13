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
    <?php
        // include('./components/sessionControl.php');
    ?>
</head>

<body>
    <?php
    include('./components/header.php');
    include('./components/menudesplegable.php');
    ?>
    <section id="recipe_section">
        <div class="recipe_container">
            <div class="makefs-media-player">
                <button id="first-play-btn"></button>
                <video poster="./test-imgs/elBhicho.jfif" id="source_video">
                    <source src="./test-imgs/videoPrueba.mp4" type="video/mp4" />
                    El navegador no soporta este video lol
                </video>
                <div class="in-panel-video" id="mkfv_controlls_big_panel">
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_backTo"></figure>
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_big_play"></figure>
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_afterTo"></figure>
                </div>
                <span id="progress-bar-time-read">00:00</span>
                <div class="makefs-video-controls controls-hidden first-play">
                    <div class="makefs-video-progress">
                        <progress id="mkfs_video_progress_bar" min="0">
                        </progress>
                        <figure class="mkfs_video_dragable_ball" draggable="true"></figure>
                        <figure class="mkfs_video_dragable_representation mkfs_ball_static"></figure>
                    </div>
                    <button id="mkfv_controlls_play" class="makefs-video-control-button"></button>
                    <button id="mkfv_controlls_mute" class="makefs-video-control-button"></button>
                    <button id="mkfv_controlls_fullscreen" class="makefs-video-control-button"></button>
                    <input type="range" name="volume-range" id="mkfv_controlls_volume" min="0" max="1" step="0.05">
                </div>
            </div>
            <div class="panels">
                
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/ddr.js"></script>
</body>

</html>