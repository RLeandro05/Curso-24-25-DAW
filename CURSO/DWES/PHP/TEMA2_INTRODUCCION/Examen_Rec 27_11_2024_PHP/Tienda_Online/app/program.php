<?php

    // Inicializar la lista de productos en sesión
    $_SESSION["listaProductos"] = [
        'hombre' => [
            'camisas' => [
                [
                    'nombre' => 'Camisa Casual Hombre',
                    'precio' => 25.99,
                    'cantidad' => 50,
                    'id' => 1, // Identificador único
                ],
                [
                    'nombre' => 'Camisa Formal Hombre',
                    'precio' => 39.99,
                    'cantidad' => 30,
                    'id' => 2, // Identificador único
                ],
            ],
            'pantalones' => [
                [
                    'nombre' => 'Pantalón Chino Hombre',
                    'precio' => 29.99,
                    'cantidad' => 40,
                    'id' => 3, // Identificador único
                ],
                [
                    'nombre' => 'Jeans Hombre',
                    'precio' => 49.99,
                    'cantidad' => 60,
                    'id' => 4, // Identificador único
                ],
            ],
            // Otros productos de hombre
        ],
        'mujer' => [
            // Productos de mujer
        ],
        'niño' => [
            // Productos de niño
        ],
    ];

    // Inicializar el carrito si no existe
    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = [];
    }

    //Función para agregar productos al carrito de compras
    function agregar_producto($producto_id, $cantidad) {
        // Buscar el producto en la lista de productos
        foreach ($_SESSION["listaProductos"] as $categoria => $categorias) {
            foreach ($categorias as $tipo => $productos) {
                foreach ($productos as $producto) {
                    // Si encontramos el producto con el ID correspondiente
                    if ($producto['id'] == $producto_id) {
                        // Verificamos que haya suficiente cantidad en stock
                        if ($producto['cantidad'] >= $cantidad) {
                            // Agregar el producto al carrito
                            $_SESSION["carrito"][] = [
                                'id' => $producto['id'],
                                'nombre' => $producto['nombre'],
                                'precio' => $producto['precio'],
                                'cantidad' => $cantidad
                            ];
                            // Actualizar el stock
                            $_SESSION["listaProductos"][$categoria][$tipo][array_search($producto, $productos)]['cantidad'] -= $cantidad;
                            echo "Producto agregado al carrito.";
                        } else {
                            echo "No hay suficiente stock para la cantidad solicitada.";
                        }
                        return;
                    }
                }
            }
        }
        echo "Producto no encontrado.";
    }

    //Función para eliminar productos del carrito de compras
    function eliminar_producto($producto_id) {
        foreach ($_SESSION["carrito"] as $key => $producto) {
            if ($producto['id'] == $producto_id) {
                // Devolver la cantidad al stock
                foreach ($_SESSION["listaProductos"] as $categoria => $categorias) {
                    foreach ($categorias as $tipo => $productos) {
                        foreach ($productos as $p) {
                            if ($p['id'] == $producto_id) {
                                $_SESSION["listaProductos"][$categoria][$tipo][array_search($p, $productos)]['cantidad'] += $producto['cantidad'];
                                break 3;
                            }
                        }
                    }
                }
                // Eliminar el producto del carrito
                unset($_SESSION["carrito"][$key]);
                $_SESSION["carrito"] = array_values($_SESSION["carrito"]); // Reindexar el arreglo
                echo "Producto eliminado del carrito.";
                return;
            }
        }
        echo "Producto no encontrado en el carrito.";
    }

    //Función para calcular el total de la compra en el carrito
    function calcular_total() {
        $total = 0;
        foreach ($_SESSION["carrito"] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        return number_format($total, 2, ",", ".");
    }
?>
