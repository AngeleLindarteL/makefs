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
    session_start();
    include("./components/tokenControl.php");
    if (!isset($_GET["video"]) || empty($_GET["video"])){
        header("location: ./error.html");
        exit;
    }
    $videoId = $_GET["video"];
    $conn = new Conexion();
    $conn = $conn->Conectar();
    $query = "SELECT * FROM recipe WHERE recipeid = :ID";
    try{
        $res = $conn->prepare($query);
        $res->execute(array(":ID"=>$videoId));
        $res = $res->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
        header("location: ./error.html");
        exit;
    }
    echo <<<EOT
        <script>
            const duration = $res[duration];
        </script>
    EOT;
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
                <video id="source_video">
                    <source src="../controllers/video_streaming/startStream.php?video_path="<?php echo $res["video"];?> type="video/mp4"/>
                    <source src="../controllers/video_streaming/startStream.php?video_path="<?php echo $res["video"];?> type="video/webm"/>
                    El navegador no soporta este formato de video
                </video>
                <div class="loading-obj"></div>
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
                    <div class="first-controls">
                        <button id="mkfv_controlls_play" class="makefs-video-control-button"></button>
                        <button id="mkfv_controlls_mute" class="makefs-video-control-button"></button>
                        <input type="range" name="volume-range" id="mkfv_controlls_volume" min="0" max="1" step="0.05">
                    </div>
                    <div class="last-controls">
                        <p id="time_counter">00:00-00:00</p>
                        <div class="config-options">
                            <div class="makefs-video-config-menu main-config-options">
                                <button id="makefs-video-controls-steps"><p>Pasos</p><figure class="config-controllers-slidable"><span class="slidable-switch" id="config-controllers-slidable-steps"></span></figure></button>
                                <button id="makefs-video-controls-bucle"><p>Bucle</p><figure class="config-controllers-slidable"><span class="slidable-switch" id="config-controllers-slidable-bucle"></span></figure></button>
                                <button id="makefs-video-controls-speedrate"><p>Velocidad de reproduccion</p><p id="actual-speed-rate">Normal</p></button>
                            </div>
                            <div class="makefs-video-config-menu" id="speedrate-options">
                                <button id="makefs-video-controls-speedrate-back">Volver</button>
                                <button class="makefs-video-controls-speedrate" setRate="0.25">0.25</button>
                                <button class="makefs-video-controls-speedrate" setRate="0.50">0.50</button>
                                <button class="makefs-video-controls-speedrate" setRate="0.75">0.75</button>
                                <button class="makefs-video-controls-speedrate" setRate="1">Normal</button>
                                <button class="makefs-video-controls-speedrate" setRate="1.25">1.25</button>
                                <button class="makefs-video-controls-speedrate" setRate="1.50">1.50</button>
                                <button class="makefs-video-controls-speedrate" setRate="1.75">1.75</button>
                                <button class="makefs-video-controls-speedrate" setRate="2">2</button>
                            </div>
                        </div>
                        <button id="mkfv_controlls_config" class="makefs-video-control-button"></button>
                        <button id="mkfv_controlls_fullscreen" class="makefs-video-control-button"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/ddr.js"></script>
</body>

</html>