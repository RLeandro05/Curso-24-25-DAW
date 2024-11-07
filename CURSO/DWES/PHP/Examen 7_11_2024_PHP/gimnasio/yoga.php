<?php 
    session_start(); // Iniciar sesión

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["realizarReserva"])) { //Si elije realizar la reserva, se va a procesar_formulario.php
        $_SESSION["horario"] = $_POST["horario"];
        $_SESSION["clase"] = $_POST["clase"];
        header("Location: procesar_formulario.php");
        exit();
    } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["realizarReserva"]) && !isset($_POST["horario"])) {
        echo "<h3>Debes seleccionar un horario para continuar la reserva</h3>";
    } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancelarReserva"])) { //Si elije cancelar la reserva, se va a main.php
        header("Location: main.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="yoga.php" method="post">
        <h3>Yoga</h3>
        <img src="Yoga.jpg" alt="Yoja.jpg"> <br>
        <p>Complementa tu rutina de gimnasio con yoga. <br>
            Aumenta tu fuerza y resistencia de una manera diferente, mejora tu postura y alineación, y reduce el riesgo de lesiones. <br>
            El yoga te ayudará a esculpir músculos y a ganar flexibilidad de una forma más suave y consciente.
        </p>
        *EN CASO DE ESCOGER YOGA, ELIJA EL HORARIO: <br>
        <input type="radio" id="horario1" name="horario">
        <label for="horario1"><?php print_r ($_SESSION["matrizClases"]["yoga"]["lunes"]["hora"])?></label>

        <input type="radio" id="horario2" name="horario">
        <label for="horario2"><?php print_r ($_SESSION["matrizClases"]["yoga"]["miércoles"]["hora"])?></label>

        <input type="radio" id="horario3" name="horario">
        <label for="horario3"><?php print_r ($_SESSION["matrizClases"]["yoga"]["viernes"]["hora"])?></label>

        <input type="hidden" name="clase" value="yoga">
        
        <br>
        <br>

        <input type="submit" name="realizarReserva" value="Realizar Reserva">
        <input type="submit" name="cancelarReserva" value="Cancelar Reserva">
    </form>
</body>
</html>