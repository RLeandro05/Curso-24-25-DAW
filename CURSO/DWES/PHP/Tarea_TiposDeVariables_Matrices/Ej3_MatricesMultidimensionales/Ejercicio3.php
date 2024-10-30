<?php 
    // Definiciond de matriz multidimensional con valores predeterminados de alumnos
    $listaAlumnos = [
        ["nombre" => "Juan", "edad" => 20, "nota" => 9],
        ["nombre" => "Maria", "edad" => 18, "nota" => 7.8],
        ["nombre" => "Javier", "edad" => 22], "nota" => 10
    ];

    echo "Nombre del segundo estudiante: '{$listaAlumnos[1]["nombre"]}'"; // Mostrar nombre del segundo alumno de la lista de alumnos llamandolo entre {}
?>