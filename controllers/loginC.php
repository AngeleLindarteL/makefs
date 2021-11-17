<?php
session_start();
include("./jwtController.php");

    if(isset($_POST['cerrar_sesion'])){
        include('./cerrar.php');
        header("Location: ../views/login.php");
    }

    if(isset($_SESSION['auth'])){
        header("Location: ../views/index.php");      
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
                $user = $userLog->fetch(PDO::FETCH_ASSOC);
                
            }catch(Exception $e){
                $conexion->rollBack();
                echo "Failed: " . $e->getMessage();
            }
            
            $contraIngresada = $_POST['pw'];
            $user["passwordm"];
            echo $contraIngresada;
            echo $user["passwordm"];

            if($user){
                if(password_verify($contraIngresada,$user["passwordm"])){
                    session_start();
                                 
                    $id=$user["userid"];
                    $_SESSION['id'] = $id;

                    $nombre=$user["namem"];
                    $_SESSION['nombre'] = $nombre;

                    $username=$user["username"];
                    $_SESSION['username'] = $username;

                    $email=$user["email"];
                    $_SESSION['email'] = $email;

                    $nacimiento=$user["birthdate"];
                    $_SESSION['nacimiento'] = $nacimiento;
                    
                    $descript = $user["descript"];
                    $_SESSION['description'] = $descript;

                    $pic = $user["pic"];
                    $_SESSION["pic"] = "../mediaDB/usersImg/".$pic;

                    $chefid = $user["chefid"];
                    $_SESSION["chefid"]= $chefid;

                    $facebook = $user["facebook"];
                    $_SESSION["facebook"]= $facebook;
                    $instagram = $user["instagram"];
                    $_SESSION["instagram"]= $instagram;
                    $youtube = $user["youtube"];
                    $_SESSION["youtube"]= $youtube;

                    $password = $user["passwordm"];
                    $token = generateToken($_SESSION["username"], $password);

                    
                    $_SESSION["token"] = $token;
                    header("location: ../views/index.php");

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