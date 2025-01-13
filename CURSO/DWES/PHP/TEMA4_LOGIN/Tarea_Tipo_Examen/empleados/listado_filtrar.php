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

    $resultados = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buscar"])) {
        //Variables para los filtros
        $numHijos = $_POST["numHijos"] ?? null;
        $salMin = $_POST["salMin"] ?? null;
        $salMax = $_POST["salMax"] ?? null;
        $texto = $_POST["texto"] ?? null;

        //Realizar la consulta sql uniendo las tablas necesarias y aplicar alias para no dar errores en el código
        $sql = "SELECT 
                    empleados.nombre AS nombre,
                    empleados.apellidos AS apellidos,
                    empleados.email AS correo,
                    empleados.salario AS salario,
                    empleados.hijos AS num_hijos,
                    departamentos.nombre AS departamento,
                    sedes.nombre AS sede
                FROM empleados
                JOIN departamentos ON empleados.departamento_id = departamentos.id
                JOIN sedes ON departamentos.sede_id = sedes.id";

        $where = [];
        $parametros = [];

        //Añadir filtros dinámicamente
        if (!empty($numHijos)) {
            $where[] = "empleados.hijos = :numHijos";
            $parametros[':numHijos'] = $numHijos;
        }

        if (!empty($salMin)) {
            $where[] = "empleados.salario >= :salMin";
            $parametros[':salMin'] = $salMin;
        }

        if (!empty($salMax)) {
            $where[] = "empleados.salario <= :salMax";
            $parametros[':salMax'] = $salMax;
        }

        if (!empty($texto)) {
            $where[] = "(empleados.nombre LIKE :texto OR empleados.apellidos LIKE :texto OR empleados.email LIKE :texto)";
            $parametros[':texto'] = '%' . $texto . '%';
        }

        //Construir la consulta con filtros
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        $consulta = $conexion->prepare($sql);
        $consulta->execute($parametros);

        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
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
        <title>Listado de Empleados</title>
    </head>
    <body>
        <h1>Listado de Empleados</h1>

        <h3>Filtrado</h3>

        <!-- Filtrados -->
        <form action="listado_filtrar.php" method="post">

            <label for="numHijos">Número de hijos: </label>
            <input type="number" name="numHijos" id="numHijos" value="<?= isset($_POST['buscar']) ? '' : htmlspecialchars($_POST['numHijos'] ?? '') ?>">

            <br>

            <label for="salMin">Salario mínimo: </label>
            <input type="number" name="salMin" id="salMin" value="<?= isset($_POST['buscar']) ? '' : htmlspecialchars($_POST['salMin'] ?? '') ?>">

            <label for="salMax">Salario máximo: </label>
            <input type="number" name="salMax" id="salMax" value="<?= isset($_POST['buscar']) ? '' : htmlspecialchars($_POST['salMax'] ?? '') ?>">

            <br>

            <label for="texto">Texto: </label>
            <input type="text" name="texto" id="texto" value="<?= isset($_POST['buscar']) ? '' : htmlspecialchars($_POST['texto'] ?? '') ?>">

            <br><br>

            <input type="submit" name="buscar" value="Buscar">
            <input type="reset" value="Borrar">
        </form>


        <br>

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
                <?php if (!empty($resultados)): ?>
                    <?php foreach ($resultados as $empleado): ?>
                        <tr>
                            <td><?= htmlspecialchars($empleado['nombre']) ?></td>
                            <td><?= htmlspecialchars($empleado['apellidos']) ?></td>
                            <td><?= htmlspecialchars($empleado['correo']) ?></td>
                            <td><?= htmlspecialchars($empleado['salario']) ?></td>
                            <td><?= htmlspecialchars($empleado['num_hijos']) ?></td>
                            <td><?= htmlspecialchars($empleado['departamento']) ?></td>
                            <td><?= htmlspecialchars($empleado['sede']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay registros con los criterios de búsqueda introducidos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <br>

        <a href="../index.html">Volver a Inicio</a>
    </body>
</html>         