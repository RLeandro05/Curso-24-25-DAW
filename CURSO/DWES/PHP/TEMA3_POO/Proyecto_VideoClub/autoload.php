<?php
    spl_autoload_register(function ($class) {
    // Directorio base de las clases
    $baseDir = __DIR__ . "/"; // Ruta correcta a la carpeta "class"

    // Convertir la barra invertida del namespace en barra normal para la ruta
    $file = $baseDir . str_replace("\\", "/", $class) . ".php";

    // Comprobar si el archivo existe
    if (file_exists($file)) {
        require $file;
    } else {
        echo "Archivo no encontrado: $file<br>";
    }
    });
?>