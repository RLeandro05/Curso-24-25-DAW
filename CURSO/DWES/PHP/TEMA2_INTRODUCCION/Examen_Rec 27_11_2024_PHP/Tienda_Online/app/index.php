<?php 
//session_destroy();
//session_unset();

//evita el almacenamiento en caché
header('Cache-Control: no-store, no-cache, must-revalidate');

session_start();

$aux= session_id();
print_r(nl2br( "\n El SID actual antes de iniciar el código de cierre de sesion es: " . session_id(). "\n"));


?>
<!DOCTYPE html>
<html>
<head>
    <title>SOLINE</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <header>
        <img src="../img/logo.png" alt="SOLINE">
        <h1>Tu tienda de Ropa Online</h1>
    </header>
   
<nav><form action="login.php" method="post">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required>
    <br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>
    <br>
    <input type="submit" value="Iniciar sesión">
</form></nav>
       <footer>
        <p>Página web creada en 2024</p>
    </footer>
</body>
</html>