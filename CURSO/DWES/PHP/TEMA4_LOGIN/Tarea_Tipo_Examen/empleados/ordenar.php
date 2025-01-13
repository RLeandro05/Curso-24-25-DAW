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

        //Obtener parámetros de ordenación
        $campo = $_GET['campo'] ?? 'id'; // Por defecto, ordenar por 'id'
        $orden = $_GET['orden'] ?? 'ASC'; // Por defecto, orden ascendente

        //Realizar la consulta sql uniendo las tablas necesarias y aplicar alias para no dar errores en el código
        $sql = "SELECT empleados.nombre as empleado_nombre,
                    empleados.email as empleado_email,
                    empleados.apellidos as empleado_apellidos,
                    empleados.salario as empleado_salario,
                    empleados.hijos as empleado_hijos,
                    departamentos.nombre as departamento_nombre,
                    sedes.nombre as sede_nombre
                FROM empleados
                JOIN departamentos ON empleados.departamento_id = departamentos.id
                JOIN sedes ON departamentos.sede_id = sedes.id
                ORDER BY $campo $orden;
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
        <!-- Añadir en cada flecha el lugar destino y las variables campo y orden para poder ordenar en función de qué campo y orden sea -->
        <th>Nombre <a href="ordenar.php?campo=empleado_nombre&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=empleado_nombre&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Apellidos <a href="ordenar.php?campo=empleado_apellidos&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=empleado_apellidos&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Correo Electrónico <a href="ordenar.php?campo=empleado_email&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=empleado_email&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Salario <a href="ordenar.php?campo=empleado_salario&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=empleado_salario&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Número de Hijos <a href="ordenar.php?campo=empleado_hijos&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=empleado_hijos&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Departamento <a href="ordenar.php?campo=departamento_nombre&orden=ASC" id="ASC">&#8593;</> <a href="ordenar.php?campo=departamento_nombre&orden=DESC" id="DESC">&#8595;</a> </th>
            <th>Sede <a href="ordenar.php?campo=sede_nombre&orden=ASC" id="ASC">&#8593;</a> <a href="ordenar.php?campo=sede_nombre&orden=DESC" id="DESC">&#8595;</a> </th>
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