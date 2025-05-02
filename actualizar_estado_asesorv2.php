<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexion.php');

    // Obtener los datos del formulario
    $id_solicitud = $_POST['id_solicitud'];
    $estado_jefe = $_POST['estado_jefe'];
    $nota_jefe = $_POST['nota_jefe'];

    try {
        // Conexión a la base de datos
        $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para actualizar el estado y la conclusión del asesor
        $sql = "UPDATE resumen_solicitud SET estado_jefe = :estado_jefe, nota_jefe = :nota_jefe WHERE id_solicitud = :id_solicitud";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':estado_jefe' => $estado_jefe,
            ':nota_jefe' => $nota_jefe,
            ':id_solicitud' => $id_solicitud
        ]);

        // Mostrar mensaje de éxito y redirigir
        echo "<script>alert('Permiso actualizado exitosamente'); window.location.href = 'asesorucv2.php';</script>";
        

        
    } catch (PDOException $e) {
        // Si ocurre un error, mostrar mensaje
        echo "Error: " . $e->getMessage();
    }
}
?>
