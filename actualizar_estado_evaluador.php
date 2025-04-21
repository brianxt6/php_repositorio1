<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexion.php');

    // Obtener los datos del formulario
    $id_trabajo = $_POST['id_trabajo'];
    $estado_evaluador = $_POST['estado_evaluador'];
    $conclusion_evaluador = $_POST['conclusion_evaluador'];

    try {
        // Conexión a la base de datos
        $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE trabajo_grado SET estado_evaluador = :estado_evaluador, conclusion_evaluador = :conclusion_evaluador WHERE id_trabajo = :id_trabajo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':estado_evaluador' => $estado_evaluador,
            ':conclusion_evaluador' => $conclusion_evaluador,
            ':id_trabajo' => $id_trabajo
        ]);

        // Mostrar mensaje de éxito y redirigir
        echo "<script>alert('Trabajo de grado actualizado exitosamente'); window.location.href = 'evaluadorUC.php';</script>";
    } catch (PDOException $e) {
        // Si ocurre un error, mostrar mensaje
        echo "Error: " . $e->getMessage();
    }
}
?>
