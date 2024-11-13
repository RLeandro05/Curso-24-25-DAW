<?php
    session_start();

    echo nl2br("SID actual: ".session_id()); //Generar un SID
    
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

    echo nl2br("\n\n\n");

    //unset($_SESSION["user"]);
    //unset($_SESSION["registrado"]);
    //session_unset();

    /*echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";*/

    if(isset($_SESSION['user'])) { //Asegurarse de si existe el usuario, para mostrar el mensaje de bienvenida
        $userName = $_SESSION['user'];
        echo "<h3>¡Hola, $userName!</h3>";
    } else if(!isset($_SESSION["registrado"])){ //Si no existe ningún usuario y no se registró, enviar al registro.php
        echo "<button><a href=\"registro.php\">Regístrate</a></button>";
    } else { //Si no existe ningún usuario y ya estaba registrado, enviar a login.php
        echo "<button><a href=\"login.php\">Iniciar Sesión</a></button>";
    }

    echo "</form>";
?>