<?php
    session_start();
    include("../../models/conexion.php");
    $infoEditRecipe = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $consulta = "UPDATE recipe SET namer=:namer, 
    ingredients=:ingredients,steps=:steps,tags=:tags,region=:region
    WHERE recipeid = :recipeid";
    
    $ingredientes = json_encode($infoEditRecipe->ingredients);
    $etiquetas = json_encode($infoEditRecipe->tags);
    $steps = json_encode($infoEditRecipe->steps);
    $ingredientes = base64_encode($ingredientes);
    $etiquetas = base64_encode($etiquetas);
    $steps = base64_encode($steps);

    try{
        $update = $conn->prepare($consulta);
        $conn->beginTransaction();
        $update->execute(
            array(
                ":recipeid"=>$infoEditRecipe->recipeid,
                ":namer"=>$infoEditRecipe->namer,
                ":ingredients"=>$ingredientes,
                ":steps"=>$steps,
                ":tags"=>$etiquetas,
                ":region"=>$infoEditRecipe->regionTag,
            ));
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo http_response_code(400);
    }
    
?>