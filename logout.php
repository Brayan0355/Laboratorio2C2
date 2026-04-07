<?php
session_start(); // Iniciar sesión para poder manipularla

// Limpiamos todas las variables de sesión
session_unset();

// Destruimos la sesión actual en el servidor
session_destroy();

// Redireccionamos a la página principal de login (index.php)
header("Location: index.php");
exit();
?>
