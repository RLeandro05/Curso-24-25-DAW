<?php
    session_start(); // Iniciar sesión

    //Incluir el horario y su respectiva clase
    require_once("horario.php");
    require_once("../class/Yoga.php");

    //Objeto de crossfit
    $objYoga = new Yoga($matrizClases["yoga"]["lunes"]["hora"], $matrizClases["yoga"]["miércoles"]["hora"], $matrizClases["yoga"]["viernes"]["hora"]);


    //Guardar en sus respectivas variables los horarios
    $horario1 = $objYoga->getHorario1();
    $horario2 = $objYoga->getHorario2();
    $horario3 = $objYoga->getHorario3();

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
        <img src="../img/Yoga.jpg" alt="Yoja"> <br>
        <p>Complementa tu rutina de gimnasio con yoga. <br>
            Aumenta tu fuerza y resistencia de una manera diferente, mejora tu postura y alineación, y reduce el riesgo de lesiones. <br>
            El yoga te ayudará a esculpir músculos y a ganar flexibilidad de una forma más suave y consciente.
        </p>
        *EN CASO DE ESCOGER YOGA, ELIJA EL HORARIO: <br>
        <input type="radio" id="horario1" name="horario" value="<?= $horario1?>">
        <label for="horario1"><?= $horario1?></label>

        <input type="radio" id="horario2" name="horario" value="<?= $horario2?>">
        <label for="horario2"><?= $horario2?></label>

        <input type="radio" id="horario3" name="horario" value="<?= $horario3?>">
        <label for="horario3"><?= $horario3?></label>

        <input type="hidden" name="clase" value="yoga">
        
        <br>
        <br>

        <input type="submit" name="realizarReserva" value="Realizar Reserva">
        <input type="submit" name="cancelarReserva" value="Cancelar Reserva">
    </form>
</body>
</html>