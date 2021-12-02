<?php
    session_start();
    $folderVideos = "../../mediaDB/recipeVideos";

    $video = $_FILES["videoR"];
    $tipo = $_FILES["videoR"]["type"];

    if($tipo !='video/mp4' ||  'video/webm'){
        echo json_encode(array("msg"=>"error_unsuported_type"));
        exit;
    }

    if($tipo == 'video/mp4' || $tipo == 'video/webm'){
        $resultado = move_uploaded_file($video["tmp_name"], $folderVideos.'/chef-'.$_SESSION["chefid"].$video["name"]);
        if ($resultado) {
            http_response_code(200);
            $jsonEcho = json_encode(array("msg"=>"success_200"));
            echo $jsonEcho;
        } else {
            echo json_encode(array("msg"=>"error_upload"));
        }
    }
?>
