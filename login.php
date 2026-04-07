<?php
session_start();
require_once 'config.php';

// Verificamos si se han enviado datos por POST (el formulario)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Limpiamos los espacios en blanco iniciales/finales
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    // Validamos que no estén vacíos
    if (empty($username) || empty($password)) {
        header("Location: index.php?error=empty");
        exit();
    }
    
    // Hacemos un hash (SHA256) de la contraseña ingresada 
    // Debe coincidir con la de la base de datos
    $hashed_pass = hash('sha256', $password);
    
    // Utilizamos consultas preparadas PDO/MySQLi para prevenir inyección SQL
    $stmt = $conn->prepare("SELECT id, username FROM usuarios WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $hashed_pass);
    
    // Ejecutamos y verificamos si hay algún resultado
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        // Encontramos al usuario, lo guardamos en la sesión
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // Redirigimos a la página protegida
        header("Location: dashboard.php");
        exit();
    } else {
        // Credenciales incorrectas
        header("Location: index.php?error=invalid");
        exit();
    }
    
    $stmt->close();
} else {
    // Si entran directamente a login.php sin mandar datos, devolver al index
    header("Location: index.php");
    exit();
}
?>
