<?php

$hostname= 'localhost';
$database= 'listadoproductos';
$username= 'root';
$password= '';

$conexion= new mysqli($hostname, $username, $password, $database);
if ($conexion->connect_errno) {
	echo "lo sentimos, error al conectar";
} else {
    echo "Conectado al servidor";
}

?>