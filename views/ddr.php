<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="../views/favicon/makefslogo.png">
    <link href="../views/css/normalize.css" rel="stylesheet">
    <link href="../views/css/chef-index.css" rel="stylesheet">
    <link href="../views/css/report.css" rel="stylesheet">
    <link href="../views/css/header.css" rel="stylesheet">
    <link href="../views/css/footer.css" rel="stylesheet">
    <link href="../views/css/ddr.css" rel="stylesheet">
    <link href="../views/css/notifications.css" rel="stylesheet">
    <link href="../views/css/libraryNotif.css" rel="stylesheet">
    <link href="../views/css/not-registered.css" rel="stylesheet">
    <link href="../views/css/Darkddr.css" rel="stylesheet">
    <link href="../views/css/DarkMenu.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/Preloader.css">
    <meta name="description" content="Mira la preparacion de tu receta que deseas aprender y aprende a cocinar">
    <meta name="robots" content="index, follow">
    <script src="../views/js/defineUrl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let recipeProperties = {
            reported: false,
            rate: 0.0,
            savedrecipes: 0
        }
    </script>
    <?php
    include("models/conexion.php");
    include("views/components/test_inputs.php");
    session_start();
    if(!isset($_SESSION['id'])){
        $_SESSION['id']=0;
        $_SESSION['chefid']=0;
    }
    if (!isset($_SESSION["id"]) || $_SESSION["id"] == 0){
        $rConn = new Conexion();
        try {
            $rConn = $rConn->Conectar();
            $rConn->beginTransaction();

            $query = "SELECT 
            recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname,
            CAST(AVG(stars.star) AS DECIMAL(10,2)) AS rate,
            userm.minpic
            FROM recipe INNER JOIN userm ON userm.chefid = recipe.chefid INNER JOIN stars ON stars.recipeid = recipe.recipeid 
            WHERE recipe.recipeid NOT IN ($_GET[video]) AND recipe.privater = FALSE GROUP BY (recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname, userm.minpic) LIMIT 6";
            $exec = $rConn->prepare($query);
            $exec->execute();
            $exec = $exec->fetchAll(PDO::FETCH_ASSOC);
            
            $finalOrdering = array();

            function ordering($rate,$views){
                $viewRanges = [
                    [0,20],
                    [20,50],
                    [50,100],
                    [100,500],
                    [500,1000],
                    [1000,10000],
                    [10000, 20000],
                    [20000, 50000],
                    [50000, 100000],
                    [100000,1000000]
                ];
                $vscore = 0;
                $vrate = 0;
                for($i = 0; $i < sizeof($viewRanges); $i++){
                    if ($viewRanges[$i][0] <= $views && $viewRanges[$i][1] >= $views){
                        $vscore = ($i+1) * 100;
                        break;
                    }
                }
                try{
                    $vrate = (number_format($rate,2) / 0.5) * 100;
                }catch (DivisionByZeroError $e){
                    $vrate = 100;
                }
                return $vrate + $vscore;
            }

            foreach ($exec as $key => $val){
                array_push($finalOrdering,[
                    "recipeid"=>$val["recipeid"],
                    "chefid"=>$val["chefid"],
                    "namer"=>$val["namer"],
                    "rate"=>$val["rate"],
                    "views"=>$val["views"],
                    "chefname"=>$val["chefname"],
                    "imagen"=>$val["imagen"],
                    "chefpic"=>$val["minpic"],
                    "fscore"=> ordering($val["rate"], $val["views"])
                ]);
            }

            usort($finalOrdering, function ($item1, $item2) {
                return $item2['fscore'] <=> $item1['fscore'];
            });
            $response = json_decode(json_encode(["recipes"=>$finalOrdering]));
        } catch (Exception $e) {
            print_r($e);
            $rConn->rollBack();
        }
    }else{
        if(empty($_SESSION['id'])){
            $_SESSION['id']=0;
            $_SESSION['chefid']=0;
        }else{
            include("views/components/tokenControl.php");
        }
        $url = "https://makefsapi.herokuapp.com/user/$_SESSION[id]/vr";

        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $viewed = curl_exec($ch);
        curl_close($ch);

        $rConn = new Conexion();
        $rConn = $rConn->Conectar();
        
        $viewed = json_decode($viewed)->ids;
        
        array_push($viewed,$_GET["video"]);
        $numsViewed = array_map('intval',$viewed);
        $numsViewed = implode(",",$numsViewed);

        if(empty($numsViewed)){
            $numsViewed = 0;
        }

        $selectQuery = "SELECT 
        recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname,
        CAST(AVG(stars.star) AS DECIMAL(10,2)) AS rate,
        userm.minpic
        FROM recipe INNER JOIN userm ON userm.chefid = recipe.chefid INNER JOIN stars ON stars.recipeid = recipe.recipeid 
        WHERE recipe.recipeid NOT IN ($numsViewed) AND recipe.privater = FALSE GROUP BY (recipe.recipeid, recipe.chefid,recipe.namer, recipe.status,recipe.imagen, recipe.duration, recipe.tags, recipe.region, recipe.views,recipe.privater, recipe.chefname, userm.minpic) LIMIT 6";

        try {
            $getR = $rConn->prepare($selectQuery);
            $getR->execute();
            $res = $getR->fetchAll(PDO::FETCH_ASSOC);
            $data = json_encode($res);
            $url = "https://makefsapi.herokuapp.com/user/$_SESSION[id]";

            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-type: application/json"
            ]);

            $response = json_decode(curl_exec($ch));
            curl_close($ch);

            if ($response->status == 200){
                # code...
            }
        } catch (Exception $th) {
            print_r($th);
        }
    }
    if (!isset($_GET["video"]) || empty($_GET["video"])){
        header("location: /error");
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
        echo "<title>Cocina: $res[namer]</title>";
    }catch(Exception $e){
        header("location: /error");
        exit;
    }
    if($res == false || empty($res)){
        header("location: /error");
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
    $region = $res["region"];
    echo <<<EOT
        <script>
        let interactingOutVideo = true;
        const duration = $res[duration];
        const videoID = $_GET[video];
        const times = "$times";
        recipeProperties.region = "$res[region]";
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
        header("location: /error");
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
        header("location: /error");
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
        header("location: /error");
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
        header("location: /error");
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
        header("location: /error");
        exit;
    }
    if(isset($_SESSION["errorRegister"])){
        unset($_SESSION["errorRegister"]);
    }

    if(isset($_SESSION["errorLog"])){
        unset($_SESSION["errorLog"]);
    }
    ?>
</head>
<body class="White">
    <?php
    include('views/components/header.php');
    include('views/components/menudesplegable.php');
    include("views/components/report.php");
    include('views/components/preloader.php');
    ?>
    <div class="makefs-notification ddr-in-notification">
        <figure class="makefs-notification-rep"></figure>
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-msg">En espera</p></article>
    </div>
    <div class="bookshelf-notification WhiteNotif">
        <img id="bookshelf-icon" src="../views/iconos/book.png" alt="guardados">
        <article class="makefs-notification-info"><b class="notification-title">Notificación</b><p id="notification-save-msg">bookshelf Notification</p></article>
        <a target="_blank" href="/library/<?php echo $_SESSION["id"]?>">Ir a biblioteca</a>
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
                                        <h4> $stepRenderInfo[1] - $stepRenderInfo[2]</h4>
                            EOT;
                                    echo "<p>".test_input($stepRenderInfo[0])."</p>";
                                echo "</article>
                                </li>";
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
                    <h1 class="makefs-video-info-title Whitetitlevideo"><?php echo test_input($res["namer"])?></h1>
                    <a class="makefs-video-info-chef" href="/chef/<?php echo $res['chefid']; ?>">
                        <div id="foto-chef-ddr">
                            <img src="../mediaDB/usersImg/<?PHP echo $res["minpic"]?>" alt="imagen de usuario">
                            <?php if($isVerify){ echo "<img class='verified2' src='../views/img/chef-verified.png' alt='verificacion'>";} ?>
                        </div>
                        
                        <article>
                            <p id="usernameSection" class="Whiteusername"> <?php echo  $res["username"] ?></p>
                            <p class="seguidoresp whitepseg"> <b id="followersSection" class="Whitefollow"><?php echo $seguidores ?></b> Seguidores</p>
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
                        <p class="viewp Whiteviewp"><b id="makefs-video-views" class="Whiteview" ><?php echo $res["views"] ?></b> Visualizaciones</p>
                        <div class="makes-recipe-tags-wrapper">
                            <?php
                                $tagsBase64 = base64_decode($res["tags"]);
                                $tagsDecoded = json_decode($tagsBase64,true);
                                $tagsforjs = "[";
                                foreach ($tagsDecoded as $key => $value){
                                    echo "<p class='makefs-recipe-tag'>".test_input($value)."</p>";
                                    $tagsforjs .= '"'.str_replace($region,"",$value).'",';
                                }
                                echo "<script>recipeProperties.tags = $tagsforjs]</script>";
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
                                    <img src="../views/iconos/makefslogo.jpg" alt='makefslogo'>
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
                        <?php 
                        foreach ($response->recipes as $key => $recipe) {
                            $recipe->rate = number_format($recipe->rate, 1);
                            $title = test_input($recipe->namer);
                            $chefname = test_input($recipe->chefname);
                            echo <<<EOT
                                <div class="recipe-template ddr-recipe">
                                    <a class="image-template" href="/recipe/$recipe->recipeid">
                                        <img src="../mediaDB/recipeImages/$recipe->imagen" alt='imagen de receta'>
                                        <figure class="star-template WhiteStar"><img src="../views/img/hico-star-red.png" alt='estrellas de receta'><b id="starCount">$recipe->rate</b></figure>
                                    </a>
                                    <div class="next-text-recipe WhiteModeP">
                                        <img src="../mediaDB/usersImg/$recipe->chefpic" alt="imagen de usuario">
                                        <a href="./chef/$recipe->chefid">
                                            <h3 class="text-template">$title</h3>
                                            <p>$chefname</p>
                                            <p>$recipe->views Views</p>
                                        </a>
                                    </div>
                                </div>
                            EOT;
                        }
                        ?>
                    </div>
                    <div class="makefs-video-ingredients-ad-wrapper">
                        <h3 class="makefs-ingredients-tittle">Ingredientes</h3>
                        <ul class="makefs-ingredients-wrapper">
                        <?php
                            $ingredientsBase64 = base64_decode($res["ingredients"]);
                            $ingredientsDecoded = json_decode($ingredientsBase64,true);
                            foreach ($ingredientsDecoded as $key => $value){
                                echo "<p class='makefs-ingredient'>".test_input($value)."</p>";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
                <?php
                    include('views/components/categoriesMenu.php');
                ?>
        </div>
    </section>
    <?php
        include('views/components/footer.php');
        if($_SESSION['id']!=0){
            echo <<<EOT
                <script src='../views/js/axiosFollow.js'></script>
                <script src="../views/js/axiosReport.js"></script>
                <script src="../views/js/axiosSaveRecipe.js"></script>
            EOT;
        }
    ?>
    <script src="../views/js/index.js"></script>
    <script src="../views/js/ddr.js"></script>
    <script src="../views/js/followUnloged.js"></script>
    <script src="../views/js/report.js"></script>
    <script src="../views/js/menuDesplegable.js"></script>
    <script src="../views/js/DarkModeddr.js"></script>
    <script src="../views/js/DarkLoader.js"></script>
    <script src="../views/js/DarkModeM.js"></script>
    <script src="../../views/js/responsiveCategoriesOutIndex.js"></script>
<script src="../views/js/preloader.js"></script>
</body>

</html>