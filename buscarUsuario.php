<?php
// Conexión a la base de datos
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el correo enviado desde la solicitud
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;

    if (!$email) {
        echo json_encode(['success' => false, 'message' => 'El correo es requerido.']);
        exit;
    }

    try {
        $pdo = new PDO("mysql:host=$direccionservidor;dbname=$baseDatos", $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consultar el usuario por correo
        $stmt = $pdo->prepare("SELECT email, rol FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Devolver información en formato JSON
            echo json_encode([
                'success' => true,
                'email' => $usuario['email'],
                'rol' => $usuario['rol']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Correo no encontrado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al consultar la base de datos: ' . $e->getMessage()]);
    }
}
?>
