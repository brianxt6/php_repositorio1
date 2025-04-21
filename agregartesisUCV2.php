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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a href="https://xolit.com/en/rocking-your-business/">
    <img src="./img/logo-1.png" alt="logo" style="height: 25px;">
    </a>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="cerrar.php">Cerrar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="container-2">

    <h2>Solicitud de permisos</h2>
    <p>Describa en los siguientes 2 campos la solicitud de permisos que desea realizar</p>

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
                <a class="btn btn-primary" href="trabajocargadoUCV2.php" required>Volver pagina anterior</a>
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


 



</body>

</html>