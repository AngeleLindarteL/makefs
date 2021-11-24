<?php
    session_start();
    include("../../models/conexion.php");
    $infoEditDelete = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $consultaDelete = "DELETE FROM recipe WHERE recipeid = :recipeid";
    
    try{
        $delete = $conn->prepare($consultaDelete);
        $conn->beginTransaction();
        $delete->execute(
            array(
                ":recipeid"=>$infoEditDelete->recipeid,
            ));
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo http_response_code(400);
    }
    
?>