<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema2";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    // Si el formulario se ha enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = (int) $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];

        // Consulta para actualizar el usuario
        $update_sql = "UPDATE usuarios SET nombres = ?, apellidos = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssi", $nombres, $apellidos, $id);

        if ($stmt->execute()) {
            echo "Usuario actualizado correctamente.";
            header("Location: index.php");
        } else {
            echo "Error al actualizar el usuario.";
        }

        $stmt->close();
    } else {
        // Obtener el id del usuario para editar
        $id = (int) $_GET['id'];
        $sql = "SELECT id, nombres, apellidos FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>

<!-- Formulario de edición -->
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" value="<?php echo htmlspecialchars($user['nombres']); ?>" required>
    <br>
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo htmlspecialchars($user['apellidos']); ?>" required>
    <br>
    <input type="submit" value="Actualizar">
</form>
