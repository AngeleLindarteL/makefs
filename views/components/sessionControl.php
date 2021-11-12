<?php
    session_start();
    if (!isset($_SESSION['token'])) {
        header('location: ../login.php');
    }else{
        $id=$_SESSION['id'];

        $nombre=$_SESSION['nombre'];

        $username=$_SESSION['username'];

        $email=$_SESSION['email'];

        $nacimiento=$_SESSION['nacimiento'];
    }
?>