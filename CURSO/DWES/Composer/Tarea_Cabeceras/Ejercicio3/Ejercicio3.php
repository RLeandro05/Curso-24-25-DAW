<?php 
    $imagen = 'C:\Users\DAW_M\Documents\DAW_DWES_M\Curso 2ºDAW\DWES\Composer\Tarea_Cabeceras\Ejercicio3\homerGIF.gif'; // Ruta de la imagen

    // Dependiendo de la ruta, seleccionar el convertidor específico
    if(isset($_POST["seleccion"]) && $_POST["seleccion"] == "JPEG") {
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="homerJPEG.jpeg"');
    } else if(isset($_POST["seleccion"]) && $_POST["seleccion"] == "PNG") {
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="homerPNG.png"');
    } else if(isset($_POST["seleccion"]) && $_POST["seleccion"] == "GIF") {
        header('Content-Type: image/gif');
        header('Content-Disposition: attachment; filename="homerGIF.gif"');
    }

    readFile($imagen);
?>