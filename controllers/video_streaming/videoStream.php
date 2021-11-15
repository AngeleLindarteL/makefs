<?php
class VideoStream{
    private $path = ""; // La ruta del video al que le vamos a hacer stream 
    private $stream = ""; // Esta va a ser la variable que va a hacer de objeto stream
    private $buffer = 102400; // Este es el peso en Bytes que vamos a leer y a otorgar al cliente (102.4 KBS por Lectura)
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
            // Cabe resaltar que el 
        }
    }

    function start(){
        $this->openStream();
        $this->setHeaders();
    }
}
$testingAssert = new VideoStream("C:/xampp/htdocs/makefs/mediaDB/recipeVideos/videoPrueba.mp4");
$testingAssert->start();

?>