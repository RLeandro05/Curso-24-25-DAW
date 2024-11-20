<?php 
    //Incluir subclases
    require_once("Coche.php");
    require_once("Moto.php");
    require_once("Camion.php");

    //Crear objetos
    $coche = new Coche("Peugeot", "207", 2005);
    $moto = new Moto("Toyota", "GT", 2018);
    $camion = new Camion("Volvo", "FH Aero", 2023);

    //Calcular impuestos
    $impuestoCoche = $coche->calcularImpuesto();
    $impuestoMoto = $moto->calcularImpuesto();
    $impuestoCamion = $camion->calcularImpuesto();

    //Mostrar mensajes de impuestos
    echo nl2br("Impuesto a pagar del <u><i>'".$coche->getMarca()." ".$coche->getModelo()."'</i></u>: <u>".$impuestoCoche." €</u>\n");
    echo nl2br("Impuesto a pagar del <u><i>'".$moto->getMarca()." ".$moto->getModelo()."'</i></u>: <u>".$impuestoMoto." €</u>\n");
    echo nl2br("Impuesto a pagar del <u><i>'".$camion->getMarca()." ".$camion->getModelo()."'</i></u>: <u>".$impuestoCamion." €</u>\n\n");

    //Clonar vehículo
    $cocheClon = $coche->clonarVehiculo();

    //Mostrar vehículo clonado
    echo nl2br("Ahora, este es el vehículo clonado: '".$cocheClon->getMarca()." ".$cocheClon->getModelo()."'");
?>