<?php
    $fila = $_POST["seleccionFila"];
    $columna = $_POST["seleccionColumna"];

    echo nl2br("Los valores de la matriz partiendo de la posición ($fila, $columna) y con la trayectoria seleccionada son:\n");

    $listaFinal = [];
    
    $numFilasColumnas = (int) $_POST["totalFilasColumnas"];
    
    switch ($_POST["trayectoria"]) { // Dependiendo de qué se seleccione, hará un recorrido un otro
        case "Arriba":
            while ($fila >= 1) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $fila--;
            }
            break;
        case "Abajo":
            while ($fila <= $numFilasColumnas) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $fila++;
            }
            break;
        case "Derecha":
            while ($columna <= $numFilasColumnas) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $columna++;
            }
            break;
        case "Izquierda":
            while ($columna >= 1) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $columna--;
            }
            break;
        case "Arriba Izquierda":
            while ($fila >= 1 && $columna >= 1) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $fila--;
                $columna--;
            }
            break;
        case "Abajo izquierda":
            while ($fila <= $numFilasColumnas && $columna >= 1) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $fila++;
                $columna--;
            }
            break;
        case "Arriba derecha":
            while ($columna <= $numFilasColumnas && $fila >= 1) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $fila--;
                $columna++;
            }
            break;
        case "Abajo derecha":
            while ($fila <= $numFilasColumnas && $columna <= $numFilasColumnas) {
                //$listaFinal[] = "$fila, $columna";
                $listaFinal [] = $_POST["$fila".","."$columna"];
                $fila++;
                $columna++;
            }
            break;
    }

    print "<pre>";
    print_r($listaFinal);
    print "<pre>";
?>