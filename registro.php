<?php
   if($_SERVER["REQUEST_METHOD"]=="POST"){
       include('conexion.php');
       $errores=array();
       $success="false";
   
       $nombres=(isset($_POST['nombres']))? $_POST['nombres']:null;
       $apellidos=(isset($_POST['apellidos']))? $_POST['apellidos']:null;
       $email=(isset($_POST['email']))? $_POST['email']:null;
       $password=(isset($_POST['password']))? $_POST['password']:null;
       $confirmarpassword=(isset($_POST['confirmarpassword']))? $_POST['confirmarpassword']:null;
   
       if(empty($nombres)){
           $errores['nombres']="El campo nombres no puede estar vacio";
       }
       if(empty($apellidos)){
           $errores['apellidos']="El campo apellidos no puede estar vacio";
       }
   
       if(empty($email)){
           $errores['email']="El campo email no puede estar vacio";
   
       }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errores['email']='Formato de Email incorrecto';
       }
   
       if(empty($password)){
           $errores['password']="El campo password no puede estar vacio";
       }
   
       if(empty($confirmarpassword)){
           $errores['confirmarpassword']="El campo confirmar contraseña no puede estar vacio";
       }elseif($password!=$confirmarpassword){
           $errores['confirmarpassword'] = "Las contraseñas no coinciden";
       }
   
       foreach($errores as $error){
           echo "<br/>".$error."<br/>";
       }
   
       if(empty($errores)){
   
       try{
        
           $pdo=new PDO('mysql:host='.$direccionservidor.'; dbname='.$baseDatos,$usuarioBD, $contraseniaBD);
           $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
           $nuevopassword=password_hash($password, PASSWORD_DEFAULT);
   
           $sql="INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `password`, `rol`) VALUES (NULL,:nombres,:apellidos,:email,:password,1);";
           $resultado=$pdo->prepare($sql);
           $resultado->execute(array(
               ':nombres' => $nombres,
               ':apellidos' => $apellidos,
               ':password' => $nuevopassword,
               ':email' => $email,
           ));
           //header("Location:login.html");
           $success="true";
   
       }catch(PDOExeption $e){
           echo "Error".$e->getMessage();
       }
   }else{
       echo "No se registraron los datos, pongase en contacto con el administrador";
   }
   
   }
   
   //-----------------------------------------------------HTML------------------------------
   ?>

<!doctype html>
<html lang="es">
   <head>
      <title>Title</title>
      <!-- Required meta tags -->
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Bootstrap CSS v5.2.1 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
   </head>
   <body>
      <header>
         <!-- place navbar here -->
      </header>
      <main>
         <div class="container mt-5">
            <div class="row justify-content-center">
               <div class="col md-8 col-lg-8">
                  <!------------------ALERTA BOOTSTRAP-------------------------->
                  <?php if(isset($success)) {?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     <strong>Registro logrado con exito!</strong> Puede logearse ahora. En el siguiente enlace: <a href="login.html" class="btn btn-success">Login</a>
                  </div>
                  <?php } ?>
                  <!------------------ALERTA BOOTSTRAP-------------------------->
                  <div class="card">
                     <div class="card-header">Registro</div>
                     <div class="card-body">
                        <form action="registro.php" method="post" id="formularioderegistro">
                           <div class="row mb-3">
                              <div class="col">
                                 <div class="mb-3">
                                    <label for="" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="" />
                                 </div>
                              </div>
                              <div class="col">
                                 <div class="mb-3">
                                    <label for="" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="" />
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col">
                                 <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" />
                                 </div>
                              </div>
                              <div class="col">
                                 <div class="mb-3">
                                    <label for="" class="form-label">Repetir Password</label>
                                    <input type="password" class="form-control" name="confirmarpassword" id="confirmarpassword" aria-describedby="helpId" placeholder="" />
                                    <div class="invalid-feedback">Las constraseñas no coinciden</div>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="" class="form-label">Correo</label>
                              <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="correo@uc.edu.co" />
                           </div>
                           <button type="submit" class="btn btn-success">Registrarme</button>
                           <a href="login.html" class="btn btn-primary">Login</a>
                        </form>
                     </div>
                     <div class="card-footer text-muted"></div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <footer>
         <!-- place footer here -->
      </footer>
      <!-- Bootstrap JavaScript Libraries -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
      <script>
         document.addEventListener('DOMContentLoaded', function(){
                     document.getElementById("formularioderegistro").addEventListener('submit', function(event){
         
                     var password = document.getElementById("password").value;
                     var confirmarpassword =document.getElementById("confirmarpassword").value;
         
                     if(password !== confirmarpassword){
                         document.getElementById('confirmarpassword').classList.add('is-invalid');
                         event.preventDefault();
                     }else{
                         document.getElementById('confirmarpassword').classList.remove('is-invalid');
                     }
         
                     });
                 });
      </script>
   </body>
</html>