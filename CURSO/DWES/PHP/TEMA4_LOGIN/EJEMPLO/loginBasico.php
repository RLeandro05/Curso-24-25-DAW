<?php
// Comprobamos que nos llegan los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Base de datos ficticia que se usará en el ejemplo.
    $baseDeDatos = ['email' => 'correo@ejemplo.com', 'password' => password_hash('123', PASSWORD_BCRYPT)];

    // Variables del formulario
    $emailFormulario = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $contrasenaFormulario = isset($_REQUEST['contrasena']) ? $_REQUEST['contrasena'] : null;

    // Comprobamos si los datos son correctos
    if ($baseDeDatos['email'] == $emailFormulario && password_verify($contrasenaFormulario, $baseDeDatos['password'])) {
        // Si son correctos, creamos la sesión 'sesion-privada'
        session_name("sesion-privada");
        session_start();
        $_SESSION['email'] = $_REQUEST['email'];

        // Redireccionamos a la página privada
        header('Location: privado.php');
        exit();  // Aseguramos que no se ejecute más código después de redirigir
    } else {
        // Si no son correctos, informamos al usuario
        print '<p style="color: red">El email o la contraseña es incorrecta.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form method="post">
        <!-- Si falta el atributo action, el formulario se enviará a la misma página-->
        <p> <input type="text" name="email" placeholder="correo@del.usuario" required> </p>
        <p> <input type="password" name="contrasena" placeholder="Contraseña" required> </p>
        <p> <input type="submit" value="Entrar"> </p>
    </form>
    <a href="recuperarContraseña.php">Pulsa aquí para cambiarla</a>
</body>

</html>