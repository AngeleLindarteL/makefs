<?php
    session_start();
    include("../../models/conexion.php");
    $infoFollow = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $consulta = "INSERT INTO follows(followerid,chefid) VALUES(:followerid,:chefid)";
    try{
        $consulta = $conn->prepare($consulta);
        $conn->beginTransaction();
        $consulta->execute(
            array(
                ":followerid"=>$infoFollow->followerid,
                ":chefid"=>$infoFollow->chefid,
            ));
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    
?>