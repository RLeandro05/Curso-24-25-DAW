<?php
    namespace DawM\ProyectoVideoClubMonolog;

    use DawM\ProyectoVideoClubMonolog\Resumible;

    abstract class Soporte implements Resumible { //Instanciar clase
        //Instanciar atributos e id incremental
        public string $titulo;
        protected int $numero;
        private float $precio;
        private const IVA = 0.21;
        public bool $alquilado;

        //Constructor para crear objetos Soporte
        public function __construct(string $titulo, int $numero , float $precio) {
            $this->titulo = $titulo;
            $this->numero = $numero;
            $this->precio = $precio;
            $this->alquilado = false;
        }

        //Función para devolver el valor del título
        public function getTitulo() {
            return $this->titulo;
        }

        //Función para devolver el valor del numero
        public function getNumero() {
            return $this->numero;
        }

        //Función para devolver el valor del precio
        public function getPrecio() {
            return $this->precio;
        }

        //Método para devolver el precio sumado con el iva
        public function getPrecioConIva() {
            $precio = $this->precio;

            return number_format($precio + $precio*self::IVA, 2, ",", ".");
        }

        //Método para devolver un resumen
        public function muestraResumen() {
            echo nl2br("Soporte: ".$this->getTitulo()."\n");
            echo nl2br("Precio unitario: ".$this->getPrecio()." euros\n");
            echo nl2br("Precio IVA incluído: ".$this->getPrecioConIva()." euros\n");
        }
    }
?>