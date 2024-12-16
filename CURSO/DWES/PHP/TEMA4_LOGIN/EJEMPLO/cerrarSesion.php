<?php
 // Inicia las sesiones
 session_name("sesion-privada");
 session_start();
 // Destruye cualquier sesión del usuario
 session_destroy();
 // Redirecciona a login.php
 header('Location: loginBásico.php');
?>