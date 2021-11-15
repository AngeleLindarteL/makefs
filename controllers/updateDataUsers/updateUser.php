<?php
    include("../../models/conexion.php");
    $req_info = json_decode(file_get_contents("php://input",TRUE));

        $query = "UPDATE userm SET 
        namem = :nombre,
        username = :username,
        email = :email,
        descript = :descript WHERE userid = :id";

        $connObj = new Conexion();
        $conn = $connObj->Conectar();
        $prepared = $conn->prepare($query);
        try{
            $conn->beginTransaction();
            $prepared->execute(
                array(
                ":nombre" => $req_info->nombre,
                ":username" => $req_info->username,
                ":email" => $req_info->email,
                ":descript" => $req_info->descript,
                ":id" => $req_info->id,
                )
            );
            $conn->commit();

            echo "Informacion actualizada del Usuario $req_info->username";
        }catch(Exception $e){
            $conn->rollBack();
            echo "salio mal";
        }
?>