<?php
session_start();

$mensajeH2 = "Selección de horario de ";

if (isset($_REQUEST["pelicula"])) { // Primero, asegurar de que se escogió alguna opción anterior
    $_SESSION['pelicula'] = $_POST["pelicula"];
    $_SESSION['horarioPelicula'] = "";

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    $mensajeH2 .= $_POST["pelicula"] == "spiderman1" ? "Spider-Man 1" : ($_POST["pelicula"] == "spiderman2" ? "Spider-Man 2" : "Spider-Man 3");
    
    echo nl2br("<h2>".$mensajeH2."</h2>");
    echo nl2br("<h3>Horarios actualmente disponibles</h3>");

    echo "<form method=\"POST\" action=\"seleccion_asientos.php\">";
    echo "<input type=\"hidden\" name=\"accion\" value=\"seleccion_horario\">"; // Campo oculto para identificar el formulario

    if ($_POST["pelicula"] == "spiderman1") {
        echo nl2br("<input type=\"radio\" id=\"horario1\" name=\"horario\" value=\"15:30 PM\">");
        echo nl2br("<label for=\"horario1\"> 15:30 PM</label>\n");
        echo nl2br("<input type=\"radio\" id=\"horario2\" name=\"horario\" value=\"17:00 PM\">");
        echo nl2br("<label for=\"horario2\"> 17:00 PM</label>\n");
        echo nl2br("<input type=\"radio\" id=\"horario3\" name=\"horario\" value=\"20:15 PM\">");
        echo nl2br("<label for=\"horario3\"> 20:15 PM</label>\n");
    } elseif ($_POST["pelicula"] == "spiderman2") {
        echo nl2br("<input type=\"radio\" id=\"horario1\" name=\"horario\" value=\"15:00 PM\">");
        echo nl2br("<label for=\"horario1\"> 15:00 PM</label>\n");
        echo nl2br("<input type=\"radio\" id=\"horario2\" name=\"horario\" value=\"18:00 PM\">");
        echo nl2br("<label for=\"horario2\"> 18:00 PM</label>\n");
        echo nl2br("<input type=\"radio\" id=\"horario3\" name=\"horario\" value=\"21:00 PM\">");
        echo nl2br("<label for=\"horario3\"> 21:00 PM</label>\n");
    } else {
        echo nl2br("<input type=\"radio\" id=\"horario1\" name=\"horario\" value=\"16:15 PM\">");
        echo nl2br("<label for=\"horario1\"> 16:15 PM</label>\n");
        echo nl2br("<input type=\"radio\" id=\"horario2\" name=\"horario\" value=\"18:45 PM\">");
        echo nl2br("<label for=\"horario2\"> 18:45 PM</label>\n");
        echo nl2br("<input type=\"radio\" id=\"horario3\" name=\"horario\" value=\"20:00 PM\">");
        echo nl2br("<label for=\"horario3\"> 20:00 PM</label>\n");
    }

    echo "<input type=\"submit\" value=\"Enviar respuesta\"> ";
    echo "<input type=\"reset\" value=\"Borrar respuesta\">";
    echo "</form>";

    echo "<a href=\"inde.php\"> >>> Pinche aquí para volver</a>";
    
} else { // Si no se escogió ninguna opción
    echo nl2br("<h2>¡Vaya! Parece que no has seleccionado ninguna película de la cartelera</h2>");
    echo nl2br("<h3>Por favor, pinche en el siguiente enlace para volver a la página de inicio</h3> >>> <a href=\"inde.php\">Pinche aquí para volver</a>");
}
?>
