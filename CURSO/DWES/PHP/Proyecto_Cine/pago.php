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
        echo nl2br("El tiempo para seleccionar asientos a concluído\n");
        echo "<p><a href=\"index.php\"> >>> Pinche aquí para volver</a></p>";
    
        unset($_SESSION['tiempo']); //Eliminar el atributo de tiempo para luego reiniciarlo

        //Dejar libres aquellos asientos previamente seleccionados
        $_SESSION["asientos_ocupados"] = array_diff($_SESSION["asientos_ocupados"], $_SESSION["asientos_seleccionados"]);

        /*echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";*/

        exit(); //Detener la ejecución
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
            width: 500px;
            height: 400px;
            border-radius: 8px;
            background-color: lightgray;
            text-align: center;
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
    </div>
</body>
</html>