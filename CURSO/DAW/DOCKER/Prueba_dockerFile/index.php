<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IES Velázquez de Sevilla</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #0056b3;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
        nav {
            background-color: #003f7d;
            padding: 0.5rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 1rem;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 2rem;
        }
        footer {
            background-color: #0056b3;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 0.5rem;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenidos al IES Velázquez de Sevilla</h1>
        <p>Excelencia educativa al alcance de todos</p>
    </header>
    <nav>
        <a href="#">Inicio</a>
        <a href="#">Sobre Nosotros</a>
        <a href="#">Oferta Educativa</a>
        <a href="#">Contacto</a>
    </nav>
    <main>
        <h2>Prueba de PHP</h2>
        <p>A continuación, mostramos información dinámica generada con PHP:</p>
        
        <!-- Código PHP para mostrar la fecha actual -->
        <?php
            echo "<p><strong>Fecha actual:</strong> " . date("d/m/Y") . "</p>";
            
            // Simulación de datos de ejemplo
            $ciclos = [
                ["nombre" => "Desarrollo de Aplicaciones Web", "nivel" => "Grado Superior"],
                ["nombre" => "Desarrollo de Aplicaciones Multiplataforma", "nivel" => "Grado Superior"],
                ["nombre" => "Sistemas Microinformáticos y Redes", "nivel" => "Grado Medio"]
            ];

            echo "<h3>Oferta educativa:</h3>";
            echo "<table>";
            echo "<tr><th>Ciclo</th><th>Nivel</th></tr>";

            foreach ($ciclos as $ciclo) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($ciclo['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($ciclo['nivel']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Mostrar información del servidor
            echo "<h3>Información del servidor:</h3>";
            echo "<ul>";
            echo "<li><strong>Versión de PHP:</strong> " . phpversion() . "</li>";
            echo "<li><strong>Software del servidor:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</li>";
            echo "<li><strong>Dirección IP del servidor:</strong> " . $_SERVER['SERVER_ADDR'] . "</li>";
            echo "</ul>";
        ?>
    </main>
    <footer>
        <p>&copy; 2025 IES Velázquez de Sevilla. Todos los derechos reservados.</p>
        <p>C. Francisco Carrión Mejías, 10, Casco Antiguo, 41003 Sevilla</p>
    </footer>
</body>
</html>


