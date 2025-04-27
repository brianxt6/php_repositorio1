
<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}


?>


<style>



  .additional-items a {
    color: antiquewhite;
    list-style: none;
  }

  .container-2{
    width: 60%;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    height: 100vh;
  }

.superior h2, h3{
    text-align: center;
}

footer{
    grid-area: footer;
}

.footer {
    background-color: #333;
    color: #fff;
    width: 100vw;
    margin-left: auto;
    margin-right: auto;
}
  
  .footer h3 {
    color: #fff;
  }

  
  .footer ul {
    padding: 0;
  }
  
  .footer ul li {
    list-style-type: none;
  }
  
  .footer ul li a {
    color: #fff;
    text-decoration: none;
  }
  
  .footer ul li a:hover {
    text-decoration: underline;
  }
  
  main h2{
    color: white;
}

.container h5{
    margin-top: 20px;
}

.bg-dark text-light py-4{
    width: 100%;
}

@media only screen and (max-width: 600px){
    .container-2{
        width: 95%;
      }
}

</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Agregar_tesis.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

        <style>
    body {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
    }

    .card-login {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 100%;
    }

      </style>

</head>

<body>

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

    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link active text-danger fw-bold" href="cerrar.php">
          <i class="fas fa-sign-out-alt"></i> Cerrar
        </a>
      </li>
    </ul>
  </div>
</nav>

    <div class="container-2">

   <div class="card-login">
   <h2>Solicitud de permisos</h2>
<br>
    <div class="accordion mb-3" id="accordionExample">
    <div>
    </h2>
    </div>

    <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Ejemplo de como crear la solicitud.
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Titulo: </strong>Permisos área facturación <br>
        <strong>Plataforma: </strong>Siesa <br>
        <strong>Usuario: </strong>pedro.perez<br>
        <strong>Detalles: </strong>Ruta: pedidos/cancelados<br>

      </div>
    </div>
  </div>

</div>


</div>
        <form action="enviartesisUCV2.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmSubmit()">


            <div class="input-group mb-3 mt-3">
              <span class="input-group-text">Titulo:</span>
              <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="titulo" id="titulo" required>
            </div>

            <div class="input-group mb-4">
                <select class="form-select" aria-label="Default select example" name="plataforma" id="plataforma" required>
                    <option value="" selected disabled>Plataforma</option>
                    <option value="Siesa">Siesa</option>
                    <option value="Pimovi">Pimovi</option>
                    <option value="Pagina">Pagina Tropi</option>
                    <option value="Inlog">Inlog</option>
                </select>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Usuario:</span>
              <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="name_usuario" id="name_usuario" required>
            </div>

            <div class="input-group mb-4">
                <span class="input-group-text" style="height: 8rem;">Detalles   </span>
                <textarea class="form-control" aria-label="With textarea" name="nota_usuario" id="nota_usuario" required></textarea>
            </div>

            <div class="text">
                <a class="btn btn-info" href="trabajocargadoUCV2.php" required>Volver pagina anterior</a>
                <a href=""></a>
                <button type="submit" class="btn btn-primary">Enviar Formulario</button>
            </div>
            <br>

    </form>
    
    <script>
    function confirmSubmit() {
        // Muestra un cuadro de confirmación
        var confirmation = confirm("¿Desea confirmar el envío del formulario? Por favor revise que la informacion esta diligenciada correctamente, si esta seguro presione ACEPTAR de lo contrario presione CANCELAR");
        
        // Si el usuario hace clic en "Aceptar", se envía el formulario
        // Si hace clic en "Cancelar", el formulario no se envía
        return confirmation;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

   </div>

    </div>


 

<br>

</body>

</html>