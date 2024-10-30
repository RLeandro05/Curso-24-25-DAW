<?php 
    $listaOriginal = $_REQUEST;

    function permutacion($listaOriginal) {
        echo nl2br("Tus datos originales son:\n");
        foreach($listaOriginal as $i) { // Mostrar los datos originales de la lista traída
            echo $i;
        }

        echo nl2br("\n\n");

        echo nl2br("Tus datos invertidos son:\n");
        $listaReversa = array_reverse($listaOriginal); // Con array_reverse, revertir los valores de la lista original y luego mostrar dicha lista revertida
        foreach($listaReversa as $i) {
            echo $i;
        }

        echo nl2br("\n\n");

        echo "<a href=\"Pag1.html\">Volver al inicio</a>";
    }

    permutacion($listaOriginal);
    
?>