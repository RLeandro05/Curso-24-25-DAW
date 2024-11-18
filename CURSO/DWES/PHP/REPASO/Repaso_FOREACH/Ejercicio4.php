<?php
    require_once "Data.php";

    /*Actividad 4: Dado el siguiente formulario, 
    se debe mostrar por pantalla el resultado de los datos
    solicitados por el usuario.*/

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $PROVINCIA = $_POST["provincia"];
        $booleano = false;

        foreach ($comunidades as $comunidad => $infoComunidad) {
            foreach ($infoComunidad["provincias"] as $provincia => $infoProvincia) {
                if($PROVINCIA == $infoProvincia) {
                    echo nl2br($infoProvincia."\n");
                    $booleano = true;
                }
            }
        }

        if (!$booleano) {
            echo "<h2>No existe dicha provincia</h2>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Buscar Provincia</title>
    </head>
    <body>
        <h1>Buscar Provincia</h1>
        <form method="POST" action="">
            <label for="provincia">Ingrese el nombre de la provincia:</label>
            <input type="text" id="provincia" name="provincia">
            <button type="submit">Buscar</button>
        </form>
    </body>
</html>
