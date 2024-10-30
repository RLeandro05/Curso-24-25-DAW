<?php
    if(is_numeric($_POST["Numero"])) {
        echo nl2br("El mensaje es numérico usando is_numeric\n");
    } else {
        echo nl2br("El mensaje no es numérico usando is_numeric\n");
    }
    if(ctype_digit($_POST["Numero"])) {
        echo nl2br("El mensaje es numérico usando ctype_digit\n");
    } else {
        echo nl2br("El mensaje no es numérico usando ctype_digit\n");
    }
?>