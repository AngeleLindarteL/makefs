<?php
    $folderVideos = "../../mediaDB/recipeVideos";
    $folderImg = "../../mediaDB/recipeImages";

    $video = $_FILES["videoR"];
    $resultado = move_uploaded_file($video["tmp_name"], $folderVideos.'/chef#'.$infoRecipe->chefid.$video["name"]);
    if ($resultado) {
        echo "Subido con éxito";
    } else {
        echo "Error al subir archivo";
    }
?>
