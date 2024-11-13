<?php
    $cadena = "Hola";
    $longitudCadena = strlen($cadena);

    echo "<p>Longitud de la cadena '$cadena': $longitudCadena</p> <br>";

    $cadenaMayuculas = strtoupper($cadena);

    echo "<p>Cadena en mayusculas: $cadenaMayuculas</p> <br>";

    $cadenaConcatenada = $cadena . " Mundo";

    echo "<p>Cadena concatenada: $cadenaConcatenada</p> <br>";
?>