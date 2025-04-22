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

    $sql = "SELECT id_solicitud, titulo, fecha, nombre_usuario, nota_usuario, estado_jefe, nota_jefe, estado_sistemas, nota_sistemas, aprobacion, hora_solucion FROM resumen_solicitud";

    $stmt = $pdo->query($sql);
    $trabajos = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<style>
    .my-textarea {
  height: 100px;
}
</style>

</head>
<body>
<header>
    <!-- Navbar -->
</header>
<main>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a href="https://xolit.com/en/rocking-your-business/">
    <img src="./img/logo-1.png" alt="logo" style="height:25px;">
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

<br/>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col">
            <h2>Bienvenido: <?php echo $_SESSION['usuario_nombres']; ?></h2>
            <p>Esta sección permite el aprobar los trabajos de grado del trabajo de grado</p>
            <p>Su perfil es: <button class="btn btn-primary">Analista de Sistemas</button></p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h3>Solicitudes Creadas</h3>
    <div class="table-responsive mt-2">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th>ID Trabajo</th>
                    <th>Fecha</th>
                    <th>Título</th>
                    <th>Nota[Usuario]</th>
                    <th>Estado[Jefe]</th>
                    <th>Nota[Jefe]</th>
                    <th>Estado[Sistemas]</th>
                    <th>Nota[Sistemas]</th>
                    <th>Actualizar</th>
                    <th>Hora Solucion</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($trabajos)): ?>
    <tr>
        <td colspan="10">No tienes trabajos registrados.</td>
    </tr>
<?php else: ?>
    <?php foreach ($trabajos as $trabajo): ?>
        
        <tr>
            <td><?= htmlspecialchars($trabajo['id_solicitud']) ?></td>
            <td><?= htmlspecialchars($trabajo['fecha']) ?></td>
            <td><?= htmlspecialchars($trabajo['titulo']) ?></td>
            <td><?= htmlspecialchars($trabajo['nota_usuario']) ?></td>

            
            
            <?php
        // Lógica para estado_jefe
        $estadoJefe = $trabajo['estado_jefe'] ?: 'No asignado';
        switch ($estadoJefe) {
            case 'Aprobado':
                $claseBtnJefe = 'btn-success';
                break;
            case 'Rechazado':
                $claseBtnJefe = 'btn-danger';
                break;
            default:
                $claseBtnJefe = 'btn-info';
                break;
        }

        // Lógica para estado_sistemas
        $estadoSistemas = $trabajo['estado_sistemas'] ?: 'No asignado';
        switch ($estadoSistemas) {
            case 'Aprobado':
                $claseBtnSistemas = 'btn-success';
                break;
            case 'Rechazado':
                $claseBtnSistemas = 'btn-danger';
                break;
            default:
                $claseBtnSistemas = 'btn-info';
                break;
        }
        ?>


            <td><button class="btn  <?= $claseBtnJefe ?>"><?= htmlspecialchars($trabajo['estado_jefe'] ?: 'No asignado') ?></button>
            </td>


            <td><?= htmlspecialchars($trabajo['nota_jefe'] ?: 'No asignado') ?>

            <form method="POST" action="actualizar_estado_evaluadorV2.php">

        </td>
        <?php $deshabilitar = ($trabajo['estado_sistemas'] != 'Pendiente') ? 'disabled' : ''; ?>
                            <td>
                                 <select name="estado_sistemas" class="form-select" <?= $deshabilitar ?>
                                    <option value="Pendiente" <?= ($trabajo['estado_sistemas'] == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                                    <option value="Aprobado" <?= ($trabajo['estado_sistemas'] == 'Aprobado') ? 'selected' : '' ?>>Aprobado</option>
                                    <option value="Rechazado" <?= ($trabajo['estado_sistemas'] == 'Rechazado') ? 'selected' : '' ?>>Rechazado</option>
                                </select>
                            </td>
                            <td>
    <textarea class="my-textarea"
        name="nota_sistemas" 
        id="nota_sistemas" 
        class="form-control"
        <?= $trabajo['nota_sistemas'] !== 'Pendiente Sistemas' ? 'disabled' : '' ?>
    ><?= htmlspecialchars($trabajo['nota_sistemas']) ?></textarea>
</td>
<td>
    <input type="hidden" name="id_solicitud" value="<?= htmlspecialchars($trabajo['id_solicitud']) ?>">
    <button type="submit" class="btn btn-success">Actualizar</button>
</td>
<td><?= htmlspecialchars($trabajo['hora_solucion']) ?></td>
</tr>
        
        </form>
    <?php endforeach; ?>
<?php endif; ?>
            </tbody>
        </table>
    </div>
                 

</div>

</main>
</body>
</html>
