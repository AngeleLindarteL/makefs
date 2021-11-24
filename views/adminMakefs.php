<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="./css/adminPanel.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Admin Panel</title>
    <?php
        include('./components/sessionControl.php');
        include("./components/tokenControl.php")
    ?>
    <script>
        <?php echo "const id =".$_SESSION['id'] ?>
    </script>
</head>
<body>
    <?php
        include('./components/header.php');
        include('./components/menudesplegable.php');
        if($_SESSION["rol"]!="administrador"){
            header("location ./error.html");
        }
    ?>
    <section id="admin-panel">
        <div class="makefsContainer adminpanel">
            <div id="adminContainer">
                <div id="adminData">
                    <figure id="adminFoto">
                            <img class="profile-pic-img-user" src="<?php echo $_SESSION['pic']; ?>">
                            <img class="verified-user" src="./img/chef-verified.png">
                    </figure>
                    <article id="adminInfo">
                        <h2><?php echo $_SESSION["nombre"]?></h2>
                        <p>@<?php echo $_SESSION["username"]?></p>
                        <p><?php echo $_SESSION["rol"]?></p>
                    </article>
                </div>
                <div id="btnsAdmin">
                    <button class="seeDataBtn" id="seeUsers">Ver Usuarios</button><br>
                    <button class="seeDataBtn" id="seeChefs">Ver Chefs</button>
                </div>
            </div>
            <div id="tablasData">
                <div class="tablasDiv" id="tablaUsuarios">
                    <?php
                        
                        $conn = new Conexion;
                        $conn = $conn->Conectar();
                        $sql = "SELECT * FROM userm WHERE chefid is null order by userid";
                        $users = $conn->prepare($sql);
                        try{
                            $conn->beginTransaction();
                            $users->execute();
                            $conn->commit();
                        }catch(Exception $e){
                            $conn->rollBack();
                            echo "Error de consulta";
                        }
                        
                        echo <<<EOT
                            <table>
                                <thead>
                                <tr>
                                    <th>UserId</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Picture</th>
                                    <th>Rol</th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>
                                </tr>
                                </thead>
                                <tbody>
                         EOT;
                            while($userdata=$users->fetch(PDO::FETCH_ASSOC)){
                                echo <<<EOT
                                    <tr>
                                        <td>$userdata[userid]</td>
                                        <td>$userdata[namem]</td>
                                        <td>$userdata[username]</td>
                                        <td>$userdata[email]</td>
                                        <td>$userdata[pic]</td>
                                        <td>$userdata[rol]</td>
                                        <td><img src="./img/deleteUserAdmin.png" alt=""></td>
                                        <td><img src="./img/editUserAdmin.png" alt=""></td>
                                    </tr>
                                EOT;
                            }
                        echo <<<EOT
                                </tbody>
                            </table>
                        EOT;
                    ?>
                </div>
                
                <div class="tablasDiv" id="tablaChefs">
                    <?php
                        $conn = new Conexion;
                        $conn = $conn->Conectar();
                        $sql = "SELECT * FROM userm WHERE chefid is not null order by chefid";
                        $users = $conn->prepare($sql);
                        try{
                            $conn->beginTransaction();
                            $users->execute();
                            $conn->commit();
                        }catch(Exception $e){
                            $conn->rollBack();
                            echo "Error de consulta";
                        }
                        
                        echo <<<EOT
                            <table>
                                <thead>
                                    <th>UserId</th>
                                    <th>ChefId</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Picture</th>
                                    <th>Rol</th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>
                                    <th>Ver Recetas</th>
                                </thead>
                                <tbody>
                         EOT;
                            while($userdata=$users->fetch(PDO::FETCH_ASSOC)){
                                echo <<<EOT
                                    <tr>
                                        <td>$userdata[userid]</td>
                                        <td>$userdata[chefid]</td>
                                        <td>$userdata[namem]</td>
                                        <td>$userdata[username]</td>
                                        <td>$userdata[email]</td>
                                        <td>$userdata[pic]</td>
                                        <td>$userdata[rol]</td>
                                        <td><img src="./img/deleteUserAdmin.png" alt=""></td>
                                        <td><img src="./img/editUserAdmin.png" alt=""></td>
                                        <td><img src="./img/seeRecipesAdmin.png" alt=""></td>
                                    </tr>
                                EOT;
                            }
                        echo <<<EOT
                                </tbody>
                            </table>
                        EOT;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/index.js"></script>
    <script src="./js/chef-view.js"></script>
    <script src="./js/adminMakefs.js"></script>
</body>
</html>