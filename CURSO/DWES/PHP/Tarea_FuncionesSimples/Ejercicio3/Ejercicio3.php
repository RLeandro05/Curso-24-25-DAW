<?php 
    function eliminarNumero($arrayNumeros, $cantidadAeliminar) { // Función para eliminar números en el array pasado como argumento y la cantidad por eliminar
        $contador = $cantidadAeliminar;
        $booleano = true;

        if ($cantidadAeliminar > count($arrayNumeros)) {
            $booleano = false;
        }
        for ($i = 1; $i <= $contador; $i++) { // For para eliminar posiciones aleatorias
            $posicionAleatoria = rand(0, count($arrayNumeros)-1); // Sacar una posición aleatoria
            unset($arrayNumeros[$posicionAleatoria]); // Eliminar dicha posición, si existe
        }

        $arrayNumeros = array_values($arrayNumeros); // Reindexar índices del array

        return $booleano;
    }

    $arrayNumeros = [13, 2, 25, 56, 4, 1]; // Definir array de números aleatorios
    $cantidadAeliminar = 3; // Definir la cantidad de números para eliminar del array

    echo nl2br(eliminarNumero($arrayNumeros, $cantidadAeliminar)."\n");
    echo "<pre>Array modificado: ";
    print_r($arrayNumeros);
    echo "</pre>";
?>