<?php 

$data = json_decode(file_get_contents("php://input",true));
include("../models/conexion.php");

$userid = $data->userid;
$recipeid = $data->recipeid;
$reason = $data->reason;
$details = $data->details;

if (empty($reason) || empty($details) || empty($userid) || empty($recipeid) || $details == "Escoge la razón del reporte") {
    http_response_code(400);
}

try {
    $conn = new Conexion();
    $conn = $conn->Conectar();
    $checkQuery = "SELECT * FROM report WHERE userid = $userid";
    $execQuery = "";
    $conn->beginTransaction();
    
    $alreadyReported = $conn->prepare($checkQuery);
    $alreadyReported->execute();
    $alreadyReported = $alreadyReported->fetch(PDO::FETCH_ASSOC);
    if (empty($alreadyReported)){
        $execQuery = "INSERT INTO report(recipeid,userid,reason,details) VALUES (:recipe,:user,:reason,:details)";
    }else{
        $execQuery = "UPDATE report SET reason = :reason, details = :details WHERE recipeid = :recipe AND userid = :user";
    }
    $exec = $conn->prepare($execQuery);
    $exec->execute(array("reason" => $reason, "user" => $userid, "details" => $details, "recipe" => $recipeid));

    $conn->commit();
} catch (Exception $th) {
    $conn->rollBack();
    http_response_code(400);
    echo $th;
}

?>