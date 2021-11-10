<?php
include("./models/conexion.php");
 if(isset($_POST['register'])){

    if(isset($_POST['realname']) && isset($_POST['username']) &&
    isset($_POST['email']) && isset($_POST['pw']) && isset($_POST['date'])){

        $nombre = $_POST['realname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pw'];
        $date = $_POST['date'];

        $pass_cifrada = password_hash($pass,PASSWORD_DEFAULT);

        $connObj = new Conexion();
        $conexion= $connObj->Conectar();
        if($conexion){
            $sql = "INSERT INTO userm(namem,username,email,passwordm,birthdate) VALUES(:nombre,:username,:email,:pass,:birthdate)";
            $resultado = $conexion->prepare($sql);

            try{
                $conexion->beginTransaction();
                $resultado->execute(array(":nombre"=>$nombre,":username"=>$username,":email"=>$email,":pass"=>$pass_cifrada,":birthdate"=>$date));
                $conexion->commit();
                echo "registro exitoso";
                header("location: login.html");
            }catch(Exception $e){
                $conexion->rollBack();
                echo "Failed: " . $e->getMessage();
            }
        }else{
            echo "Error en el registro de los datos";
        }
    }else{
        echo "Llena todos los campos";
    }
 }
?>