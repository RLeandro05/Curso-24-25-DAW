<?php
    echo nl2br("<h2>Bienvenid@ al Cine</h2>\n"); //Mensaje de bienvenida

    echo nl2br("<h3>Cartelera del día</h3>\n");

    echo "<form method=\"POST\" action=\"seleccion_pelicula.php\">"; //En un formulario, mostrar las películas y horarios

    echo nl2br("<input type=\"radio\" id=\"spiderman1\" name=\"pelicula\" value=\"spiderman1\">");
    echo nl2br("<label for=\"spiderman1\"> Spider-Man 1 || 15:30 - 17:00 - 20:15</label>\n");

    echo nl2br("<input type=\"radio\" id=\"spiderman2\" name=\"pelicula\" value=\"spiderman2\">");
    echo nl2br("<label for=\"spiderman2\"> Spider-Man 2 || 15:00 - 18:00 - 21:00</label>\n");

    echo nl2br("<input type=\"radio\" id=\"spiderman3\" name=\"pelicula\" value=\"spiderman3\">");
    echo nl2br("<label for=\"spiderman3\"> Spider-Man 3 || 16:15 - 18:45 - 20:00</label>\n\n");

    echo "<input type=\"submit\" value=\"Enviar respuesta\"> "; //Al enviar, mostrar a detalle los horarios
    echo "<input type=\"reset\" value=\"Borrar respuesta\">";

    echo "</form>";
?>