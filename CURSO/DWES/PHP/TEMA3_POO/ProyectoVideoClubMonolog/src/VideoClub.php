<?php
    namespace DawM\ProyectoVideoClubMonolog;

    use DawM\ProyectoVideoClubMonolog\Cliente;
    use DawM\ProyectoVideoClubMonolog\CintaVideo;
    use DawM\ProyectoVideoClubMonolog\Juego;
    use DawM\ProyectoVideoClubMonolog\Soporte;
    use DawM\ProyectoVideoClubMonolog\Resumible;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use util\SoporteYaAlquiladoException;

    class VideoClub { //Instanciar clase 
        //Instanciar atributos
        private $miLog;
        private string $nombre;
        private array $productos = []; //Array de Soporte
        private int $numProductos;
        private array $socios = []; //Array de Cliente
        private int $numSocios;
        private array $cintasVideo = []; //Array de cintas de vídeo
        private int $numCintasVideo;
        private array $juegos = []; //Array de juegos
        private int $numJuegos;
        private int $numProductosAlquilados;
        private int $numTotalAlquileres;

        //Creación de constructor
        public function __construct() {
            //Crear un logger 
            $this->miLog = new Logger('VideoclubLogger');

            //Agregar el RotatingFileHandler con nivel debug 
            $this->miLog->pushHandler(new RotatingFileHandler(__DIR__, 0, Logger::DEBUG));

            //Agregar el procesador de introspección y el manejador 
            $this->miLog->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/../logs/videoclub.log', Logger::DEBUG));
            //$this->miLog->pushProcessor(new IntrospectionProcessor());
        }

        //Método para obtener el logger
        public function getMiLog() {
            return $this->miLog;
        }

        //Método para obtener el valor del nombre
        public function getNombre() {
            return $this->nombre;
        }

        //Método para obtener el valor de productos
        public function getProductos() {
            return $this->productos;
        }

        //Método para obtener el valor del número de productos
        public function getNumProductos() {
            return $this->numProductos;
        }

        //Método para obtener el valor de socios
        public function getSocios() {
            return $this->socios;
        }

        //Método para obtener el valor del número de socios
        public function getNumSocios() {
            return $this->numSocios;
        }

        //Método para obtener el valor de cintas de video
        public function getCintasVideo() {
            return $this->cintasVideo;
        }

        //Método para obtener el valor del número de cintas de video
        public function getNumCintasVideo() {
            return $this->numCintasVideo;
        }

        //Método para obtener el valor de juegos
        public function getJuegos() {
            return $this->juegos;
        }

        //Método para obtener el valor del número de juegos
        public function getNumJuegos() {
            return $this->numJuegos;
        }

        //Método para obtener el valor del número de los productos alquilados
        public function getNumProductosAlquilados() {
            return $this->numProductosAlquilados;
        }

        //Método para obtener el valor del número del total de alquileres
        public function getnumTotalAlquileres() {
            return $this->numTotalAlquileres;
        }

        //Método para incluir un nuevo producto al array
        public function incluirProducto(Soporte $soporte) {
            foreach ($this->productos as $producto) {
                if ($producto === $soporte) {
                    $this->getMiLog()->warning("Ya existe dicho soporte");
                    throw new SoporteYaAlquiladoException();
                }
            }

            //Añadir el producto a la lista de productos
            $this->productos[] = $soporte;
            return "El soporte ha sido añadido satisfactoriamente";
        }

        //Método para incluir cinta de video
        public function incluirCintaVideo(CintaVideo $cintaVideo) {
            foreach ($this->cintasVideo as $cintavideo) {
                if ($cintavideo == $cintaVideo) {
                    $this->getMiLog()->warning("Ya existe dicha cinta de vídeo");
                    throw new SoporteYaAlquiladoException();
                }
            }

            //Añadir la cinta de vídeo a la lista de cintas de vídeo
            $this->cintasVideo[] = $cintaVideo;
            return "La cinta de vídeo ha sido añadida satisfactoriamente";
        }

        //Método para incluir juego
        public function incluirJuego(Juego $juego) {
            foreach ($this->juegos as $Juego) {
                if ($Juego == $juego) {
                    $this->getMiLog()->warning("Ya existe dicho juego");
                    throw new SoporteYaAlquiladoException();
                }
            }

            //Añadir el juego a la lista de juegos
            $this->juegos[] = $juego;
            return "El juego ha sido añadido satisfactoriamente";
        }

        //Método para incluir un nuevo socio al array
        public function incluirSocio(Cliente $cliente) {
            foreach ($this->socios as $socio) {
                if ($socio == $cliente) {
                    return "Ya existe dicho cliente";
                }
            }

            //Añadir el soporte a la lista de socios
            $this->socios[] = $cliente;
            return "El cliente ha sido añadido satisfactoriamente";
        }

        //Método para listar productos
        public function listarProductos() {
            $this->getMiLog()->info(nl2br("Lista de productos: \n"));

            foreach ($this->productos as $producto) {
                $this->getMiLog()->info(nl2br("Producto: ".$producto->getTitulo()."\n"));
                $this->getMiLog()->info(nl2br("Número: ".$producto->getNumero()."\n"));
                $this->getMiLog()->info(nl2br("Precio: ".$producto->getPrecio()."€\n-------------------------\n"));
            }
        }

        //Método para listar socios
        public function listarSocios() {
            $this->getMiLog()->info(nl2br("Lista de socios: \n"));

            foreach ($this->socios as $socio) {
                $this->getMiLog()->info(nl2br("Socio: ".$socio->getNombre()."\n"));
                $this->getMiLog()->info(nl2br("Número: ".$socio->getNumero()."\n-------------------------\n"));
            }
        }

        
        public function alquilarSocioProductos(int $numSocio, array $numerosProductos) {
            
        }
    }
?>