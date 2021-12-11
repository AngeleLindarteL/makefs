<?php
session_start();
include("../../models/conexion.php");
    if(isset($_POST["deleteUser"])){

        $connObj = new Conexion;
        $conn = $connObj -> Conectar();
        $consulta = "SELECT passwordm,minpic,midpic FROM userm WHERE userid = :id ";
        
        try{
            $password = $conn->prepare($consulta);
            $conn->beginTransaction();
            $password->execute(array(":id"=>$_SESSION["id"]));
            $conn->commit();
            $passwordm = $password->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
        
        if(password_verify($_POST["deleteUserPass"],$passwordm["passwordm"])){
            $consultaDelete = "DELETE FROM userm WHERE userid = :id";
            try{
                $url = "https://makefsapi.herokuapp.com/user/$_SESSION[id]";

                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

                $response = curl_exec($ch);
                curl_close($ch);
                if($response == false || $response == "False" || $response == "false"){
                    return;
                    exit;
                }
                unlink( "../mediaDB/usersImg/" . $passwordm["minpic"]);
                unlink( "../mediaDB/usersImg/" . $passwordm["midpic"]);
                $delete = $conn->prepare($consultaDelete);
                $conn->beginTransaction();
                $delete->execute(array(":id"=>$_SESSION["id"]));
                $conn->commit();
                include('../cerrar.php');
                header("location: /login");
            }catch(Exception $e){
                $conn->rollBack();
                echo "Failed: " . $e->getMessage();
            }
        }else{
            echo "contraseñas incorrectas";
        }
        
    }
?>