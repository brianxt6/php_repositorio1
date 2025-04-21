<?php
// Paso 1: Configuración de la conexión
$servername = "localhost"; // Cambia por tu servidor
$username = "root";        // Cambia por tu usuario
$password = "";            // Cambia por tu contraseña
$dbname = "sistema2";      // Nombre de tu base de datos

// Paso 2: Conectar a la base de datos con manejo de excepciones
try {
    // Crear conexión utilizando el constructor de mysqli
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    // Paso 3: Verificar si se ha solicitado eliminar un usuario
    if (isset($_GET['delete_id'])) {
        $delete_id = (int) $_GET['delete_id'];
        $delete_sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "<script>alert('Usuario eliminado correctamente'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar usuario');</script>";
        }
        $stmt->close();
    }

    // Paso 4: Realizar la consulta para obtener los usuarios
    $sql = "SELECT id, nombres, apellidos FROM usuarios";
    $result = $conn->query($sql);

    // Paso 5: Mostrar los resultados en una tabla HTML
    if ($result->num_rows > 0) {
        // Inicia la tabla HTML
        echo "<table border='1'><tr><th>ID</th><th>Nombres</th><th>Apellidos</th><th>Acciones</th></tr>";

        // Mostrar los datos fila por fila
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";          // Mostrar el ID
            echo "<td>" . htmlspecialchars($row['nombres']) . "</td>";     // Mostrar los nombres
            echo "<td>" . htmlspecialchars($row['apellidos']) . "</td>";   // Mostrar los apellidos

            // Columna con botones para editar y eliminar
            echo "<td>
                    <a href='editar.php?id=" . $row['id'] . "'><button>Editar</button></a>
                    <a href='?delete_id=" . $row['id'] . "'><button>Eliminar</button></a>
                  </td>";
            echo "</tr>";
        }

        echo "</table>"; // Cierra la tabla
    } else {
        echo "No hay resultados.";
    }

} catch (Exception $e) {
    // Si hay un error, lo capturamos y mostramos un mensaje
    echo "Error: " . $e->getMessage();
} finally {
    // Paso 6: Cerrar la conexión
    if (isset($conn)) {
        $conn->close();
    }
}
?>
