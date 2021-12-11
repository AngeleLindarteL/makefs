<?php
    if(sizeof(explode("/",$_SERVER["REQUEST_URI"])) > 1){
        $viewsUrl = "../views";
        $mediaUrl = "../mediaDB";
    }else{
        $viewsUrl = "views";
        $mediaUrl = "mediaDB";
    }
    echo <<<EOT
        <figure id="btnCategoriesShow" class="WhiteBtnDown"></figure>
        <div class="categories-down WhiteModeCategories" id="menuCATE">
            <div class="categoryDiv Whiteindice" >
                <a id="latamCate">
                    <img src="$viewsUrl/img/latamCat.png" alt="Colombian">
                    <h2 >Latam</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a id="asiaCate">
                    <img src="$viewsUrl/img/asiaCat.png" alt="Italian">
                    <h2>Asia</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a id="norteamericaCate">
                    <img src="$viewsUrl/img/norteamericaCat.png" alt="Mexican">
                    <h2>Norte.A</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a id="europaCate">
                    <img src="$viewsUrl/img/europaCat.png" alt="Vegetarian">
                    <h2>Europa</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice" >
                <a id="africaCate">
                    <img src="$viewsUrl/img/africaCat.png" alt="Hamburguesa">
                    <h2>Africa</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice" >
                <a id="oceaniaCate">
                    <img src="$viewsUrl/img/oceaniaCat.png" alt="Hamburguesa">
                    <h2>Oceania</h2>
                </a>
            </div>
        </div>
        <div class="subcategories-down WhiteModesubCategories" id="latinoamerica">
            <div class="categoryDiv Whiteindice returnBtn">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=latam&type=sopas">
                    <img src="$viewsUrl/img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href./category.php?region=latam&type=vegana">
                    <img src="$viewsUrl/img/vegetarianCat.png" alt="Italian">
                    <h2>Vegana</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=latam&type=gourmet">
                    <img src="$viewsUrl/img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=latam&type=postres">
                    <img src="$viewsUrl/img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=latam&type=casero">
                    <img src="$viewsUrl/img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=latam&type=tipicas">
                    <img src="$viewsUrl/img/latamTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down WhiteModesubCategories" id="asia">
            <div class="categoryDiv Whiteindice returnBtn">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=asia&type=sopas">
                    <img src="$viewsUrl/img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=asia&type=vegana">
                    <img src="$viewsUrl/img/vegetarianCat.png" alt="Italian">
                    <h2>Vegana</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=asia&type=gourmet">
                    <img src="$viewsUrl/img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=asia&type=postres">
                    <img src="$viewsUrl/img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=asia&type=casero">
                    <img src="$viewsUrl/img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=asia&type=tipicas">
                    <img src="$viewsUrl/img/asiaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down WhiteModesubCategories" id="norteamerica">
            <div class="categoryDiv Whiteindice returnBtn">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=nortea&type=sopas">
                    <img src="$viewsUrl/img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=nortea&type=vegana">
                    <img src="$viewsUrl/img/vegetarianCat.png" alt="Italian">
                    <h2>Vegana</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=nortea&type=gourmet">
                    <img src="$viewsUrl/img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=nortea&type=postres">
                    <img src="$viewsUrl/img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=nortea&type=casero">
                    <img src="$viewsUrl/img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=nortea&type=tipicas">
                    <img src="$viewsUrl/img/norteamericaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down WhiteModesubCategories" id="europa">
            <div class="categoryDiv Whiteindice returnBtn">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=europa&type=sopas">
                    <img src="$viewsUrl/img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=europa&type=vegana">
                    <img src="$viewsUrl/img/vegetarianCat.png" alt="Italian">
                    <h2>Vegana</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=europa&type=gourmet">
                    <img src="$viewsUrl/img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=europa&type=postres">
                    <img src="$viewsUrl/img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=europa&type=casero">
                    <img src="$viewsUrl/img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=europa&type=tipicas">
                    <img src="$viewsUrl/img/europaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down WhiteModesubCategories" id="africa">
            <div class="categoryDiv Whiteindice returnBtn">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=africa&type=sopas">
                    <img src="$viewsUrl/img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=africa&type=vegana">
                    <img src="$viewsUrl/img/vegetarianCat.png" alt="Italian">
                    <h2>Vegana</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=africa&type=gourmet">
                    <img src="$viewsUrl/img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=africa&type=postres">
                    <img src="$viewsUrl/img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=africa&type=casero">
                    <img src="$viewsUrl/img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=africa&type=tipicas">
                    <img src="$viewsUrl/img/africaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        <div class="subcategories-down WhiteModesubCategories" id="oceania">
            <div class="categoryDiv Whiteindice returnBtn">
                <a href="#">
                    <h2><<</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=oceania&type=sopas">
                    <img src="$viewsUrl/img/sopaCat.png" alt="Colombian">
                    <h2>Sopas</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=oceania&type=vegana">
                    <img src="$viewsUrl/img/vegetarianCat.png" alt="Italian">
                    <h2>Vegana</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=oceania&type=gourmet">
                    <img src="$viewsUrl/img/gourmetCat.png" alt="Mexican">
                    <h2>Gourmet</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=oceania&type=postres">
                    <img src="$viewsUrl/img/postresCat.png" alt="Mexican">
                    <h2>Postres</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=oceania&type=casero">
                    <img src="$viewsUrl/img/caseroCat.png" alt="Vegetarian">
                    <h2>Casero</h2>
                </a>
            </div>
            <div class="categoryDiv Whiteindice">
                <a href="./category.php?region=oceania&type=tipicas">
                    <img src="$viewsUrl/img/oceaniaTipica.png" alt="Hamburguesa">
                    <h2>Tipicas</h2>
                </a>
            </div>
            
        </div>
        
    EOT;
?>