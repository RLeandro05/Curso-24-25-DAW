<?php
    require_once "Data.php";

    /*Actividad 5: Calcular la población total de 
    cada comunidad y mostrarla en una tabla HTML*/

    //Función para calcular la población total de cada comunidad
    function calcularPoblacionTotal($provincias) {
        $total = 0;
        foreach ($provincias as $provincia => $datos) {
            $total += $datos['poblacion'];
        }
        return $total;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Población total</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Comunidades</th>
                <th>Total Población</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comunidades as $comunidad => $infoComunidad): ?>
                <tr>
                    <td><?php echo $comunidad; ?></td>
                    <td>
                        <?php 
                            //Calculamos la población total sumando las provincias
                            $poblacionTotal = calcularPoblacionTotal($infoComunidad['provincias']);
                            echo number_format($poblacionTotal);
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>