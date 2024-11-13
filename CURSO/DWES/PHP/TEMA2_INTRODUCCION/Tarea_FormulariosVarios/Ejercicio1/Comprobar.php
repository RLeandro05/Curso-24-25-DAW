<?php 
    $num = (int) $_REQUEST["numElementos"];


    if($num >= 1 && $num <= 10) { // Comprobar que el número es entero
        // En caso afirmativo, hacer un segundo formulario
        echo nl2br("Número de elementos: $num\n");
        echo nl2br("Introduzca los elementos a tratar: \n");
        echo "<form method=\"post\" action=\"Pag3.php\">";
        echo "<p>";
        for ($i=0; $i<$num ; $i++) { // For para crear el número de inputs equivalentes al número traído de la anterior página
            echo "<input type=\"text\" name=\"elemento_{$i}\" id=\"elemento_{$i}\" maxlength=\"1\" size=\"1\">";
        }
        echo "</p>";
        echo "<p>";
        echo "<input type=\"submit\" value=\"Enviar\">";
        echo "<input type=\"reset\" value=\"Borrar\">";
        echo "</p>";
        echo "<a href=\"Pag1.html\">Volver al inicio</a>";

        echo "</form>";
    } else { // En caso negativo, indicar el error y dar la opción de volver al inicio
        echo nl2br("El valor es incorrecto. Debe ser un número entero entre 1 y 10.\n");
        echo "<a href=\"Pag1.html\">Volver al inicio</a>";
    }
?>