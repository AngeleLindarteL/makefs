<?php 

// This is an example for login for Deiberdev

    use Firebase\JWT\JWT;
    include("./jwtController.php");
    $req_info = json_decode(file_get_contents("php://input",TRUE));
    $data = array(
        "username" => $req_info->user,
        "password" => $req_info->password,
        "status" => true
    );
    $token = generateToken($data["username"],$data["password"]);
    echo $token;
    // $token = json_decode($token);
    // echo validateToken($token->access_token);
    // echo decodeUserData($token->access_token)
?>