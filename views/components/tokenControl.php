<?php
    if (!isset($_SESSION["token"])) {
        echo <<<EOT
            <script>
                if(window.localStorage.getItem("token")){
                    window.localStorage.removeItem("token");
                }
            </script>
        EOT;
    }else{
        include("../controllers/jwtController.php");
        if(isset($_SESSION["token"])){
            echo <<<EOT
                <script>
                if(!window.localStorage.getItem("token")){
                    window.localStorage.setItem("token", "$_SESSION[token]");
                }
                </script>
            EOT;
        }
        $token = array("token" => $_SESSION["token"]);
        $validatingToken = validateToken(json_encode($token));
        /*echo "<p>".print_r($_SERVER)."</p>";
        echo $validatingToken;*/
    }
?>