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

    <div class="container-2">

   <div class="card-login">
   <h2>Solicitud de permisos</h2>
   <br>
    <p>Describa en los siguientes 2 campos la solicitud de permisos que desea realizar</p>
    <p>Recuerde la correcta estructura del mensaje Ejemplo:</p>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
    Titulo: Plataforma [Pagina Tropi] <br>
                       Usuario [pedro.perez] <br><br>
    Detalles: Ruta: Pedidos/Productos/Autorizados
  </div>
</div>
        <form action="enviartesisUCV2.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmSubmit()">


            <div class="input-group mb-3">
                <span class="input-group-text" style="height: 8rem;">Titulo      </span>
                <textarea class="form-control" aria-label="With textarea" name="titulo" id="titulo" required></textarea>
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

   </div>

    </div>


 



</body>

</html>