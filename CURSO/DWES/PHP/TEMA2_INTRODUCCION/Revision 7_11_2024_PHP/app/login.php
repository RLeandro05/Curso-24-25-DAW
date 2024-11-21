<?php
session_start();
session_regenerate_id();
//evita el almacenamiento en caché
header('Cache-Control: no-store, no-cache, must-revalidate');
require_once 'horario.php';
$usuarios = array(
    'admin' => 'admin',
    'usuario' => 'usuario'
);

if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $contrasena) {
        $_SESSION['usuario'] = $usuario;
        header('Location: main.php');
        exit;
    } else {
        echo "<br><div style='text-align: center;font-weight: bold; font-size: 16px;'> Usuario o contraseña incorrectos. </div>";        
        echo "<p><href : 'index.php'></p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gimnasio Iron Forge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav><form action="index.php" method="post">
       <input type="submit" value="Volver a la página de inicio">
</form></nav>
</body>
</html>