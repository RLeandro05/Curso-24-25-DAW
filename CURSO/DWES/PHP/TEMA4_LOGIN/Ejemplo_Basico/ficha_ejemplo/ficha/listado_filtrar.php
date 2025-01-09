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
</head>
<body>
    <h1>Listado de Fichas con filtro</h1>
    <div style="margin-bottom: 1em">
      <fieldset style="width:50%">
        <legend>Filtrado</legend>
        <form name="filtrar" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <p><label for="texto">Texto <input type="text" name="texto"></label>
          </p>
          <p><label for="ciudad">Ciudad <input type="text" name="ciudad"></label>
          </p>
          <p>Género: <select name="genero">
            <option value="">Seleccione género </option>
            <option value="1"> Femenino </option>
            <option value="2"> Masculino </option>
          </select>
          </p>
          <input type="submit" value="Filtrar">
        </form>
      </fieldset>
    </div>
      <?php
        
        // Realiza la conexion a la base de datos a través de una función 
        $conexion = conectarPDO($host, $user, $password, $bbdd);

        // Obtenemos los valores del formulario de filtrado
        $texto = obtenerValorCampo("texto");
        $ciudad = obtenerValorCampo("ciudad");
        $genero = obtenerValorCampo("genero");

        $condicionWhere = "";
        $condiciones = [];

        // Creamos la condición del texto
        if ($texto!="")
        {
          $condiciones[] = "(nombre like '%$texto%' OR apellidos like '%$texto%' OR email like '%$texto%')";
        } 

        // Creamos la condición de la ciudad
        if ($ciudad!="")
        {
          $condiciones[] = "(ciudad like '%$ciudad%')";
        } 

        // Creamos la condición del genero
        if ($genero!="") 
        {
          $condiciones[] = "id_genero=$genero";
        } 

        if (count($condiciones) > 0) 
        {
          $condicionWhere = "WHERE ";
          foreach ($condiciones as $contador => $condicion) 
          {
            $condicionWhere .= $condicion;
            if ($contador < count($condiciones) -1) 
            {
              $condicionWhere .= " AND ";
            }
    
          }
        }
        
        // Realiza la consulta a ejecutar en la base de datos en una variable
        $consulta = "SELECT f.id, nombre, apellidos, email, ciudad, provincia, genero
        FROM ficha f 
        INNER JOIN ciudad c ON 
        c.id = f.id_ciudad
        INNER JOIN genero g ON 
        g.id = f.id_genero
        $condicionWhere";

        // Obten el resultado de ejecutar la consulta para poder recorrerlo. El resultado es de tipo PDOStatement
        $resultado = resultadoConsulta($conexion, $consulta);

        // Obtenemos el número de registros de la consulta
        $numRegistros = $resultado->rowCount();
 
        // Mostramos los criterios de búsqueda
        if ($texto!= "" || $ciudad!= "" || $genero!=""):
      ?>
          <h3>Criterios de búsqueda:</h3>
          <ul>
            <!-- Texto en campo de nombre, apellidos o email -->
            <?php
              if ($texto!= ""):
            ?>
              <li>Texto en nombre, apellidos o email: <?php echo $texto;?></li>
            <?php
              endif;
            ?>
            <!-- ciudad -->
            <?php
              if ($ciudad!= ""):
            ?>
              <li>Ciudad: <?php echo $ciudad;?></li>
            <?php
              endif;
            ?>
            <!-- Genero -->
            <?php
              if ($genero!= ""):
            ?>
              <li>Género: <?php echo $genero;?></li>
            <?php
              endif;
            ?>
          </ul>
      <?php
        endif;

        if ($numRegistros==0):
      ?>   
          <p>No hay registros con los criterios de búsqueda introducidos.</p>
      
      <?php

        else:

      ?> 
      
        <table border="1" cellpadding="10">
          <thead>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Correo electrónico</th>
              <th>Ciudad</th>
              <th>Provincia</th>
              <th>Genero</th>
          </thead>
          <tbody>
              <?php
                 
                  // para mostrar todos los datos
                  while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)):
              ?>
                  <tr>
                      <td><?php echo $registro["nombre"]; ?></td>
                      <td><?php echo $registro["apellidos"]; ?></td>
                      <td><?php echo $registro["email"]; ?></td>
                      <td><?php echo $registro["ciudad"]; ?></td>
                      <td><?php echo $registro["provincia"]; ?></td>
                      <td><?php echo $registro["genero"]; ?></td>
                  </tr>
                  </tr>
              <?php
                  endwhile;
              ?>
          </tbody>
        </table>
      <?php

        endif;
      
      ?>
      <div class="contenedor">
          <div class="enlaces">
            <a href="../index.php">Volver a página de listados</a>
          </div>
          <div class="enlaces">
            <a href="nuevo.php">Nuevo Registro</a>
        </div>
      </div>

    <?php
        $consulta = null;

        $conexion = null;
    ?>
</body>
</html>
