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
        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        $sql = "SELECT empleados.nombre as empleado_nombre,
                    empleados.email as empleado_email,
                    empleados.apellidos as empleado_apellidos,
                    empleados.salario as empleado_salario,
                    empleados.hijos as empleado_hijos,
                    departamentos.nombre as departamento_nombre,
                    sedes.nombre as sede_nombre
                FROM empleados
                JOIN departamentos ON empleados.departamento_id = departamentos.id
                JOIN sedes ON departamentos.sede_id = sedes.id;
        ";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
</head>
<body>
    <h1>Listado de Empleados</h1>

    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo Electrónico</th>
            <th>Salario</th>
            <th>Número de Hijos</th>
            <th>Departamento</th>
            <th>Sede</th>
        </thead>
        <tbody>
            <!-- Mostrar el listado de la lista de objetos de empleados -->
            <?php while ($empleado = $consulta->fetch(PDO::FETCH_OBJ)) :?>
                <tr>
                    <td><?= htmlspecialchars($empleado->empleado_nombre); ?></td>
                    <td><?= htmlspecialchars($empleado->empleado_apellidos); ?></td>
                    <td><?= htmlspecialchars($empleado->empleado_email); ?></td>
                    <td><?= htmlspecialchars($empleado->empleado_salario); ?></td>
                    <td><?= htmlspecialchars($empleado->empleado_hijos); ?></td>
                    <td><?= htmlspecialchars($empleado->departamento_nombre); ?></td>
                    <td><?= htmlspecialchars($empleado->sede_nombre); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>