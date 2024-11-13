<?php

$usuario = "Leandro"; // Creación de variable 'usuario' para dar a entender que inicia sesión en su cuenta para realizar la compra online
echo "Usuario que inicia sesión: <strong>'$usuario'</strong>"; // Indicar usuario que inicia sesión

// Lista de variables con el nombre, precio unitario y cantidad de cada producto para comprar
$nombreTomate = "Tomate";
$precioTomate = 0.5;
$cantidadTomate = 20;

$nombreLechuga = "Lechuga";
$precioLechuga = 1;
$cantidadLechuga = 10;

$nombrePollo = "Pollo";
$precioPollo = 2;
$cantidadPollo = 34;

echo "<h3>Lista de productos de la compra</h3>"; // Mostrar título en pantalla

// Indicar al usuario el precio por unidad de cada producto
echo "<p>1. $nombreTomate: $precioTomate €/unidad</p>";
echo "<p>2. $nombreLechuga: $precioLechuga €/unidad</p>";
echo "<p>3. $nombrePollo: $precioPollo €/unidad</p> <br>";

echo "<strong>-------------------------------------------------------------------------</strong>";

echo "<h3>Subtotal de la compra</h3>"; // Indicar el subtotal de la compra una vez seleccionado los productos

// Realizar total de cada producto elegido
$totalTomate = $precioTomate * $cantidadTomate;
$totalLechuga = $precioLechuga * $cantidadLechuga;
$totalPollo = $precioPollo * $cantidadPollo;

$subtotal = $totalTomate + $totalLechuga + $totalPollo; // Calcular subtotal
$total = 0;

if ($subtotal > 50) { // En caso de que supere los 50€, entrar en el if
    $descuento = $subtotal * 0.1; // Se aplica descuento del 10%
    $total = $subtotal - $descuento; // Se calcula el total restando el valor del descuento aplicado

    // Mostrar por pantalla al usuario el ticket completo con la información de la compra: Producto, unidades, total del producto, subtotal, descuento aplicado o no y total de la compra
    echo "--------------Unidad------Precio------Total<br>";
    echo "$nombreTomate:------$cantidadTomate----------$precioTomate €-------$totalTomate €<br>";
    echo "$nombreLechuga:------$cantidadLechuga------------$precioLechuga €---------$totalLechuga €<br>";
    echo "$nombrePollo:----------$cantidadPollo------------$precioPollo €---------$totalPollo €<br>";
    echo "<strong>Subtotal:-------------------------------$subtotal €</strong><br>";
    echo "<strong>Descuento 10%:----------------------Aplicado</strong><br>";
    echo "<strong>Total:-----------------------------------$total €<br>";

    if ($subtotal > 100) { // En caso de ser compra grande en el subtotal, indicar al usuario que es una compra grande
        echo "<strong>COMPRA GRANDE</strong>";
    }
} else { // En caso de no ser mayor a 50€, simplemente indicar el mismo ticket pero sin aplicar descuento
    echo "--------------Unidad------Precio------Total<br>";
    echo "$nombreTomate:------$cantidadTomate----------$precioTomate €-------$totalTomate €<br>";
    echo "$nombreLechuga:------$cantidadLechuga------------$precioLechuga €---------$totalLechuga €<br>";
    echo "$nombrePollo:----------$cantidadPollo------------$precioPollo €---------$totalPollo €<br>";
    echo "<strong>Subtotal:-------------------------------$subtotal €</strong><br>";
    echo "<strong>Descuento 10%:----------------------No Aplicado</strong><br>";
    echo "<strong>Total:-----------------------------------$subtotal €<br>";
}

echo "<br>";

echo "<strong>-------------------------------------------------------------------------</strong>";

echo "<h2>Gracias por su compra. ¡Vuelva pronto!</h2>"; // Indicar el final del programa, dando una despedida

echo "Usuario que cierra sesión: <strong>'$usuario'</strong>"; // Indicar el cierre de sesión del usuario que compró en la página los productos

?>