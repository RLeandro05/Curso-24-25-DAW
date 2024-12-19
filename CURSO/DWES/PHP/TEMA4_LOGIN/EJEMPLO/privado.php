<?php
// Activa las sesiones
session_name("sesion-privada");
session_start();
// Comprueba si existe la sesión "email", en caso contrario vuelve a la página de login
if (!isset($_SESSION["email"])) {
    header("Location: loginBasico.php"); // Redirige si no hay sesión
    exit(); // Asegúrate de no ejecutar más código después de la redirección
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privado</title>
</head>

<body>
    <h1>Panel secreto</h1>
    <p>¡Te encuentras en una zona secreta!, solo visible por una persona identificada.</p>
    <p><a href="cerrarSesion.php">Cerrar sesión</a></p>
</body>

</html>