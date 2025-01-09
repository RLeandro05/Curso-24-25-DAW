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
    <title>Listado de Registros</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    
</head>
<body>
    <h1>Ficha</h1>
    <?php
        
        // Realiza la conexion a la base de datos a través de una función 
        $conexion = conectarPDO($host, $user, $password, $bbdd);

        // Realiza la consulta a ejecutar en la base de datos en una variable
        $consulta = "SELECT f.id, nombre, apellidos, email, ciudad, provincia, genero
        FROM ficha f 
        INNER JOIN ciudad c ON 
        c.id = f.id_ciudad
        INNER JOIN genero g ON 
        g.id = f.id_genero";
                
        // Obtenemos el resultado de ejecutar la consulta para poder recorrerlo. 
        $resultado = resultadoConsulta($conexion, $consulta);

    ?>
        <table border="1" cellpadding="10" style="margin-bottom: 10px;">
            <thead>
               
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo electrónico</th>
                <th>Ciudad</th>
                <th>Provincia</th>
                <th>Género</th>
                <th>Acciones</th>
                
            </thead>
            <tbody>
                <!-- Mostrar todos los datos -->
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
                        <td><a href="modificar.php?idficha=<?php echo $registro->id; ?>" class="estilo_enlace">&#9998</a> <a href="borrar.php?idficha=<?php echo $registro->id; ?>" class="confirmacion_borrar">&#128465</a></td>
                    </tr>
                <?php
                    endwhile;
                ?>
            </tbody>
        </table>
        
    </form>
        
    <div class="contenedor">
        <div class="enlaces">
            <a href="../index.php">Volver a página de listados</a>
        </div>
        <div class="enlaces">
            <a href="nuevo.php">Nuevo Registro</a>
        </div>
    </div>
    <?php
        $resultado = null;

        $conexion = null;
    ?>
    <script type="text/javascript">    
        var elementos = document.getElementsByClassName("confirmacion_borrar");
        var confirmFunc = function (e) {
            if (!confirm('Está seguro de que desea borrar este regitro?')) e.preventDefault();
        };
        for (var i = 0, l = elementos.length; i < l; i++) {
            elementos[i].addEventListener('click', confirmFunc, false);
        }
    </script>
</body>
</html>