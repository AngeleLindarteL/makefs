<?php
include("../models/conexion.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$data = json_decode(file_get_contents("php://input",true));
$user = $data->userId;
$video = $data->videoId;
$timeNow = time();

if (isset($_SESSION[$video])){
    if ($_SESSION[$video] > $timeNow) {
        echo json_encode(array("msg"=>"View ya registrada"));
        exit;
    }
}
if (isset($_COOKIE[$video])) {
    echo json_encode(array("msg"=>"View ya registrada"));
    exit;
}
$conn = new Conexion();
$conn = $conn->Conectar();
$updateSQL = "UPDATE recipe SET views = views+1 WHERE recipeid = $video";
try{
    $conn->beginTransaction();

    $views = $conn->prepare($updateSQL);
    $views->execute();

    $conn->commit();

    $_SESSION[$video] = time()+1800;
}catch(Exception $e){
    $conn->rollBack();
    echo json_encode(array("msg"=>"Error al registrar la view en la base de datos", "error", $e));
    exit;
}
echo json_encode(array("msg"=>"View Registrada", "checkthis" => $_SESSION[$video], "actualTime" => $timeNow));
?>