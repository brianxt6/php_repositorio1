<?php
session_start(); // Asegúrate de que la sesión está iniciada

if (!isset($_SESSION['usuario_id'])) {
    // Redirige al login si no hay sesión activa
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('conexion.php');
    $errores = array();
    $success = false;

    $titulo = $_POST['titulo'] ?? null;
    $nota_usuario = $_POST['nota_usuario'] ?? null;
    $usuario_id = $_SESSION['usuario_id']; // Obtiene el ID del usuario actual
    
    date_default_timezone_set('America/Bogota');
    $fecha_actual = date('d/m/Y H:i:s'); 
    
    try {
        $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Obtener nombre y apellido del usuario
        $sql_usuario = "SELECT nombres, apellidos FROM usuarios WHERE id = :usuario_id";
        $stmt_usuario = $pdo->prepare($sql_usuario);
        $stmt_usuario->execute(['usuario_id' => $usuario_id]);
        $usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario) {
            $nombre_completo = $usuario['nombres'] . ' ' . $usuario['apellidos'];
        } else {
            $nombre_completo = 'Usuario no encontrado';
        }
    
        // Inserción a la tabla resumen_solicitud, incluyendo nombre_usuario
        $sql = "INSERT INTO `resumen_solicitud` 
            (`usuario_id`, `nombre_usuario`, `titulo`, `fecha`, `nota_usuario`, `nota_jefe`,
             `estado_jefe`, `nota_sistemas`, `estado_sistemas`, `aprobacion`)
             VALUES (:usuario_id, :nombre_usuario, :titulo, :fecha_actual, :nota_usuario, 'Pendiente Jefe',
             'Pendiente', 'Pendiente Sistemas', 'Pendiente', 'Pendiente')";
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'usuario_id' => $usuario_id,
            'nombre_usuario' => $nombre_completo,
            'titulo' => $titulo,
            'fecha_actual' => $fecha_actual,
            'nota_usuario' => $nota_usuario
        ]);

        $success = true;
    } catch (PDOException $e) {
        $errores[] = "Error: " . $e->getMessage();
    }

    if ($success) {
        header("Location: trabajocargadoUCV2.php");
        exit();
    } else {
        foreach ($errores as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>
