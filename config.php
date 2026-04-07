<?php
/**
 * Configuración de la base de datos
 */

$host = '127.0.0.1';     
$port = 3307;            
$dbname = 'laboratorio2'; 
$user = 'root';          
$pass = '';        


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    
    $conn = new mysqli($host, $user, $pass, $dbname, $port);
    
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    $mensaje_error = $e->getMessage();
    
    
    echo "<style>
            body { font-family: sans-serif; background: #0f172a; color: #f8fafc; padding: 2rem; display: flex; justify-content: center; }
            .error-box { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); padding: 1.5rem; border-radius: 0.5rem; max-width: 600px; }
            h3 { color: #fca5a5; margin-top: 0; }
            a { color: #93c5fd; }
          </style>";
    echo "<div class='error-box'>";

    if (strpos($mensaje_error, 'Unknown database') !== false) {
        // Error común 1: No se ha ejecutado el SQL en phpMyAdmin
        echo "<h3> Falta crear la base de datos</h3>";
        echo "<p>El sistema logró conectarse a MySQL, pero <strong>no encuentra la base de datos '$dbname'</strong>.</p>";
        echo "<p><strong>Cómo solucionarlo:</strong></p>";
        echo "<ol>
                <li>Abre <a href='http://localhost/phpmyadmin' target='_blank'>phpMyAdmin</a>.</li>
                <li>Haga clic en la pestaña <strong>SQL</strong>.</li>
                <li>Abre el archivo <code>database.sql</code>, copia todo su contenido y pégalo ahí.</li>
                <li>Haz clic en <strong>Continuar</strong> para crearlo.</li>
                <li>Después de eso, recarga esta página.</li>
              </ol>";
    } else {
        // Error común 2: Credenciales, servidor apagado, o distinto puerto
        echo "<h3> Error de conexión a MySQL</h3>";
        echo "<p>No nos hemos podido conectar a tu servidor MySQL. Detalle técnico:</p>";
        echo "<pre style='background:#1e293b; padding:10px; border-radius:4px;'>$mensaje_error</pre>";
        echo "<p><strong>Posibles causas y soluciones:</strong></p>";
        echo "<ul>
                <li>¿MySQL está encendido en tu panel de control de XAMPP? Asegúrate de que esté en verde.</li>
                <li>¿Tienes configurada una contraseña para el usuario 'root'? (Por defecto en XAMPP está vacía, pero si le pusiste una, edita <code>config.php</code> e insértala en <code>\$pass</code>).</li>
                <li>¿MySQL usa otro puerto? (Por ejemplo 3307). Si es así, prueba a cambiar la variable <code>\$host = 'localhost:3307';</code> en <code>config.php</code>.</li>
              </ul>";
    }
    echo "</div>";
    die();
}
?>
