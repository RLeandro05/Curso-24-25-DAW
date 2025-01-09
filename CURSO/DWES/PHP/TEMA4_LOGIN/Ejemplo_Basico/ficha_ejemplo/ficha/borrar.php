<?php
    require_once("../utiles/variables.php");
    require_once("../utiles/funciones.php");

    if (count($_REQUEST) > 0)
    {

        if (isset($_GET["idficha"]))
        {
            $idficha = $_GET["idficha"];

            $conexion = conectarPDO($host, $user, $password, $bbdd);

            // consulta a ejecutar
            $delete = "DELETE FROM ficha where id = ?";

            // preparar la consulta
            $consulta = $conexion->prepare($delete);
			
			$consulta->bindParam(1, $idficha); 

			// ejecutar la consulta 
			try 
			{
				$consulta->execute();
				$exito = true;
			} 
			catch (PDOException $exception) 
			{
				$exito = false;
			}
			
			$consulta = null;

			$conexion = null;

        	if ($exito) 
        	{
        		echo "<h2>Registro eliminado con éxito.</h2>";
        	} 
        	else 
        	{
        		echo "<h2>No se ha podido eliminar el registro.</h2>";
        	}
        	
	    	header("refresh:3;url=listado.php");
	    	exit();
	    } 
	    
	} 
	else 
	{
		// redireccionamos al listado de ficha si se accede directamente
  		header("Location: listado.php");
  		exit();
	}
?>