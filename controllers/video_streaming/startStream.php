<?php

include("./videoStream.php");
include("../../models/conexion.php");

$conn = new Conexion();
$conn = $conn->Conectar();
$query = "SELECT video FROM recipe WHERE recipeid = :recipe";
$videoInfo = $conn->prepare($query);
try{
    $videoInfo->execute(array("recipe" => $_GET["video_id"]));
    $videoPath = $videoInfo->fetch(PDO::FETCH_NUM);
}catch(Exception $e){
    echo http_response_code(400);
    exit;
}
$resourceDir = "../../mediaDB/";

$stream = new VideoStream($resourceDir.$videoPath);
$stream->start();
?>