<?php
    session_start();
    include("../../models/conexion.php");
    $infoEditDelete = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $recipeid = $infoEditDelete->recipeid;
    $consultaData = "SELECT video, imagen FROM recipe WHERE recipeid = :recipeid";
    $consultaDelete = "DELETE FROM recipe WHERE recipeid = :recipeid";
    

    try{
        $delete = $conn->prepare($consultaDelete);
        $dataDelete = $conn->prepare($consultaData);
        
        $conn->beginTransaction();
        $dataDelete->execute(array(":recipeid" => $recipeid));
        $dataDelete = $dataDelete->fetch(PDO::FETCH_ASSOC);
        if(unlink("../../mediaDB/recipeVideos/$dataDelete[video]"));{
            echo "eliminado video con exito";
        }
        if(unlink("../../mediaDB/recipeImages/$dataDelete[imagen]"));{
            echo "elimina imagen con exito";
        }
        $delete->execute(
            array(
                ":recipeid"=> $recipeid,
            ));
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo $e;
    }
    
?>