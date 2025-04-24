<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
    header('Location:login.html');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Registro</h5>
        </div>
        <div class="card-body">
            <form id="buscarForm">
                <!-- Buscar Correo -->
                <div class="mb-3">
                    <label for="buscarCorreo" class="form-label">Buscar Correo</label>
                    <input type="text" class="form-control" id="buscarCorreo" placeholder="Ingrese el correo">
                </div>
                <!-- Correo Encontrado y Rol -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="correoEncontrado" class="form-label">Correo encontrado</label>
                        <input type="text" class="form-control" id="correoEncontrado" placeholder="Correo encontrado" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-select" id="rol">
                            <option value="1">Usuario</option>
                            <option value="3">Jefe</option>
                            <option value="4">Sistemas</option>
                        </select>
                    </div>
                </div>
                <!-- Botones -->
                <div class="mt-4">
                    <button type="button" class="btn btn-warning me-2" id="btnBuscar">Buscar</button>
                    <button type="button" class="btn btn-success me-2" id="btnActualizar">Actualizar</button>
                    <a href="cerrar.php" class="btn btn-primary">Cerrar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript -->
<script>
document.getElementById("btnBuscar").addEventListener("click", function () {
    const correo = document.getElementById("buscarCorreo").value;

    if (correo === "") {
        alert("Por favor, ingrese un correo.");
        return;
    }

    // Realizar la consulta AJAX al backend
    fetch("buscarUsuario.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `email=${correo}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar el correo y rol en los campos
            document.getElementById("correoEncontrado").value = data.email;
            document.getElementById("rol").value = data.rol;
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});

document.getElementById("btnActualizar").addEventListener("click", function () {
    const email = document.getElementById("correoEncontrado").value;
    const rol = document.getElementById("rol").value;

    if (email === "") {
        alert("Primero busque un usuario para actualizar.");
        return;
    }

    // Realizar la actualización AJAX
    fetch("actualizarUsuario.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `email=${email}&rol=${rol}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar alerta de actualización exitosa
            alert("Usuario actualizado");
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});
</script>
</body>
</html>
