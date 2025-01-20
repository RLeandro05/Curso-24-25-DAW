<?php

namespace DawM\app;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class ProductoManager {
    private $log;

    public function __construct() {
        // Crear el logger y asignar el canal "Productos"
        $this->log = new Logger("Productos");

        // Añadir manejadores para registrar los mensajes
        $this->log->pushHandler(new StreamHandler(__DIR__ . "/../logs/productos.log", Logger::DEBUG));
        $this->log->pushHandler(new FirePHPHandler(Logger::DEBUG));
    }

    public function buscarProducto($productoId) {
        // Simulamos que el producto no se encuentra
        $producto = null;

        if (!$producto) {
            // Registrar un warning en el log
            $this->log->warning("Producto no encontrado", ['id' => $productoId]);
            return null;
        }

        return $producto;
    }

    public function crearProducto($nombre, $precio) {
        // Simulamos que el producto se crea correctamente
        $producto = ['nombre' => $nombre, 'precio' => $precio];

        // Registrar un mensaje de información en el log
        $this->log->info("Producto creado", $producto);

        return $producto;
    }
} 
?>