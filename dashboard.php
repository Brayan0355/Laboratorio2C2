<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'config.php';

$productos = [];
$query = "SELECT * FROM productos ORDER BY id DESC";
$resultado = $conn->query($query);

if ($resultado && $resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard del Laboratorio 2">
    <title>Panel de Control | Laboratorio 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <header class="glass-container navbar">
            <div class="navbar-brand">
                <h2>Panel | Hola, <span class="highlight"><?php echo htmlspecialchars($_SESSION['username']); ?></span></h2>
            </div>
            <div class="navbar-actions">
                <a href="logout.php" class="btn-danger">Cerrar Sesión</a>
            </div>
        </header>

        <main class="dashboard-content">
          
            <?php if(isset($_GET['success'])): ?>
                <div class="alert success">Registro agregado correctamente a la base de datos.</div>
            <?php endif; ?>
            <?php if(isset($_GET['error'])): ?>
                <div class="alert error">Error al guardar. Verifica que los datos sean válidos y el precio sea mayor a 0.</div>
            <?php endif; ?>

            <div class="dashboard-grid">
                
                <div class="glass-container form-section">
                    <h3>Insertar Nuevo Producto</h3>
                    <p class="subtitle">Añade información a la tabla de base de datos.</p>
                    
                    <form action="insert.php" method="POST" class="styled-form">
                        <div class="input-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required maxlength="100">
                        </div>
                        
                        <div class="input-group">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" placeholder="Detalles o especificaciones" rows="3" required></textarea>
                        </div>
                        
                        <div class="input-group">
                            <label for="precio">Precio ($)</label>
                            <input type="number" step="0.01" min="0" id="precio" name="precio" placeholder="0.00" required>
                        </div>
                        
                        <button type="submit" class="btn-primary">Guardar Datos</button>
                    </form>
                </div>

                <!-- Columna Derecha: Tabla -->
                <div class="glass-container table-section">
                    <h3>Registros Almacenados</h3>
                    <div class="table-container">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($productos) > 0): ?>
                                    <?php foreach($productos as $prod): ?>
                                    <tr>
                                        <td><?php echo $prod['id']; ?></td>
                                        <!-- Usamos htmlspecialchars para evitar ataques XSS al pintar en HTML -->
                                        <td><strong><?php echo htmlspecialchars($prod['nombre']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($prod['descripcion']); ?></td>
                                        <td class="price">$<?php echo number_format($prod['precio'], 2); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="empty-state">No hay registros almacenados. ¡Añade tu primer producto!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
