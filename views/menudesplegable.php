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
                <div class="dosCategorias-despegable">
                    <div class="categoryDiv-desplegable" >
                        <a href="#" id="latamCate2">
                            <img src="./img/latamCat.png" alt="Colombian">
                            <h2>Latinoamerica</h2>
                        </a>
                    </div>
                    <div class="categoryDiv-desplegable">
                        <a href="#" id="asiaCate2">
                            <img src="./img/asiaCat.png" alt="Italian">
                            <h2>Asia</h2>
                        </a>
                    </div>
                </div>
                
                <div class="dosCategorias-despegable">
                    <div class="categoryDiv-desplegable">
                        <a href="#" id="norteamericaCate2">
                            <img src="./img/norteamericaCat.png" alt="Mexican">
                            <h2>Norteamerica</h2>
                        </a>
                    </div>
                    <div class="categoryDiv-desplegable">
                        <a href="#" id="europaCate2">
                            <img src="./img/europaCat.png" alt="Vegetarian">
                            <h2>Europa</h2>
                        </a>
                    </div>
                </div>

                <div class="dosCategorias-despegable">
                    <div class="categoryDiv-desplegable" id="africaCate2">
                        <a href="#">
                            <img src="./img/africaCat.png" alt="Hamburguesa">
                            <h2>Africa</h2>
                        </a>
                    </div>
                    <div class="categoryDiv-desplegable" id="oceaniaCate2">
                        <a href="#">
                            <img src="./img/oceaniaCat.png" alt="Hamburguesa">
                            <h2>Oceania</h2>
                        </a>
                    </div>
                </div> 
        </div>
        <div class="subcategories-down-despegable" id="latinoamerica2">
            
            <div class="categoryDiv-desplegable returnBtnDesp">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="dosCategorias-despegable">
                <div class="categoryDiv-desplegable">
                    <a href="#">
                        <img src="./img/sopaCat.png" alt="Colombian">
                        <h2>Sopas</h2>
                    </a>
                </div>
                <div class="categoryDiv-desplegable">
                    <a href="#">
                        <img src="./img/vegetarianCat.png" alt="Italian">
                        <h2>Vegetariana</h2>
                    </a>
                </div>
            </div>
            <div class="dosCategorias-despegable">
                <div class="categoryDiv-desplegable">
                    <a href="#">
                        <img src="./img/gourmetCat.png" alt="Mexican">
                        <h2>Gourmet</h2>
                    </a>
                </div>
                <div class="categoryDiv-desplegable">
                    <a href="#">
                        <img src="./img/postresCat.png" alt="Mexican">
                        <h2>Postres</h2>
                    </a>
                </div>
            </div>
            <div class="dosCategorias-despegable">
                <div class="categoryDiv-desplegable">
                    <a href="#">
                        <img src="./img/caseroCat.png" alt="Vegetarian">
                        <h2>Casero</h2>
                    </a>
                </div>
                <div class="categoryDiv-desplegable">
                    <a href="#">
                        <img src="./img/latamTipica.png" alt="Hamburguesa">
                        <h2>Tipicas</h2>
                    </a>
                </div>
            </div>
            
        </div>
        <div class="subcategories-down-despegable" id="asia2">
            <div class="categoryDiv-desplegable returnBtnDesp">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/vegetarianCat.png" alt="Italian">
                    <h2>Vegetariana</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/asiaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down-despegable" id="norteamerica2">
            <div class="categoryDiv-desplegable returnBtnDesp">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/vegetarianCat.png" alt="Italian">
                    <h2>Vegetariana</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/norteamericaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down-despegable" id="europa2">
            <div class="categoryDiv-desplegable returnBtnDesp">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/vegetarianCat.png" alt="Italian">
                    <h2>Vegetariana</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/europaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down-despegable" id="africa2">
            <div class="categoryDiv-desplegable returnBtnDesp">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/vegetarianCat.png" alt="Italian">
                    <h2>Vegetariana</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/africaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down-despegable" id="oceania2">
            <div class="categoryDiv-desplegable returnBtnDesp">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/vegetarianCat.png" alt="Italian">
                    <h2>Vegetariana</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv-desplegable">
                <a href="#">
                    <img src="./img/oceaniaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <button class="categoriasOpen">
            Suscripciones
            <img src='./img/suscription.png' alt="TusSus">
        </button>
        <div class="btnsMenuDesp"> 
            <div class="btndesp">
                <img src="./img/home.png" alt="Hamburguesa">
                <h3>Home</h3>
            </div>
            <div class="btndesp">
                <img src="./img/saveds.png" alt="Hamburguesa">
                <h3>Guardados</h3>
            </div> 
        </div>
        </nav>
    </div>
    EOT;
?>