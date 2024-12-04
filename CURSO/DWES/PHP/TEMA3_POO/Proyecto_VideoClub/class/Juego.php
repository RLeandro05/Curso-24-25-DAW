<?php
    namespace DWES\PHP\TEMA3_POO\Proyecto_VideoClub\class;

    require_once("Soporte.php"); //Incluir clase padre

    use DWES\PHP\TEMA3_POO\Proyecto_VideoClub\class\Soporte;

    class Juego extends Soporte { //Instanciar clase
        //Instanciar atributos
        public string $consola;
        private int $minNumJugadores;
        private int $maxNumJugadores;

        //Constructor que hereda atributos del padre
        public function __construct(string $titulo, int $numero , float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores) {
            parent::__construct($titulo, $numero, $precio);

            $this->consola = $consola;
            $this->minNumJugadores = $minNumJugadores;
            $this->maxNumJugadores = $maxNumJugadores;
        }

        //Función para obtener el valor de la consola
        public function getConsola() {
            return $this->consola;
        }

        //Función para obtener el valor del mínimo de jugadores
        public function getMinNumJugadores() {
            return $this->minNumJugadores;
        }

        //Función para obtener el valor del máximo de jugadores
        public function getMaxNumJugadores() {
            return $this->maxNumJugadores;
        }

        //Método par mostrar los jugadores posibles
        public function muestraJugadoresPosibles() {
            if($this->getMinNumJugadores() == 1 && $this->getMaxNumJugadores() == 1) {
                echo nl2br("Para un jugador\n");
            } else if($this->getMinNumJugadores() > 1 && $this->getMaxNumJugadores() == $this->getMinNumJugadores()) {
                echo nl2br("Para ".$this->getMinNumJugadores()." jugadores");
            } else if($this->getMinNumJugadores() >= 1 && $this->getMaxNumJugadores() > $this->getMinNumJugadores()) {
                echo nl2br("De ".$this->getMinNumJugadores()." a ".$this->getMaxNumJugadores()." jugadores");
            } else {
                echo nl2br("No especificado o hubo un error");
            }
        }

        //Método para mostrar el resumen del objeto
        public function muestraResumen() {
            parent::muestraResumen();

            echo nl2br("Juego para: ".$this->getConsola()."\n");
            $this->muestraJugadoresPosibles();
        }

    }
?>