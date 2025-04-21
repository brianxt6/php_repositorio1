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

    // Consulta para obtener todos los trabajos de grado junto con el estado y la conclusión del asesor
    $sql = "SELECT id_trabajo, titulo, autor1, autor2, asesor, evaluador, fecha_trabajo, archivo, estado_asesor, conclusion_asesor FROM trabajo_grado";
    $stmt = $pdo->query($sql);
    $trabajos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener los asesores (rol 3) y evaluadores (rol 4)
    $sqlAsesores = "SELECT id, nombres, apellidos FROM usuarios WHERE rol = 3";
    $stmtAsesores = $pdo->query($sqlAsesores);
    $asesores = $stmtAsesores->fetchAll(PDO::FETCH_ASSOC);

    $sqlEvaluadores = "SELECT id, nombres, apellidos FROM usuarios WHERE rol = 4";
    $stmtEvaluadores = $pdo->query($sqlEvaluadores);
    $evaluadores = $stmtEvaluadores->fetchAll(PDO::FETCH_ASSOC);

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
<header>
    <!-- Navbar -->
</header>
<main>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <img src="./img/logo-1.png" alt="">
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="https://uc.edu.co/" aria-current="page">Pagina Universidad <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="cerrar.php" aria-current="page">Cerrar <span class="visually-hidden">(current)</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br/>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col">
            <h2>Bienvenido usuario: <?php echo $_SESSION['usuario_nombres']; ?></h2>
            <p>Esta sección permite el registro del trabajo de grado para aprobación</p>
            <a href="agregartesisUC.php" class="btn btn-primary">Cargar Información</a>
        </div>
    </div>
</div>

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
                    <th scope="col">Archivo</th>
                    <th scope="col">Estado Asesor</th>
                    <th scope="col">Conclusión Asesor</th>
                    <th scope="col">Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trabajos as $trabajo): ?>
                    <tr>
                        <form method="POST" action="actualizar_estado_asesor.php">
                            <td><?= htmlspecialchars($trabajo['id_trabajo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['titulo']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor1']) ?></td>
                            <td><?= htmlspecialchars($trabajo['autor2']) ?></td>
                            <td><?= htmlspecialchars($trabajo['fecha_trabajo']) ?></td>
                            <td>
                                <a href="<?= htmlspecialchars($trabajo['archivo']) ?>" target="_blank">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </td>
                            <td>
                                <select name="estado_asesor" class="form-select">
                                    <option value="Pendiente" <?= ($trabajo['estado_asesor'] == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                                    <option value="Aprobado" <?= ($trabajo['estado_asesor'] == 'Aprobado') ? 'selected' : '' ?>>Aprobado</option>
                                    <option value="Rechazado" <?= ($trabajo['estado_asesor'] == 'Rechazado') ? 'selected' : '' ?>>Rechazado</option>
                                </select>
                            </td>
                            <td>
                                <textarea name="conclusion_asesor" id="conclusion_asesor"><?= htmlspecialchars($trabajo['conclusion_asesor']) ?></textarea>
                            </td>
                            <td>
                                <input type="hidden" name="id_trabajo" value="<?= htmlspecialchars($trabajo['id_trabajo']) ?>">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</main>
</body>
</html>
