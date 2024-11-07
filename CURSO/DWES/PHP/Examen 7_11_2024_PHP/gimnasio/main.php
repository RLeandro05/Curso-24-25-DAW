<?php 
    session_start(); //Iniciar Sesión

    //echo "Llega a main.php";

    echo nl2br("¡Bienvenido, ".$_SESSION["user"]."!\n\n"); //Dar mensaje de bienvenida al admin o usuario que inicie sesión

    //Implementar enlace para ver las clases
    echo nl2br("Puede ver el catálogo de actividades del gimnasio en el siguiente enlace:\n\n");
    echo nl2br("<a href=\"clases.php\">Pinche aquí para ver las clases/actividades</a>\n\n");

    //Implementar botón que redirige a index.php, cerrando la sesión del usuario o admin
    echo "<form action=\"index.php\" method=\"post\">";
        echo "<button name=\"sesionCerrada\">Cerrar Sesión</button>";
    echo "</form>";
?>