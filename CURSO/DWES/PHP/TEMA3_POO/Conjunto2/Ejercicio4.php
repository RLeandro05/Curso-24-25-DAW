<?php
    abstract class Empleado { //Clase padre Empleado
        //Instanciar atributos
        protected string $nombre;
        protected string $apellido;
        protected float $salario;

        //Crear constructor de la clase
        public function __construct(string $nombre, string $apellido, float $salario) {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->salario = $salario;
        }

        //Función para obtener el nombre
        public function getNombre() {
            return $this->nombre;
        }

        //Función para obtener el apellido
        public function getApellido() {
            return $this->apellido;
        }

        //Función para obtener el salario
        public function getSalario() {
            return $this->salario;
        }

        //Función para calcular el sueldo
        public function calcularSueldo() {

        }
    }
?>