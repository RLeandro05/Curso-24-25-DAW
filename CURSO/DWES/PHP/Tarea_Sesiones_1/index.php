<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Lista de productos
$productos = [
    ['id' => 1, 'nombre' => 'Ratón', 'precio' => 8.99],
    ['id' => 2, 'nombre' => 'Teclado', 'precio' => 129.99],
    ['id' => 3, 'nombre' => 'Auriculares', 'precio' => 49.99],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['id'];
    // Agregar el producto al carrito
    $_SESSION['carrito'][$idProducto] = ($_SESSION['carrito'][$idProducto] ?? 0) + 1;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Productos disponibles</h1>
    <ul>
        <?php
        foreach ($productos as $producto) {
            echo '<li>';
            echo $producto['nombre'] . ' - ' . number_format($producto['precio'], 2) . ' €';
            echo '<form method="POST" style="display:inline;">';
            echo '<input type="hidden" name="id" value="' . $producto['id'] . '">';
            echo '<button type="submit">Agregar al carrito</button>';
            echo '</form>';
            echo '</li>';
        }
        ?>
    </ul>
    <a href="carrito.php">Ver carrito</a>
</body>
</html>
