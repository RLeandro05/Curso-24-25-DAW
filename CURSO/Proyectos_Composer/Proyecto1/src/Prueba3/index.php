<?php
require_once("../../vendor/autoload.php"); // Incluye Monolog y sus dependencias
require_once("productoManager.php");

// Crear una instancia del gestor de productos
$productoManager = new ProductoManager();

// Intentar buscar un producto que no existe
$productoManager->buscarProducto(123);

// Crear un producto nuevo
$productoManager->crearProducto("Laptop", 999.99); 
?>