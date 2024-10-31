<?php
session_start();

// Si el carrito está vacío, redirigir a index.php
if (empty($_SESSION['carrito'])) {
    header('Location: index.php');
    exit;
}

// Lista de productos (debe coincidir con index.php)
$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10],
    2 => ['nombre' => 'Producto 2', 'precio' => 20],
    3 => ['nombre' => 'Producto 3', 'precio' => 30],
];

// Calcular total
$total = 0;
foreach ($_SESSION['carrito'] as $id => $cantidad) {
    $total += $productos[$id]['precio'] * $cantidad;
}

// Procesar la compra
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí podrías añadir lógica para procesar el pago
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
        <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
            <li>
                <?php echo $productos[$id]['nombre']; ?> - Cantidad: <?php echo $cantidad; ?> - Precio: $<?php echo $productos[$id]['precio']; ?> 
                - Total: $<?php echo $productos[$id]['precio'] * $cantidad; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <h2>Total: $<?php echo $total; ?></h2>
    <form method="POST">
        <button type="submit">Realizar compra</button>
    </form>
    <a href="index.php">Seguir comprando</a>
</body>
</html>