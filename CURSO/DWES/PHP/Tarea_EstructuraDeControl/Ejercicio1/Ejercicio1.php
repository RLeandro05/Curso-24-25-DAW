<?php 
    // Primer for para mostrar el numero
    for ($i=1; $i <= 3; $i++) {
        echo nl2br("Sentencia de la variable $i incluyendo el valor '$i'\n");
        for ($j="a"; $j<="d"; $j++) { // Segundo for para mostrar la letra
            echo nl2br("&emsp;&emsp;Sentencia de la variable $j incluyendo el valor '$j'\n");
        }
    }
?>