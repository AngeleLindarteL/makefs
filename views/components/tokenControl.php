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
        
        if(isset($_SESSION["token"])){
            echo <<<EOT
                <script>
                if(!window.localStorage.getItem("token")){
                    window.localStorage.setItem("token", $_SESSION[token].access_token);
                }
                </script>
            EOT;
        }
        
    }
?>