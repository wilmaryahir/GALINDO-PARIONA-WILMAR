<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Gestionar  Tareas</title>
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
	<?php
$conexion = new mysqli('localhost', '335668', 'cenizoR1', '335668');
session_start();

if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
if(isset($_GET['accion'])){
    if($_GET['accion'] == "eliminar"){ 
        $sql = "delete from tarea where idtarea=".$_GET['id'].";";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar eliminacion!";
        }else{
            echo "<script>alert('Se elimino la tarea !!');window.location.href = 'ListarTareas.php';</script>";
        }
    }
	 if($_GET['accion'] == "archivar"){ 
        $sql = "update tarea set estado='Archivada' where idtarea=".$_GET['id'].";";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar eliminacion!";
        }else{
            echo "<script>alert('Se actualizo la tarea !!');window.location.href = 'ListarTareas.php';</script>";
        }
    }
}
if(isset($_POST['grabar'])){
    if($_POST['titulo'] == "" || $_POST['contenido'] == "" || $_POST['vencimiento'] == "" || $_POST['id'] == ""){ 
        echo "<script>alert('Ingrese los campos tareas!!');</script>";
    }else{
		$sql = "UPDATE tarea set  contenido='".$_POST['contenido']."',fechavencimiento='".$_POST['vencimiento']."' where idtarea=".$_POST['id'].";";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar actualizar!";
        }else{
            echo "<script>alert('Se actualizo la tarea !!');window.location.href = 'ListarTareas.php';</script>";
        }
    }
}
?>


  </head>
  <body>
   

   
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Modificar Tarea</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" href="ListarTareas.php">Listar Tareas</a>
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

<?php
if(isset($_GET['accion']) && $_GET['accion'] == "modificar"){
	
	    $sql = "SELECT * FROM tarea WHERE idtarea = ".$_GET['id'];
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{
		   while ($fila = $consulta->fetch_assoc()) {
			
?>

<form  action="GestionTarea.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Titulo</label>
    <input type="text" class="form-control" name="titulo" readonly="readonly" value='<?php echo  $fila['titulo'];?>'/>
	 <input type="hidden" name="id"  value='<?php echo $_GET['id'];?>' />
  </div>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Contenido</label>
    <textarea name="contenido" class="form-control" rows="3" cols="20"><?php echo  $fila['contenido'];?></textarea>
  </div>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Fecha Vencimiento</label>
   <input type="date" name="vencimiento"  class="form-control"  value='<?php echo $fila['fechavencimiento'];?>'/>
  </div>
  <button type="submit" class="btn btn-primary" name="grabar">Grabar</button>
</form>
<?php
 }  } }
?>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
  </body>
</html>