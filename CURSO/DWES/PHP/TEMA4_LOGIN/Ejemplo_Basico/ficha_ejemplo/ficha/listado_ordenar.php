<?php
    require_once("../utiles/variables.php");
    require_once("../utiles/funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Fichas</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <script type="text/javascript">
        function ordenarListado(campo, orden)
        {
            location.href = "listado_ordenar.php?orden="+campo+"&sentido="+orden;
        }
    </script>
</head>
<body>
    <h1>Listado con Ordenación</h1>
    <?php
        // Campos que permiten ordenación
        $camposOrdenacion = ["nombre", "apellidos", "email", "ciudad", "provincia", "genero"];

        // Obtener campo de la ordenación
        if (isset($_GET["orden"])) 
        {
            $campoOrdenar = $_GET["orden"];
            if (!in_array($campoOrdenar,$camposOrdenacion)) 
            {
                $campoOrdenar = $camposOrdenacion[0];
            }
        } 
        else 
        {
            $campoOrdenar = $camposOrdenacion[0];
        }

        $sentidosOrdenacion = ["ASC", "DESC"];
        if (isset($_GET["sentido"])) 
        {
            $sentidoOrdenar = $_GET["sentido"];
            if (!in_array($sentidoOrdenar,$sentidosOrdenacion)) 
            {
                $sentidoOrdenar = $sentidosOrdenacion[0];
            }
        } 
        else 
        {
            $sentidoOrdenar = $sentidosOrdenacion[0];
        }
        
        // Realiza la conexion a la base de datos a través de una función 
        $conexion = conectarPDO($host, $user, $password, $bbdd);

        // Realiza la consulta a ejecutar en la base de datos en una variable
        $consulta = "SELECT f.id, nombre, apellidos, email, ciudad, provincia, genero
        FROM ficha f 
        INNER JOIN ciudad c ON 
        c.id = f.id_ciudad
        INNER JOIN genero g ON 
        g.id = f.id_genero
        ORDER BY $campoOrdenar $sentidoOrdenar"; 

        // Obtenemos el resultado de ejecutar la consulta para poder recorrerlo.
        $resultado = resultadoConsulta($conexion, $consulta);
 
    ?>

        <table border="1" cellpadding="10">
            <thead>
                <th>Nombre <a href="javascript: void(0);" onclick="ordenarListado('nombre', 'ASC')">&#8593</a> <a href="javascript: void(0);" onclick="ordenarListado('nombre', 'DESC')">&#8595</a></th>
                <th>Apellidos <a href="javascript: void(0);" onclick="ordenarListado('apellidos', 'ASC')">&#8593</a> <a href="javascript: void(0);" onclick="ordenarListado('apellidos', 'DESC')">&#8595</a></th>
                <th>Correo electrónico <a href="javascript: void(0);" onclick="ordenarListado('email', 'ASC')">&#8593</a> <a href="javascript: void(0);" onclick="ordenarListado('email', 'DESC')">&#8595</a></th>
                <th>Ciudad <a href="javascript: void(0);" onclick="ordenarListado('ciudad', 'ASC')">&#8593</a> <a href="javascript: void(0);" onclick="ordenarListado('ciudad', 'DESC')">&#8595</a></th>
                <th>Provincia <a href="javascript: void(0);" onclick="ordenarListado('provincia', 'ASC')">&#8593</a> <a href="javascript: void(0);" onclick="ordenarListado('provincia', 'DESC')">&#8595</a></th>
                <th>Género <a href="javascript: void(0);" onclick="ordenarListado('genero', 'ASC')">&#8593</a> <a href="javascript: void(0);" onclick="ordenarListado('genero', 'DESC')">&#8595</a></th>
               </thead>
            <tbody>
                <?php
                   
                    // para mostrar todos los datos
                    while ($registro = $resultado->fetch(PDO::FETCH_OBJ)):
                ?>
                    <tr>
                        <td><?php echo $registro->nombre; ?></td>
                        <td><?php echo $registro->apellidos; ?></td>
                        <td><?php echo $registro->email; ?></td>
                        <td><?php echo $registro->ciudad; ?></td>
                        <td><?php echo $registro->provincia; ?></td>
                        <td><?php echo $registro->genero; ?></td>
                    </tr>
                    </tr>
                <?php
                    endwhile;
                ?>
            </tbody>
        </table>
        <div class="contenedor">
            <div class="enlaces">
                <a href="../index.php">Volver a página de listados</a>
            </div>
            <div class="enlaces">
                <a href="nuevo.php">Nuevo registro</a>
            </div>
        </div>

    
    <?php
        $consulta = null;

        $conexion = null;
    ?>
</body>
</html>