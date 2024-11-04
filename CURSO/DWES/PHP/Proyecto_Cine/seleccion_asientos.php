<?php
session_start();

// Inicializar el array de asientos ocupados si no existe
if (!isset($_SESSION['asientos_ocupados'])) {
    $_SESSION['asientos_ocupados'] = [];
}

// Comprobar si se ha enviado el formulario desde la selección de película
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'seleccion_horario') {
    if (isset($_POST["horario"])) {
        $_SESSION["horarioPelicula"] = $_POST["horario"];
    }
}

// Recuperar los asientos ocupados
$asientos_ocupados = $_SESSION['asientos_ocupados'];

// Si se envían asientos, guardarlos en la sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['asientos'])) {
    // Guardar los asientos seleccionados en la sesión
    $_SESSION['asientos_seleccionados'] = $_POST['asientos'];
    
    // Actualizar los asientos ocupados
    $_SESSION['asientos_ocupados'] = array_merge($asientos_ocupados, $_SESSION['asientos_seleccionados']);
    
    // Redirigir a pago.php
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
                            <label class="<?= $ocupado ? 'ocupado' : 'disponible' ?>"><?= $asiento ?></label>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
        <input type="hidden" name="horario" value="<?php echo isset($_SESSION['horarioPelicula']) ? $_SESSION['horarioPelicula'] : ''; ?>">
        <button type="submit">Confirmar Selección</button>
    </form>
</body>
</html>
