<?php

require_once("utils/listadoCampeones.php");

//Función para conectarse a una base de datos que devuelve un objeto PDO, es decir, una conexión
function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO
{
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

//Obtener parámetros de ordenación
$campo = $_GET['campo'] ?? 'id'; // Por defecto, ordenar por 'id'
$orden = $_GET['orden'] ?? 'ASC'; // Por defecto, orden ascendente

//Consulta SQL ordenada
$sql = "SELECT * FROM campeon ORDER BY $campo $orden";
//Preparar la consulta insertando el sql previamente realizado
$consulta = $conexion->prepare($sql);

//Ejecutar la consulta
$consulta->execute();
$campeones = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar Campeones</title>
    <style>
        #ordenarAsc:hover, #ordenarDesc:hover {
            cursor: pointer;
        }

        #ordenarAsc {
            color: green;
            text-decoration: none;
        }

        #ordenarDesc {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Lista de Campeones</h1>
    <table border="1">
        <thead>
            <tr>
                <th> <!--Por cada flecha, llevar el enlace a ordenar.php con el campo y orden específico-->
                    ID
                    <a href="ordenar.php?campo=id&orden=ASC" id="ordenarAsc">↑</a>
                    <a href="ordenar.php?campo=id&orden=DESC" id="ordenarDesc">↓</a>
                </th>
                <th>
                    Nombre
                    <a href="ordenar.php?campo=nombre&orden=ASC" id="ordenarAsc">↑</a>
                    <a href="ordenar.php?campo=nombre&orden=DESC" id="ordenarDesc">↓</a>
                </th>
                <th>
                    Rol
                    <a href="ordenar.php?campo=rol&orden=ASC" id="ordenarAsc">↑</a>
                    <a href="ordenar.php?campo=rol&orden=DESC" id="ordenarDesc">↓</a>
                </th>
                <th>
                    Dificultad
                    <a href="ordenar.php?campo=dificultad&orden=ASC" id="ordenarAsc">↑</a>
                    <a href="ordenar.php?campo=dificultad&orden=DESC" id="ordenarDesc">↓</a>
                </th>
                <th>
                    Descripción
                    <a href="ordenar.php?campo=descripcion&orden=ASC" id="ordenarAsc">↑</a>
                    <a href="ordenar.php?campo=descripcion&orden=DESC" id="ordenarDesc">↓</a>
                </th>
                <th>Borrar</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($campeones as $campeon): ?>
                <tr> <!--Por cada campeón, mostrar sus datos y por último, los botones de Borrar y Editar-->
                    <td><?= htmlspecialchars($campeon['id']) ?></td>
                    <td><?= htmlspecialchars($campeon['nombre']) ?></td>
                    <td><?= htmlspecialchars($campeon['rol']) ?></td>
                    <td><?= htmlspecialchars($campeon['dificultad']) ?></td>
                    <td><?= htmlspecialchars($campeon['descripcion']) ?></td>
                    <td>
                        <a href="#" onclick="borrarCampeon(<?= htmlspecialchars($campeon['id']) ?>, '<?= htmlspecialchars($campeon['nombre']) ?>')">Borrar</a>
                    </td>
                    <td>
                        <a href="editarCampeon.php?id=<?= htmlspecialchars($campeon['id']) ?>"><button>Editar</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        //Función para borrar un campeón
        const borrarCampeon = (id, nombre) => {
            if (confirm("¿Estás seguro de que deseas eliminar a " + nombre + "?")) {
                window.location.href = "borrarCampeon.php?id=" + id;
            }
        }
    </script>
</body>
</html>
