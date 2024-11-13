<?php
    session_start();

    //$_SESSION['horarioPelicula'] = $_POST['horario'];

    /*echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";*/

    if (!isset($_SESSION['tiempo'])) { //Crear el atributo de tiempo en caso de que no exista
        $_SESSION["tiempo"] = time();
    }
    
    if(time() - $_SESSION["tiempo"] > 60) { //Si supera el tiempo concreto, dar la opción de volver al inicio pero sin cerrar sesión
        echo nl2br("El tiempo para pagar ha concluido\n");
        echo "<p><a href=\"index.php\"> >>> Pinche aquí para volver</a></p>";
    
        unset($_SESSION['tiempo']); //Eliminar el atributo de tiempo para luego reiniciarlo

        //Dejar libres aquellos asientos previamente seleccionados
        $_SESSION["asientos_ocupados"] = array_diff($_SESSION["asientos_ocupados"], $_SESSION["asientos_seleccionados"]);

        /*echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";*/

        exit(); //Detener la ejecución
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pagado"])) { //Asegurar de que se pinchó en el botón Pagar

        session_regenerate_id(); //Generar un nuevo SID
        //echo session_id();

        //Dar la opción de descargar el ticket
        echo "<form action=\"pago.php\" method=\"post\">";
        echo "<h3><input type=\"submit\" name=\"ticket\" value=\"Descargar Ticket\"></h3>";
        echo "<h3><input type=\"submit\" name=\"cerrarSesion\" value=\"Cerrar Sesión\"></h3>";
        echo "</form>";

    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ticket"])) { //Asegurar de que se pinchó  en el botón Descargar Ticket
        //Guardar toda la información del ticket
        $pelicula = $_SESSION["pelicula"];
        $sesion = $_SESSION["horarioPelicula"];
        $precioUnidad = 3;
        $asientos = $_SESSION["asientos_seleccionados"];
        $total = 3*count($_SESSION["asientos_seleccionados"]);

        //Crear el archivo
        header("Content-Type: text/plain");
        header('Content-Disposition: attachment; filename="ticket.txt"');

        //Añadir al archivo el contenido
        echo nl2br("Película: ".$pelicula."\n");
        echo nl2br("Hora de sesión: ".$sesion."\n");
        echo nl2br("---------------------\n");
        echo nl2br("Precio unitario: ".$precioUnidad." €\n");
        echo "Asientos: ";
        foreach ($asientos as $asiento) {
            echo $asiento.", ";
        }
        echo nl2br("\n");
        echo nl2br("---------------------\n");
        echo nl2br("Total a pagar: ".$total." €\n");
        if(isset($_SESSION["user"])) {
            echo nl2br("Usuario que paga: ".$_SESSION["user"]);
        } else {
            echo nl2br("Usuario que paga: Invitado");
        }

        exit(); //Terminar ejecución
    } elseif (isset($_POST["cerrarSesion"])) { //Redireccionar al usuario a index.php después de cerrar sesión
        unset($_SESSION["user"]);
        header("Location: index.php");
        exit(); //Terminar ejecución
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        #divPago {
            border: 1px solid gray;
            width: 250px;
            height: 280px;
            border-radius: 8px;
            background-color: lightgray;
            margin: auto;
            padding: 10px;
            text-align: left;
        }

        #divPago h2 {
            text-align: center;
        }

        h3 {
            margin: auto;
            margin-bottom: 10px;
            text-align: center;
        }

        input[type=submit] {
            font-size: 1.3em;
        }
    </style>
    <title>Pago total</title>
</head>
<body>
    <div id="divPago">
        <h2>Resumen de la compra</h2>
        <p>Película: '<?php echo $_SESSION['pelicula']?>'</p>
        <p>Sesión: '<?php echo $_SESSION['horarioPelicula']?>'</p>
        <p>Precio por entrada: 3 €</p>
        <p>
        Asientos:
            <?php
                foreach ($_SESSION['asientos_seleccionados'] as $asiento) {
                    echo $asiento.", ";
                }
                //print_r($_SESSION['asientos_seleccionados']);
            ?>
        </p>
        <p>Total a pagar: <?php echo 3*count($_SESSION['asientos_seleccionados'])?> €</p>
        <form action="pago.php" method="post">
        <p><input type="submit" name="pagado" value="Pagar"></p>
        </form>
    </div>
    <h3 id="sesion">
        <?php //Código para mostrar quién inicia sesión
        if (!isset($_SESSION["user"])) {
            echo nl2br("\n\n Iniciado sesión como: Invitado");
        } else {
            echo nl2br("\n\n Iniciado sesión como: ".$_SESSION["user"]);
        }
        ?>
    </h3>
</body>
</html>