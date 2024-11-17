<?php
    require_once "Program.php";

    //Productos
    $producto1 = new Producto("Ordenador", 1299.99, 23);
    $producto2 = new Producto("Monitor", 99.99, 10);
    $producto3 = new Producto("Ratón", 49.99, 5);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $producto = (string) $_POST['listaProductos'];  //Nombre del producto
        $cantidad = (int) $_POST['cantidad']; //Cantidad

        $mensaje = "";

        //Dependiendo del producto, cambiar el stock de uno u otro
        switch ($producto) {
            case $producto1->getNombre():
                $mensaje = $producto1->disminuirStock($cantidad);
                break;
            case $producto2->getNombre():
                $mensaje = $producto2->disminuirStock($cantidad);
                break;
            case $producto3->getNombre():
                $mensaje = $producto3->disminuirStock($cantidad);
                break;
            default:
                $mensaje = "Producto no reconocido";
                break;
        }

        echo $mensaje;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <form action="Productos.php" method="post">
        Seleccione el producto
        <select name="listaProductos" id="listaProductos" required>
            <option value="<?= $producto1->getNombre()?>"><?php echo $producto1->getNombre()." || Stock: ".$producto1->getStock()?></option>
            <option value="<?= $producto2->getNombre()?>"><?php echo $producto2->getNombre()." || Stock: ".$producto2->getStock()?></option>
            <option value="<?= $producto3->getNombre()?>"><?php echo $producto3->getNombre()." || Stock: ".$producto3->getStock()?></option>
        </select>

        <br> <br>

        Seleccione la cantidad
        <input type="number" name="cantidad" id="cantidad" required>

        <br> <br>

        <input type="submit" value="Realizar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>
