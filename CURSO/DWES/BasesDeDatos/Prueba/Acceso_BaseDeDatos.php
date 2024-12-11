<?php
    try {
        $mysql = "mysql:host=localhost;dbname=dwes_prueba_m;charset=UTF8";
        $user = "root";
        $password = "";
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $conexion = new PDO($mysql, $user, $password, $opciones); 

        $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);

        echo "<p>Conectado a la BBDD</p>";
        echo "<p>Versión: ".$version."</p>";
    } catch(PDOException $e) {
        echo "<p>".$e->getMessage()."</p>";
    } finally {
        $conexion = null;
    }
    
?>