<?php
session_start();

// Si el carrito está vacío, redirigir a index.php
if (empty($_SESSION['carrito'])) {
    header('Location: index.php');
    exit;
}

// Lista de productos
$productos = [
    1 => ['nombre' => 'Ratón', 'precio' => 8.99],
    2 => ['nombre' => 'Teclado', 'precio' => 129.99],
    3 => ['nombre' => 'Auriculares', 'precio' => 49.99],
];

// Calcular total
$total = 0;
foreach ($_SESSION['carrito'] as $id => $cantidad) {
    $total += $productos[$id]['precio'] * $cantidad;
}

// Procesar la compra
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>Compra realizada con éxito!</h2>";
    // Limpiar el carrito
    $_SESSION['carrito'] = [];
    exit;
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
    <h1>Tu carrito de compras</h1>
    <ul>
        <?php
        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            echo '<li>';
            echo $productos[$id]['nombre'] . ' - Cantidad: ' . $cantidad . ' - Precio: ' . number_format($productos[$id]['precio'], 2) . ' €';
            echo ' - Total: ' . number_format($productos[$id]['precio'] * $cantidad, 2) . ' €';
            echo '</li>';
        }
        ?>
    </ul>
    <h2>Total: <?= number_format($total, 2) . ' €'; ?></h2>
    <form method="POST">
        <button type="submit">Realizar compra</button>
    </form>
    <a href="index.php">Seguir comprando</a>
</body>
</html>
