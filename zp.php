<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include('conexion.php');
$usuario_id = $_SESSION['usuario_id'];

try {
    // Conexión a la base de datos
    $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los trabajos de grado con nombres de asesor y evaluador
    $sql = "
        SELECT 
            tg.id_trabajo, 
            tg.titulo, 
            tg.autor1, 
            tg.autor2,
            tg.estado_asesor,
            tg.conclusion_asesor,
            CONCAT(asesor.nombres, ' ', asesor.apellidos) AS nombre_asesor, 
            CONCAT(evaluador.nombres, ' ', evaluador.apellidos) AS nombre_evaluador, 
            tg.fecha_trabajo, 
            tg.archivo 
        FROM 
            trabajo_grado tg
        LEFT JOIN usuarios asesor ON tg.asesor = asesor.id
        LEFT JOIN usuarios evaluador ON tg.evaluador = evaluador.id
    ";
    $stmt = $pdo->query($sql);
    $trabajos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Panel de Bienvenida</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body>
<main>
    <div class="container mt-5">
        <h3>Mi Trabajo de Grado</h3>
        <div class="table-responsive mt-2">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID Trabajo</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor 1</th>
                        <th scope="col">Autor 2</th>
                        <th scope="col">Fecha Trabajo</th>
                        <th scope="col">Estado Asesor</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Conclusion Asesor</th>
                        <th scope="col">Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trabajos as $trabajo): ?>
                        <tr>
                            <td><?= htmlspecialchars($trabajo['id_trabajo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['titulo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor1']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor2']) ?></td>
                            <td><?= htmlspecialchars($trabajo['fecha_trabajo']) ?></td>
                            <td> <a href="<?= htmlspecialchars($trabajo['archivo']) ?>" target="_blank">
                                    <i class="fas fa-file-alt"></i>
                                </a></td>
                            <td>
                        <select class="form-select" id="estado_asesor" name="estado_asesor">
                            <option value="Pendiente">Pendiente</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Rechazado">Rechazado</option>
                        </select></td>
                            <td><textarea name="conclusion_asesor" id="conclusion_asesor"></textarea></td>
                            <td><button class="btn btn-primary">Actualizar</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
