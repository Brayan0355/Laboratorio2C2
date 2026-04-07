<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $nombre = trim(strip_tags($_POST['nombre'] ?? ''));
    $descripcion = trim(strip_tags($_POST['descripcion'] ?? ''));
    
    // Convertimos el precio a valor flotante explícitamente
    $precio = floatval($_POST['precio'] ?? -1);
    
    // 2. Validaciones obligatorias de negocio según indicaciones
    // - Ningún campo vacío
    // - El precio debe ser un número positivo (mayor a 0)
    if (empty($nombre) || empty($descripcion) || $precio <= 0) {
        header("Location: dashboard.php?error=validation");
        exit();
    }
    
    // 3. Preparar la inserción (Usando consultas preparadas para mayor seguridad)
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
    
    // Validamos que la sentencia se preparo correctamente
    if ($stmt) {
        // "ssd" significa String, String, Double 
        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);
        
        if ($stmt->execute()) {
            // Se insertó correctamente
            header("Location: dashboard.php?success=1");
        } else {
            // Error de base de datos
            header("Location: dashboard.php?error=db");
        }
        $stmt->close();
    } else {
        // Error de preparación
        header("Location: dashboard.php?error=stmt");
    }
    
} else {
    // Si no es POST, mandar al dashboard
    header("Location: dashboard.php");
}
exit();
?>
