<?php
    abstract class Figura { //Definir la clase
        //Instanciar atributos
        private string $color;

        //Crear Constructor
        public function __construct(string $color) {
            $this->color = $color;
        }

        //Método abstracto para calcular el área
        abstract public function calcularArea();

        //Método para obtener el valor del color
        public function getColor() {
            return $this->color;
        }

        //Método para insertar un nuevo valor del color
        public function setColor(string $color) {
            $this->color = $color;
            return $this;
        }
    }
?>