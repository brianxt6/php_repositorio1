<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la cédula enviada desde la solicitud
    $cc = isset($_POST['cc']) ? trim($_POST['cc']) : null;

    if (!$cc) {
        echo json_encode(['success' => false, 'message' => 'La cédula es requerida.']);
        exit;
    }

    try {
        $pdo = new PDO("mysql:host=$direccionservidor;dbname=$baseDatos", $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consultar el usuario por cédula
        $stmt = $pdo->prepare("SELECT email, nombres, cc, rol FROM usuarios WHERE cc = :cc");
        $stmt->bindParam(':cc', $cc, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Devolver información en formato JSON
            echo json_encode([
                'success' => true,
                'email' => $usuario['email'],
                'nombres' => $usuario['nombres'],  // Cambié 'nombre' por 'nombres'
                'cc' => $usuario['cc'],
                'rol' => $usuario['rol']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cédula no encontrada.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al consultar la base de datos: ' . $e->getMessage()]);
    }
}
?>
