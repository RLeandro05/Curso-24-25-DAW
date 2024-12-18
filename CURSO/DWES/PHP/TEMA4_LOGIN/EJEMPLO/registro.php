<?php
//-----------------------------------------------------
// Funciones Para Validar
//-----------------------------------------------------
/**
 * Método que valida si un texto no está vacío
 * @param {string} - Texto a validar
 * @return {boolean}
 */
function validarRequerido(string $texto): bool
{
    return !(trim($texto) == "");
}
/**
 * Método que valida si el texto tiene un formato válido de email
 * @param {string} - Email
 * @return {bool}
 */
function validarEmail(string $texto): bool
{
    return (filter_var($texto, FILTER_VALIDATE_EMAIL) === FALSE) ? False : True;
}
/**
 * Método que establece la conexión con la base de datos
 * @param {string} - Host
 * @param {string} - Usuario
 * @param {string} - Contraseña
 * @param {string} - Esquema de la base de datos
 * @return {PDO}
 */
function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO
{
    try {
        $mysql = "mysql:host=$host;dbname=$bbdd;charset=utf8";
        $conexion = new PDO($mysql, $user, $password);
        // set the PDO error mode to exception
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
    return $conexion;
}
//-----------------------------------------------------
// Variables
//-----------------------------------------------------
$errores = [];
$email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
$password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : "";
$host = "localhost";
$user = "root";
$passwordDB = "";
$bbdd = "dwes_prueba_m";
// Comprobamos si nos llega los datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //-----------------------------------------------------
    // Validaciones
    //-----------------------------------------------------
    // Email
    if (!validarRequerido($email)) {
        $errores[] = "Campo Email obligatorio.";
    }
    if (!validarEmail($email)) {
        $errores[] = "Campo Email no tiene un formato válido";
    }
    // Contraseña
    if (!validarRequerido($password)) {
        $errores[] = "Campo Contraseña obligatorio.";
    }
    /* Verificar que no existe en la base de datos el mismo email */
    // Conecta con base de datos
    $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);
    // Cuenta cuantos emails existen
    $select = "SELECT COUNT(*) as numero FROM usuarios WHERE email = :email";
    $consulta = $conexion->prepare($select);
    // Ejecuta la búsqueda
    $consulta->execute([
        "email" => $email
    ]);
    // Recoge los resultados
    $resultado = $consulta->fetch();
    $consulta = null;
    // Comprueba si existe
    if ($resultado["numero"] > 0) {
        $errores[] = "La dirección de email ya esta registrada.";
    }

    //-----------------------------------------------------
    // Crear cuenta
    //-----------------------------------------------------
    if (count($errores) === 0) {
        /* Registro En La Base De Datos */
        // Prepara INSERT
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $insert = "INSERT INTO usuarios (email, contrasena, activo, token) VALUES
(:email, :contrasena, :activo, :token)";
        $consulta = $conexion->prepare($insert);
        // Ejecuta el nuevo registro en la base de datos
        $consulta->execute([
            "email" => $email,
            "contrasena" => password_hash($password, PASSWORD_BCRYPT),
            "activo" => 0,
            "token" => $token
        ]);
        $consulta = null;
        /* Envío De Email Con Token */
        // Cabecera
        $headers = [
            "From" => "dwes@php.com",
            "Content-type" => "text/plain; charset=utf-8"
        ];
        // Variables para el email
        $emailEncode = urlencode($email);
        $tokenEncode = urlencode($token);
        // Texto del email
        $textoEmail = "
Hola!\n
Gracias por registrate en la mejor plataforma de internet, demuestras inteligencia.\
n
Para activar entra en el siguiente enlace:\n
http://localhost/Curso-24-25-DAW/CURSO/DWES/PHP/TEMA4_LOGIN/EJEMPLO/verificar-cuenta.php?email=$emailEncode&token=$tokenEncode
";
        // Envio del email
        mail($email, 'Activa tu cuenta', $textoEmail, $headers);
        /* Redirección a login.php con GET para informar del envío del email */
        header('Location: identificarse.php?registrado=1');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    10
    Desarrollo Web Entorno Servidor
    —-------------------------------------------------------------------------------------------------------------------------------
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <h1>Registro</h1>
    <!-- Mostramos errores por HTML -->
    <?php if (isset($errores)): ?>
        <ul class="errores">
            <?php
            foreach ($errores as $error) {
                echo '<li>' . $error . '</li>';
            }
            ?>
        </ul>
    <?php endif; ?>
    <!-- Formulario -->
    <form action="" method="post">
        <p>
            <!-- Campo de Email -->
            <label>
                Correo electrónio
                <input type="text" name="email">
            </label>
        </p>
        <p>
            <!-- Campo de Contraseña -->
            <label>
                Contraseña
                <input type="password" name="password">
            </label>
        </p>
        <p>
            <!-- Botón submit -->
            <input type="submit" value="Registrarse">
        </p>
    </form>
</body>

</html>