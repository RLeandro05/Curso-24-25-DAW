<?php
    require_once("Figura.php"); //Incluir al padre

    class Circulo extends Figura{ //Definir subclase
        //Instanciar atributos extra
        private float $radio;

        public function __construct(string $color, float $radio) {
            parent::__construct($color);

            $this->radio = $radio;
        }

        //Método para obtener el valor del radio
        public function getRadio() {
            return $this->radio;
        }

        //Método para insertar un nuevo valor del radio
        public function setRadio($radio) {
            $this->radio = $radio;
            return $this;
        }

        //Método heredado del padre para calcular el área
        public function calcularArea() {
            return number_format(pi()*pow($this->getRadio(), 2), 2, ",", ".");
        }
    }
?>