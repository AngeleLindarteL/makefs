<?php
session_start();
    include("../../models/conexion.php");
    $req_info = json_decode(file_get_contents("php://input",TRUE));

        $query = "UPDATE userm SET 
        namem = :nombre,
        username = :username,
        email = :email,
        facebook = :facebook,
        instagram = :instagram,
        youtube = :youtube,
        twitter = :twitter,
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
                ":facebook" => $req_info->facebook,
                ":instagram" => $req_info->instagram,
                ":youtube" => $req_info->youtube,
                ":twitter" => $req_info->twitter,
                ":descript" => $req_info->descript,
                ":id" => $req_info->id,
                )
            );
            $conn->commit();

            echo "Informacion actualizada del Usuario $req_info->username";
            $_SESSION['nombre'] = $req_info->nombre ;
            $_SESSION['username'] = $req_info->username;
            $_SESSION['email'] = $req_info->email;
            $_SESSION['description'] =$req_info->descript ;
            $_SESSION['facebook'] =$req_info->facebook ;
            $_SESSION['instagram'] =$req_info->instagram ;
            $_SESSION['youtube'] =$req_info->youtube ;
            $_SESSION['twitter']=$req_info->twitter;
        }catch(Exception $e){
            $conn->rollBack();
            echo http_response_code(400);
        }
?>