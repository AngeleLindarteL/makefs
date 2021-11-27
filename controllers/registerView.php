<?php
include("../models/conexion.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$data = json_decode(file_get_contents("php://input",true));
$video = $data->videoId;
$video_session_variable = "_".$video."_";
$timeNow = time();

if(isset($_SESSION[$video_session_variable])){
    if ($_SESSION[$video_session_variable] > $timeNow) {
        http_response_code(400);
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

    $_SESSION[$video_session_variable] = time()+1080000;
    array_push($_SESSION["watched_in_session_list"], $video_session_variable);
}catch(Exception $e){
    $conn->rollBack();
    echo json_encode(array("msg"=>"Error al registrar la view en la base de datos", "error", $e));
    exit;
}
echo json_encode(array("msg"=>"View Totalmente Registrada", "checkthis" => $_SESSION[$video_session_variable], "actualTime" => $timeNow, "bruh" => $_SESSION["watched_in_session_list"]));
$_
?>