<?php
    if (session_status() == PHP_SESSION_NONE) {
        echo <<<EOT
            <script>
                if(window.localStorage.getItem("token")){
                    window.localStorage.removeItem("token");
                }
            </script>
        EOT;
    }
?>