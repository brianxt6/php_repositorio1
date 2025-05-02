<?php
// Conexión a la base de datos
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cc = isset($_POST['cc']) ? trim($_POST['cc']) : null;
    $rol = isset($_POST['rol']) ? (int) $_POST['rol'] : null;

    if (!$cc || !$rol) {
        echo json_encode(['success' => false, 'message' => 'La cédula y el rol son requeridos.']);
        exit;
    }

    try {
        $pdo = new PDO("mysql:host=$direccionservidor;dbname=$baseDatos", $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Actualizar el rol del usuario
        $stmt = $pdo->prepare("UPDATE usuarios SET rol = :rol WHERE cc = :cc");
        $stmt->bindParam(':rol', $rol, PDO::PARAM_INT);
        $stmt->bindParam(':cc', $cc, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró el usuario o no se realizaron cambios.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $e->getMessage()]);
    }
}
?>
