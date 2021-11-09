<?php 

// This is an example for login for Deiberdev

    use Firebase\JWT\JWT;

    $key = "b119bf23af9566f4d16417725242e9485f396564c4d331e19fd9d920ef2154e2"; // Makefs secret key
    $algorithm = ["HS256",];
    include("./jwtController.php");
    $req_info = json_decode(file_get_contents("php://input",TRUE));
    $data = array(
        "user" => $req_info->user,
        "password" => $req_info->password,
        "status" => true
    );
    $token = generateToken($data);
    echo $token;
    $token = json_decode($token);
    echo validateToken($token->access_token);
    echo decodeUserData($token->access_token)
?>