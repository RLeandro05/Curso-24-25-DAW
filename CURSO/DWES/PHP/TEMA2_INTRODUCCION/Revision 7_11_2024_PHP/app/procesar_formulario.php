<?php
    session_start();

    //echo "Llega";

    //Mostrar resumen de reserva
    echo nl2br("Clase seleccionada: ".$_SESSION["clase"]."\n");
    echo nl2br("Horario seleccionado: ".$_SESSION["horario"]."\n");

    
?>