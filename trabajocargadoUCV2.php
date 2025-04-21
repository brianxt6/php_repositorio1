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

    // Consulta para obtener los trabajos asociados al usuario autenticado
    $sql = "
    SELECT 
        rs.id_solicitud, 
        rs.titulo, 
        rs.fecha, 
        rs.nota_usuario, 
        rs.nota_jefe, 
        rs.estado_jefe, 
        rs.nota_sistemas, 
        rs.estado_sistemas, 
        rs.aprobacion
    FROM 
        resumen_solicitud rs
    WHERE 
        rs.usuario_id = :usuario_id
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
    <p>Esta sección permite el realizar solicitudes de permisos a las diferentes plataformas</p>
    <p>Su perfil es: <button class="btn btn-primary">Usuario Tropi</button></p>
    <a href="agregartesisUCV2.php" class="btn btn-info">Realizar Solictud</a>
    <br>

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
                    <th>Aprobacion</th>
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


            <td><button class="btn  <?= $claseBtnJefe ?>"><?= htmlspecialchars($trabajo['estado_jefe'] ?: 'No asignado') ?></button></td>
            <td><?= htmlspecialchars($trabajo['nota_jefe'] ?: 'No asignado') ?></td>
            <td><button class="btn <?= $claseBtnSistemas ?>"><?= htmlspecialchars($trabajo['estado_sistemas'] ?: 'No asignado') ?></button></td>
            <td><?= htmlspecialchars($trabajo['nota_sistemas'] ?: 'No asignado') ?></td>
            <td><?= htmlspecialchars($trabajo['aprobacion']) ?></td>
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
