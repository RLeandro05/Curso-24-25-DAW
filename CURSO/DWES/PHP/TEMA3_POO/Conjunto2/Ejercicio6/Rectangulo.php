<?php
    require_once("Figura.php"); //Incluir al padre

    class Rectangulo extends Figura{ //Definir subclase
        //Instanciar atributos extra
        private float $largo;
        private float $ancho;

        public function __construct(string $color, float $largo, float $ancho) {
            parent::__construct($color);

            $this->largo = $largo;
            $this->ancho = $ancho;
        }

        //Método para obtener el valor del radio
        public function getLargo() {
            return $this->largo;
        }

        //Método para insertar un nuevo valor del radio
        public function setLargo($largo) {
            $this->largo = $largo;
            return $this;
        }

        //Método para obtener el valor del ancho
        public function getAncho() {
            return $this->ancho;
        }

        //Método para insertar un nuevo valor del ancho
        public function setAncho($ancho) {
            $this->ancho = $ancho;
            return $this;
        }

        //Método heredado del padre para calcular el área
        public function calcularArea() {
            return number_format($this->getLargo()*$this->getAncho(), 2, ",", ".");
        }
    }
?>