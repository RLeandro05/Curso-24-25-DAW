<?php 
    function sumarNumeros($num1, $num2, $num3) { // Función para sumar tres números pasados como argumentos
        $suma = $num1+$num2+$num3; // Guardar en una variable el resultado de la suma

        return $suma; // Devolver el valor de la suma
    }

    function multiplicarNumeros($num1, $num2, $num3) { // Función para multiplicar tres números pasados como argumentos
        $producto = $num1*$num2*$num3; // Guardar en una variable el resultado de la multiplicación

        return $producto; // Devolver el valor de la multiplicación
    }

    // Definir tres números aleatorios
    $num1 = 3;
    $num2 = 4;
    $num3 = 6;

    // Guardar en dos variables diferentes los dos reusltados de las funciones
    $resultadoSuma = sumarNumeros($num1, $num2, $num3);
    $resultadoProducto = multiplicarNumeros($num1, $num2, $num3);

    // Mostrar por pantalla los dos resultados
    echo nl2br("Resultado de la suma: ".$resultadoSuma."\n");
    echo nl2br("Resultado de la multiplicación: ".$resultadoProducto);
?>