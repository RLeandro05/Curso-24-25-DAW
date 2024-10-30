<?php
    if(ctype_alpha($_POST["valor"])){
            echo ("El valor es alfabético");
    } else if(ctype_alnum($_POST["valor"])){
        echo ("El valor es alfanumérico");
    } else if (ctype_digit($_POST["vallor"])){
        echo ("El valor es numérico");
    } else {
        echo ("El valor es distinto de alfabético, alfanumérico y numérico");
    }
?>