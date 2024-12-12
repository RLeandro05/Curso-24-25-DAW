<?php
    try {
        $mysql = "mysql:host=localhost;dbname=dwes_prueba_m;charset=UTF8";
        $user = "root";
        $password = "";
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $conexion = new PDO($mysql, $user, $password, $opciones); 

        echo "<p>Conectado a la BBDD</p>";

        $resultado = $conexion->query("select * FROM mensajes");
        while ($registro = $resultado->fetch(PDO::FETCH_OBJ)) {
            echo "<p>Id: ".$registro->id."</p>";
            echo "<p>Nombre: ".$registro->nombre."</p>";
            echo "<p>Email: ".$registro->email."</p>";
        }
    } catch(PDOException $e) {
        echo "<p>".$e->getMessage()."</p>";
        exit();
    }
?>