<?php
    session_start();
    if (isset($_SESSION['token'])) {
        header('location: /');
    }
?>