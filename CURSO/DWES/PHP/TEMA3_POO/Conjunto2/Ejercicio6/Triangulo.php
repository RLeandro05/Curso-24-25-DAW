<?php
    require_once("Figura.php"); //Incluir al padre

    class Triangulo extends Figura{ //Definir subclase
        //Instanciar atributos extra
        private float $altura;
        private float $base;

        public function __construct(string $color, float $altura, float $base) {
            parent::__construct($color);

            $this->altura = $altura;
            $this->base = $base;
        }

        //Método para obtener el valor del radio
        public function getAltura() {
            return $this->altura;
        }

        //Método para insertar un nuevo valor del radio
        public function setAltura($altura) {
            $this->altura = $altura;
            return $this;
        }

        //Método para obtener el valor del ancho
        public function getBase() {
            return $this->base;
        }

        //Método para insertar un nuevo valor del ancho
        public function setBase($base) {
            $this->base = $base;
            return $this;
        }

        //Método heredado del padre para calcular el área
        public function calcularArea() {
            return number_format(($this->getAltura()*$this->getBase())/2, 2, ",", ".");
        }
    }
?>