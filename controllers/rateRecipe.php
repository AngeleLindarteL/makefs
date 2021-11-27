<?php 

include("../models/conexion.php");

$data = json_decode(file_get_contents("php://input",true));
$recipe = $data->recipe;
$userId = $data->userId;
$rate = $data->rate;

try{
    $conn = new Conexion();
    $conn = $conn->Conectar();
    $comprobeQuery = "SELECT * FROM stars WHERE recipeid = $recipe AND userid = $userId";
    $rateQuery = "";
    $conn->beginTransaction();
    $isAlreadyRated = $conn->prepare($comprobeQuery);
    $isAlreadyRated->execute();
    $isAlreadyRated = $isAlreadyRated->fetch(PDO::FETCH_ASSOC);
    if (empty($isAlreadyRated)){
        $rateQuery = "INSERT INTO stars(recipeid,userid,star) VALUES ($recipe,$userId,$rate)";
    }else{
        $rateQuery = "UPDATE stars SET star = $rate WHERE userid = $userId AND recipeid = $recipe";
    }
    $rateExecution = $conn->prepare($rateQuery);
    $rateExecution->execute();

    $conn->commit();
    echo "Puntuación hecha con éxito";
}catch(Exception $e){
    http_response_code(400);
}

?>