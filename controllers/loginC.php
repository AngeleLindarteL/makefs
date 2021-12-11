<?php
session_start();

try {
    include_once("../vendor/autoload.php");
    include_once("../models/conexion.php");
    include("jwtController.php");
} catch (Exception $th) {

}
include("../views/components/test_inputs.php");
    if(isset($_POST['cerrar_sesion'])){
        destroyToken($_SESSION["token"]);
        include('controllers/cerrar.php');
        header("Location: /login");
    }
    if(isset($_SESSION['auth'])){
        header("Location: /");      
    }

    if(isset($_POST['logeo'])){
        
        if(isset($_POST['username']) && isset($_POST['pw'])){

            $actualDate = date("Y-m-d H:i:s", time());
            $objConn = new Conexion;
            $conexion = $objConn->Conectar();
            $sql = "SELECT * FROM userm WHERE username='$_POST[username]'";
            $cleanBlackTokens = "DELETE FROM jwt_tokens_blacklist WHERE expires < '$actualDate'";

            $userLog = $conexion->prepare($sql);
            $cleanBLJWT = $conexion->prepare($cleanBlackTokens);
            try{
                $conexion->beginTransaction();
                $cleanBLJWT->execute();
                $userLog->execute();
                $conexion->commit(); 
                $user = $userLog->fetch(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                $conexion->rollBack();
                echo "Failed: " . $e->getMessage();
            }
            
            $contraIngresada = $_POST['pw'];
            $user["passwordm"];

            if($user){
                if(password_verify($contraIngresada,$user["passwordm"])){
                    session_start();
                                 
                    $id=$user["userid"];
                    $_SESSION['id'] = $id;

                    $nombre=$user["namem"];
                    $_SESSION['nombre'] = test_input($nombre);

                    $username=$user["username"];
                    $_SESSION['username'] = test_input($username);

                    $email=$user["email"];
                    $_SESSION['email'] = test_input($email);

                    $nacimiento=$user["birthdate"];
                    $_SESSION['nacimiento'] = $nacimiento;
                    
                    $descript = $user["descript"];
                    $_SESSION['description'] = test_input($descript);

                    $pic = $user["midpic"];
                    $_SESSION["midpic"] = $pic;

                    $pic = $user["minpic"];
                    $_SESSION["minpic"] = $pic;

                    $chefid = $user["chefid"];
                    $_SESSION["chefid"]= $chefid;

                    $rol = $user["rol"];
                    $_SESSION["rol"]=$rol;

                    $facebook = $user["facebook"];
                    $_SESSION["facebook"]= test_input($facebook);
                    $instagram = $user["instagram"];
                    $_SESSION["instagram"]= test_input($instagram);
                    $youtube = $user["youtube"];
                    $_SESSION["youtube"]= test_input($youtube);
                    $twitter = $user["twitter"];
                    $_SESSION["twitter"]= test_input($twitter);

                    $password = $user["passwordm"];
                    $token = generateToken($_SESSION["username"], $password);
                    $token = json_decode($token);
                    $token = $token->access_token;
                    $_SESSION["watched_in_session_list"] = array();

                    if(isset($_SESSION["errorLog"])){
                        unset($_SESSION["errorLog"]);
                    }

                    if(isset($_SESSION["errorRegister"])){
                        unset($_SESSION["errorRegister"]);
                    }
                    
                    $_SESSION["token"] = $token;
                    header("location: /");
                    

                }else{
                    $_SESSION["errorLog"] = "contrasena";
                    header("location: /login");
                }
                
            }else{
                $_SESSION["errorLog"] = "user";
                header("location: /login");
            }
            
        }
        
    }
    echo "</div>";
?>