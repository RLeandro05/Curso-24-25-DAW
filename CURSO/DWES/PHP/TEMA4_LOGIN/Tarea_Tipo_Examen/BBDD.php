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
    //Conexión inicial sin base de datos, ya que no existirá la primera vez
    $conexion = conectarPDO($host, $user, $passwordDB);

    //Ejecutar la consulta de creación de base de datos si no existe la que se quiere crear
    $conexion->exec("CREATE DATABASE IF NOT EXISTS $bbdd");
    echo "Base de datos '$bbdd' creada exitosamente.<br>";

    //Conectarse a la base de datos recién creada
    $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

    //Consulta para crear las tablas
    $sql = "
        CREATE TABLE IF NOT EXISTS sedes (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(50) NOT NULL,
            direccion VARCHAR(255) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS departamentos (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            presupuesto INT(11) NOT NULL,
            sede_id INT(11) NOT NULL,
            FOREIGN KEY (sede_id) REFERENCES sedes(id)
        );

        CREATE TABLE IF NOT EXISTS paises (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            nacionalidad VARCHAR(50) NOT NULL,
            pais VARCHAR(50) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS empleados (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(50) NOT NULL,
            email VARCHAR(120) NOT NULL,
            apellidos VARCHAR(150) NOT NULL,
            salario FLOAT NOT NULL,
            hijos INT(11) NOT NULL,
            departamento_id INT(11) NOT NULL,
            pais_id INT(11) NOT NULL,
            FOREIGN KEY (departamento_id) REFERENCES departamentos(id),
            FOREIGN KEY (pais_id) REFERENCES paises(id)
        );
    ";

    //Ejecutar la consulta SQL previamente preparada
    $conexion->exec($sql);
    echo "Tablas creadas exitosamente.<br>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
