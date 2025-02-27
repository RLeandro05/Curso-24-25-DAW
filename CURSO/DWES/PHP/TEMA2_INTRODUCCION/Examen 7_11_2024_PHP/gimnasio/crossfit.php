<?php 
    session_start(); // Iniciar sesión

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

    $matrizClases = [ //Matriz de clases a elegir
        'yoga' => [
            'lunes' => [
            'hora' => '19:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'miércoles' => [
            'hora' =>'08:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'viernes' => [
            'hora' =>'10:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
        ],
        'zumba' => [
            'martes' => [
            'hora' => '18:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'jueves' => [
            'hora' =>'19:30',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
        ],
        'crossfit' => [
            'lunes' => [
            'hora' => '18:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'miércoles' => [
            'hora' =>'14:30',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'viernes' => [
            'hora' =>'20:30',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],       
        ]
    ];

    $_SESSION["matrizClases"] = $matrizClases;
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
        <img src="crossfit.jpg" height="400px" width="600px" alt="crossfit.jpg"> <br>
        <p><p>¿Buscas un entrenamiento que te desafíe al máximo y te haga sentir como un auténtico atleta? <br>
            ¡Nuestras clases de CrossFit son para ti! Combina ejercicios funcionales de alta intensidad con movimientos olímpicos, <br>
            fortaleciendo todo tu cuerpo y mejorando tu resistencia, fuerza y agilidad. <br>
            ¡Prepárate para sudar, quemar calorías y alcanzar tus metas de fitness más rápido que nunca!.
        </p>
        *EN CASO DE ESCOGER CROSSFIT, ELIJA EL HORARIO: <br>
        <input type="radio" id="horario1" name="horario">
        <label for="horario1"><?php print_r ($_SESSION["matrizClases"]["crossfit"]["lunes"]["hora"])?></label>

        <input type="radio" id="horario2" name="horario">
        <label for="horario2"><?php print_r ($_SESSION["matrizClases"]["crossfit"]["miércoles"]["hora"])?></label>

        <input type="radio" id="horario3" name="horario">
        <label for="horario3"><?php print_r ($_SESSION["matrizClases"]["crossfit"]["viernes"]["hora"])?></label>

        <input type="hidden" name="clase" value="crossfit">
        
        <br>
        <br>

        <input type="submit" name="realizarReserva" value="Realizar Reserva">
        <input type="submit" name="cancelarReserva" value="Cancelar Reserva">
    </form>
</body>
</html>