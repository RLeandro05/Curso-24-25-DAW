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

    $departamentos = null;

    try {
        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        $sql = "SELECT 
                    departamentos.nombre as departamento_nombre, 
                    departamentos.presupuesto as departamento_presupuesto, 
                    sedes.nombre as sede_nombre
                FROM 
                    departamentos
                JOIN 
                    sedes ON departamentos.sede_id = sedes.id;";

        $consulta = $conexion->prepare($sql);

        //Vinculamos las variables a las columnas
        $departamento_nombre = '';
        $departamento_presupuesto = '';
        $sede_nombre = '';

        $consulta->bindColumn('departamento_nombre', $departamento_nombre);
        $consulta->bindColumn('departamento_presupuesto', $departamento_presupuesto);
        $consulta->bindColumn('sede_nombre', $sede_nombre);

        //Ejecutamos la consulta
        $consulta->execute();

        //Creamos un array para almacenar los resultados
        $departamentos = [];

        //Obtenemos los resultados uno por uno
        while ($consulta->fetch(PDO::FETCH_BOUND)) {
            //Añadimos los resultados al array
            $departamentos[] = [
                'departamento_nombre' => $departamento_nombre,
                'departamento_presupuesto' => $departamento_presupuesto,
                'sede_nombre' => $sede_nombre
            ];
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    /*
    echo "<pre>";
    print_r($departamentos);
    echo "</pre>";
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Departamentos</title>
</head>
<body>
    <h1>Listado de Departamentos</h1>

    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Presupuesto</th>
            <th>Nombre Sede</th>
        </thead>
        <tbody>
            <!-- Mostrar el listado del array de departamentos -->
            <?php foreach ($departamentos as $departamento) :?>
                <tr>
                    <td><?= htmlspecialchars($departamento["departamento_nombre"]); ?></td>
                    <td><?= htmlspecialchars($departamento["departamento_presupuesto"]); ?></td>
                    <td><?= htmlspecialchars($departamento["sede_nombre"]); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
