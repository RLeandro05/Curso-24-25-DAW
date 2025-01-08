<?php

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

//Consulta para obtener toda la información de los campeones de la tabla campeon
$sql = "SELECT * FROM campeon";

//Preparar y ejecutar la consulta insertando el sql anteriormente creado
$consulta = $conexion->prepare($sql);
$consulta->execute();

//Obtener todos los resultados con fetchAll para dar todos los campos al completo
$campeones = $consulta->fetchAll(PDO::FETCH_ASSOC);

//Crear una tabla donde se mostrarán los datos de la consuñta realizada
echo "<table border=\"1\">";
echo "<thead>";
echo "<tr>";
    //Cabecera
    echo "<th>Nombre</th>";
    echo "<th>Rol</th>";
    echo "<th>Dificultad</th>";
    echo "<th>Descripcion</th>";
    echo "<th>Borrar</th>";
    echo "<th>Editar</th>";
echo "</tr>";
echo "</thead>";

    //Cuerpo
    echo "<tbody>";
    foreach ($campeones as $campeon) { //Por cada campeón de la consulta realizada, mostrar cada campo en una nueva celda
        echo "<tr>";
            //Usar htmlspecialchars() para evitar inyección de código
            echo "<td>" . htmlspecialchars($campeon['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($campeon['rol']) . "</td>";
            echo "<td>" . htmlspecialchars($campeon['dificultad']) . "</td>";
            echo "<td>" . htmlspecialchars($campeon['descripcion']) . "</td>";

            //Poner un botón de Borrar el cual, al pinchar en él, llevarse su id y nombre a una función JavaScript en el cual preguntará si está seguro de eliminarlo
            echo "<td><a href=\"#\" onclick=\"borrarCampeon(".htmlspecialchars($campeon['id']).", '".htmlspecialchars($campeon['nombre'])."')\">Borrar</a></td>";

            //Poner un botón de Editar, el cual, al pinchar en él, llevarlo a un formulario donde modificar la info del campeón seleccionado, llevándose su id para no equivocarse
            echo "<td><a href=\"editarCampeon.php?id=" . $campeon['id'] . "\"><button>Editar</button></a></td>";
        echo "</tr>";
    }
    echo "</tbody>";

echo "</table>";
?>

<script>
    //Función para borrar un campeón
    function borrarCampeon(id, nombre) {
        if (confirm("¿Estás seguro de que deseas eliminar a "+nombre+"?")) {
            //En caso afirmativo, llevarlo a la página correspondiente llevándose el id para así eliminar el campeón seleccionado
            window.location.href = "borrarCampeon.php?id="+id;
        }
    }
</script>