<?php

include 'conexion.php';
$codigo=$_POST['codigo'];

$consulta="delete from producto where codigo = '".$codigo."'";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);

?>