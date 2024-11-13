<?php
    session_start(); //Iniciar sesión

    $matrizClases = [ //Matriz de clases a elegir
        'yoga' => [
            'lunes' => [
            'hora' => '19:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'miércoles' => [
            'hora' =>'08:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'viernes' => [
            'hora' =>'10:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
        ],
        'zumba' => [
            'martes' => [
            'hora' => '18:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'jueves' => [
            'hora' =>'19:30',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
        ],
        'crossfit' => [
            'lunes' => [
            'hora' => '18:00',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'miércoles' => [
            'hora' =>'14:30',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],
            'viernes' => [
            'hora' =>'20:30',
            'plazas_totales' => 20,
            'plazas_disponibles' => 20,
            'plazas_reservadas' => 0,
            ],       
        ]
    ];

    $_SESSION["matrizClases"] = $matrizClases; //Guardar la matriz en una sesión

    function reservar_plaza() {

    }

    function liberar_plaza() {

    }
?>