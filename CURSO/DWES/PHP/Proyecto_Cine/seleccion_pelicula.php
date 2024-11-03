<?php
    session_start();

    $mensajeH2 = "Selección de horario de ";

    if (isset($_REQUEST["pelicula"])) { //Primero, asegurar de que se esocgió alguna opción anterior
        $_SESSION['pelicula'] = $_REQUEST["pelicula"];

        /*echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";*/

        if ($_REQUEST["pelicula"] == "spiderman1") { //Caso Spider-Man 1
            $mensajeH2 = $mensajeH2 . "Spider-Man 1";

            echo nl2br("<h2>".$mensajeH2."</h2>");

            echo nl2br("<h3>Horarios actualmente disponibles</h3>"); //Mostrar a detalle los horarios disponibles para escoger

            echo "<form method=\"POST\" action=\"seleccion_asientos.php\">";

            echo nl2br("<input type=\"radio\" id=\"horario1\" name=\"horario\" value=\"horario1\">");
            echo nl2br("<label for=\"horario1\"> 15:30 PM</label>\n");

            echo nl2br("<input type=\"radio\" id=\"horario2\" name=\"horario\" value=\"horario2\">");
            echo nl2br("<label for=\"horario2\"> 17:00 PM</label>\n");

            echo nl2br("<input type=\"radio\" id=\"horario3\" name=\"horario\" value=\"horario3\">");
            echo nl2br("<label for=\"horario3\"> 20:15 PM</label>\n\n");

            echo "<input type=\"submit\" value=\"Enviar respuesta\"> ";
            echo "<input type=\"reset\" value=\"Borrar respuesta\">";

            echo "</form>";

        } else if ($_REQUEST["pelicula"] == "spiderman2") { //Caso Spider-Man 2
            $mensajeH2 = $mensajeH2 . "Spider-Man 2";

            echo nl2br("<h2>".$mensajeH2."</h2>");

            echo nl2br("<h3>Horarios actualmente disponibles</h3>"); //Mostrar a detalle los horarios disponibles para escoger

            echo "<form method=\"POST\" action=\"seleccion_asientos.php\">";

            echo nl2br("<input type=\"radio\" id=\"horario1\" name=\"horario\" value=\"horario1\">");
            echo nl2br("<label for=\"horario1\"> 15:00 PM</label>\n");

            echo nl2br("<input type=\"radio\" id=\"horario2\" name=\"horario\" value=\"horario2\">");
            echo nl2br("<label for=\"horario2\"> 18:00 PM</label>\n");

            echo nl2br("<input type=\"radio\" id=\"horario3\" name=\"horario\" value=\"horario3\">");
            echo nl2br("<label for=\"horario3\"> 21:00 PM</label>\n\n");

            echo "<input type=\"submit\" value=\"Enviar respuesta\"> ";
            echo "<input type=\"reset\" value=\"Borrar respuesta\">";

            echo "</form>";
        } else { //Caso Spider-Man 3
            $mensajeH2 = $mensajeH2 . "Spider-Man 3";

            echo nl2br("<h2>".$mensajeH2."</h2>");

            echo nl2br("<h3>Horarios actualmente disponibles</h3>"); //Mostrar a detalle los horarios disponibles para escoger

            echo "<form method=\"POST\" action=\"seleccion_asientos.php\">";

            echo nl2br("<input type=\"radio\" id=\"horario1\" name=\"horario\" value=\"horario1\">");
            echo nl2br("<label for=\"horario1\"> 16:15 PM</label>\n");

            echo nl2br("<input type=\"radio\" id=\"horario2\" name=\"horario\" value=\"horario2\">");
            echo nl2br("<label for=\"horario2\"> 18:45 PM</label>\n");

            echo nl2br("<input type=\"radio\" id=\"horario3\" name=\"horario\" value=\"horario3\">");
            echo nl2br("<label for=\"horario3\"> 20:00 PM</label>\n\n");

            echo "<input type=\"submit\" value=\"Enviar respuesta\"> ";
            echo "<input type=\"reset\" value=\"Borrar respuesta\">";

            echo "</form>";
        }

        echo "<a href=\"inde.php\"> >>> Pinche aquí para volver</a>"; //Dar la opción de volver a la página de inicio si desea realizar otra operación

        
    } else { //Si no se escogió ninguna opción, comentar el error y dar la opción de volver a la página de inicio
        echo nl2br("<h2>¡Vaya! Parece que no has seleccionado ninguna película de la cartelera</h2>");
        echo nl2br("<h3>Por favor, pinche en el siguiente enlace para volver a la página de inicio</h3> >>> <a href=\"inde.php\">Pinche aquí para volver</a>");
    }
    
?>