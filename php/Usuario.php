<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="signin.css" rel="stylesheet">
<?php

$conexion = new mysqli('localhost', '335668', 'cenizoR1', '335668');
if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
if(isset($_POST['grabar'])){
    $u = $_POST['usuario'];
    $c = $_POST['clave']; 
    if($u == "" || $_POST['clave'] == ""){ 
        echo "<script>alert('Error: usuario y/o clave vacios!!');</script>";
    }else{
        $sql = "INSERT INTO usuario(usuario,clave) values ('$u' ,AES_ENCRYPT('$c','tarea'));";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar insert!";
        }else{
            echo "<script>alert('Se inserto el registro , inicie session !!');window.location.href = 'Login.php';</script>";
        }
    }
}
?>

    <title>Usuario</title>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="Usuario.php" method="post">
    <img class="mb-4" src="https://e7.pngegg.com/pngimages/72/610/png-clipart-computer-icons-management-business-school-login-business-company-people.png" alt="" width="150" height="77">
    <h1 class="h3 mb-3 fw-normal">Registro Usuario</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="usuario" placeholder="Ingrese usuario" maxlength="10">
      <label for="floatingInput">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="clave"  placeholder="Ingrese clave" maxlength="10">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary mb-4" type="submit" name="grabar">Grabar</button>
	
	<div class="btn-group">
 	<a href="Login.php" class="btn btn-primary">Login</a>
	</div>

    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>