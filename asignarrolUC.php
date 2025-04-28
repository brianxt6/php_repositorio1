<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
    header('Location:login.html');
    exit();
}

include('conexion.php');

    $nombre_encontrado="";
    $cedula_encontrada="";

    $sql = ""


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
    body {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
    }

    .card{
      padding: 15px;
      border-radius: 16px;
    }



      </style>

</head>
<body>

<header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
  <a href="https://xolit.com/en/rocking-your-business/" class="navbar-brand">
    <img src="./img/logo-1.png" alt="logo" style="height: 25px;">
  </a>

  <!-- Botón colapsable para móviles -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Menú colapsable -->
  <div class="collapse navbar-collapse" id="collapsibleNavId">
    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
      <!-- Aquí puedes agregar más elementos del menú -->
    </ul>

    <!-- Botón cerrar (siempre visible) -->
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link active text-danger fw-bold" href="cerrar.php">
          <i class="fas fa-sign-out-alt"></i> Cerrar
        </a>
      </li>
    </ul>
  </div>
</nav>

      </header>

<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col md-8 col-lg-8">
    <div class="card">
            <div class="card-body">
            <h2>Asignación de roles</h2>
            <br>
            <form id="buscarForm">
                <!-- Buscar Correo -->
                <div class="mb-3">
                    <label for="buscarCorreo" class="form-label">Buscar Cedula</label>
                    <input type="text" class="form-control" id="buscarCorreo">
                </div>

                <hr class="my-4">
                <!-- Correo Encontrado y Rol -->
                
                <div class="row">
                    <div class="col-md-6">
                        <label for="correoEncontrado" class="form-label">Correo encontrado</label>
                        <input type="text" class="form-control mb-3" id="correoEncontrado" placeholder="Correo encontrado" readonly>
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
                
                <div class="row">
                    <div class="col-md-6">
                        <label for="correoEncontrado" class="form-label">Nombre encontrado</label>
                        <input type="text" class="form-control mb-3" id="correoEncontrado" placeholder="Nombre encontrado" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="correoEncontrado" class="form-label">Cedula encontrada</label>
                        <input type="text" class="form-control mb-3" id="correoEncontrado" placeholder="Cedula encontrada" readonly>
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
