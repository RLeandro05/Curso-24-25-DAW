<?php
    try {
        $mysql = "mysql:host=localhost;dbname=dwes_prueba_m;charset=UTF8";
        $user = "root";
        $password = "";
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        //Realizar conexión
        $conexion = new PDO($mysql, $user, $password, $opciones); 

        echo "<p>Conectado a la BBDD</p>";

        //Mostrar drivers disponibles
        print_r(PDO::getAvailableDrivers());

        //Crear tabla con los campos de la tabla proporcionada
        echo "<table border='1'>";
        echo
        "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
        </tr>";

        //Realizar consulta para mostrar todos los datos de la tabla "productos"
        $resultado = $conexion->query("select * FROM productos");

        //Mientras el registro guarde el siguiente elemento de la tabla, mostrarlo en una nueva celda
        while ($registro = $resultado->fetch(PDO::FETCH_OBJ)) {
            /*echo "<p>Id: ".$registro->id."</p>";
            echo "<p>Nombre: ".$registro->nombre."</p>";
            echo "<p>Descripción: ".$registro->descripcion."</p>";
            echo "<p>Precio: ".$registro->precio."</p>";
            echo "<p>Stock: ".$registro->stock."</p>";
            echo "<p>Categoria: ".$registro->categoria."</p>";*/

            //Crear nueva fila con los valores de los campos en la tabla
            echo "<tr>
                <td>".$registro->id."</td>
                <td>".$registro->nombre."</td>
                <td>".$registro->descripcion."</td>
                <td>".$registro->precio."</td>
                <td>".$registro->stock."</td>
                <td>".$registro->categoria."</td>
            </tr>";
        }
    } catch(PDOException $e) {
        echo "<p>".$e->getMessage()."</p>";
    } finally {
        $conexion = null;
    }
    
?>