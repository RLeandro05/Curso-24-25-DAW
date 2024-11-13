<?php 
    $array = $_POST;
    // Si el valor es nulo en la checkbox o el sexo, mostrar el error
    if(!isset($array['NoEsRobot']) | !isset($array['Sexo'])) {
        echo "No confirmaste que no eres u robot o no elejiste una opción sexual";
    } else {
        print "<pre>";
        print_r($array);
        print "<pre>";
    }
?>