<?php
    include("../vendor/autoload.php");
    include("../models/conexion.php");
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    // This it's the key and the algorithm used to encrypt the data of JWT
    define("mkey","b119bf23af9566f4d16417725242e9485f396564c4d331e19fd9d920ef2154e2"); // Makefs secret key
    define("algorithm","HS256");

    // This define the life time of a token 

    $iat = date("Y-m-d H:i:s", time()); // Emission time of token (unixstamp now)
    // $nfb = $iat + 120; // Not before time of token
    $exp = date("Y-m-d H:i:s", time() + (60 * 60)); // DateTime of Expiration
    // Now we got the final config for using JWT
    $payload = array(
        "iss" => "https://www.makefs.com",
        "aud" => "https://www.makefs.com",
        "iat" => $iat,
        "exp" => $exp,
        // "exp" => $exp,
        // "time" => 1356999524,
        // "nbf" => 1357000000
    );

    function generateToken($username, $password, $ip){
        $payload = $GLOBALS["payload"];
        $sql = "SELECT * FROM userm WHERE username = :username AND passwordm = :password";
        $TokenSql = "INSERT INTO jwt_tokens_blacklist(token,expires) VALUES(:token,:expire)";
        $error = "";
        $conexion = new Conexion();
        try{
            $conexion = $conexion->Conectar();
            $request = $conexion->prepare($sql);
            $conexion->beginTransaction();
            $request->execute(array(":username" =>  $username, ":password" => $password));
            // $tokenReq = $conexion->prepare($TokenSql);
            // $tokenReq->execute(array(":token" => $payload[""], ":expire"))
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
            "IP_ACCESS" => $ip,
        );
        $payload["userData"] = $userData;
        $jwtToken = JWT::encode($payload, mkey);
        try{
            $request = $conexion->prepare($TokenSql);
            $conexion->beginTransaction();
            $request->execute(array(":token" => $jwtToken, ":expire" => $payload["exp"]));
            $conexion->commit();
            $data = $request->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $conexion->rollBack();
            $error = "error noob: ".$e->getMessage();
        }
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
        $token = json_decode($token);
        $token = $token->token;
        $decodedInfo = [];
        try {
            $decodedInfo = JWT::decode($token, mkey, array(algorithm));
        } catch (Exception $th){
            return json_encode(array("Error"=>"Signature Failed", "isValid"=>false, "token" => $token, "error" => JSON_THROW_ON_ERROR));
            exit;
        }
        $timeNow = new DateTime();
        $timeNow = date_timestamp_get($timeNow);
        if ($timeNow > $decodedInfo->nfb) {
            return json_encode(array("Error" => "Este token ya ha expirado", "isValid" => false));
            exit;
        }
        if ($_SERVER["REMOTE_ADDR"] != $decodedInfo->IP_ACCESS){
            return http_response_code(401);
            exit;
        }
        return json_encode(array("isValid"=>true));
    }
    function decodeUserData($token){
        $tokenInfo = json_decode(validateToken($token));
        if($tokenInfo->isValid != true){
            return json_encode(array("Error" => "invalid token"));
            exit;
        }
        $decodedInfo = JWT::decode($token, mkey, array(algorithm));
        $userData = $decodedInfo->userData;
        return json_encode($userData);
    }
    function compareUserData($token, $userData){
        $tokenInfo = json_decode(validateToken($token));
        validateToken($token);
        if($tokenInfo->isValid != true){
            return json_encode(array("Error" => "invalid token"));
        }
        if (
            $tokenInfo->username != $userData["username"] || 
            $tokenInfo->email != $userData["email"] ||
            $tokenInfo->IP_ACCESS != $userData["IP_CLIENT"]
        ){
            return http_response_code(401);
            exit;
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