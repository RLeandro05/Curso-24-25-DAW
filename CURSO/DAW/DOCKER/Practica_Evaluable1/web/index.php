<?php
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
try {
// Conexión a la base de datos
$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
echo "Conexión exitosa con la biblioteca.<br><br>";
$query = "SELECT id, titulo, autor FROM libro";
$stmt = $pdo->query($query);
if ($stmt) {
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Título</th><th>Autor</th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo "<tr>";
echo "<td>" . htmlspecialchars($row['id']) . "</td>";
echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
echo "</tr>";
}
echo "</table>";
} else {
echo "Error al obtener los libros.";
}
} catch (PDOException $e) {
echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
