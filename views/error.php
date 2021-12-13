<?php

if(sizeof(explode("/",$_SERVER["REQUEST_URI"])) > 1){
  $viewsUrl = "../views";
}else{
  $viewsUrl = "views";
}

ECHO <<<EOT
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Error 404</title>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="$viewsUrl/style.css">
  <link rel="icon" type="image/png" sizes="96x96" href="views/favicon/makefslogo.png">
  <link rel="stylesheet" href="$viewsUrl/css/error.css">
</head>
<body>
<div id="particles-js">
  <canvas class="particles-js-canvas-el"  style="width: 100%; height: 100%;">
  </canvas>
</div>
<div class="divBackCont">
  <a href="/"><img src="$viewsUrl/iconos/back.png" alt="Backbtn"><h1>Regresar</h1></a>
</div>
<div class="container">
  <div class="text">
    <h1 style="text-shadow: -3px 0 0 rgba(255,0,0,.7),
		3px 0 0 rgba(0,255,255,.7);"> ERROR 404 </h1>
    <h2 style="text-shadow: -3px 0 0 rgba(255,0,0,.7),
		3px 0 0 rgba(0,255,255,.7);">La pagina no existe o esta en proceso de desarrollo! </h2>
  </div>
</div>
<footer class="footerM">
  <div>
    <h1>Makefs</h1>
    <h2>Making chef´s</h2>
  </div>
</footer>
  <script src="$viewsUrl/js/error.js"></script>

</body>
</html>
EOT;
?>