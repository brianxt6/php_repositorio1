<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexion.php');

    // Obtener los datos del formulario
    $id_trabajo = $_POST['id_trabajo'];
    $estado_asesor = $_POST['estado_asesor'];
    $conclusion_asesor = $_POST['conclusion_asesor'];

    try {
        // Conexión a la base de datos
        $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para actualizar el estado y la conclusión del asesor
        $sql = "UPDATE trabajo_grado SET estado_asesor = :estado_asesor, conclusion_asesor = :conclusion_asesor WHERE id_trabajo = :id_trabajo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':estado_asesor' => $estado_asesor,
            ':conclusion_asesor' => $conclusion_asesor,
            ':id_trabajo' => $id_trabajo
        ]);

        // Mostrar mensaje de éxito y redirigir
        echo "<script>alert('Trabajo de grado actualizado exitosamente'); window.location.href = 'cf.php';</script>";
    } catch (PDOException $e) {
        // Si ocurre un error, mostrar mensaje
        echo "Error: " . $e->getMessage();
    }
}
?>
