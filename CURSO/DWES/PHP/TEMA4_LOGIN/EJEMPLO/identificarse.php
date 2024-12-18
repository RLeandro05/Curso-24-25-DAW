<?php
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
try
{
$mysql="mysql:host=$host;dbname=$bbdd;charset=utf8";
$conexion = new PDO($mysql, $user, $password);
// set the PDO error mode to exception
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $exception)
{
exit($exception->getMessage());
}
return $conexion;
}
//-----------------------------------------------------
// Variables
//-----------------------------------------------------
$errores = [];
$email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
$password = isset($_REQUEST["contrasena"]) ? $_REQUEST["contrasena"] : null;
$host = "localhost";
$user = "root";
$passwordDB = "";
$bbdd = "dwes_prueba_m";
// Comprobamos que nos llega los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
//-----------------------------------------------------
// COMPROBAR SI LA CUENTA ESTÁ ACTIVA
//-----------------------------------------------------
// Conecta con base de datos
$conexion = conectarPDO($host, $user, $passwordDB, $bbdd);
// Prepara SELECT para obtener la contraseña almacenada del usuario
$select = "SELECT activo, contrasena FROM usuarios WHERE email = :email;";
$consulta = $conexion->prepare($select);
// Ejecuta consulta
$consulta->execute([
"email" => $email
]);
// Guardo el resultado
$resultado = $consulta->fetch();

// Al hacer comprobación con el tipo convertimos el resultado a entero
if ((int) $resultado["activo"] !== 1)
{
$errores[] = "Tu cuenta aún no está activa. ¿Has comprobado tu bandeja de correo?";
}
else
{

//-----------------------------------------------------
// COMPROBAR LA CONTRASEÑA
//-----------------------------------------------------
// Comprobamos si es válida
if (password_verify($password, $resultado["contrasena"]))
{
// Si son correctos, creamos la sesión
session_name("sesion-privada");
session_start();
$_SESSION["email"] = $email;
// Redireccionamos a la página segura
header("Location: privado.php");
exit();
}
else
{
$errores[] = "El email o la contraseña es incorrecta.";
}
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrada</title>
</head>
<body>
<h1>Entrar</h1>
<!-- Mostramos errores por HTML -->
<?php if (count($errores) > 0): ?>
<ul class="errores">
<?php
foreach ($errores as $error)
{
echo "<li>" . $error . "</li>";
}
?>
</ul>
<?php endif; ?>
<!-- Mensaje de aviso al registrarte -->
<?php if(isset($_REQUEST["registrado"])): ?>
<p>¡Gracias por registrarte! Revisa tu bandeja de correo para activar la cuenta.</p>
<?php endif; ?>
<!-- Mensaje de cuenta activa -->
<?php if(isset($_REQUEST["activada"])): ?>
<p>¡Cuenta activada!</p>
<?php endif; ?>
<!-- Formulario de identificación -->
<form method="post">
<p>
<input type="text" name="email" placeholder="Email">
</p>
<p>
<input type="password" name="contrasena" placeholder="Contraseña">
</p>
<p>
<input type="submit" value="Entrar">
</p>
</form>
</body>
</html>