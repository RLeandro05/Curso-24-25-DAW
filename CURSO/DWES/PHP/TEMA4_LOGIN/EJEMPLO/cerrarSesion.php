<?php
// Inicia las sesiones
session_name("sesion-privada");
session_start();
// Destruye cualquier sesión del usuario
session_destroy();
// Redirecciona a loginBasico.php
header('Location: loginBasico.php');
exit();  // Aseguramos que no se ejecute más código después de la redirección
?>
