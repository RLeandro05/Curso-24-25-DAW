<?php 
    // Definicion de dos listas separadas
    $listaFrutas = ["Manzana", "Platano", "Pera"];
    $listaVerduras = ["Brocoli", "Coliflor", "Zanahoria"];

    // Unir ambas matrices en una sola y guardarla en una variable nueva
    $listaResultante = array_merge($listaFrutas, $listaVerduras);

    echo "Lista combinada entre frutas y verduras: <br>";

    // Mostrar la lista combinada para demostrar que funciona la funcion
    print "<pre>";
    print_r( $listaResultante);
    print "</pre>";
?>