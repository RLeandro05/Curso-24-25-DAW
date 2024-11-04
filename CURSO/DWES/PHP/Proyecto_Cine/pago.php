<?php
    session_start();

    //$_SESSION['horarioPelicula'] = $_POST['horario'];

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    /*if(!isset($_SESSION['asientos_seleccionados'])) { //Asegurarse de que seleccionó asientos el usuario
        echo nl2br("<h2>No has seleccionado ningún asiento</h2>\n");
        echo nl2br("<h3>Pinche en el siguiente enlace</h3>\n");
        echo "<a href=\"index.php\"> >>> Pinche aquí para volver";

        exit();
    }*/

    /*if (time() - $_SESSION['inicio_seleccion'] > 60) { //Cada segundo que pase, se resta el tiempo actual menos el tiempo en el que empezó el usuario
        echo "<p>El tiempo para el pago ha expirado.</p>"; //Cuando supere el minuto, mostrar el mensaje
        echo "<p><a href=\"index.php\"> >>> Pinche aquí para volver</a></p>";
        unset($_SESSION['inicio_seleccion']); //Eliminar el atributo para que cuando vuelva a meterse el usuario, empiece en 0 segundos de nuevo
        $_SESSION['asientos_ocupados'] = []; //Vaciar el array de asientos si estuvo escogiendo asientos
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        exit(); //Parar la ejecución del código
    }*/
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
        <p>Precio por entrada: 3 €</p>
        <p>
        Asientos: '
            <?php
                print_r($_SESSION['asientos_seleccionados']);
            ?>'
        </p>
        <p>Total a pagar: <?php echo 3*count($_SESSION['asientos_seleccionados'])?> €</p>
    </div>
</body>
</html>