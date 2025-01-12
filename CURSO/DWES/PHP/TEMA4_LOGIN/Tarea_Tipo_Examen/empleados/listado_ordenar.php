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

    <style>
        #ASC {
            color: red;
        }

        #DESC {
            color: green;
        }
    </style>
</head>
<body>
    <h1>Listado de Empleados</h1>

    <table border="1">
        <thead>
            <th>Nombre <a href="ordenar.php?campo=nombre&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=nombre&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Apellidos <a href="ordenar.php?campo=apellidos&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=apellidos&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Correo Electrónico <a href="ordenar.php?campo=email&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=email&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Salario <a href="ordenar.php?campo=salario&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=salario&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Número de Hijos <a href="ordenar.php?campo=hijos&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=hijos&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Departamento <a href="ordenar.php?campo=departamento&orden=ASC" id="ASC">&#8593;</> <a href="ordenar.php?campo=departamento&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Sede <a href="ordenar.php?campo=sede&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=sede&orden=DESC" id="DESC">&#8595;</a> </th>
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

    <br>

    <a href="../index.html">Volver a Inicio</a>
</body>
</html>