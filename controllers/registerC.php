<?php
session_start();
include("../models/conexion.php");
 if(isset($_POST['register'])){

    if(isset($_POST['realname']) && isset($_POST['username']) &&
    isset($_POST['email']) && isset($_POST['pw']) && isset($_POST['date'])){

        $nombre = $_POST['realname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pw'];
        $date = $_POST['date'];
        $passconfirmed =$_POST["pwconfirm"];
        if($pass==$passconfirmed){
            $pass_cifrada = password_hash($pass,PASSWORD_DEFAULT);

            $connObj = new Conexion;
            $conexion= $connObj->Conectar();
            if($conexion){
                $sql = "INSERT INTO userm(namem,username,email,passwordm,birthdate,midpic,minpic) VALUES(:nombre,:username,:email,:pass,:birthdate,:midpic,:minpic)";
                $resultado = $conexion->prepare($sql);

                try{
                    $conexion->beginTransaction();
                    $resultado->execute(array(":nombre"=>$nombre,":username"=>$username,":email"=>$email,":pass"=>$pass_cifrada,":birthdate"=>$date,"midpic" => "makefsUser.png","minpic" => "makefsUser.png"));
                    $conexion->commit();

                    if(isset($_SESSION["errorRegister"])){
                        unset($_SESSION["errorRegister"]);
                    }

                    if(isset($_SESSION["errorLog"])){
                        unset($_SESSION["errorLog"]);
                    }

                    header("location: ../views/login.php");
                }catch(PDOException $e){
                    $conexion->rollBack();
                    $_SESSION["errorRegister"] = $e->getMessage();
                    header("location: ../views/register.php");
                }
            }else{
                echo "Error en el registro de los datos";
            }
        }else{
            $_SESSION["errorRegister"] = "contrasNoCoinciden";
            header("location: ../views/register.php");
        }   
    }else{
        echo "Llena todos los campos";
    }
 }
?>