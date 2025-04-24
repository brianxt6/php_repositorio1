<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include('conexion.php');

    $errores = array();

    $email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : null;
    $password = (isset($_POST['password'])) ? $_POST['password'] : null;

    if (empty($email)) {
        $errores['email'] = "El campo email no puede estar vacío";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Formato de Email incorrecto';
    }

    if (empty($password)) {
        $errores['password'] = "El campo contraseña no puede estar vacío";
    }

    if (empty($errores)) {
        try {
            $pdo = new PDO('mysql:host=' . $direccionservidor . '; dbname=' . $baseDatos, $usuarioBD, $contraseniaBD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(['email' => $email]);

            $user = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Guardar información del usuario en la sesión
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombres'] = $user['nombres'] . " " . $user['apellidos'];
                $_SESSION['usuario_rol'] = $user['rol'];

                // Redirigir según el rol
                switch ($user['rol']) {
                    case 1:
                        // Validar si el usuario ya tiene un trabajo de grado
                        $sqlCheck = "SELECT COUNT(*) FROM trabajo_grado WHERE usuario_id = :usuario_id";
                        $stmtCheck = $pdo->prepare($sqlCheck);
                        $stmtCheck->execute(['usuario_id' => $user['id']]);
                        $hasTrabajo = $stmtCheck->fetchColumn();

                        if ($hasTrabajo > 0) {
                            header("Location: trabajocargadoUCV2.php");
                        } else {
                            header("Location: trabajocargadoUCV2.php");
                        }
                        break;

                    case 2:
                        header("Location: comiteUC.php");
                        break;

                    case 3:
                        header("Location: asesorUCV2.php");
                        break;

                    case 4:
                        header("Location: evaluadorUCV2.php");
                        break;
                    
                    case 5:
                        header("Location: asignarrolUC.php");
                        break;

                    default:
                        echo "Rol no válido.";
                        break;
                }
                exit();
            } else {
                echo "Credenciales incorrectas.";
                echo "<br><a href='login.html'>Regresar al formulario de inicio</a>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Mostrar errores del formulario
        foreach ($errores as $error) {
            echo "<br>" . $error . "</br>";
        }
        echo "</br><a href='login.html'>Regresar al formulario de inicio</a>";
    }
}
?>
