<?php
    require_once("Empleado.php"); //Incluir Empleado.php

    class EmpleadoPorHoras extends Empleado { //Clase hija que hereda de Empleado
        //Atributo adicional para calcular sueldo en función de las horas trabajadas
        protected int $horas;

        public function __construct(string $nombre, string $apellido, float $salario, int $horas) {
            parent::__construct($nombre, $apellido, $salario);

            $this->horas = $horas;
        }

        //Método para obtener las horas de trabajo por día
        public function getHoras(){
            return $this->horas;
        }

        //Método para insertar un nuevo valor de horas
        public function setHoras($horas) {
            $this->horas = $horas;
            return $this;
        }

        //Método que sobreescribe al del padre
        public function obtenerSueldoPorHoras() {
            return $this->calcularSueldo($this->getSalario(), $this->getHoras());
        }
    }
?>