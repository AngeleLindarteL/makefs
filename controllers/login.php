<?php
include("../models/conexion.php");

    if(isset($_POST['cerrar_sesion'])){
        include_once './cerrar.php';
    }

    if(isset($_SESSION['auth'])){
        header("Location: index.php");      
    }

    if(isset($_POST['logeo'])){
        
        if(isset($_POST['username']) && isset($_POST['pw'])){

            $objConn = new Conexion;
            $conexion = $objConn->Conectar();
            $sql = "SELECT * FROM userm WHERE username='$_POST[username]'";

            $userLog = $conexion->prepare($sql);
            try{
                $conexion->beginTransaction();
                $userLog->execute();
                $conexion->commit(); 
                $user = $userLog->fetch(PDO::FETCH_NUM);
                header("location: index.php");
            }catch(Exception $e){
                $conexion->rollBack();
                echo "Failed: " . $e->getMessage();
            }

            if($user){
                if(password_verify($user[4],$_POST['pw'])){
                    $auth=$user[0];
                    $_SESSION['auth']=$auth;
                    if($auth){
                        header("Location: index.php");      
                    }
                    $id=$user[0];
                    $_SESSION['id'] = $id;

                    $nombre=$user[1];
                    $_SESSION['nombre'] = $nombre;

                    $username=$user[2];
                    $_SESSION['username'] = $username;

                    $email=$user[3];
                    $_SESSION['email'] = $email;

                    $nacimiento=$user[5];
                    $_SESSION['nacimiento'] = $nacimiento;

                    $userData = array(
                        "id"=> $_SESSION['id'],
                        "name" => $_SESSION['nombre'],
                        "username" => $_SESSION['username'],
                        "email" => $_SESSION['email'],
                        "password" => $user[4]
                    );
                }else{
                    echo "Contraseña incorrecta";
                }
                
            }else{
                echo "Usuario Incorrecto";
            }
            
        }
        
    }
    echo "</div>";
?>