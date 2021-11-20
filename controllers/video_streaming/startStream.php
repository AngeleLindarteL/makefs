<?php

include("./videoStream.php");

$videoInfo = $_GET["video_path"];
$resourceDir = "../../mediaDB/";

$stream = new VideoStream($resourceDir.$videoPath);
$stream->start();
?>