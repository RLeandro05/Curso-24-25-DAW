<?php
    require_once "Data.php";

    /*Actividad6:  Usando el siguiente formulario ,
    se pide crear un sistema de búsqueda avanzado que
    permita buscar por nombre de comunidad, provincia o capital, y mostrar resultados
    relevantes*/
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Buscar en Comunidades</title>
    </head>
    <body>
        <h1>Buscar en Comunidades</h1>
        <form method="POST" action="">
            <label for="buscar">Buscar por comunidad, provincia o
            capital:</label>
            <input type="text" id="buscar" name="buscar">
            <button type="submit">Buscar</button>
        </form>
    </body>
</html>