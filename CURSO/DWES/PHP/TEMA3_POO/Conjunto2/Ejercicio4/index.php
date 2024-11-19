<?php

    require_once("EmpleadoTiempoCompleto.php");
    require_once("EmpleadoPorHoras.php");
    
    //Crear objetos de las subclases
    $empleadoTiempoCompleto = new EmpleadoTiempoCompleto("Alfonso", "Domínguez", 46.66);
    $empleadoPorHoras = new EmpleadoPorHoras("Mario", "Escobar", 10.2, 8);

    //Llamar a los métodos de cada objeto
    $sueldoTiempoCompleto = $empleadoTiempoCompleto->obtenerSueldoTiempoCompleto();
    $sueldoPorHoras = $empleadoPorHoras->obtenerSueldoPorHoras();

    echo "<h2>";
    echo nl2br("El empleado <u><i>'".$empleadoTiempoCompleto->getNombre()." ".$empleadoTiempoCompleto->getApellido()."'</u></i> tiene un <u><i>sueldo de: '".$sueldoTiempoCompleto."€'</u></i>\n");
    echo nl2br("El empleado <u><i>'".$empleadoPorHoras->getNombre()." ".$empleadoPorHoras->getApellido()."'</u></i> tiene un <u><i>sueldo de: '".$sueldoPorHoras."€'</u></i>\n");
    echo "</h2>";

?>