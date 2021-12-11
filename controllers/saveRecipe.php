<?php 

error_reporting(E_ALL ^ E_WARNING); 
try {
    include("../models/conexion.php");
    include("../vendor/autoload.php");
    include("jwtController.php");
} catch (Exception $th) {
}

$data = json_decode(file_get_contents("php://input",true));
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userid = $data->userid;
$recipeid = $data->recipeid;
$dateNow = date("Y-m-d H:i:s",time());

$decodedTokenId = json_decode(decodeUserData($_SESSION["token"]));

if ($_SESSION["id"] != $userid || $decodedTokenId->id != $userid) {
    http_response_code(401);
}

try {
    $arguments = array("userid"=>$userid,"recipeid"=>$recipeid);

    $conn = new Conexion();
    $conn = $conn->Conectar();
    $conn->beginTransaction();

    $isSaved = $conn->prepare("SELECT * FROM saveds WHERE userid = :userid AND recipeid = :recipeid");
    $isSaved->execute($arguments);
    $isSaved = $isSaved->fetch(PDO::FETCH_ASSOC);

    if (empty($isSaved)){
        $query = "INSERT INTO saveds(userid,recipeid,savedtime) VALUES(:userid,:recipeid,:savedAt)";
        $arguments["savedAt"] = $dateNow;
    }else{        
        $query = "DELETE FROM saveds WHERE userid = :userid AND recipeid = :recipeid";
    }

    $exec = $conn->prepare($query);
    $exec->execute($arguments);

    $conn->commit();
    $msg = empty($isSaved) ? "saved": "removed";
    echo $msg;
} catch (Exception $ex){
    $conn->rollBack();
    http_response_code(400);
}

?>