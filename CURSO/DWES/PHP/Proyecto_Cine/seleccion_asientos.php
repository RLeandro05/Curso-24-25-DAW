<?php
session_start();

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

if (!isset($_SESSION['tiempo'])) { //Crear el atributo de tiempo en caso de que no exista
    $_SESSION["tiempo"] = time();
}

if(time() - $_SESSION["tiempo"] > 60) { //Si supera el tiempo concreto, dar la opción de volver al inicio, sin cerrar sesión
    echo nl2br("El tiempo para seleccionar asientos a concluído\n");
    echo "<p><a href=\"index.php\"> >>> Pinche aquí para volver</a></p>";

    unset($_SESSION['tiempo']);

    exit();
}

//Inicializar el array de asientos ocupados si no existe
if (!isset($_SESSION['asientos_ocupados'])) {
    $_SESSION['asientos_ocupados'] = [];
}

//Comprobar si se ha enviado el formulario desde la selección de película para evitar fallos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'seleccion_horario') {
    if (isset($_POST["horario"])) { //En el caso de que exista el atributo, asignarle el valor
        $_SESSION["horarioPelicula"] = $_POST["horario"];
    }
}

//Recuperar los asientos ocupados y asignarlos a una variable
$asientos_ocupados = $_SESSION['asientos_ocupados'];

//Si se envían asientos, guardarlos en la sesión, asegurando de que se checkearon al menos 1 asiento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['asientos'])) {
    //Guardar los asientos seleccionados en la sesión
    $_SESSION['asientos_seleccionados'] = $_POST['asientos'];
    
    //Actualizar los asientos ocupados
    $_SESSION['asientos_ocupados'] = array_merge($asientos_ocupados, $_SESSION['asientos_seleccionados']);

    if (isset($_SESSION["tiempo"])) {
        unset($_SESSION['tiempo']); //Eliminar el atributo para quitar errores
    }
    
    //Redirigir a pago.php
    header("Location: pago.php");
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

    <form method="POST" action="">
        <table>
            <?php for ($fila = 1; $fila <= 5; $fila++): ?>
                <tr>
                    <?php for ($columna = 1; $columna <= 6; $columna++): ?>
                        <?php
                        $asiento = "Fila{$fila}-Asiento{$columna}";
                        $ocupado = in_array($asiento, $asientos_ocupados);
                        ?>
                        <td>
                            <input 
                                type="checkbox" 
                                name="asientos[]"
                                value="<?= $asiento ?>" 
                                class="asiento" 
                                <?= $ocupado ? 'disabled' : '' ?>
                            >
                            <label class="<?= $ocupado ? 'ocupado' : 'disponible' ?>"><?= $asiento ?></label> <!--Poner si está ocupado o no dependiendo de si se chequea-->
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
        <input type="hidden" name="horario" value="<?php echo isset($_SESSION['horarioPelicula']) ? $_SESSION['horarioPelicula'] : ''; ?>">
        <input type="hidden" name="tiempo" value="<?php echo isset($_SESSION['tiempo']) ? $_SESSION['tiempo'] : ''; ?>">
        <br>
        <button type="submit">Confirmar Selección</button>
    </form>
</body>
</html>

<?php //Código para mostrar quién inicia sesión
    if (!isset($_SESSION["user"])) {
        echo nl2br("\n\n <h3>Iniciado sesión como: Invitado</h3>");
    } else {
        echo nl2br("\n\n <h3>Iniciado sesión como: ".$_SESSION["user"]."</h3>");
    }
?>