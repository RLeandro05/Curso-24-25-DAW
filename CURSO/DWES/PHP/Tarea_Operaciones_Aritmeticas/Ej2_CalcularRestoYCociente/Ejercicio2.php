<?php 
    // Definicion de dos numeros aleatorios
    $num1 = 10;
    $num2 = 5;

    // Realizar operaciones de cociente y resto con divisiones
    $cociente = $num1/$num2;
    $resto = $num1%$num2;

    // Mostrar por pantalla el resultado
    echo "El cociente es: '".number_format($cociente, 2)."'";
    echo "El resto es: '".number_format($resto, 2)."'";
?>