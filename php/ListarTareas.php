<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Listado de Tareas</title>
   	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

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
    <link href="navbar-top.css" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Listado de Tareas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" href="Tarea.php">Nueva Tarea</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="CerrarSession.php">Cerrar Session</a>
        </li>
       
      </ul>
     
    </div>
  </div>
</nav>

<main class="container">
  <div class="bg-light p-5 rounded">
    
<form class="row g-3" action="ListarTareas.php" method="post">
  <div class="col-auto">
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Estado:">
  </div>
  <div class="col-auto">
    <select name="prioridad" class="form-select">
	  <option value="%">Todos</option>
	  <option value="Pendiente">Pendiente</option>
	  <option value="Vencida">Vencida</option>
	  <option value="Archivada">Archivada</option>
	</select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3" name="buscar">Buscar</button>
  </div>
</form>

<br/>

<table class="table table-striped">
<tr>
<td> Titulo </td>
<td> Contenido</td>
<td> Fecha Registro</td>
<td> Fecha Vencimiento</td>
<td> Prioridad</td>
<td> Estado</td>
<td> Accion</td>
</tr>

<?php
$conexion = new mysqli('localhost', '335668', 'cenizoR1', '335668');
session_start();

if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}

$u = $_SESSION['idusuario'];
$filtro = "%";
if(isset($_POST['buscar'])){
    $filtro  = $_POST['prioridad'];
}

$sql = "select * from (".
" SELECT idtarea,titulo,contenido,fecharegistro,fechavencimiento,prioridad,".
" case when estado = 'Pendiente' and now() >= fechavencimiento  then 'Vencida' else estado end as estadofinal".
" FROM tarea where idusuario=$u order by fechavencimiento desc,prioridad asc) a where a.estadofinal like '$filtro'";

if(!$consulta = $conexion->query($sql)){
	echo "ERROR: no se pudo ejecutar la consulta!";
}else{
	$filas = mysqli_num_rows($consulta);
	if($filas == 0){
		echo "<script>alert('No existe tareas!!');</script>";
	}else{
	   while ($fila = $consulta->fetch_assoc()) {		   
		   echo "<tr><td>".$fila["titulo"]."</td><td> ".$fila["contenido"]."</td><td> ".$fila["fecharegistro"]."</td><td> ".$fila["fechavencimiento"].
		   "</td><td>  ".$fila["prioridad"]."</td><td>  ".$fila["estadofinal"]."</td>".
		   "<td> <a href='GestionTarea.php?accion=eliminar&id=".$fila["idtarea"]."'>Eliminar</a>&nbsp;<a href='GestionTarea.php?accion=archivar&id=".$fila["idtarea"]."'>Archivar</a>";
		   if($fila["estadofinal"]=="Pendiente"){
		   echo "&nbsp;<a href='GestionTarea.php?accion=modificar&id=".$fila["idtarea"]."'>Modificar</a>";
		   }
		   echo "</td></tr>";
		}
	}
}

?>
</table>


  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
  </body>
</html>