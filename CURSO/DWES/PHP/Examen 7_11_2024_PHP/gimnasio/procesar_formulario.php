<?php 
    session_start(); //Iniciar sesión

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["horario"] = $_POST["horario"];
        $_SESSION["clase"] = $_POST["clase"];
        //echo $_SESSION["clase"];
    }

    

    //echo "Llega a procesar_formulario.php";
?>

