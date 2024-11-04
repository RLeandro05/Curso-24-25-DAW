<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registrado"])) { //Asegurarse de que se usa POST para enviar datos y de que se pulsa en Registrar
        //Crear el usuario y registro en $_SESSION
        $_SESSION["user"] = trim($_POST["user"]);
        $_SESSION["copiaUser"] = trim($_POST["user"]); //Añadir una copia de user para poder validarlo en login.php
        $_SESSION["registrado"] = $_POST["registrado"];

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        #formRegistro {
            width: 250px;
            height: 120px;
            text-align: left;
            margin: auto;
            padding: 10px;
            background-color: lightgray;
            border: 1ps solid gray;
            border-radius: 8px;
        }
    </style>
    <title>Registro</title>
</head>
<body>
    <div id="formRegistro">
        <form action="registro.php" method="post"> <!--Formulario para introducir los datos de la cuenta por primera vez-->
            <p>
                <label for="usuario">Usuario: </label>
                <input type="text" id="usuario" name="user" size="15" required>
            </p>
            
            <p>
                <label for="password">Contrase&ntilde;a: </label>
                <input type="password" id="password" name="pass" size="15" required>
            </p>

            <p>
                <input type="submit" name="registrado" value="Registrarse">
                <input type="reset" value="Borrar">
            </p>
        </form>
    </div>
</body>
</html>