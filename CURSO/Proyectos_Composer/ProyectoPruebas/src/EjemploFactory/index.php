<?php
// Cargar autoload (si usas Composer, esta línea es para autoload)
require 'vendor/autoload.php';

// Incluir archivos de las clases
use Dwes\Ejemplos\Model\Cliente;

try {
    // Crear el cliente y verificar el log
    $cliente = new Cliente(12345);
    echo "Cliente creado con éxito. Código: " . $cliente->obtenerCodigo() . "<br>";

    // Aquí puedes hacer más operaciones y ver los logs que se generen
} catch (\Exception $e) {
    echo "Ocurrió un error: " . $e->getMessage();
}
