<?php
//Función para conectarse a la base de datos
function conectarPDO(string $host, string $user, string $password, string $bbdd = null): PDO
{
    try {
        $mysql = $bbdd ? "mysql:host=$host;dbname=$bbdd;charset=utf8" : "mysql:host=$host;charset=utf8";
        $conexion = new PDO($mysql, $user, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }

    return $conexion;
}

//Variables de conexión
$host = "localhost";
$user = "root";
$passwordDB = "";
$bbdd = "dwes_manana_empresa";

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {

        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];

        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        $sql = "INSERT INTO sedes (nombre, direccion) values ('$nombre', '$direccion')";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        header("Location: listado.php");
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Sede</title>
</head>
<body>
    <h1>A&ntilde;adir una nueva sede</h1>

    <form action="nuevo.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" minlength="3" maxlength="50">

        <br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" minlength="10" maxlength="255">

        <br>

        <input type="submit" name="guardar" value="Guardar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>