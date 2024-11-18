<?php
    require_once "Data.php";

    //Actividad1: Muestra los datos de las provincias

    foreach ($comunidades as $comunidad => $valor) {
        echo nl2br($comunidad."\n\n");
    }
?>