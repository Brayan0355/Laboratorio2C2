<?php
session_start(); // Iniciar la sesión
require_once 'config.php';

// Si ya hay alguien logueado, redirigir al panel de control
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de inicio de sesión - Laboratorio 2">
    <title>Acceso al Sistema | Laboratorio 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
    <div class="glass-container login-box">
        <div class="login-header">
            <h1>Bienvenido</h1>
            <p>Ingresa tus credenciales para acceder</p>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert error">
                Usuario o contraseña incorrectos.
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="styled-form">
            <div class="input-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" required autocomplete="off">
            </div>
            
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn-primary">Iniciar Sesión</button>
        </form>
        
        <div class="login-footer">
            <p>El usuario de prueba es <strong>admin</strong> y la contraseña <strong>password123</strong></p>
        </div>
    </div>
</body>
</html>
