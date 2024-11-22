<?php

include 'conexion.php';
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$fabricante = $_POST['fabricante'];

$consulta = "insert into productos values('" . $codigo . "', '" . $nombre . "','" . $precio . "','" . $fabricante . "')";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);

?>