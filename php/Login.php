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
session_start();
if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
if(isset($_POST['login'])){
    $u = $_POST['usuario'];
    $c = $_POST['clave']; 

    if($u == "" || $c == ""){ 
        echo "<script>alert('Error: usuario y/o clave vacios!!');</script>";
    }else{
        $sql = "SELECT * FROM usuario WHERE usuario = '$u' AND AES_DECRYPT(clave,'tarea') = '$c'";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{
            $filas = mysqli_num_rows($consulta);
            if($filas == 0){
                echo "<script>alert('Error: usuario y/o clave incorrectos!!');</script>";
            }else{
			   while ($fila = $consulta->fetch_assoc()) {
					$_SESSION['idusuario'] = $fila["idusuario"];
					$_SESSION['usuario'] = $fila["usuario"];
				}
                echo "<script>alert('Usuario correcto !!');window.location.href = 'ListarTareas.php';</script>";
            }

        }
    }
}
?>

    <title>Login</title>

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
  <form action="Login.php" method="post">
    <img class="mb-4" src="https://e7.pngegg.com/pngimages/72/610/png-clipart-computer-icons-management-business-school-login-business-company-people.png" alt="" width="150" height="77">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="usuario" placeholder="Ingrese usuario">
      <label for="floatingInput">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="clave"  placeholder="Ingrese clave">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary mb-4" type="submit" name="login">Acceder</button>
	
	<div class="btn-group">
 	<a href="Usuario.php" class="btn btn-primary">Registrar Usuario</a>
	&nbsp;&nbsp
	<a href="Recordar.php" class="btn btn-primary">Recordar Contraseña</a>
</div>

    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>