<?php
session_start();
include("../../models/conexion.php");
    if(isset($_POST["deleteUser"])){

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
        
        if(password_verify($_POST["deleteUserPass"],$passwordm["passwordm"])){
            $consultaDelete = "DELETE FROM userm WHERE userid = :id";
            try{
                $delete = $conn->prepare($consultaDelete);
                $conn->beginTransaction();
                $delete->execute(array(":id"=>$_SESSION["id"]));
                $conn->commit();
                include('../cerrar.php');
                header("location: ../../views/login.php");
            }catch(Exception $e){
                $conexion->rollBack();
                echo "Failed: " . $e->getMessage();
            }
        }else{
            echo "contraseñas incorrectas";
        }
        
    }
?>