<?php
    session_start();
    $folderVideos = "../../mediaDB/recipeVideos";

    $video = $_FILES["videoR"];
    $tipo = $_FILES["videoR"]["type"];
    if($tipo == 'video/mp4' || $tipo == 'video/webm'){
        $resultado = move_uploaded_file($video["tmp_name"], $folderVideos.'/chef#'.$_SESSION["chefid"].$video["name"]);
        if ($resultado) {
            echo "Subido con éxito";
        } else {
            echo "Error al subir archivo";
        }
    }
?>
