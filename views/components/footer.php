<?php
    if(sizeof(explode("/",$_SERVER["REQUEST_URI"])) > 1 && sizeof(explode("/",$_SERVER["REQUEST_URI"])) < 3){
        $viewsUrl = "../views";
        $mediaUrl = "../mediaDB";
    }else if(sizeof(explode("/",$_SERVER["REQUEST_URI"])) > 2){
        $viewsUrl = "../../views";
        $mediaUrl = "../../mediaDB";
    }else{
        $viewsUrl = "views";
        $mediaUrl = "mediaDB";
    }
echo <<<EOT
	<footer class="footer">
		<div class="titlemakefs">
			<h1>Makef's</h1>
			<h6>Making chefs</h6>
		</div>
		<div class="social">
			<a href="https://www.facebook.com/Kodastr-110199621482041" target="_blank"><img class="imgas" src="$viewsUrl/iconos/facebook.png" alt="Facebook"></a>
			<a href="https://www.instagram.com/kodastrdev/" target="_blank"><img class="imgas" src="$viewsUrl/iconos/instagram.png" alt="Instagram"></a>
			<a href="https://www.youtube.com/channel/UCG9uVvmvhpyU1-lCAklmSYw" target="_blank"><img class="imgas" src="$viewsUrl/iconos/Youtube.png" alt="Youtube"></a>
			<a href="mailto:kodastrdevelop@gmail.com"><img class="imgas" src="$viewsUrl/iconos/email.png" alt="Email"></a>
		</div>
		<ul class="list">
			<li>
				<a href="/">Inicio</a>
			</li >
			<li>
				<a href="#">Servicios</a>
			</li>
			<li>
				<a href="#">Nosotros</a>
			</li>
			<li>
				<a href="#">Terminos</a>
			</li>
			<li>
				<a href="#">Politicas de privacidad</a>
			</li>
		</ul>
		<p class="copyright">Copyright © 2021. Todos los derechos reservados.</p>

	</footer>
	EOT;
?>