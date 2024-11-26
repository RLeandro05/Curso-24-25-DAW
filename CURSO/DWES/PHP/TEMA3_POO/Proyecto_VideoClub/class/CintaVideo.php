<?php
    require_once("Soporte.php"); //Llamar al padre

    class CintaVideo extends Soporte { //Instanciar clase y heredar del padre
        //Instanciar nuevos atributos del hijo
        private int $duracion;

        //Constructor que hereda atributos del padre y añade el del hijo
        public function __construct(string $titulo, int $numero, float $precio, int $duracion) {
            parent::__construct($titulo, $numero, $precio);

            $this->duracion = $duracion;
        }

        //Función para devolver el valor de la duración
        public function getDuracion() {
            return $this->duracion;
        }

        //Método para mostrar el resumen entero de los atributos del objeto
        public function muestraResumen() {
            parent::muestraResumen(); //Mostrar resumen anterior

            echo nl2br("Duración: ".$this->getDuracion()." min\n");
        }
    }
?>