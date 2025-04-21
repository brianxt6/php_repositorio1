<?php
// Conexión a la base de datos
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $rol = isset($_POST['rol']) ? (int) $_POST['rol'] : null;

    if (!$email || !$rol) {
        echo json_encode(['success' => false, 'message' => 'El correo y rol son requeridos.']);
        exit;
    }

    try {
        $pdo = new PDO("mysql:host=$direccionservidor;dbname=$baseDatos", $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Actualizar el rol del usuario
        $stmt = $pdo->prepare("UPDATE usuarios SET rol = :rol WHERE email = :email");
        $stmt->bindParam(':rol', $rol, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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
