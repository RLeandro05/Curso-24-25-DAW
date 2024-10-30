<?php

    require '../../vendor/autoload.php'; // Requerido el autorload.php para poder crear el zip

    use nelexa\Zip; // Usar la extensión descargada de nelexaZip

    // Implementar las cabeceras con el tipo ZIP
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="archivos.zip"');

    $zip = new \PhpZip\ZipFile(); // Crear un nuevo \PhpZip\ZipFile

    // Agregar archivos al ZIP
    $zip->addFile('C:\Users\DAW_M\Documents\DAW_DWES_M\Curso 2ºDAW\DWES\Composer\Tarea_Cabeceras\Ejercicio3\homerGIF.gif');
    $zip->addFile('C:\Users\DAW_M\Documents\DAW_DWES_M\Curso 2ºDAW\DWES\Composer\Tarea_Cabeceras\Ejercicio3\Ejercicio3.html');

    $zip->saveAsFile("archivos.zip"); // Guardar el archivo zip EN UNA RUTA ESPECÍFICA

    readfile("archivos.zip"); // Leer el archivo una vez guardado

    //$zip->close(); OPCIONAL
?>
