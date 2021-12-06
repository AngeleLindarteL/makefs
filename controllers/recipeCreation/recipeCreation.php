<?php
    session_start();
    include("../../models/conexion.php");
    $infoRecipe = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $consulta = "INSERT INTO recipe(chefid,namer,ingredients,steps,video,imagen,duration,tags,region,recommendedt,privater,chefname)
    VALUES (:chefid,:namer,:ingredients,:steps,:video,:imagen,:duration,:tags,:regionTag,0,:privater,:chefname) RETURNING recipeid";

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
                ":video"=>'chef-'.$infoRecipe->chefid.$infoRecipe->video,
                ":imagen"=>'chef-'.$infoRecipe->chefid.$infoRecipe->imagen,
                ":duration"=>$infoRecipe->duration,
                ":tags"=>$etiquetas,
                ":regionTag"=>$infoRecipe->regionTag,
                ":privater"=>$infoRecipe->privater,
                ":chefname"=>$infoRecipe->chefname,
        ));
        $rbrecipeid = $password->fetchColumn();
        $rbQuery = "INSERT INTO stars (recipeid,userid,star) VALUES (:rid,10,0)";
        $rbExec = $conn->prepare($rbQuery);
        $rbExec->execute(array("rid"=>$rbrecipeid));
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    
?>