<?php
    //echo "Estás en listado de sedes";

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

    $sedes = null;

    try {
        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        //echo "Conectado a la BBDD";

        $sql = "SELECT * FROM sedes";

        $consulta = $conexion->prepare($sql);
        $consulta->execute();

        $sedes = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Sedes</title>
</head>
<body>
    <h1>Listado de Sedes</h1>

    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Dirección</th>
        </thead>
        <tbody>
            <!--Mostrar el listado del array de sedes-->
            <?php foreach ($sedes as $sede) :?>
                <tr>
                    <td><?= htmlspecialchars($sede["nombre"]); ?></td>
                    <td><?= htmlspecialchars($sede["direccion"]); ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <br>

    <a href="../index.html">Volver a Inicio</a>
    <a href="nuevo.php">A&ntilde;adir</a>
</body>
</html>