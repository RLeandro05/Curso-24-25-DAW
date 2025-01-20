<?php
$host = 'db';
$dbname = 'shop_db';  // El nombre de la base de datos definida en el docker-compose.yml
$user = 'shop_user'; 
$password = 'shoppass'; 


try {  
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $query = $pdo->query("SELECT * FROM productos");


  // Mostrar los productos
  echo "<h1>Lista de productos</h1>";
  echo "<table border='1'>
          <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Precio</th>
          </tr>";


  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['nombre']}</td>
              <td>{$row['precio']}€</td>
            </tr>";
  }


  echo "</table>";
} catch (PDOException $e) {
  echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
