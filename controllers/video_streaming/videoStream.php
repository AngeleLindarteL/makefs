<?php

// Script basado en el Script del programador Rana, Github: https://gist.github.com/ranacseruet
// Script traducido y explicado al español por Angel Lindarte, Github: https://github.com/AngeleLindarteL
// adaptado y mejorado para formatos WebM y MP4
class VideoStream{
    private $path = ""; // La ruta del video al que le vamos a hacer stream 
    private $stream = ""; // Esta va a ser la variable que va a hacer de objeto stream
    private $buffer = 150000; // Este es el peso en Bytes que vamos a leer y a otorgar al cliente (150 KBS por Lectura)
    private $start = -1; // Este es el inicio de nuestro video
    private $end = -1; // El final de nuestro video
    private $size = 0; // Este es el tamaño de nuestro video

    // Construimos el objeto tipo VideoStream
    function __construct($filepath){
        $this->path = $filepath; // Declaramos la ruta del video
    }

    // Abrimos la operación de stream
    private function openStream(){
        $this->stream = fopen($this->path, "rb") // Tratamos de abrir el archivo con fopen para hacer uso de un stream
        or die ("Error al abrir el archivo de video"); // Error por si no abre o no lo encuentra XD
    }
    // Vamos a setear los headers para tener una respuesta correcta frente al servidor
    private function setHeaders(){
        $info = ob_get_clean(); // Primero limpiamos todo lo que haya en el buffer
        $extension = explode(".",$this->path); // Así sabemos la extensión de un archivo
        $extension = $extension[sizeof($extension)-1]; // ☝🏼
        // Ahora vamos a poner el header de Content Type dependiendo del tipo de video que tengamos, puede ser webm o mp4
        // ya que son formatos ligeros que podemos manejar sin petar el almacenamiento del servidor
        switch($extension){
            case "webm":
                header("Content-Type: video/webm");
            break;
            case "mp4":
                header("Content-Type: video/mp4");
            break;
            default:
                die("El archivo que seleccionaste esta en un formato prohibido");
            break;
        }
        // Ahora configurammos los headers del control de caché de nuestra respuesta al cliente
        // max-age es el tiempo que nuestra caché va a ser valida, es decir, el tiempo que puede ser usable antes de mandar otra petición
        // con private le decimos que la caché solo puede ser accedida por un dispositivo cliente como un navegador
        header("Cache-Control: max-age: 2592000, public"); 
        // Ahora definimos hasta que tiempo la respuesta va a ser valida
        header("Expires: ".gmdate('D, d M Y H:i:s', time()+2592000) . " GMT"); // El momento en el que saca + 700 horas
        // La ultima fecha donde el recurso(el video) fue modificado
        header("Last-Modified: ".gmdate('D, d M Y H:i:s',@filemtime($this->path))." GMT");
        // Definimos donde inicia el readable, donde termina y que peso tiene este en bytes, para recorrerlo
        $this->start = 0;
        $this->size = filesize($this->path);
        $this->end = $this->size - 1;
        // Ahora definimos que nuestra respuesta acepta solicitudes parciales (Esto es para cargar el video por partes)
        // Más detalladamente, le indicamos al servidor que la peticion se puede dar en este rango, que vendría siendo
        // el inicio del video y el final de este.
        header("Accept-Ranges: 0-".$this->end);
        // Ahora vamos a evaluar si el servidor tiene el header de rango en la petición
        if (isset($_SERVER["HTTP_RANGE"])) {
            // c_start y c_end se refieren a content_start y content_end
            $c_start = $this->start;
            $c_end = $this->end;
            // Cabe resaltar que el formato de un HTTP_RANGE es el siguiente: "Range: bytes=200-1000"
            // Por lo que debemos hacer diferentes tratamientos de strings para definir el content_start y content_end
            // Aquí dividimos la solicitud en dos por medio del separador "=" y tomamos la ultima para una comprobación
            list(,$range) = explode("=",$_SERVER["HTTP_RANGE"],2);
            // Comprobamos que solo nos hayan pedido un rango, de lo contrario arrojara un error
            if (strpos($range, ",") !== false){
                header("HTTP/1.1 416 Requested Range Not Satisfiable");
                header("Content-Range: bytes $this->start-$this->end / $this->size");
                exit;
            }
            // Ahora comprobamos si el rango que mandaron no contiene valores, de ser así
            // Iniciara desde ese rango, su valor sera, el tamaño del video - la cantidad en negativo que solicitan 
            if ($range == "-") {
                $c_start = $this->size - substr($range, 1);
            }
            // Ahora si tenemos valores, dividimos el string y asignamos el inicio y el final
            else{
                $range = explode("-", $range);
                $c_start = $range[0];
                // Ahora evaluamos con evaluador terniario, si el ulitmo valor existe y si es numerico
                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $c_end;
            }
            // Ahora evaluamos si el rango de final que solicitaron es mayor al que nuestro archivo puede ofrecer.
            // De ser así entonces al fin del rango le asignamos la maxima capacidad de nuestro archivo.
            $c_end = ($c_end > $this->end) ? $this->end : $c_end;
            
            // Ahora evaluamos tres condiciones, para asegurar el funcionamiento de nuestro modulo.
            // 1. Que el inicio del rango solicitado no sea mayor al final del mismo.
            // 2. Que el inicio del rango no sea mayor a lo que podemos ofrecer.
            // 3. Que el final no sea igual o mayor que nuestro limite
            // Si alguna de estas se cumple, se dara una respuesta de 416
            if ($c_start > $c_end || $c_start > $this->size - 1 || $c_end >= $this->size){
                header("HTTP/1.1 416 Requested Range Not Satisfiable");
                header("Content-Range: bytes $this->start-$this->end / $this->size");
                exit;
            }
            // Si todo sale bien, asignaremos los rangos solicitados al inicio y el fin de nuestra respuesta
            // Adicionalmente, le mandamos la longitud que va a recibir en Bytes
            $this->start = $c_start;
            $this->end = $c_end;
            $length = $this->end - $this->start + 1;
            // Asignamos el inico de nuestro puntero para stremear el video en el inicio del rango solicitado
            // Mandamos los headers correspondientes
            fseek($this->stream, $this->start);
            header("HTTP/1.1 206 Partial Content"); // Mandamos una respuesta parcial
            header("Content-Length: ".$length); // La cantidad de Bytes que recibira
            header("Content-Range: bytes $this->start-$this->end/".$this->size); // El rango que recibira en bytes sobre el que nuestro contenido ofrece
            // Ejemplo de como se muestran los headers:
            // Headers("HTTP/1.1 206 Partial Content","Content-Length: 1000","Content-Range: bytes 150 - 2500 / 8000")
        }else{
            // Si no tiene la cabecera HTTP_RANGE, le mandamos todo el contenido.
            header("Content-Lenght: ".$this->size);
        }
    }
    // Cerramos el stream que este abierto
    private function end(){
        fclose($this->stream);
        exit;
    }
    // Ahora iniciaremos el stream en el rango que calculamos "this->end y this->start"
    private function stream(){
        $i = $this->start; // Asignamos la variable i al inico de nuestro rango
        set_time_limit(0); // Asignamos que el script no tiene un tiempo limite de ejecucion
        while(!feof($this->stream) && $i <= $this->end){ // Mientras NO sea el fin del archivo y "i" sea menor o igual al final de nuestro rango
            $bytesToRead = $this->buffer; // Asignamos cuantos datos vmaos a leer, en este caso es el buffer que asignamos (100,4KB)
            // Ahora nos aseguramos que el inico sumado a los bytes que vamos a leer no superen el limite o el rango asignado
            if (($i+$bytesToRead) > $this->end){
                $bytesToRead = $this->end - $i + 1; // Si lo supera asignamos los bytes a leer como el finalSolicitado - inicioSolicitado + 1
            }
            $data = fread($this->stream, $bytesToRead); // Aca empezamos a leer los datos hasta el limite solicitado
            echo $data; // Damos la información
            flush(); // limpiamos el buffer que exista
            $i += $bytesToRead; // Asignamos el inicio como el inicio + los bytes leidos
        }
    }
    // Aquí iniciamos nuestro script
    function start(){
        $this->openStream();
        $this->setHeaders();
        $this->stream();
        $this->end();
    }
}
$testingAssert = new VideoStream("C:/xampp/htdocs/makefs/mediaDB/recipeVideos/videoPrueba.mp4");
$testingAssert->start();

?>