<?php
session_start(); // Asegúrate de que la sesión está iniciada

if (!isset($_SESSION['usuario_id'])) {
    // Redirige al login si no hay sesión activa
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('conexion.php');
    $errores = array();
    $success = false;

    // Asignación de variables del formulario
    $titulo = $_POST['titulo'] ?? null;
    $autor1 = $_POST['autor1'] ?? null;
    $autor2 = $_POST['autor2'] ?? null;
    $fecha_trabajo = $_POST['fecha_trabajo'] ?? null;
    $pclave1 = $_POST['pclave1'] ?? null;
    $pclave2 = $_POST['pclave2'] ?? null;
    $pclave3 = $_POST['pclave3'] ?? null;
    $pclave4 = $_POST['pclave4'] ?? null;
    $pclave5 = $_POST['pclave5'] ?? null;
    $pclave6 = $_POST['pclave6'] ?? null;
    $resumen = $_POST['resumen'] ?? null;
    $abstract = $_POST['abstract'] ?? null;
    $usuario_id = $_SESSION['usuario_id']; // Obtiene el ID del usuario actual

    // Verificar si se ha cargado el archivo
    $archivo = null;
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
        $nombre_original = pathinfo($_FILES['archivo']['name'], PATHINFO_FILENAME);
        $nombre_archivo = date('YmdHis') . '_' . $nombre_original . '.' . $ext;
        $ruta_destino = 'uploads/' . $nombre_archivo;

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_destino)) {
            $archivo = $ruta_destino;
        } else {
            $errores[] = "Hubo un problema al subir el archivo.";
        }
    }

    try {
        $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO `trabajo_grado` 
        (`titulo`, `autor1`, `autor2`, `fecha_trabajo`, `resumen`, `abstract`, `archivo`, 
        `pclave1`, `pclave2`, `pclave3`, `pclave4`, `pclave5`, `pclave6`, `usuario_id`) 
        VALUES (:titulo, :autor1, :autor2, :fecha_trabajo, :resumen, :abstract, :archivo, 
        :pclave1, :pclave2, :pclave3, :pclave4, :pclave5, :pclave6, :usuario_id)";

        $resultado = $pdo->prepare($sql);
        $resultado->execute(array(
            ':titulo' => $titulo,
            ':autor1' => $autor1,
            ':autor2' => $autor2,
            ':fecha_trabajo' => $fecha_trabajo,
            ':resumen' => $resumen,
            ':abstract' => $abstract,
            ':archivo' => $archivo,
            ':pclave1' => $pclave1,
            ':pclave2' => $pclave2,
            ':pclave3' => $pclave3,
            ':pclave4' => $pclave4,
            ':pclave5' => $pclave5,
            ':pclave6' => $pclave6,
            ':usuario_id' => $usuario_id,
        ));

        $success = true;
    } catch (PDOException $e) {
        $errores[] = "Error: " . $e->getMessage();
    }

    if ($success) {
        header("Location: trabajocargadoUC.php");
        exit();
    } else {
        foreach ($errores as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>
