<?php 
    // Definir ancho y alto del rectangulo
    $anchoRectangulo = 1.23;
    $altoRectangulo = 2.4;

    // Calcular perimetor y area
    $perimetro = $anchoRectangulo+$altoRectangulo;
    $area = $anchoRectangulo*$altoRectangulo;

    // Mostrar por pantalla los resultados
    echo "El perimetro del rectangulo es: '".number_format($perimetro, 2)."'<br>";
    echo "El area del rectangulo es: '".number_format( $area, 2)."'<br>";
?>