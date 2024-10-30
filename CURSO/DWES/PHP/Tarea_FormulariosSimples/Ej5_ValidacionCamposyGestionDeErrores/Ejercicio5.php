<?php
    if(empty($_POST["Nombre"])) {
        echo "El campo Nombre es obligatorio.";
    } else if(empty($_POST["Email"])) {
        echo "El campo Email es obligatorio.";
    } else {
        print "<pre>";
        print_r($_POST);
        print "<pre>";
    }
?>