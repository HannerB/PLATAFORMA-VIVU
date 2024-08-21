<?php
session_start();

require_once "cursos/clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

if (isset($_SESSION['user_id'])) {
  $id_ = $_SESSION['user_id'];
  $tildes = $conexion->query("SET NAMES 'utf8'");
  $sql="SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, 
  fechaRegistro, rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img, centro 
  FROM users WHERE id = $id_";
  $result_login = mysqli_fetch_row(mysqli_query($conexion,$sql));
  $user = null;

  if (count($result_login) > 0) {
    $user = $result_login;
  }
}

$id=$_GET['id'];

$sql="SELECT id, nombre_grupo, tipo_archivo, nombre_archivo FROM grupos where id='$id'";
$res = mysqli_fetch_array(mysqli_query($conexion,$sql));


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UFT-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Editar grupo | Oferta Complementaria</title>
  <link rel="icon" href="assets/logoSena.png">
  <meta property="og:title" content="Cursos | Oferta Complementaria">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

  <meta name="csrf-token" content="sD0hPoBuliGFd5InGhre2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />
  <link rel="stylesheet" media="all" href="assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="assets/grupos.css" />
  <script src="assets/general.js" data-turbolinks-track="reload"></script>
  <style type="text/css">
  .footer_new {
    bottom: 0;
    text-align: center;
    font-size: 15px;
    width: 100%;
    height: 50px; /* Set the fixed height of the footer here */
    line-height: 44px; /* Vertically center the text there */
    background-color: #FF6C00;
    color: white;
  }
</style>
</head>
<body>
<?php if(!empty($user) && ($user[9]=='1')): ?>
    
    <!-- menu-->
    <?php include 'header_admin.php'; ?>

    <div class="mt-1 PopUpContainer">
      <div class="contentContainer">
        <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li><a href="cursos.php">Grupos</a></li><li class="active">Editar Grupo: <?php echo $res['nombre_grupo']; ?></li></ol>
      </div>
      <?php include 'popupLogin_admin.php'; ?>
    </div>

    <!--<div class="contenedor-vistas">-->
    <div class="container">
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    Información del grupo
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" src="http://www.vivu.com.co/assets/<?php echo $res['nombre_archivo'];?>" alt="Defaultimage" />
                    </div>
                    <div class="col-md-8 container">
                        <div class="container">
                            <h3 class="text-center">Editar datos del curso</h3>
                            <hr>
                            <form class="" id="editarGrupo" enctype="multipart/form-data" action="cursos/procesos/editarGrupo.php" accept-charset="UTF-8" method="post">
                                <div class="form-group grupo_nombre">
                                    <label class="control-label" for="grupo_nombre">Nombre del grupo</label>
                                    <input class="form-control" type="text" value="<?php echo $res['nombre_grupo']; ?>" name="txtNombre" id="txtNombre"/>
                                </div>
                                <div class="form-group file optional grupo_avatar">
                                    <label class="control-label file optional" for="grupo_avatar">Logo del grupo</label>
                                    <input class="file optional" type="file" name="archivo" id="grupo_avatar" value="">
                                    <p class="help-block">PNG, GIF o JPG. Máximo 4MB. Será escalado a 100px</p>
                                </div>
                                <input type="hidden" name="txtCodigo" value="<?php echo $res['id']; ?>">
                                <input type="hidden" name="txtImg" value="">
                                <center><input type="submit" name="commit" value="Editar grupo" class="btn btn-outline-primary btn-block"></center>
                            </form>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

<?php endif; ?>

<footer class="footer_new">
  <div class="container">
    <span class="">Todos los derechos <?php echo '&copy'; echo date("Y"); ?>  SENA - Políticas de privacidad y condiciones uso Portal Web SENA</span>
  </div>
</footer>

    <!-- Demo ads. Please ignore and remove. -->
    <script src="http://cdn.tutorialzine.com/misc/enhance/v2.js" async></script>
    <!-- ====== Pie de pagina ======-->
    <link rel="stylesheet" href="assets/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://www.vivu.com.co/assets/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>
</html>
