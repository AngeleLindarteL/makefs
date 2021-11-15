<?php
session_start();
include("../../models/conexion.php");

    if(isset($_POST["updateSocialMedia"])){
        if(isset($_POST["namem"])&& isset($_POST["username"])&&
        isset($_POST["email"])&& isset($_POST["descript"])){
            $update = "UPDATE userm SET 
            namem = :nombre,
            username = :username,
            email = :email,
            descript = :descript WHERE userid = :id";

            $nombre = $_POST['namem'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $descript = $_POST['descript'];

            $connObj = new Conexion();
            $conn = $connObj->Conectar();
            
            if($conn){
                $prepared = $conn->prepare($update);
                try{
                    $conn->beginTransaction();
                    $prepared->execute(
                        array(
                        ":nombre" => $nombre,
                        ":username" => $username,
                        ":email" => $email,
                        ":descript" => $descript,
                        ":id" => $_SESSION['id'],
                        )
                    );
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['description'] = $descript;
                    $conn->commit();
                    if(isset($_SESSION["chefid"])){
                        header("location: ../../views/chef-view.php");
                    }else{
                        header("location: ../../views/user-view.php");
                    }
                }catch(Exception $e){
                    $conn->rollBack();
                    echo "salio mal";
                }
            }else{
                echo "error en conectar a la bd";
            }
            
        }
    }
?>