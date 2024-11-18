<?php
    require_once "Data.php";

    /*Actividad 5: Calcular la población total de 
    cada comunidad y mostrarla en una tabla HTML*/

    //CABE DESTACAR QUE SÇOLO APARECEN LAS POBLACIONES DE LAS CAPITALES

    foreach ($comunidades as $comunidad => $infoComunidad) {
        foreach ($infoComunidad["capital"] as $capital => $infoCapital) {
            print_r($infoCapital);
        }
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
            <th>Comunidades</th>
            <th>Total Población</th>
        </thead>
        <tbody>
            <tr>
                <td>Andalucía</td>
                <td><?php
                        ?></td>
            </tr>
            <tr>
                <td>Cataluña</td>
            </tr>
            <tr>
                <td>Castilla Y León</td>
            </tr>
            <tr>
                <td>Galicia</td>
            </tr>
            <tr>
                <td>País Vasco</td>
            </tr>
        </tbody>
    </table>
</body>
</html>