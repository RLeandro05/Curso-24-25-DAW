<?php
    require_once("Vehiculo.php"); //Incluir la clase padre

    class Camion extends Vehiculo { //Definir subclase y heredar
        //Constructor que hereda atributos de Vehiculo
        public function __construct(string $marca, string $modelo, int $anio) {
            parent::__construct($marca, $modelo, $anio);
        }

        //Método heredado del padre para calcular impuestos
        public function calcularImpuesto() {
            return 200 + (2024-$this->getAnio()) * 20;
        }
    }
?>