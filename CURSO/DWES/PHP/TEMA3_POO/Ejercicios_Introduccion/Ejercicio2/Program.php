<?php
    class Producto {
        //Instanciar variables del producto
        private static int $idIncrementa = 1;
        private int $id;
        private string $nombre;
        private float $precio;
        private int $stock;

        public function __construct(string $nombre, float $precio, int $stock = 0) {
            $this->id = self::$idIncrementa++; //Primero asigna y luego incrementa
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->stock = $stock;
        }

        //Getters para obtener rápidamente el valor
        public function getId(){
            return $this->id;
        }

        public function getNombre()
        {
                return $this->nombre;
        }

        public function getPrecio()
        {
                return $this->precio;
        }

        public function getStock()
        {
                return $this->stock;
        }

        //Método para asegurarse de si existe stock o no de un producto
        public function disminuirStock($cantidad) {
            if ($this->stock >= $cantidad) {
                $this->stock = $this->stock - $cantidad;
                return nl2br("<h2>Pedido realizado correctamente. Stock disminuido a ".$this->stock." unidades</h2>");
            } else {
                return  nl2br("<h2>Pedido no realizado. No hay suficiente stock</h2>");
            }
        }
    }
?>