<?php
    require_once("Cliente.php");
    require_once("Soporte.php");

    class VideoClub { //Instanciar clase 
        //Instanciar atributos
        protected array $productos = []; //Array de Soporte
        protected array $socios = []; //Array de Cliente

        //Creación de constructor
        public function __construct(array $productos, array $socios) {
            $this->productos = $productos;
            $this->socios = $socios;
        }

        //Método para obtener el valor de productos
        public function getProductos() {
            return $this->productos;
        }

        //Método para incluir un nuevo producto al array
        private function incluirProducto(Soporte $soporte) {
            foreach ($this->getProductos() as $producto) {
                if ($producto === $soporte) {
                    return "Ya existe dicho producto";
                }
            }

            //Añadir el soporte a la lista d eproductos
            $this->getProductos()[] = $soporte;
            return "El soporte ha sido añadido satisfactoriamente";
        }
    }
?>