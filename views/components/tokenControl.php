<?php
    include("../controllers/jwtController.php");
    if (!isset($_SESSION["token"])) {
        echo <<<EOT
            <script>
                if(window.localStorage.getItem("token")){
                    window.localStorage.removeItem("token");
                }
            </script>
        EOT;
    }else{
        if(isset($_SESSION["token"])){
            echo <<<EOT
                <script>
                if(!window.localStorage.getItem("token")){
                    window.localStorage.setItem("token", "$_SESSION[token]");
                }
                </script>
            EOT;
        }
        $token = $_SESSION["token"];
        try{
            $validatingToken = validateToken($token);
        }catch(Exception $e){
            destroyToken($token);
            include('../controllers/cerrar.php');
            header("Location: ../views/login.php");
        }
    }
?>