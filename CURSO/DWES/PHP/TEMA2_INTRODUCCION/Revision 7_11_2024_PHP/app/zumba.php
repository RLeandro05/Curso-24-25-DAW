<?php
    session_start(); // Iniciar sesión

    //Incluir el horario y su respectiva clase
    require_once("horario.php");
    require_once("../class/Zumba.php");

    //Objeto de crossfit
    $objZumba = new Zumba($matrizClases["yoga"]["lunes"]["hora"], $matrizClases["yoga"]["miércoles"]["hora"]);


    //Guardar en sus respectivas variables los horarios
    $horario1 = $objZumba->getHorario1();
    $horario2 = $objZumba->getHorario2();

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["realizarReserva"]) && isset($_POST["horario"]) ) { //Si elije realizar la reserva, se va a procesar_formulario.php
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
    <form action="zumba.php" method="post">
        <h3>Zumba</h3>
        <img src="../img/zumba.jpg" alt="zumba.jpg"> <br>
        <p>¡Tonifica tu cuerpo y mejora tu condición física mientras te mueves al ritmo de la música! <br>
            La Zumba es una forma divertida y efectiva de quemar calorías, fortalecer tus músculos y mejorar tu coordinación. <br>
            ¡Olvídate de la monotonía y descubre una nueva forma de entrenar!.
        </p>
        *EN CASO DE ESCOGER ZUMBA, ELIJA EL HORARIO: <br>
        <input type="radio" id="horario1" name="horario" value="<?= $horario1?>">
        <label for="horario1"><?= $horario1?></label>

        <input type="radio" id="horario2" name="horario" value="<?= $horario2?>">
        <label for="horario2"><?= $horario2?></label>

        <input type="hidden" name="clase" value="zumba">

        <br>
        <br>

        <input type="submit" name="realizarReserva" value="Realizar Reserva">
        <input type="submit" name="cancelarReserva" value="Cancelar Reserva">
    </form>
</body>
</html>