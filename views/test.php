<?php 
    include("../controllers/video_streaming/test.php");
    $stream = new VideoStream("./test-imgs/videoPrueba.mp4");
    $stream->start();
?>