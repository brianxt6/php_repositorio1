<style>


  .logo {
    width: 140px;
    height: 40px;
    background-color: #fff;
  }

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

    <nav
            class="navbar navbar-expand-lg navbar-light bg-light"
        >
            <div class="container">
            <img src="./img/logo-1.png" alt="">
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="https://uc.edu.co/" aria-current="page"
                                >Pagina Universidad
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cerrar.php" aria-current="page"
                                >Cerrar
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

    <div class="container-2">

        <form action="enviartesisUC.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmSubmit()">

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo">
            </div>


            <div class="row">
                <div class="col mb-3">
                <label for="autor1" class="form-label">Autor 1</label>
                <input type="text" class="form-control" name="autor1">
                </div>

                <div class="col mb-3">
                <label for="autor2" class="form-label">Autor 2</label>
                <input type="text" class="form-control" name="autor2">
                </div>
            </div>

            <div class="col mb-3">
                <label for="fecha" class="form-label">Fecha de culminacion de trabajo de grado:</label>
                <input type="date" class="form-control" name="fecha_trabajo">
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="pclave1" class="form-label">Palabra Clave 1</label>
                    <input type="text" class="form-control" name="pclave1">
                </div>

                <div class="col mb-3">
                <label for="pclave2" class="form-label">Palabra Clave 2</label>
                <input type="text" class="form-control" name="pclave2">
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                <label for="pclave3" class="form-label">Palabra Clave 3</label>
                <input type="text" class="form-control" name="pclave3">
                </div>

                <div class="col mb-3">
                <label for="pclave4" class="form-label">Palabra Clave 4</label>
                <input type="text" class="form-control" name="pclave4">
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                <label for="pclave5" class="form-label">Palabra Clave 5</label>
                <input type="text" class="form-control" name="pclave5">
                </div>

                <div class="col mb-3">
                <label for="pclave6" class="form-label">Palabra Clave 6</label>
                <input type="text" class="form-control" name="pclave6">
                </div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" style="height: 8rem;">Resumen</span>
                <textarea class="form-control" aria-label="With textarea" name="resumen"></textarea>
            </div>

            <div class="input-group mb-4">
                <span class="input-group-text" style="height: 8rem;">Abstract  </span>
                <textarea class="form-control" aria-label="With textarea" name="abstract"></textarea>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Trabajo final</label>
                <input class="form-control mb-3" type="file" id="archivo" name="archivo">
            </div> 

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar Formulario</button>
            </div>
            <br>

    </form>
    
    <script>
    function confirmSubmit() {
        // Muestra un cuadro de confirmación
        var confirmation = confirm("¿Desea confirmar el envío del formulario? Por favor revise que todos los campos estén completos, si esta seguro presion ACEPTAR de lo contrario presione CANCELAR");
        
        // Si el usuario hace clic en "Aceptar", se envía el formulario
        // Si hace clic en "Cancelar", el formulario no se envía
        return confirmation;
    }
</script>


    </div>


 



</body>

</html>