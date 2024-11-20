<?php

    //Incluir las subclases. Como ya contenían Empleado.php, no hace falta volver a ponerlo
    require_once("EmpleadoTiempoCompleto.php");
    require_once("EmpleadoPorHoras.php");
    
    //Crear objetos de las subclases
    $empleadoTiempoCompleto = new EmpleadoTiempoCompleto("Alfonso", "Domínguez", 46.66);
    $empleadoPorHoras = new EmpleadoPorHoras("Mario", "Escobar", 10.2, 8);

    //Llamar a los métodos de cada objeto
    $sueldoTiempoCompleto = $empleadoTiempoCompleto->calcularSueldo($empleadoTiempoCompleto->getSalario());
    $sueldoPorHoras = $empleadoPorHoras->calcularSueldo($empleadoPorHoras->getSalario(), $empleadoPorHoras->getHoras());

    echo "<h2>";
    echo nl2br("El empleado <u><i>'".$empleadoTiempoCompleto->getNombre()." ".$empleadoTiempoCompleto->getApellido()."'</i></u> tiene un <u><i>sueldo de: '".$sueldoTiempoCompleto."€'</i></u>\n");
    echo nl2br("El empleado <u><i>'".$empleadoPorHoras->getNombre()." ".$empleadoPorHoras->getApellido()."'</i></u> tiene un <u><i>sueldo de: '".$sueldoPorHoras."€'</i></u>\n");
    echo "</h2>";

    //Llamar al método para asignar el objeto clonado a uno nuevo
    $empleadoTiempoCompletoCLONADO = $empleadoTiempoCompleto->clonarEmpleado($empleadoTiempoCompleto);

    echo "<h3>";
    echo nl2br("Ahora, el empleado <u><i>'".$empleadoTiempoCompleto->getNombre()." ".$empleadoTiempoCompleto->getApellido()."'</i></u> ha sido clonado.\n");
    echo nl2br("El empleado clonado es: <u><i>'".$empleadoTiempoCompletoCLONADO->getNombre()." ".$empleadoTiempoCompletoCLONADO->getApellido()."'</i></u>\n");
    echo "</h3>";
?>