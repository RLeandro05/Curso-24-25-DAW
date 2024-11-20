<?php
    //Incluir las subclases
    require_once("Circulo.php");
    require_once("Rectangulo.php");
    require_once("Triangulo.php");

    //Crear objetos
    $circulo = new Circulo("rojo", 12.3);
    $rectangulo = new Rectangulo("verde", 3.5, 5.3);
    $triangulo = new Triangulo("rosa", 12.3, 6.8);

    //Calcular áreas
    $areaCirculo = $circulo->calcularArea();
    $areaRectangulo = $rectangulo->calcularArea();
    $areaTriangulo = $triangulo->calcularArea();

    //Mostrar resultados de cada figura
    echo "<h2>";
    echo nl2br("Área de la figura <u><i>'".$circulo->getColor()."'</i></u>: <u>'".$areaCirculo." cm^2</u>'\n");
    echo nl2br("Área de la figura <u><i>'".$rectangulo->getColor()."'</i></u>: <u>'".$areaRectangulo." cm^2</u>'\n");
    echo nl2br("Área de la figura <u><i>'".$triangulo->getColor()."'</i></u>: <u>'".$areaTriangulo." cm^2</u>'\n");
    echo "</h2>";
?>