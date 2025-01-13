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
            $presupuesto = $_POST["presupuesto"];
            $sede_id = $_POST["sede"];

            $sql = "UPDATE departamentos SET nombre = '$nombre', presupuesto = $presupuesto, sede_id = $sede_id
            WHERE id = $id";

            $consulta = $conexion->prepare($sql);

            $consulta->execute();

            header("Location: listado.php");
        }
    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }

    try {
        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        $id = $_GET["id"];

        $sql = "SELECT departamentos.nombre as departamento_nombre, 
                    departamentos.presupuesto as departamento_presupuesto,
                    sedes.nombre as sede_nombre
                FROM departamentos
                JOIN sedes ON departamentos.sede_id = sedes.id
                WHERE departamentos.id = $id;";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $departamento = $consulta->fetchObject();

        //-----------------------------------------------------

        $sql = "SELECT nombre, id FROM sedes";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $sedes = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //-----------------------------------------------------

        $sql = "SELECT sedes.id as id_sede FROM sedes
                JOIN departamentos ON sedes.id = departamentos.sede_id
                WHERE departamentos.id = $id";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $id_sede = $consulta->fetchColumn();
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Departamento</title>
</head>
<body>
    <h1>Modificar el departamento</h1>

    <form action="modificar.php?id=<?=$id?>" method="post">

        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?=$departamento->departamento_nombre?>" minlength="3" maxlength="100">

        <br>

        <label for="presupuesto">Presupuesto: </label>
        <input type="number" name="presupuesto" id="presupuesto" value="<?=$departamento->departamento_presupuesto?>" min="0">

        <br>

        Sede:
        <select name="sede" id="sede">
            <?php foreach ($sedes as $sede) :?>
                <?php if ($sede["id"] == $id_sede) :?>
                    <option value="<?=$sede["id"]?>" selected><?=$sede["nombre"]?></option>
                <?php else :?>
                    <option value="<?=$sede["id"]?>"><?=$sede["nombre"]?></option>
                <?php endif;?>
            <?php endforeach;?>
        </select>

        <br> <br>

        <input type="submit" name="guardar" value="Guardar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>