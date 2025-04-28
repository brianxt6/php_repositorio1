<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

include('conexion.php');
$usuario_id = $_SESSION['usuario_id'];

try {
    // Conexión a la base de datos
    $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los trabajos asociados al usuario autenticado
    $sql = "
        SELECT 
            tg.id_trabajo, 
            tg.titulo, 
            tg.autor1, 
            tg.autor2, 
            tg.archivo, 
            tg.conclusion_asesor, 
            tg.estado_asesor, 
            tg.conclusion_evaluador, 
            tg.estado_evaluador, 
            tg.archivo, 
            CONCAT(asesor.nombres, ' ', asesor.apellidos) AS nombre_asesor, 
            CONCAT(evaluador.nombres, ' ', evaluador.apellidos) AS nombre_evaluador, 
            tg.fecha_trabajo
        FROM 
            trabajo_grado tg
        LEFT JOIN usuarios asesor ON tg.asesor = asesor.id
        LEFT JOIN usuarios evaluador ON tg.evaluador = evaluador.id
        WHERE 
            tg.usuario_id = :usuario_id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario_id' => $usuario_id]);
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a href="https://xolit.com/en/rocking-your-business/">
    <img src="./img/logo-1.png" alt="logo" style="height: 25px;">
    </a>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="cerrar.php">Cerrar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Bienvenido usuario: <?= htmlspecialchars($_SESSION['usuario_nombres']); ?></h2>
    <p>Esta sección permite el registro de las solicitudes realizadas</p>
    <a href="agregartesisUC.php" class="btn btn-primary">Realizar Solictud</a>
</div>

<div class="container mt-5">
    <h3>Solicitudes Creadas</h3>
    <br>
    <div class="table-responsive mt-2">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th>ID Trabajo</th>
                    <th>Título</th>
                    <th>Autor 1</th>
                    <th>Autor 2</th>
                    <th>Asesor</th>
                    <th>Evaluador</th>
                    <th>Fecha</th>
                    <th>Archivo</th>
                    <th>Estado[ASESOR]</th>
                    <th>Conclusion[ASESOR]</th>
                    <th>Estado[EVALUADOR]</th>
                    <th>Conclusion[EVALUADOR]</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($trabajos)): ?>
                    <tr>
                        <td colspan="8">No tienes trabajos registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($trabajos as $trabajo): ?>
                        <tr>
                            <td><?= htmlspecialchars($trabajo['id_trabajo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['titulo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor1']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor2']) ?></td>
                            <td><?= htmlspecialchars($trabajo['nombre_asesor'] ?: 'No asignado') ?></td>
                            <td><?= htmlspecialchars($trabajo['nombre_evaluador'] ?: 'No asignado') ?></td>
                            <td><?= htmlspecialchars($trabajo['fecha_trabajo']) ?></td>
                            <td>
                                <a href="<?= htmlspecialchars($trabajo['archivo']) ?>" target="_blank">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </td>
                            <td><button class="btn btn-warning"><?= htmlspecialchars($trabajo['estado_asesor']) ?></button></td>
                            <td><?= htmlspecialchars($trabajo['conclusion_asesor']) ?></td>
                            <td><button class="btn btn-warning"><?= htmlspecialchars($trabajo['estado_evaluador']) ?></button></td>
                            <td><?= htmlspecialchars($trabajo['conclusion_evaluador']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
                    
    
<div class="container mt-5">
    <h3>Solicitudes Creadas</h3>
    <br>
    <div class="table-responsive mt-2">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th>ID Solicitud</th>
                    <th>Solicitud</th>
                    <th>Fecha</th>
                    <th>Nota</th>
                    <th>Jefe</th>
                    <th>Estado[Jefe]</th>
                    <th>Nota[Jefe]</th>
                    <th>Estaso[Gestión]</th>
                    <th>Nota[Gestión]</th>
                    <th>Aprobado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($trabajos)): ?>
                    <tr>
                        <td colspan="8">No tienes trabajos registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($trabajos as $trabajo): ?>
                        <tr>
                            <td><?= htmlspecialchars($trabajo['id_trabajo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['titulo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor1']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor2']) ?></td>
                            <td><?= htmlspecialchars($trabajo['nombre_asesor'] ?: 'No asignado') ?></td>
                            <td><?= htmlspecialchars($trabajo['nombre_evaluador'] ?: 'No asignado') ?></td>
                            <td><?= htmlspecialchars($trabajo['fecha_trabajo']) ?></td>
                            <td>
                                <a href="<?= htmlspecialchars($trabajo['archivo']) ?>" target="_blank">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </td>
                            <td><button class="btn btn-warning"><?= htmlspecialchars($trabajo['estado_asesor']) ?></button></td>
                            <td><?= htmlspecialchars($trabajo['conclusion_asesor']) ?></td>
                            <td><button class="btn btn-warning"><?= htmlspecialchars($trabajo['estado_evaluador']) ?></button></td>
                            <td><?= htmlspecialchars($trabajo['conclusion_evaluador']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</main>
</body>
</html>
