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

        //Método para obtener el apellido
        public function getApellido() {
            return $this->apellido;
        }

        //Método para obtener el salario
        public function getSalario() {
            return $this->salario;
        }

        //Método para calcular el sueldo
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