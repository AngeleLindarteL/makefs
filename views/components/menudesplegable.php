<?php
if(isset($_SESSION['token'])){
    $isloged = true;
}else{
    $isloged = false;
}
echo <<<EOT
    <div class="makefsContainer nav-bar-container nav-bar-hidden" id="nav-bar-ct">
        <nav id="nav-bar" class="WhiteMenu">
            <div class="searchNav">
                <input class="text WhiteInput" id="busqueda" placeholder="Buscar">
                <button id="sendBusqueda" class="WhiteInput"></button>
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
                            <h2>Latam</h2>
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
                            <h2>Norte.A</h2>
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
EOT;
        if($isloged){
            echo <<<EOT
                <button class="categoriasOpen" id="suscripcion">
                    Suscripciones
                    <img src='./img/suscription.png' alt="TusSus">
                </button>
                <div id="followedsContainer">
            EOT;
                    $conexion = new Conexion();
                    $conexion = $conexion->Conectar();
                    $consulta  = "SELECT userm.username, userm.minpic, userm.chefid FROM follows INNER JOIN userm ON follows.chefid = userm.chefid
                    WHERE followerid = :id";
                    try{
                        $subs = $conexion -> prepare($consulta);
                        $subs ->execute(array(":id"=>$_SESSION['id']));
                    }catch (Exception $e){
                        echo "Error en traer las suscripciones: ".$e;
                    }
                    while($followeds = $subs->fetch(PDO::FETCH_ASSOC)){
                        echo <<<EOT
                            <div id="followedDiv">
                                <a href="./chef-view.php?chef=$followeds[chefid]">
                                    <div id="followedImg">
                                        <img src='../mediaDB/usersImg/$followeds[minpic]' alt="TusSus">
                                    </div>
                                    <div id="followedName" class="Whitename">
                                        <h3>$followeds[username]</h3>
                                    </div>
                                </a>
                            </div>
                        EOT;
                    }
                echo "</div>";
        }
        echo <<<EOT
        <div class="btnsMenuDesp"> 
        <div class="btndesp WhiteDesp">
            <a href="./index.php">
                <img src="./img/home.png" alt="Hamburguesa" id="homered">
                <h3>Home</h3>
            </a>
        </div>
        EOT;
        if($isloged){
            echo <<<EOT
            <div class="btndesp WhiteDesp">
                <a href="./library.php?user=$_SESSION[id]">
                    <img src="./img/saveds.png" id="savered" alt="Hamburguesa">
                    <h3>Guardados</h3>
                </a>
            </div> 
            EOT;
        }
echo <<<EOT
        </div>
        </nav>
    </div>
    
EOT;
?>