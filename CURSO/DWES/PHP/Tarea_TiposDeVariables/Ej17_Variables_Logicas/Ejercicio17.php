<?php 
    $edad = 17;
    $booleano;

    if ($edad >= 18) {
        $booleano = true;
        echo "'$booleano': Es mayor de edad.";
    } else {
        $booleano = false;
        echo "'$booleano': Es menor de edad.";
    }
?>