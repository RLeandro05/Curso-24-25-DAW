<?php
    session_start(); // Iniciar sesión

    //Incluir el horario y su respectiva clase
    require_once("horario.php");
    require_once("../class/Crossfit.php");

    //Objeto de crossfit
    $objCrossfit = new Crossfit($matrizClases["crossfit"]["lunes"]["hora"], $matrizClases["crossfit"]["miércoles"]["hora"], $matrizClases["crossfit"]["viernes"]["hora"]);


    //Guardar en sus respectivas variables los horarios
    $horario1 = $objCrossfit->getHorario1();
    $horario2 = $objCrossfit->getHorario2();
    $horario3 = $objCrossfit->getHorario3();
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["realizarReserva"]) && isset($_POST["horario"])) { //Si elije realizar la reserva, se va a procesar_formulario.php
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
    <form action="crossfit.php" method="post">
        <h3>Crossfit</h3>
        <img src="../img/crossfit.jpg" height="400px" width="600px" alt="crossfit"> <br>
        <p><p>¿Buscas un entrenamiento que te desafíe al máximo y te haga sentir como un auténtico atleta? <br>
            ¡Nuestras clases de CrossFit son para ti! Combina ejercicios funcionales de alta intensidad con movimientos olímpicos, <br>
            fortaleciendo todo tu cuerpo y mejorando tu resistencia, fuerza y agilidad. <br>
            ¡Prepárate para sudar, quemar calorías y alcanzar tus metas de fitness más rápido que nunca!.
        </p>
        *EN CASO DE ESCOGER CROSSFIT, ELIJA EL HORARIO: <br>
        <input type="radio" id="horario1" name="horario" value="<?= $horario1?>">
        <label for="horario1"><?= $horario1?></label>

        <input type="radio" id="horario2" name="horario" value="<?= $horario2?>">
        <label for="horario2"><?= $horario2?></label>

        <input type="radio" id="horario3" name="horario" value="<?= $horario3?>">
        <label for="horario3"><?= $horario3?></label>

        <input type="hidden" name="clase" value="crossfit">
        
        <br>
        <br>

        <input type="submit" name="realizarReserva" value="Realizar Reserva">
        <input type="submit" name="cancelarReserva" value="Cancelar Reserva">
    </form>
</body>
</html>