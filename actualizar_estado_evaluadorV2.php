<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexion.php');

    // Obtener los datos del formulario
    $id_solicitud = $_POST['id_solicitud'];
    $estado_sistemas = $_POST['estado_sistemas'];
    $nota_sistemas = $_POST['nota_sistemas'];
    date_default_timezone_set('America/Bogota');
    $hora_solucion = date('d/m/Y h:i:s A');

    try {
        // Conexión a la base de datos
        $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE resumen_solicitud SET estado_sistemas = :estado_sistemas, nota_sistemas = :nota_sistemas, hora_solucion = :hora_solucion WHERE id_solicitud = :id_solicitud";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':estado_sistemas' => $estado_sistemas,
            ':nota_sistemas' => $nota_sistemas,
            ':hora_solucion' => $hora_solucion,
            ':id_solicitud' => $id_solicitud
        ]);

        // Mostrar mensaje de éxito y redirigir
        echo "<script>alert('Permiso actualizado exitosamente'); window.location.href = 'evaluadorUCV2.php';</script>";
    } catch (PDOException $e) {
        // Si ocurre un error, mostrar mensaje
        echo "Error: " . $e->getMessage();
    }
}
?>
