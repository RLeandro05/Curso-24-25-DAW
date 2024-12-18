<?php
// Conexión a la base de datos
$mysql =
"mysql:host=localhost;dbname=dwes_prueba_m;charset=UTF8";
$user = "root";
$password = "";


try {
    $conexion = new PDO($mysql, $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Generar el token seguro
$tokenSeguro = bin2hex(openssl_random_pseudo_bytes(16));
$email = "correo@ejemplo.com";
$expiracion = date("Y-m-d H:i:s", strtotime("+1 day"));  // El token expira en 1 hora

// Guardar el token en la base de datos
$stmt = $conexion->prepare("INSERT INTO usuario_recuperacion (email, token, expiracion) VALUES (:email, :token, :expiracion)");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':token', $tokenSeguro);
echo "<br>$tokenSeguro</br>";
$stmt->bindParam(':expiracion', $expiracion);

if ($stmt->execute()) {
    // Enviar el correo
    $mensaje = "
    <html>
    <head><title>Recupera tu contraseña</title></head>
    <body>
    <a href=\"http://localhost/Curso-24-25-DAW/CURSO/DWES/PHP/TEMA4_LOGIN/EJEMPLO/verifyToken.php?token=$tokenSeguro\">Pulsa aquí para cambiar tu contraseña</a>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: dwes@php.com\r\n";

    if (mail($email, 'Recuperar contraseña', $mensaje, $headers)) {
        echo "Correo enviado correctamente.";
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    echo "Error al guardar el token en la base de datos.";
}
?>