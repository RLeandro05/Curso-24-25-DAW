<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Blog</title>
  <style>
    /* Estilos generales */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
    }

    h1, h2 {
      color: #2c3e50;
    }

    /* Barra de navegación */
    nav {
      background-color: #3498db;
      color: white;
      padding: 15px 0;
      text-align: center;
    }

    nav a {
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      margin: 0 10px;
      font-size: 18px;
    }

    nav a:hover {
      background-color: #2980b9;
      border-radius: 5px;
    }

    /* Estilo de contenedor principal */
    .container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 15px;
    }

    /* Estilo de la lista de blogs */
    .blog-posts {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .blog-post {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 48%;
      padding: 20px;
      box-sizing: border-box;
    }

    .blog-post img {
      max-width: 100%;
      border-radius: 8px;
      height: auto;
    }

    .blog-post h2 {
      margin-top: 15px;
      font-size: 24px;
    }

    .blog-post p {
      line-height: 1.6;
    }

    .read-more {
      display: inline-block;
      margin-top: 15px;
      color: #3498db;
      text-decoration: none;
      font-weight: bold;
    }

    .read-more:hover {
      text-decoration: underline;
    }

    /* Pie de página */
    footer {
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <!-- Barra de navegación -->
  <nav>
    <a href="#">Inicio</a>
    <a href="#">Sobre mí</a>
    <a href="#">Contacto</a>
    <a href="#">Categorías</a>
  </nav>

  <!-- Contenedor principal -->
  <div class="container">
    <h1>Bienvenido a Mi Blog {{$nombre}}</h1>
    <p>Este es el lugar donde comparto mis pensamientos y artículos sobre tecnología, desarrollo web y mucho más.</p>

    

  <!-- Pie de página -->
  <footer>
    <p>&copy; 2025 Mi Blog | Todos los derechos reservados</p>
  </footer>
</body>
</html>
