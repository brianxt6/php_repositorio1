<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include('conexion.php');
$usuario_id = $_SESSION['usuario_id'];

try {
    $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM trabajo_grado WHERE usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':usuario_id' => $usuario_id]);

    $trabajos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Trabajos</title>
</head>
<body>
    <h1>Mis Trabajos de Grado</h1>
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Autor 1</th>
            <th>Autor 2</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($trabajos as $trabajo): ?>
            <tr>
                <td><?= htmlspecialchars($trabajo['titulo']) ?></td>
                <td><?= htmlspecialchars($trabajo['autor1']) ?></td>
                <td><?= htmlspecialchars($trabajo['autor2']) ?></td>
                <td><?= htmlspecialchars($trabajo['fecha_trabajo']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
