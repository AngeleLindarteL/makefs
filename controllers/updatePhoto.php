<?php 
include("./jwtController.php");
$headers = apache_request_headers();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($headers["Authorization"])) {
    http_response_code(401);
    exit;
}
$token = $headers["Authorization"];
try{
    validateToken($token);
    $userData = json_decode(decodeUserData($token));
}catch(Exception $e){
    http_response_code(401);
    exit;
}
if ($_SESSION["id"] != $userData->id) {
    http_response_code(401);
    exit;
}
$directory = "../mediaDB/usersImg/";
$originalName = $_FILES["photo"]["name"];
$_FILES["photo"]["name"] = "temp-id-$userData->id-".$_FILES["photo"]["name"];
$uploaded_file = $directory.basename($_FILES["photo"]["name"]);


if ($_FILES["photo"]["type"] === "image/gif") {
    echo json_encode(array("msg"=>"error_unsuported_type"));
    exit;
}

if (getimagesize($_FILES["photo"]["tmp_name"]) == false){
    echo json_encode(array("msg"=>"error_unsuported_type"));
    exit;
}
if ($_FILES["photo"]["size"] > 3000000){
    echo json_encode(array("msg"=>"error_too_large"));
    exit;
}

// Deleting old images
try{
    if ($_SESSION["midpic"] != "../mediaDB/usersImg/makefsUser.png" && $_SESSION["midpic"] != "../mediaDB/usersImg/makefsUser.png"
    ){
        unlink($_SESSION["midpic"]);
        unlink($_SESSION["minpic"]);
    }
}catch(Exception $e){
    echo json_encode(array("msg"=>"error_server"));
    exit;
}

// Move a temp img to workit
if(!move_uploaded_file($_FILES["photo"]["tmp_name"],$uploaded_file)){
    echo json_encode(array("msg"=>"error_server"));
    exit;
}
// Compress y gen mid y min images
try{
    list( $width,$height ) = getimagesize($directory.$_FILES["photo"]["name"]);
    if (($height / $width) < 0.4){
        echo json_encode(array("msg"=>"error_unsuported_ratio"));
        exit;
    }
    
    $minImageName = $directory."user-$userData->id-min-$originalName";

    if ($height > 200){
        $minDiv = $height / 200;
    }else{
        $minDiv = 1;
    }
    
    $minHeight = $height / $minDiv;
    $minWidth = $width / $minDiv;
    
    $midImageName = $directory."user-$userData->id-mid-$originalName";
    
    if ($height > 500){
        $midDiv = $height / 500;
    }else{
        $midDiv = 1;
    }

    $midHeight = $height / $midDiv;
    $midWidth = $width / $midDiv;
    
    $minThumb = imagecreatetruecolor($minWidth,$minHeight);
    $midThumb = imagecreatetruecolor($midWidth,$midHeight);
    
    switch ($_FILES["photo"]["type"]) {
        case "image/jpeg":
            $minSource = imagecreatefromjpeg($directory.$_FILES["photo"]["name"]);
            $midSource = imagecreatefromjpeg($directory.$_FILES["photo"]["name"]);
            imagecopyresized($minThumb, $minSource,0,0,0,0,$minWidth,$minHeight,$width,$height);
            imagecopyresized($midThumb, $midSource,0,0,0,0,$midWidth,$midHeight,$width,$height);
            imagejpeg($minThumb,$minImageName);
            imagejpeg($midThumb,$midImageName);
            break;
        case "image/png":
            $minSource = imagecreatefrompng($directory.$_FILES["photo"]["name"]);
            $midSource = imagecreatefrompng($directory.$_FILES["photo"]["name"]);
            imagecopyresized($minThumb, $minSource,0,0,0,0,$minWidth,$minHeight,$width,$height);
            imagecopyresized($midThumb, $midSource,0,0,0,0,$midWidth,$midHeight,$width,$height);
            imagepng($minThumb,$minImageName);
            imagepng($midThumb,$midImageName);
            break;
        default:
        echo json_encode(array("msg"=>"error_server"));
        break;
    }
}catch(Exception $e){
    echo json_encode(array("msg"=>"error_server"));
    exit;
}
unlink($uploaded_file);
$query = "UPDATE userm SET midpic = :midpic, minpic = :minpic WHERE userid = :id";
try{
    $conn = new Conexion();
    $conn = $conn->Conectar();
    $conn->beginTransaction();
    $req = $conn->prepare($query);
    $req = $req->execute(array("midpic"=>"user-$userData->id-mid-$originalName","minpic"=>"user-$userData->id-min-$originalName", "id"=>$userData->id));
    $conn->commit();
}catch(Exception $e){
    $conn->rollBack();
    echo json_encode(array("msg"=>"error_server"));
    exit;
}
$_SESSION["minpic"] = "../mediaDB/usersImg/user-$userData->id-min-$originalName";
$_SESSION["midpic"] = "../mediaDB/usersImg/user-$userData->id-mid-$originalName";
http_response_code(200);
$jsonEcho = json_encode(array("msg"=>"success_200","newMidImg"=>$_SESSION["midpic"],"newMinImg"=>$_SESSION["minpic"]));
echo $jsonEcho;
?>