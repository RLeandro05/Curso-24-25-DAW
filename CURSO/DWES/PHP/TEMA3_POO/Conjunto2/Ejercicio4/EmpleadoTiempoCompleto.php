<?php
    require_once("Empleado.php");

    class EmpleadoTiempoCompleto extends Empleado { //Clase hija que hereda de Empleado
        public function __construct(string $nombre, string $apellido, float $salario) {
            parent::__construct($nombre, $apellido, $salario);
        }

        //Método que sobreescribe al del padre
        public function obtenerSueldoTiempoCompleto() {
            return $this->calcularSueldo($this->getSalario());
        }
    }
?>