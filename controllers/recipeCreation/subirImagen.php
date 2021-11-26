<?php
    session_start();
    $folderImg = "../../mediaDB/recipeImages";

    $imagen = $_FILES["imagenR"];
    $tipo = $_FILES["imagenR"]["type"];
    if($tipo == 'image/jpeg' || $tipo == 'image/png'){
        $resultado = move_uploaded_file($imagen["tmp_name"], $folderImg.'/chef-'.$_SESSION["chefid"].$imagen["name"]);
        if ($resultado) {
            http_response_code(200);
            $jsonEcho = json_encode(array("msg"=>"success_200"));
            echo $jsonEcho;
        } else {
            echo json_encode(array("msg"=>"error_upload"));
        }
    }
?>