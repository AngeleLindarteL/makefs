<?php
    session_start();
    include("../../models/conexion.php");
    $infoRecipe = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $consulta = "INSERT INTO recipe(chefid,namer,ingredients,steps,video,imagen,duration,tags,regionTag 
    VALUES (:chefid,:namer,:ingredients,:steps,:video,:imagen,:duration,:tags,:regionTag)";
    
    $ingredientes = json_encode($infoRecipe->ingredients);
    $etiquetas = json_encode($infoRecipe->tags);
    $steps = json_encode($infoRecipe->steps);

    try{
        $password = $conn->prepare($consulta);
        $conn->beginTransaction();
        $password->execute(
            array(
                ":chefid"=>$infoRecipe->chefid,
                ":namer"=>$infoRecipe->namer,
                ":ingredients"=>$ingredientes,
                ":steps"=>$steps,
                //":video"=>$infoRecipe->video,
                //":imagen"=>$infoRecipe->imagen,
                ":duration"=>1222,
                ":tags"=>$etiquetas,
                ":regionTag"=>$infoRecipe->regionTag,
            ));
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    
?>