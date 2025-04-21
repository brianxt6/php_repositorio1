<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexion.php');
    
    $id_trabajo = $_POST['id_trabajo'];
    $asesor = $_POST['asesor'];
    $evaluador = $_POST['evaluador'];

    try {
        $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE trabajo_grado SET asesor = :asesor, evaluador = :evaluador WHERE id_trabajo = :id_trabajo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':asesor' => $asesor, ':evaluador' => $evaluador, ':id_trabajo' => $id_trabajo]);

        echo "<script>alert('Trabajo de grado actualizado exitosamente'); window.location.href = 'ComiteUC.php';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
