<?php 

require_once("utils/listadoCampeones.php");

//Función para conectarse a una base de datos que devuelve un objeto PDO, es decir, una conexión
function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO {
    try {
        //sql en el cual tendremos el host, el nombre de la base de datos y el charset
        $mysql = "mysql:host=$host;dbname=$bbdd;charset=utf8";
        //Crear una nueva conexión PDO insertando el sql, el usuario y la contraseña pasadas
        $conexion = new PDO($mysql, $user, $password);
        //Establecer el modo de error de PDO a excepciones
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        //En caso de error por alguna excepción, dejar de ejecutar y mostrar el error
        exit($exception->getMessage());
    }

    //Devolver la conexión
    return $conexion;
}

//Variables
$host = "localhost";
$user = "root";
$passwordDB = "";
$bbdd = "lol_manana";

//Guardar en una variable la conexión devuelta de la función
$conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

//Preparar la consulta para insertar campeones
$sql = "INSERT INTO campeon (nombre, rol, dificultad, descripcion) 
        VALUES (:nombre, :rol, :dificultad, :descripcion)";

//Preparar la consulta insertandon en prepare el sql
$consulta = $conexion->prepare($sql);

//Recorrer los campeones y ejecutar la inserción por cada campeón del array
foreach ($campeones as $campeon) {
    $consulta->execute([
        ":nombre" => $campeon["nombre"],
        ":rol" => $campeon["rol"],
        ":dificultad" => $campeon["dificultad"],
        ":descripcion" => $campeon["descripcion"]
    ]);
}

//Mostrar resultado satisfactorio
echo "Datos insertados correctamente.";
?>
