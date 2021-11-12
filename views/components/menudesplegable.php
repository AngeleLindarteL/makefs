<?php
echo <<<EOT
    <div class="makefsContainer nav-bar-container nav-bar-hidden" id="nav-bar-ct">
        <nav id="nav-bar">
            <div class="searchNav">
                <input class="text" placeholder="Buscar">
                <button></button>
            </div>
            <button class="categoriasOpen" id="categorias">
                Categorias
                <img onmouseout="this.src='./img/abrirCategoriaFlecha.png'";onmouseover="this.src='./img/abrirCategoriaFlechaHover.png'"; src='./img/abrirCategoriaFlecha.png' alt="abrirmenu">
            </button>
            <div class="categories-down-desplegable" id="menuCATE-DESP">
                <div class="categoryDiv-desplegable" id="returnBtnDesp">
                    
                </div>
                <div class="dosCategorias-despegable">
                    <div class="categoryDiv-desplegable" id="soup">
                        <a href="#" id="latamCate2">
                            <img src="./img/latamCat.png" alt="Colombian">
                            <h2>Latinoamerica</h2>
                        </a>
                    </div>
                    <div class="categoryDiv-desplegable" id="veg">
                        <a href="#" id="asiaCate2">
                            <img src="./img/asiaCat.png" alt="Italian">
                            <h2>Asia</h2>
                        </a>
                    </div>
                </div>
                
                <div class="dosCategorias-despegable">
                    <div class="categoryDiv-desplegable" id="gourmet">
                        <a href="#" id="norteamericaCate2">
                            <img src="./img/norteamericaCat.png" alt="Mexican">
                            <h2>Norteamerica</h2>
                        </a>
                    </div>
                    <div class="categoryDiv-desplegable" id="postre">
                        <a href="#" id="europaCate2">
                            <img src="./img/europaCat.png" alt="Vegetarian">
                            <h2>Europa</h2>
                        </a>
                    </div>
                </div>

                <div class="dosCategorias-despegable">
                    <div class="categoryDiv-desplegable" id="casero">
                        <a href="#" id="africaCate2">
                            <img src="./img/africaCat.png" alt="Hamburguesa">
                            <h2>Africa</h2>
                        </a>
                    </div>
                    <div class="categoryDiv-desplegable" id="tipico">
                        <a href="#" id="oceaniaCate2">
                            <img src="./img/oceaniaCat.png" alt="Hamburguesa">
                            <h2>Oceania</h2>
                        </a>
                    </div>
                </div> 
        </div>

        <button class="categoriasOpen">
            Suscripciones
            <img src='./img/suscription.png' alt="TusSus">
        </button>
        <div class="btnsMenuDesp"> 
            <div class="btndesp">
                <a href="#">
                    <img src="./img/home.png" alt="Hamburguesa">
                    <h3>Home</h3>
                </a>
            </div>
            <div class="btndesp">
                <a href="#">
                    <img src="./img/saveds.png" alt="Hamburguesa">
                    <h3>Guardados</h3>
                </a>
            </div> 
        </div>
        </nav>
    </div>
    EOT;
?>