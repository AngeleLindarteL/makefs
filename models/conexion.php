<?php 
class Conexion{
    private $HOST;
    private $BDNAME;
    private $USER;
    private $PORT;
    private $PASSWORD;

    public function __construct(){
        $this->HOST = 'ec2-100-24-169-249.compute-1.amazonaws.com';
        $this->BDNAME = 'd6qvq3h799t3qq';
        $this->USER = 'xzqstwxysiszit';
        $this->PORT = '5432';
        $this->PASSWORD = '3ec60a29b046d847cce68130a91d745cc81f48d6aafba57bf514877cd1d0d205';
    }
    function Conectar(){
        try{

            $dns = "pgsql:host=".$this->HOST.";port=".$this->PORT.";dbname=".$this->BDNAME;
            $conexion = new PDO($dns,$this->USER,$this->PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;

        }catch(PDOException $error){
            die("Error en conexion: ".$error->getMessage()."<br>");
        }
        //para cerrar una conexion se debe asignar null a la variable conexion,
        //el php termina la conexion automaticamente cuando se acaba el script
    }
}
    /* La forma recomendable de ejecutar querys es la siguiente,
        ya que postgre soporta transacciones se pueden ejecutar de la siguiente manera
        para que sean más seguras y rapidas

        try {  
            $dbh->beginTransaction();
            $dbh->exec("insert into staff (id, first, last) values (23, 'Joe', 'Bloggs')");
            $dbh->exec("insert into salarychange (id, amount, changedate) 
                values (23, 50000, NOW())");
            $dbh->commit();
            
            } catch (Exception $e) {
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
            }
        */
 
    /*UTILIZACION DE PREPARE STATEMENTS
    Estos prepare statements funcionan para optimizar el tiempo de ejecucion
    de las Querys a las bases de datos, estas son formas de 'reutilizar' Querys
    que ya quedan preparadas y analizadas en la bd y por eso son más eficientes,
    se deben manejar con bindParam que son los valores que se daran a los complementos
    posicionales de las Querys a reutilizar como Prepare Statements.
    Por lo tanto la sintaxis para hacer una peticion de este tipo seria la siguiente.

    $stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':value', $value);

    insert one row
    $name = 'one';
    $value = 1;
    $stmt->execute();

    insert another row with different values
    $name = 'two';
    $value = 2;
    $stmt->execute();

    Algo a tener en cuenta es que los valores posicionales que se pongan no pueden llevar
    en su nombre un '-' puede ser un '_' pero nunca un '-'

    De esta manera se pueden reutilizar las consultas y hacer mas rapido las querys.
    TENER EN CUENTA ESTE CONCEPTO JUNTO AL DE LAS TRANSACCIONES.
    */

    /*EJEMPLO DE QUERY CON PDO
        $db = Conectar();
        $stmt = $db->prepare("insert into images (id, contenttype, imagedata) values (?, ?, ?)");

        $fp = fopen($_FILES['file']['tmp_name'], 'rb');

        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $_FILES['file']['type']);
        $stmt->bindParam(3, $fp, PDO::PARAM_LOB);

        $db->beginTransaction();
        $stmt->execute();
        $db->commit();
    */
?>