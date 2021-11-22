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

    $folderVideos = "C:\xampp\htdocs\makefs\mediaDB\recipeVideos";
    $folderImg = "C:\xampp\htdocs\makefs\mediaDB\recipeImages";
    $nombrevid = $infoRecipe->videoName;
    $tmpVid = $infoRecipe->videoTmp;

    $nombreimg = $infoRecipe->imagenName;
    $tmpImg = $infoRecipe->imagenTmp;

    try{
        $password = $conn->prepare($consulta);
        $conn->beginTransaction();
        $password->execute(
            array(
                ":chefid"=>$infoRecipe->chefid,
                ":namer"=>$infoRecipe->namer,
                ":ingredients"=>$ingredientes,
                ":steps"=>$steps,
                ":video"=>$infoRecipe->videoName,
                ":imagen"=>$infoRecipe->imagenName,
                ":duration"=>1222,//no se como verga sacar la duracion del video
                ":tags"=>$etiquetas,
                ":regionTag"=>$infoRecipe->regionTag,
            ));
        try{
            move_uploaded_file($tmpVid,$folderVideos.'/'."chef#".$infoRecipe->chefid.$infoRecipe->videoName);//no se porque verga no se suben 
            move_uploaded_file($tmpImg,$folderImg.'/'."chef#".$infoRecipe->chefid.$infoRecipe->imagenName);
        }catch(Exception $e){
            echo $e;
        }
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    
?>