<?php 
    $num = (int) $_POST["numElementos"];


    if($num >= 1 && $num <= 10) { // Comprobar que el número es entero
        // En caso afirmativo, hacer un segundo formulario
        echo nl2br("Número de elementos: $num x $num\n");
        echo nl2br("Introduzca los elementos a tratar: \n");
        echo "<form method=\"post\" action=\"Pag3.php\">";
        echo "<p>";
        $contadorColumnas = 1;
        $contadorFilas = 1;
        $name = 1;
        for ($i=0; $i<$num*$num ; $i++) { // For para crear el número de inputs equivalentes al número traído de la anterior página
            if($contadorColumnas == $num) {
                echo "<input type=\"text\" name=\"{$contadorFilas},{$contadorColumnas}\" maxlength=\"1\" size=\"1\">";
                echo nl2br("\n\n");
                $contadorFilas++;
                $contadorColumnas = 1;
            } else {
                echo "<input type=\"text\" name=\"{$contadorFilas},{$contadorColumnas}\" maxlength=\"1\" size=\"1\">";
                $contadorColumnas++;
            }
            $name++;
            
        }
        echo "</p>";

        echo "<p>Selecciona una fila: <select name=\"seleccionFila\">";
        for ($i = 1; $i<=$num; $i++) {
            echo "<option>$i</option>";
        }
        echo "</select></p>";
        
        echo "<p>Selecciona una columna: <select name=\"seleccionColumna\">";
        for ($i = 1; $i<=$num; $i++) {
            echo "<option>$i</option>";
        }
        echo "</select></p>";

        echo "<p>Introduzca la trayectoria: <select name=\"trayectoria\">";
        echo "<option name=\"Arriba\">Arriba</option>";
        echo "<option name=\"Abajo\">Abajo</option>";
        echo "<option name=\"Izquierda\">Izquierda</option>";
        echo "<option name=\"Derecha\">Derecha</option>";
        echo "<option name=\"Arriba Izquierda\">Arriba Izquierda</option>";
        echo "<option name=\"Abajo izquierda\">Abajo izquierda</option>";
        echo "<option name=\"Arriba derecha\">Arriba derecha</option>";
        echo "<option name=\"Abajo derecha\">Abajo derecha</option>";
        echo "</select></p>";

        echo "<input type=\"hidden\" value=\"$num\" name=\"totalFilasColumnas\">";

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