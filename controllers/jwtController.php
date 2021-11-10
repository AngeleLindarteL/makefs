<?php
    include("../vendor/autoload.php");
    include("../models/conexion.php");
    use Firebase\JWT\JWT;

    // This it's the key and the algorithm used to encrypt the data of JWT
    $key = "b119bf23af9566f4d16417725242e9485f396564c4d331e19fd9d920ef2154e2"; // Makefs secret key
    $algorithm = ["HS256",];

    // This define the life time of a token 

    $iat = time(); // Emission time of token (unixstamp now)
    $nfb = $iat + 10; // Not before time of token
    $exp = $iat + 280; // LifeTime of Token

    // Now we got the final config for using JWT
    $payload = array(
        "iss" => "https://www.makefs.com",
        "aud" => "https://www.makefs.com",
        "iat" => $iat,
        "nfb" => $nfb,
        "exp" => $exp,
    );

    function generateToken($username, $password){
        $key = $GLOBALS["key"];
        $payload = $GLOBALS["payload"];
        $sql = "SELECT * FROM userm WHERE username = :username AND passwordm = :password";
        $error = "";
        $conexion = new Conexion;
        try{
            $conexion = $conexion->Conectar();
            $request = $conexion->prepare($sql);
            $conexion->beginTransaction();
            $request->execute(array(":username" =>  $username, ":password" => $password));
            $conexion->commit();
            $data = $request->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $conexion->rollBack();
            $error = "error noob: ".$e->getMessage();
        }
        if(!empty($error)){
            return json_encode(array("error" => "Invalid Query", "info" => $error));
        }
        if(empty($data)){
            return json_encode(array("error" => "Invalid Query", "info" => "Invalid username or password"));
        }
        // Agregar data al payload para descifrarla
        $userData = array(
            "id" => $data["userid"],
            "username"=> $data["username"],
            "email" => $data["email"],
        );
        $payload["userData"] = $userData;
        $jwtToken = JWT::encode($payload, $key);
        $returneddata = array(
            "access_token" => $jwtToken,
            "time" => date("d M Y H:i:s",time()),
            "status" => http_response_code(200),
            "message" => "Successfully logged in"
        );
        http_response_code(200);
        return json_encode($returneddata);
    }
    function validateToken($token){
        $decodedInfo = [];
        try {
            $decodedInfo = JWT::decode($token, $GLOBALS["key"], $GLOBALS["algorithm"]);
        } catch (Exception $th){
            return json_encode(array("Error"=>"Signature Failed", "isValid"=>false));
        }
        if (time() > $decodedInfo->exp) {
            return json_encode(array("Error" => "Este token ya ha expirado", "isValid" => false));
        }
        return json_encode(array("isValid"=>true));
    }
    function decodeUserData($token){
        $tokenInfo = json_decode(validateToken($token));
        if($tokenInfo->isValid != true){
            return json_encode(array("Error" => "invalid token"));
        }
        $decodedInfo = JWT::decode($token,$GLOBALS["key"], $GLOBALS["algorithm"]);
        $userData = $decodedInfo->userData;
        return json_encode($userData);
    }
    function compareUserData($token, $userData){
        $tokenInfo = json_decode(validateToken($token));
        validateToken($token);
        if($tokenInfo->isValid != true){
            return json_encode(array("Error" => "invalid token"));
        }
        if ($tokenInfo->username != $userData["username"] || $tokenInfo->email != $userData["email"]) {
            return http_response_code(401);
        }
        return ["response" => "200 OK", "Verified" => true];
    }
    /*
        DOCUMENTACIÓN JWTController

        El JWT funciona codificando la informacion del usuario en el Body y firmandolo en el head.
        Las funciones que aquí se encuentran se encargan de la creación y validación de un token, además se encarga de
        validar si no se ha vencido y si la firma es correcta. Adicionalmente, se encarga de decodificar la información
        del body que tiene un token (Si este es valido).

        
    */
?>