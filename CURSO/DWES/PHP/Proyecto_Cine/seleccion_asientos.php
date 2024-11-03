<?php
    session_start(); //Iniciar sesión

    //Guardar en una variable el array de asientos ocupados, en caso de que anteriormente ya lo estuviesen
    $asientos_ocupados = isset($_SESSION['asientos_ocupados']) ? $_SESSION['asientos_ocupados'] : [];

    if (!isset($_SESSION['inicio_seleccion'])) { //En el caso de que no exista el atributo inicio_seleccion, crearlo y añadirlo el tiempo transcurrido
        $_SESSION['inicio_seleccion'] = time();
    } elseif (time() - $_SESSION['inicio_seleccion'] > 60) { //Cada segundo que pase, se resta el tiempo actual menos el tiempo en el que empezó el usuario
        echo "<p>El tiempo para la selección de asientos ha expirado.</p>"; //Cuando supere el minuto, mostrar el mensaje
        echo "<p><a href=\"inde.php\"> >>> Pinche aquí para volver</a></p>";
        unset($_SESSION['inicio_seleccion']); //Eliminar el atributo para que cuando vuelva a meterse el usuario, empiece en 0 segundos de nuevo
        $_SESSION['asientos_ocupados'] = []; //Vaciar el array de asientos si estuvo escogiendo asientos
        exit(); //Parar la ejecución del código
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['asientos'])) { //Asegurar si se manda con POST y si existe el name "asientos"
        $_SESSION['asientos_seleccionados'] = $_POST['asientos']; //Guardar en un nuevo atributo los asientos seleccionados
        $_SESSION['asientos_ocupados'] = array_merge($_SESSION['asientos_ocupados'], $_SESSION['asientos_seleccionados']); //Añadir los nuevos asientos al atributo de ocupados
        header("Location: pago.php"); //Dirigirse automáticamente a pago.php
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Selección de Asientos</title>
        <style>
            .asiento { width: 30px; height: 30px; }
            .ocupado { background-color: #FF474C; }
            .disponible { background-color: lightgreen; }
        </style>
    </head>
    <body>
        <h2>Selecciona tus asientos</h2>
        <p>Tienes 1 minuto para seleccionar tus asientos.</p>

        <form method="POST" action="pago.php">
            <table>
                <?php for ($fila = 1; $fila <= 5; $fila++): ?> <!--Por cada fila, crear un tr-->
                    <tr>
                        <?php for ($columna = 1; $columna <= 6; $columna++): ?> <!--Por cada fila, crear 6 columnas/asientos-->
                            <?php
                            $asiento = "Fila{$fila}-Asiento{$columna}"; //Crear un asiento con los valores generados de ambos for
                            $ocupado = in_array($asiento, $asientos_ocupados); //Guardar true o false dependiendo de si ese asiento ya existía en la lista de asientos ocupados
                            ?>
                            <td> <!--Crear una nueva celda-->
                                <input 
                                    type="checkbox" 
                                    name="asientos[]" 
                                    value="<?= $asiento ?>"
                                    class="asiento" 
                                    <?= $ocupado ? 'disabled' : '' ?>
                                >
                                <label
                                    class="<?= $ocupado ? 'ocupado' : 'disponible' ?>"
                                ><?= $asiento ?></label>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </table>
            <button type="submit">Confirmar Selección</button>
        </form>
    </body>
</html>