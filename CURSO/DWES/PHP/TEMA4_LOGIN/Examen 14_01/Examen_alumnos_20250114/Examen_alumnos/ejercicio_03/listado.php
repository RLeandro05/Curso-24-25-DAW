<?php
    require_once("../utiles/config.php");
    require_once("../utiles/funciones.php");

    function PDO(string $host, string $user, string $password, string $bbdd = null): PDO
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
        $conexion = PDO($host, $user, $passwordDB, $bbdd);

        $sql = "SELECT torneos.id as idTorneo, torneos.nombre as nombre, torneos.ciudad as ciudad, superficies.nombre as superficie FROM torneos JOIN superficies ON torneos.superficie_id = superficies.id;";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $torneos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        /*echo "<pre>";
        print_r($torneos);
        echo "</pre>";*/
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
    <title>Listado de torneos</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
    <h1>Listado de torneos</h1>

        <!--  
        ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO 
        Recuerda:
        - Conéctate a la base de datos
        - Prepara la consulta a ejecutar para mostrar los torneos
        -->

    <table border="1" cellpadding="10">
        <thead>
            <th>Nombre</th>
            <th>Cuidad</th>
            <th>Superficie</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php foreach ($torneos as $torneo) :?>
                <tr>
                    <td><?=$torneo["nombre"]?></td>
                    <td><?=$torneo["ciudad"]?></td>
                    <td><?=$torneo["superficie"]?></td>
                    <td><a href="modificar.php?idTorneo=<?=$torneo["idTorneo"]?>" class="estilo_enlace">&#9998</a></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

            <!--  
                ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO PARA MOSTRAR LOS DATOS
            -->
</body>
</html>