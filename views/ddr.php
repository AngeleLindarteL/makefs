<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/makefslogo.png">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/chef-index.css" rel="stylesheet">
    <link href="./css/report.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <link href="./css/ddr.css" rel="stylesheet">
    <link href="./css/notifications.css" rel="stylesheet">
    <link href="./css/bookshelfnotif.css" rel="stylesheet">
    <link href="./css/not-registered.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <?php 
    include("../models/conexion.php");
    session_start();
    if(empty($_SESSION['id'])){
        $_SESSION['id']=0;
        $_SESSION['chefid']=0;
    }else{
        include("./components/tokenControl.php");
    }
    if (!isset($_GET["video"]) || empty($_GET["video"])){
        header("location: ./error.html");
        exit;
    }
    $videoId = $_GET["video"];
    $conn = new Conexion();
    $conn = $conn->Conectar();
    $query = "SELECT * FROM recipe INNER JOIN userm ON recipe.chefid = userm.chefid WHERE recipeid = :ID";
    try{
        $res = $conn->prepare($query);
        $res->execute(array(":ID"=>$videoId));
        $res = $res->fetch(PDO::FETCH_ASSOC);
        echo "<title>$res[namer]</title>";
    }catch(Exception $e){
        header("location: ./error.html");
        exit;
    }
    if($res == false || empty($res)){
        header("location: ./error.html");
        exit;
    }
    $step_times_json = base64_decode($res["steps"]);
    $timesDecoded = json_decode($step_times_json,true);
    $times = "";
    $timesFormatObject = "";
    foreach ($timesDecoded as $timeArray){
        $times = $times . $timeArray[1] ."//";
        $timesFormatObject .= "~^^~$timeArray[1]~^^~$timeArray[2]~^^~$timeArray[0][-|-]";
    }
    $timesFormatObject = rtrim($timesFormatObject, '[-|-]');
    echo <<<EOT
        <script>
        const duration = $res[duration];
        const videoID = $_GET[video];
        const times = "$times";
        const timesObj = {}
        const timesArr = "$timesFormatObject".split("[-|-]");
        for(let i = 0; i < timesArr.length; i++){
            timesArr[i] = timesArr[i].split("~^^~");
            timesArr[i].shift();
            timesArr[i].push(true);
            timesObj[timesArr[i][0]] = timesArr[i];
            timesArr[i] = timesArr[i][0];
        }
        const followerid = $_SESSION[id];
        const chefid = $res[chefid];
        const chefName = "$res[username]";
        </script>
    EOT;
    $query = "SELECT * FROM follows WHERE chefid = :chefid AND followerid = :followerid";
    try{
        $follow = $conn->prepare($query);
        $follow->execute(array(
            ":chefid"=>$res['chefid'],
            ":followerid"=>$_SESSION['id']
        ));
        $follow = $follow->fetch(PDO::FETCH_ASSOC);
        if(isset($follow["idfollow"])){
            $followid = $follow["idfollow"];
        }else{
            $followid = null;
        }
    }catch(Exception $e){
        header("location: ./error.html");
        exit;
    }
    $query = "SELECT COUNT(*) FROM follows WHERE chefid = :chefid";
    try{
        $seguidores = $conn->prepare($query);
        $seguidores->execute(array(
            ":chefid"=>$res['chefid'],
        ));
        $seguidores = $seguidores->fetchColumn();
    }catch(Exception $e){
        header("location: ./error.html");
        exit;
    }
    $query = "SELECT verify FROM chef WHERE chefid = :chefid";
    try{
        $verify = $conn->prepare($query);
        $verify->execute(array(
            ":chefid"=>$res['chefid'],
        ));
        $verify = $verify->fetchColumn();
    }catch(Exception $e){
        header("location: ./error.html");
        exit;
    }
    if($verify=="yes"){
        $isVerify = true;
    }else{
        $isVerify = false;
    }
    $query = "SELECT star FROM stars WHERE recipeid = :recipeid AND userid = :userid";
    try{
        $stars = $conn->prepare($query);
        $stars->execute(array(
            ":recipeid"=>$_GET["video"],
            ":userid"=>$_SESSION["id"]
        ));
        $stars = $stars->fetchColumn();
        if (!empty($stars)) {
            echo "<script>let lastRate = '$stars' </script>";
        }else{
            echo "<script>let lastRate = null</script>";
        }
    }catch(Exception $e){
        header("location: ./error.html");
        exit;
    }
    $query = "SELECT * FROM saveds WHERE recipeid = :recipeid AND userid = :userid";
    try{
        $isSaved = $conn->prepare($query);
        $isSaved->execute(array(
            ":recipeid"=>$_GET["video"],
            ":userid"=>$_SESSION["id"]
        ));
        $isSaved = $isSaved->fetch(PDO::FETCH_ASSOC);
        if (!empty($isSaved)) {
            echo "<script>const isSaved = true </script>";
        }else{
            echo "<script>const isSaved = false</script>";
        }
    }catch(Exception $e){
        header("location: ./error.html");
        exit;
    }
    ?>
</head>
<body>
    <?php
    include('./components/header.php');
    include('./components/menudesplegable.php');
    include("./components/report.php");
    ?>
    <div class="makefs-notification ddr-in-notification">
        <figure class="makefs-notification-rep"></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">En espera</p></article>
    </div>
    <div class="bookshelf-notification">
        <img id="bookshelf-icon" src="./iconos/book.png">
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-save-msg">bookshelf Notification</p></article>
        <a target="_blank" href="./bookshelf.php?user=<?php echo $_SESSION["id"]?>">Ir a biblioteca</a>
    </div>
    <section id="recipe_section">
        <div class="recipe_container">
            <div class="makefs-media-player">
                <button id="first-play-btn"></button>
                <video id="source_video" poster="../mediaDB/recipeImages/<?php echo $res["imagen"];?>">
                    <source src="../controllers/video_streaming/startStream.php?video=<?php echo $res["video"];?>" type="video/mp4"/>
                    <source src="../controllers/video_streaming/startStream.php?video=<?php echo $res["video"];?>" type="video/webm"/>
                    El navegador no soporta este formato de video
                </video>
                <div class="loading-obj"></div>
                <div class="in-panel-video" id="mkfv_controlls_big_panel">
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_backTo"></figure>
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_big_play"></figure>
                    <figure class="makefs-video-in-panel-video" id="mkfv_controlls_afterTo"></figure>
                </div>
                <button id="makefs-steps-info-button"></button>
                <div class="step-anotation" ocNotif="1">
                    <button id="step-annotation-close">x</button>
                    <h2 id="step-annotation-number">1</h2>
                    <article>
                        <b id="step-annotation-minutes">00:00 - 00:00</b>
                        <p id="step-annotation-detail">Video Notification / Step not setted yet</p>
                    </article>
                    <button id="step-annotation-show-more" ocPanelEl="1">ver más</button>
                    <span id="step-annotation-show-more-gradient"></span>
                </div>
                <ul class="makefs-steps-info-container">
                    <h2>Pasos</h2>

                    <?php
                        $counter = 1;
                        foreach ($timesDecoded as $key => $stepRenderInfo){
                            echo <<<EOT
                                <li class="makefs-steps-info-template" ocMinute="$stepRenderInfo[1]">
                                    <a class="makefs-steps-info-display-details">v</a>
                                    <h3>$counter</h3>
                                    <article>
                                        <h4>$stepRenderInfo[1] - $stepRenderInfo[2]</h4>
                                        <p>$stepRenderInfo[0]</p>
                                    </article>
                                </li>
                            EOT;
                            $counter++;
                        }

                    ?>
                </ul>
                <div></div>
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
                        <div class="volume-containers">
                            <input type="range" name="volume-range" id="mkfv_controlls_volume_rep" min="0" max="1" step="0.05">
                            <input type="range" name="volume-range" id="mkfv_controlls_volume" min="0" max="1" step="0.05">
                        </div>
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
            <div class="ddr-bottom-panels">
                <div class="makefs-video-info-panels">
                    <h1 class="makefs-video-info-title"><?php echo $res["namer"]?></h1>
                    <a class="makefs-video-info-chef" href="./chef-view.php?chef=<?php echo $res['chefid']; ?>">
                        <div id="foto-chef-ddr">
                            <img src="../mediaDB/usersImg/<?PHP echo $res["minpic"]?>">
                            <?php if($isVerify){ echo "<img class='verified2' src='./img/chef-verified.png'>";} ?>
                        </div>
                        
                        <article>
                            <p> <?php echo $res["username"] ?></p>
                            <p> <b id="followersSection"><?php echo $seguidores ?></b> Seguidores</p>
                            <?php
                                if($_SESSION['id']==0){
                                    echo <<<EOT
                                        <button id='followUnloged'>seguir</button>
                                        <div id='unlogedFollowSect'>
                                        <button id="close-UnlogedFollow"></button>
                                            <div id='unlogedFollowDiv'>
                                                <h4>Para seguir a un usuario debes estar logueado!</h4>
                                                <button id="logRedirect">LogIn</button>
                                            </div>
                                        </div>
                                    EOT;
                                }else{
                                    if(isset($followid)){
                                        echo "<button id='follow-button'>siguiendo</button>";
                                    }else{
                                        echo "<button id='follow-button'>seguir</button>";
                                    }
                                }
                            ?>  
                        </article>
                        </a>
                    <div class="makefs-video-interactions">
                        <p><b id="makefs-video-views"><?php echo $res["views"] ?></b> Visualizaciones</p>
                        <div class="makes-recipe-tags-wrapper">
                            <?php
                                $tagsBase64 = base64_decode($res["tags"]);
                                $tagsDecoded = json_decode($tagsBase64,true);
                                foreach ($tagsDecoded as $key => $value){
                                    echo "<p class='makefs-recipe-tag'>$value</p>";
                                }
                            ?>
                        </div>
                        <div class="makefs-video-report-save">
                            <button id="save-actual-recipe">Guardar</button>
                            <button id="report-actual-recipe">Reportar</button>
                        </div>
                        <?php 
                            if ($_SESSION["id"] == 0) {
                                echo <<<EOT
                                <div class="not-registered-advise">
                                    <img src="./iconos/makefslogo.jpg">
                                    <button id="hide-not-register-notif">x</button>
                                    <article>
                                        <p>Para poder interactuar con este video debes estar registrado</p>
                                        <a href="./register.php">¡Registrate!</a>
                                    </article>
                                </div>
                                EOT;
                            }
                        ?>
                        <ul class="makefs-video-star-valoration">
                            <span class="loading-rate-action"></span>
                            <li class="makefs-selection-star-container">
                                <button starValue="0.5"></button>
                                <button starValue="1.0"></button>
                            </li>
                            <li class="makefs-selection-star-container">
                                <button starValue="1.5"></button>
                                <button starValue="2.0"></button>
                            </li>
                            <li class="makefs-selection-star-container">
                                <button starValue="2.5"></button>
                                <button starValue="3.0"></button>
                            </li>
                            <li class="makefs-selection-star-container">
                                <button starValue="3.5"></button>
                                <button starValue="4.0"></button>
                            </li>
                            <li class="makefs-selection-star-container">
                                <button starValue="4.5"></button>
                                <button starValue="5.0"></button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="makefs-recommended-panels">
                    <div class="in-recipe-recommended-container">
                        <h3 class="recomended-title">recomendados</h3>
                        <div class="recipe-template in-video-template">
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
                        <div class="recipe-template in-video-template">
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
                        <div class="recipe-template in-video-template">
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
                    <div class="makefs-video-ingredients-ad-wrapper">
                        <h3 class="makefs-ingredients-tittle">Ingredientes</h3>
                        <ul class="makefs-ingredients-wrapper">
                        <?php
                            $ingredientsBase64 = base64_decode($res["ingredients"]);
                            $ingredientsDecoded = json_decode($ingredientsBase64,true);
                            foreach ($ingredientsDecoded as $key => $value){
                                echo "<p class='makefs-ingredient'>$value</p>";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        include('./components/footer.php');
    ?>
    
    <script src="./js/index.js"></script>
    <script src="./js/ddr.js"></script>
    <script src='./js/axiosFollow.js'></script>
    <script src="./js/darkMode.js"></script>
    <script src="./js/report.js"></script>
    <script src="./js/axiosReport.js"></script>
    <script src="./js/axiosSaveRecipe.js"></script>
    <script src="./js/followUnloged.js"></script>
</body>

</html>