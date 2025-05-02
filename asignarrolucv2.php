<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
    header('Location:login.html');
    exit();
}

include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
        }
        .card {
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0"></ul>
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
        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h2>Asignación de roles</h2>
                    <br>
                    <form id="buscarForm">
                        <!-- Buscar Cédula -->
                        <div class="mb-3">
                            <label for="buscarCedula" class="form-label">Buscar Cédula</label>
                            <input type="text" class="form-control" id="buscarCedula">
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="emailEncontrado" class="form-label">Correo encontrado</label>
                                <input type="text" class="form-control mb-3" id="emailEncontrado" readonly>
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
                                <label for="nombreEncontrado" class="form-label">Nombre encontrado</label>
                                <input type="text" class="form-control mb-3" id="nombreEncontrado" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="cedulaEncontrada" class="form-label">Cédula encontrada</label>
                                <input type="text" class="form-control mb-3" id="cedulaEncontrada" readonly>
                            </div>
                        </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("btnBuscar").addEventListener("click", function () {
    const cedula = document.getElementById("buscarCedula").value;

    if (cedula === "") {
        alert("Por favor, ingrese una cédula.");
        return;
    }

    fetch("buscarusuariov2.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `cc=${cedula}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("emailEncontrado").value = data.email;
            document.getElementById("rol").value = data.rol;
            document.getElementById("nombreEncontrado").value = data.nombres;  // Cambié 'nombre' por 'nombres'
            document.getElementById("cedulaEncontrada").value = data.cc;
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});

document.getElementById("btnActualizar").addEventListener("click", function () {
    const cc = document.getElementById("buscarCedula").value;
    const rol = document.getElementById("rol").value;

    if (cc === "") {
        alert("Primero busque un usuario para actualizar.");
        return;
    }

    fetch("actualizarusuariov2.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `cc=${cc}&rol=${rol}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
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
