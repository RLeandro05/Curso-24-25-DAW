<?php
    // Primer for para lanzar el primer dado
    for ($i = 1; $i <= 3; $i++) {
        $num = mt_rand(1, 6); // Numero aleatorio que se aplica al siguiente for
        echo nl2br("Sentencia del primer dado incluyendo el valor en la primera tirada: '$num'\n");
        for ($j = 1; $j <= $num; $j++) { // Segundo for que indica el valor del segundo dado
            $num2 = mt_rand(1, 6);
            echo nl2br("&emsp;&emsp;Sentencia del segundo dado incluyendo el valor: '$num2'\n");
        }
    }
?>