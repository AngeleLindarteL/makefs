<?php
    include("../vendor/autoload.php");
    include("../models/conexion.php");
    use Firebase\JWT\JWT;
    use Firebase\JWT\ExpiredException;
    use Firebase\JWT\SignatureInvalidException;

use function PHPSTORM_META\type;

// This it's the key and the algorithm used to encrypt the data of JWT
    define("mkey","b119bf23af9566f4d16417725242e9485f396564c4d331e19fd9d920ef2154e2"); // Makefs secret key
    define("algorithm","HS256");

    // This define the life time of a token 

    $iat = time(); // Emission time of token (unixstamp now)
    // $nfb = $iat + 120; // Not before time of token
    $exp = time() + (60 * 60 * 24); // DateTime of Expiration
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
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    define("REQ_IP", $ip);

    function generateToken($username, $password){
        $payload = $GLOBALS["payload"];
        $sql = "SELECT * FROM userm WHERE username = :username AND passwordm = :password";
        $error = "";
        $conexion = new Conexion();
        try{
            $conexion = $conexion->Conectar();
            $request = $conexion->prepare($sql);
            $conexion->beginTransaction();
            $request->execute(array(":username" =>  $username, ":password" => $password));
            $conexion->commit();
            $data = $request->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $conexion->rollBack();
            $error = "error: ".$e->getMessage();
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
            "ipAccess" => REQ_IP,
        );
        $payload["userData"] = $userData;
        $jwtToken = JWT::encode($payload, mkey);
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
        $decodedInfo = "";
        $checkblSQL = "SELECT * FROM jwt_tokens_blacklist WHERE (tokenu::json->>'token' = :token);";
        try {
            $decodedInfo = JWT::decode($token, mkey, array(algorithm));
        } catch (Exception $th){
            throw new Exception("Failed Signature", 405);;
            exit;
        }
        try{
            $conexion = new Conexion();
            $conexion = $conexion->Conectar();
            $blacklist = $conexion->prepare($checkblSQL);
            $blacklist->execute(array("token"=>$token));
        }catch(Exception $ex){
            return http_response_code(400);
            exit;
        }
        $isBlacklisted = $blacklist->fetch(PDO::FETCH_NUM);
        if (!empty($isBlacklisted)){
            throw new Exception("Token in blacklist", 1);
            return http_response_code(401);
            exit;
        }
        $timeNow = time();
        if ($timeNow > $decodedInfo->exp){
            throw new Exception("Token Expired", 2);
            return http_response_code(401);
            exit;
        }
        if (REQ_IP != $decodedInfo->userData->ipAccess){
            throw new Exception("Bad request, IP is Different", 3);
            return http_response_code(401);
            exit;
        }
        return json_encode(array("isValid"=>true));
    }
    function decodeUserData($token){
        $tokenInfo = json_decode(validateToken($token));
        try{
            if($tokenInfo->isValid != true){
                throw new Exception("Bad request Invalid Token", 401);
                exit;
            }
        }catch(Exception $e){
            return http_response_code(404);
            exit;
        }
        $decodedInfo = JWT::decode($token, mkey, array(algorithm));
        $userData = $decodedInfo->userData;
        return json_encode($userData);
    }
    function compareUserData($token, $userData){
        $tokenInfo = json_decode(validateToken($token));
        validateToken($token);
        try{
            if($tokenInfo->isValid != true){
                throw new Exception("Bad request Invalid Token", 401);
                exit;
            }
        }catch(Exception $e){
            return http_response_code(404);
            exit;
        }
        if (
            $tokenInfo->username != $userData["username"] || 
            $tokenInfo->email != $userData["email"] ||
            $tokenInfo->ipAccess != REQ_IP
        ){
            return http_response_code(401);
            exit;
        }
        return ["Verified" => true];
    }
    
    function destroyToken($token){
        $TokenSql = "INSERT INTO jwt_tokens_blacklist(expires,tokenu) VALUES(:expires,:token)";
        $checkblSQL = "SELECT * FROM jwt_tokens_blacklist WHERE (tokenu::json->>'token' = :token);";
        try{
            $conexion = new Conexion();
            $conexion = $conexion->Conectar();
            $blacklist = $conexion->prepare($checkblSQL);
            $blacklist->execute(array("token"=>$token));
        }catch(Exception $ex){
            return http_response_code(400);
            exit;
        }
        $isBlacklisted = $blacklist->fetch(PDO::FETCH_NUM);
        if (!empty($isBlacklisted)){
            return;
            exit;
        }
        try{
            $tokenInfo = JWT::decode($token, mkey, array(algorithm));
        } catch (Exception $th){
            try{
                $conexion->beginTransaction();
                $request = $conexion->prepare($TokenSql);
                $request->execute(array("expires" => date("Y-m-d H:i:s", time()), "token" => json_encode(["token" => $token])));
                $conexion->commit();
                return;
                exit;
            }catch(Exception $th){
                throw new Exception("Error Processing Request $th");
                $conexion->rollBack();
                return http_response_code(400);
            }
            throw new Exception("Gracia a mamá tamo bien eh", 1);
            exit;
        }
        try{
            $conexion->beginTransaction();
            $request = $conexion->prepare($TokenSql);
            $request->execute(array("expires" => date("Y-m-d H:i:s", $tokenInfo->exp), "token" => json_encode(["token" => $token])));
            $conexion->commit();
        }catch(Exception $th){
            throw new Exception("Error Processing Request $th");
            $conexion->rollBack();
            return http_response_code(400);
        }
    }
    /*
        DOCUMENTACIÓN JWTController

        El JWT funciona codificando la informacion del usuario en el Body y firmandolo en el head.
        Las funciones que aquí se encuentran se encargan de la creación y validación de un token, además se encarga de
        validar si no se ha vencido y si la firma es correcta. Adicionalmente, se encarga de decodificar la información
        del body que tiene un token (Si este es valido).

        
    */
?>