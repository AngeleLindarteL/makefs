<?php
    session_start();
    include("../../models/conexion.php");
    $infoRecipe = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $consulta = "INSERT INTO recipe(chefid,namer,ingredients,steps,video,imagen,duration,tags,region)
    VALUES (:chefid,:namer,:ingredients,:steps,:video,:imagen,:duration,:tags,:regionTag)";
    
    $ingredientes = json_encode($infoRecipe->ingredients);
    $etiquetas = json_encode($infoRecipe->tags);
    $steps = json_encode($infoRecipe->steps);
    $ingredientes = base64_encode($ingredientes);
    $etiquetas = base64_encode($etiquetas);
    $steps = base64_encode($steps);

    try{
        $password = $conn->prepare($consulta);
        $conn->beginTransaction();
        $password->execute(
            array(
                ":chefid"=>$infoRecipe->chefid,
                ":namer"=>$infoRecipe->namer,
                ":ingredients"=>$ingredientes,
                ":steps"=>$steps,
                ":video"=>'chef#'.$infoRecipe->chefid.$infoRecipe->video,
                ":imagen"=>'chef#'.$infoRecipe->chefid.$infoRecipe->imagen,
                ":duration"=>1222,//no se como verga sacar la duracion del video
                ":tags"=>$etiquetas,
                ":regionTag"=>$infoRecipe->regionTag,
            ));
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    
?>