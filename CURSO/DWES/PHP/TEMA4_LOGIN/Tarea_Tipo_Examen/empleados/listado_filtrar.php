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

    <label for="numHijos">Número de hijos: </label>
    <input type="number" name="numHijos" id="numHijos">

    <label for="salMin">Salario mínimo: </label>
    <input type="number" name="salMin" id="salMin">

    <label for="salMax">Salario máximo: </label>
    <input type="number" name="salMax" id="salMax">

    <label for="texto">Texto: </label>
    <input type="text" name="texto" id="texto">

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
            
        </tbody>
    </table>

    <br>

    <a href="../index.html">Volver a Inicio</a>
</body>
</html>