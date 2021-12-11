<?php
if (isset($_GET["view"])) {
    $view = $_GET["view"];
    
    $view = explode("/",$view);
    switch ($view[0]) {
        case 'register':
            include "./views/register.php";
            break;
        case 'login':
            include "./views/login.php";
            break;
        case 'user':
            include "./views/user-view.php";
            break;
        case 'recipe':
            if (!isset($view[1])){
                include "./views/error.php";
            }
            $_GET["video"] = $view[1];
            include "views/ddr.php";
            break;
        case 'chef':
            if (!isset($view[1])){
                include "./views/error.php";
            }
            $_GET["chef"] = $view[1];
            include "./views/chef-view.php";
            break;
        case 'library':
            if (!isset($view[1])){
                include "./views/error.php";
            }
            $_GET["user"] = $view[1];
            include "./views/library.php";
            break;
        case 'newrecipe':
            include "./views/newRecipe.php";
            break;
        case 'editrecipe':
            if (!isset($view[1])){
                include "./views/error.php";
            }
            $_GET["receta"] = $view[1];
            include "./views/editRecipe.php";
            break;
        default:
            include "./views/error.php";
        break;
    }
}else{
    include "./views/index.php";
}
?>