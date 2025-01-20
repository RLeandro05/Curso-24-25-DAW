<?php
require_once("vendor/autoload.php");
//require_once("productoManager.php");
use DawM\app\ProductoManager;

// Crear una instancia del gestor de productos
$productoManager = new ProductoManager();

// Intentar buscar un producto que no existe
$productoManager->buscarProducto(123);

// Crear un producto nuevo
$productoManager->crearProducto("Laptop", 999.99); 
?>