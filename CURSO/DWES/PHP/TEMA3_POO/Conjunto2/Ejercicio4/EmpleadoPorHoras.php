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
        public function calcularSueldo(float $salario, int $horas = 0) {
            $mes = 22; //Días de trabajo aprox. por mes (Sin contar 8 días de findes)

            if($horas != 0) { //En el caso de trabajar por horas, si se da un valor, realizar cálculos extra
                $salarioPorDia = $horas*$salario;
                return number_format($salarioPorDia*$mes, 2, ",", ".");
            }

            //Si no hay valor, simplemente devuelve el salario por el mes, es decir, el tiempo completo
            return number_format($salario*$mes, 2, ",", ".");
        }
    }
?>