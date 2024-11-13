<?php
    if(is_int($_POST["NumeroINT"])) {
        echo nl2br("El numero es entero.\n");
    } else {
        echo nl2br("El numero no es entero.\n");
    }

    if(is_float(($_POST["NumeroFLOAT"]))) {
        echo nl2br("El numero es decimal.\n");
    } else {
        echo nl2br("El numero no es decimal.\n");
    }

    if(is_string(($_POST["Cadena"]))) {
        echo nl2br("El texto es una cadena.\n");
    } else {
        echo nl2br("El texto no es una cadena.\n");
    }
?>