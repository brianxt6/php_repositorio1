<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
    header('Location:login.html');
    exit();
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Panel de bienvenida</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>

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
        
        <br/>

        <div class="container">
            
        <div class="row justify-content-center align-items-center">
            <div class="col">
            <h2>Bienvenido usuario:  <?php echo $_SESSION['usuario_nombres']; ?></h2>
<p>Esta seccion permite el registro del trabajo de grado para aprobacion</p>
<<<<<<< HEAD
            <a href="agregartesisuc.php" class="btn btn-primary">Cargar Informacion</a>
=======
            <a href="agregartesisUC.php" class="btn btn-primary">Cargar Informacion</a>
>>>>>>> b1087344be7fe5700ee9a0d1217407c3c115c42e
        </div>

        <div
            class="row justify-content-center"
        >

            

        </div>
        


    </div>


        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

