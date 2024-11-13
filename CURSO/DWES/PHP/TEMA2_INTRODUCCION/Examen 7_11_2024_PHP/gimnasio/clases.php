<?php
    session_start(); //Iniciar sesión

    //echo "Llega a clases.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviarClase"]) && !isset(($_POST["clase"]))) {
        echo "<h3>Debe elegir una clase para continuar la reserva</h3>";
    } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviarClase"])) { //Si elije realizar la reserva, ir a procesar_formulario.php
        if($_POST["clase"] == "yoga") { //Dependiendo de la clase, irá a una página o a otra
            header("Location: yoga.php");
            exit();
        } else if($_POST["clase"] == "zumba") {
            header("Location: zumba.php");
            exit();
        } else {
            header("Location: crossfit.php");
            exit();
        }
    } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancelarReserva"])) { //Si elije cancelar la reserva, ir a main.php y mostrar que se canceló la reserva anterior
        header("Location: main.php");
        exit();
    }

    //print_r($_SESSION["matrizClases"]["yoga"]["lunes"]["hora"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="clases.php" method="post">
        <h2>Elija una de las siguientes clases a realizar</h2>
        Elegir clase: <br> <br>

        <input type="radio" id="yoga" name="clase" value="yoga">
        <label for="yoga">Yoga</label> <br>

        <input type="radio" id="zumba" name="clase" value="zumba">
        <label for="zumba">Zumba</label> <br>

        <input type="radio" id="crossfit" name="clase" value="crossfit">
        <label for="crossfit">Crossfit</label> <br>
        
        <br> <br>
        
        <input type="submit" name="enviarClase" value="Mostrar Horarios">
        <input type="submit" name="cancelarReserva" value="Cancelar Reserva">
    </form>
</body>
</html>