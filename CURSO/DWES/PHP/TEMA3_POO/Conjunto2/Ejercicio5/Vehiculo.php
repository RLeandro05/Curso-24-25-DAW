<?php 
    abstract class Vehiculo { //Definir clase
        //Instanciar atributos
        private string $marca;
        private string $modelo;
        private int $anio;

        //Constructor
        public function __construct(string $marca, string $modelo, int $anio) {
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->anio = $anio;
        }

        //Método abstracto que calcula el impuesto
        abstract public function calcularImpuesto();

        //Método para clonar el vehículo seleccionado
        public function clonarVehiculo() {
            //Clonar vehículo
            $vehiculoClon = clone $this;

            //Editar texto de un atributo para distinguir del real
            $vehiculoClon->setMarca($this->getMarca()." (CLONADO)");

            //Devolver objeto vehículo clonado
            return $vehiculoClon;
        }

        //Método para obtener el valor de la marca
        public function getMarca() {
            return $this->marca;
        }

        //Método para insertar una nueva marca
        public function setMarca($marca){
            $this->marca = $marca;
            return $this;
        }

        //Método para obtener el valor del modelo
        public function getModelo() {
            return $this->modelo;
        }

        //Método para insertar un nuevo modelo
        public function setModelo($modelo){
            $this->modelo = $modelo;
            return $this;
        }

        //Método para obtener el valor del año
        public function getAnio() {
            return $this->anio;
        }

        //Método para insertar un nuevo año
        public function setAnio($anio){
            $this->anio = $anio;
            return $this;
        }
    }
?>