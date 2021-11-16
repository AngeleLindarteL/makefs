<?php
    session_start();
    include("../../models/conexion.php");
    $req_info_pass = json_decode(file_get_contents("php://input",true));
    $connObj = new Conexion;
    $conn = $connObj -> Conectar();
    $consulta = "SELECT passwordm FROM userm WHERE userid = :id ";
    
    try{
        $password = $conn->prepare($consulta);
        $conn->beginTransaction();
        $password->execute(array(":id"=>$_SESSION["id"]));
        $conn->commit();
        $passwordm = $password->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
        $conexion->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    
    $passAntigua = $req_info_pass->passAntigua;

    if(password_verify($passAntigua,$passwordm["passwordm"])){

        $newPass =$req_info_pass->passNew;

        $newPassCifrada = password_hash($newPass,PASSWORD_DEFAULT);

        $changePassSQL = "UPDATE userm SET passwordm = :newpass WHERE userid = :id";
        try{
            $updatePass = $conn->prepare($changePassSQL);
            $conn->beginTransaction();
            $updatePass->execute(array(
                ":newpass"=>$newPassCifrada,
                ":id"=>$_SESSION["id"],
                )
            );
            $conn->commit();
            include('../cerrar.php');
        }catch(Exception $e){
            $conexion->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }else{
        echo "contraseñas incorrectas";
    }
?>