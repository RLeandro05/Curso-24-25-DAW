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
            $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

            $id = $_GET["id"];

            $nombre = $_POST["nombre"];
            $direccion = $_POST["direccion"];

            $sql = "UPDATE sedes SET nombre = '$nombre', direccion = '$direccion' WHERE id = $id;";

            $consulta = $conexion->prepare($sql);

            $consulta->execute();

            header("Location: listado.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    try {
        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        $id = $_GET["id"];

        $sql = "SELECT nombre, direccion FROM sedes WHERE id=$id;";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $sede = $consulta->fetchObject();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Sede</title>
</head>
<body>
    <h1>Modificar la sede</h1>

    <form action="modificar.php?id=<?=$id?>" method="post">

        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?=$sede->nombre?>" minlength="3" maxlength="50">

        <br>

        <label for="nombre">Dirección: </label>
        <input type="text" name="direccion" id="direccion" value="<?=$sede->direccion?>" minlength="10" maxlength="250">

        <br>

        <input type="submit" name="guardar" value="Guardar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>