<?php
    require_once("../utiles/config.php");
    require_once("../utiles/funciones.php");

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

    try {
        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de tenistas</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <h1>Listado de tenistas con número de torneos ganados</h1>

      <!--  

        ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO 
        Recuerda:
        - Realiza la conexion a la base de datos a través de una función.
        - Realiza la consulta a ejecutar en la base de datos en una variable
        - Obten el resultado de ejecutar la consulta para poder recorrerlo.
      -->
    

    <table border="1" cellpadding="10">
        <thead>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Altura (cm)</th>
            <th>Año de nacimiento</th>
            <th>Mano</th>
            <th>Número de torneos ganados</th>
        </thead>
        <tbody>
        
        <!--  

            ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO 

        -->

        </tbody>
    </table>

    <!--  

        ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO 

    -->
    
</body>
</html>