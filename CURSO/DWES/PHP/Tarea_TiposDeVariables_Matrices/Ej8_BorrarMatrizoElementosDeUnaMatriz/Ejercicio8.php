<?php 
    // Definicion de matriz de numeros aleatorios
    $listaNumeros = [2, 4, 1, 13, 24];

    // Mostrar el estado anterior de la matriz antes de borrar un elemento
    echo "Antes: ";
    print_r($listaNumeros);

    // Eliminar el tercer elemento de la matriz
    unset($listaNumeros[2]);

    echo "<br>";

    // Mostrar el estado de la amtriz despues de eliminar el tercer elemento
    echo "Depues: ";
    print_r($listaNumeros);
?>