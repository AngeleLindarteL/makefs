<?php
    session_start();
    include("../../models/conexion.php");
    $req_info_pass = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $sql = "INSERT INTO chef(userid) VALUES(:id)";
    $sql2 = "SELECT * FROM chef WHERE userid = :id";
    $sql3 = "UPDATE userm SET chefid = :idchef WHERE userid = :iduser";
    
    try{
        $beChef = $conn->prepare($sql);
        $idChefToUser = $conn->prepare($sql2);
        $idChefUserExecute = $conn->prepare($sql3);

        $conn->beginTransaction();
        $beChef->execute(array(":id"=>$_SESSION["id"]));

        $idChefToUser->execute(array(":id"=>$_SESSION["id"]));
        $chefData = $idChefToUser->fetch(PDO::FETCH_ASSOC);
        $idChef = $chefData["chefid"];

        $idChefUserExecute->execute(array(":idchef"=>$idChef,":iduser"=>$_SESSION["id"]));

        $_SESSION["chefid"]=$idChef;

        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
?>