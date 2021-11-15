<?php

include("./models/conexion.php");
$req_info = json_decode(file_get_contents("php://input",TRUE));
try{
    $query = "UPDATE userm SET namem = :nombre WHERE userid = :id";
    $conn = new Conexion();

    $conn = $conn->Conectar();
    $prepared = $conn->prepare($query);

    $prepared->execute(
        array(
        ":nombre" => $req_info->nombre,
        ":id" => $req_info->id,
        )
    );

    echo "Nombre actualizado a $req_info->nombre";
}catch(Exception $e){
    echo http_response_code(404);
}
?>