<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <h1>Listados</h1>
    <div class="contenedor">
        <div class="enlaces">
            <!-- Poner enlace a listado de fichas -->
            <?php echo "<a href=\"ficha/listado.php\">Listado de Fichas</a>";?>
        </div>
        
    </div>
    <hr>
    <!-- Ampliación -->
    <div class="contenedor">
        <div class="enlaces">
            <!-- Poner enlace a Listado de fichas con ordenación -->
            <?php echo "<a href=\"ficha/listado_ordenar.php\">Listado de Ficha con ordenación</a>";?>
        </div>
        <div class="enlaces">
            <!-- Poner enlace a Listado de fichas con filtros -->
            <?php echo "<a href=\"ficha/listado_filtrar.php\">Listado de Ficha con filtros</a>";?>
        </div>
    </div>
</body>
</html>

</html>