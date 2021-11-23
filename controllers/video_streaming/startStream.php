<?php

$resourceDir = "../../mediaDB/recipeVideos/";
$videoInfo = $_GET["video"];

$_GET["video_path"] = $resourceDir.$videoInfo;
include("./videoStream.php");
?>