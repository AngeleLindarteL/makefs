<?php
    session_start();
    $folderImg = "../../mediaDB/recipeImages";

    $imagen = $_FILES["imagenR"];
    $tipo = $_FILES["imagenR"]["type"];
    if($tipo == 'image/jpeg' || $tipo == 'image/png'){
        $resultado = move_uploaded_file($imagen["tmp_name"], $folderImg.'/chef#'.$_SESSION["chefid"].$imagen["name"]);
        if ($resultado) {
            echo "Subido con éxito $tipo";
        } else {
            echo "Error al subir archivo";
        }
    }
?>