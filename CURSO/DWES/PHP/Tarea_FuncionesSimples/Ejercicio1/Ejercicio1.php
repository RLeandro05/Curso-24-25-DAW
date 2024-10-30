<?php
    // Definir variables
    $alturaH = 10;
    $radioBaseR = 5;

    function calcularVolumenCilindro($alturaH, $radioBaseR) { // Función que se lleva las variables como argumentos
        $numeroPI = 3.14; // Definir el numero PI
        $volumenCilindro = $numeroPI*($radioBaseR*$radioBaseR)*$alturaH; // Calcular el volumen

        return $volumenCilindro; // Devolver resultado
    }

    $resultado = calcularVolumenCilindro($alturaH, $radioBaseR); // Llamar a la función

    echo "El volumen resulta en: ".$resultado; // Mostrar el resultado por pantalla
?>