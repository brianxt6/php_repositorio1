<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "vendor/autoload.php";

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

        // Actualizar la solicitud
        $sql = "UPDATE resumen_solicitud 
                SET estado_sistemas = :estado_sistemas, 
                    nota_sistemas = :nota_sistemas, 
                    hora_solucion = :hora_solucion 
                WHERE id_solicitud = :id_solicitud";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':estado_sistemas' => $estado_sistemas,
            ':nota_sistemas' => $nota_sistemas,
            ':hora_solucion' => $hora_solucion,
            ':id_solicitud' => $id_solicitud
        ]);

        // Obtener los datos actualizados para el correo
        $sql = "SELECT * FROM resumen_solicitud WHERE id_solicitud = :id_solicitud";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_solicitud' => $id_solicitud]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // 🔍 Obtener el correo del usuario desde la tabla usuarios
        $sqlUsuario = "SELECT email FROM usuarios WHERE id = :usuario_id";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute([':usuario_id' => $row['usuario_id']]);
        $rowUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

        // Verificar si el correo existe
        if (empty($rowUsuario['email'])) {
            echo "Error: No se encontró el correo del usuario.";
            exit;
        }

        // 📧 Correo real del usuario
        $email = $rowUsuario['email'];

        // Crear subject con solo el ID de la solicitud
        $subject = "Respuesta a solicitud '{$row['id_solicitud']}'";

        // Crear el cuerpo del correo, organizado y con saltos de línea
        $message = '
        <div style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.3);">
          <div style="background-color: #0d6efd; color: white; padding: 16px;">
            <h4 style="margin: 0;">Respuesta a Solicitud ' . $row['id_solicitud'] . '</h4>
          </div>
          <div style="padding: 20px;">
            <p><strong>Nombre del Usuario:</strong> ' . $row['nombre_usuario'] . '</p>
            <p><strong>ID Solicitud:</strong> ' . $row['id_solicitud'] . '</p>
            <p><strong>Fecha Solicitud:</strong> ' . $row['fecha'] . '</p>
            <p><strong>Fecha de Solución:</strong> ' . $row['hora_solucion'] . '</p>
            <hr style="border: 1px solid #eee;">
            <p><strong>Título:</strong> ' . $row['titulo'] . '</p>
            <p><strong>Nota Usuario:</strong> ' . $row['nota_usuario'] . '</p>
            <hr style="border: 1px solid #eee;">
            <p><strong>Estado Jefe:</strong> ' . $row['estado_jefe'] . '</p>
            <p><strong>Nota Jefe:</strong> ' . $row['nota_jefe'] . '</p>
            <hr style="border: 1px solid #eee;">
            <p><strong>Estado Sistemas:</strong> ' . $row['estado_sistemas'] . '</p>
            <p><strong>Nota Sistemas:</strong> ' . $row['nota_sistemas'] . '</p>
          </div>
        </div>
        ';

        // Envío de correo
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->Username = "usersx2023@gmail.com";
            $mail->Password = "beikeykimzfpgzyt";

            $mail->setFrom("usersx2023@gmail.com", "Formulario Web");
            $mail->addAddress($email, $row['nombre_usuario']); // Correo real del usuario

            $mail->isHTML(true); // Esta línea activa el modo HTML
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();

            echo "<script>alert('Permiso actualizado y correo enviado exitosamente'); window.location.href = 'evaluadorUCV2.php';</script>";
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>
