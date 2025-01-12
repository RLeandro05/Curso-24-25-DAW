<?php
    require_once("utils/Datos.php");

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

    //Realizar conexión a la base de datos
    try {
        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        //echo "Conectado a la bbdd";

        //INSERCIÓN TABLA SEDES
        $sql = "INSERT INTO sedes (nombre, direccion) 
        VALUES (:nombre, :direccion)";

        $consulta = $conexion->prepare($sql);

        foreach ($sedes as $sede) {
            $consulta->execute([
                ":nombre" => $sede["nombre"],
                ":direccion" => $sede["direccion"],
            ]);
        }

        echo "Sedes insertadas correctamente <br>";

        //INSERCIÓN TABLA DEPARTAMENTOS
        $sql = "INSERT INTO departamentos (nombre, presupuesto, sede_id) 
        VALUES (:nombre, :presupuesto, :sede_id)";

        $consulta = $conexion->prepare($sql);

        foreach ($departamentos as $departamento) {
            $consulta->execute([
                ":nombre" => $departamento["nombre"],
                ":presupuesto" => $departamento["presupuesto"],
                ":sede_id" => $departamento["sede_id"]
            ]);
        }

        echo "Departamentos insertados correctamente <br>";

        //INSERCIÓN TABLA PAÍSES
        $sql = "INSERT INTO paises (nacionalidad, pais)
        VALUES (:nacionalidad, :pais)";

        $consulta = $conexion->prepare($sql);

        foreach ($paises as $pais) {
            $consulta->execute([
                ":nacionalidad" => $pais["nacionalidad"],
                ":pais" => $pais["pais"]
            ]);
        }

        echo "Países insertados correctamente <br>";

        //INSERCIÓN TABLA EMPLEADOS
        $sql = "INSERT INTO empleados (nombre, email, apellidos, salario, hijos, departamento_id, pais_id) 
        VALUES (:nombre, :email, :apellidos, :salario, :hijos, :departamento_id, :pais_id)";

        $consulta = $conexion->prepare($sql);

        foreach ($empleados as $empleado) {
            $consulta->execute([
                ":nombre" => $empleado["nombre"],
                ":email" => $empleado["email"],
                ":apellidos" => $empleado["apellidos"],
                ":salario" => $empleado["salario"],
                ":hijos" => $empleado["hijos"],
                ":departamento_id" => $empleado["departamento_id"],
                ":pais_id" => $empleado["pais_id"],
            ]);
        }

        echo "Empleados insertados correctamente <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>