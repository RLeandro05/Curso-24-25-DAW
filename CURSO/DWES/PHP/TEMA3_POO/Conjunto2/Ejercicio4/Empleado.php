<?php
    abstract class Empleado { //Clase padre Empleado
        //Instanciar atributos
        protected string $nombre;
        protected string $apellido;
        protected float $salario;

        //Constructor
        public function __construct(string $nombre, string $apellido, float $salario) {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->salario = $salario;
        }
        
        //Método para obtener el nombre
        public function getNombre() {
            return $this->nombre;
        }

        //Método para insertar un nuevo nombre
        public function setNombre($nombre){
            $this->nombre = $nombre;
            return $this;
        }

        //Método para obtener el apellido
        public function getApellido() {
            return $this->apellido;
        }

        //Método para insertar un nuevo apellido
        public function setApellido($apellido){
            $this->apellido = $apellido;
            return $this;
        }

        //Método para obtener el salario
        public function getSalario() {
            return $this->salario;
        }

        //Método para insertar un nuevo salario
        public function setSalario($salario){
            $this->salario = $salario;
            return $this;
        }

        //Método para calcular el sueldo
        abstract public function calcularSueldo(float $salario, int $horas = 0);

        //Método para clonar un empleado
        public function clonarEmpleado(object $empleado) {
            //Clonar empleado
            $empleadoClonado = clone $empleado;

            //Añadir texto editado para demostrar que está clonado
            $empleadoClonado->setNombre($empleado->getNombre()." (CLONADO)");

            //Devolver empleado
            return $empleadoClonado;
        }
    }
?>