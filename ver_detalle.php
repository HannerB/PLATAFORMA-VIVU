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
$tildes = $conexion->query("SET NAMES 'utf8'");

$sql="SELECT G.nombre_archivo, C.id, C.codigo_curso, LOWER(C.curso) As curso_m, C.curso, C.jornada, C.horario, C.intensidad, C.fecha_inicio, C.municipio, C.direccion, C.formacion, C.centro, C.descripcion, UPPER(C.nombre_grupo) As nombre_grupo, C.estado FROM cursos C, grupos G where C.nombre_grupo = G.nombre_grupo AND C.codigo_curso='$id'";
$res = mysqli_fetch_array(mysqli_query($conexion,$sql));


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UFT-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Ver Detalle | Oferta Complementaria</title>
  <link rel="icon" href="assets/logoSena.png">
  <meta property="og:title" content="Cursos | Oferta Complementaria">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

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

    <?php if ($user[9]=='1'): ?>
     <!-- contenido para Administrador -->
    <?php include 'header_admin.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
            <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li><a href="cursos.php">Cursos</a></li><li class="active">Ver Detalle: <?php echo $res['curso_m']; ?></li></ol>
    </div>
        <!-- ====== PopUpLogin ======-->
        <?php include 'popupLogin_admin.php'; ?>
    </div>
    <?php elseif ($user[9]=='2'): ?>
        <!-- contenido para Aprendiz -->
        <?php include 'header_aprendiz.php'; ?>
        <div class="mt-4 PopUpContainer">
            <div class="contentContainer">
            <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li><a href="cursos.php">Cursos</a></li><li class="active">Ver Detalle: <?php echo $res['curso_m']; ?></li></ol>
        </div>
            <!-- ====== PopUpLogin ======-->
            <?php include 'popupLogin_aprendiz.php'; ?>
        </div>
    <?php elseif ($user[9]=='3'): ?>
        <!-- contenido para Orientador -->
        <?php include 'header_orientador.php'; ?>
        <div class="mt-4 PopUpContainer">
            <div class="contentContainer">
            <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li><a href="cursos.php">Cursos</a></li><li class="active">Ver Detalle: <?php echo $res['curso_m']; ?></li></ol>
        </div>
            <!-- ====== PopUpLogin ======-->
            <?php include 'popupLogin_orientador.php'; ?>
        </div>
    <?php elseif ($user[9]=='4'): ?>
        <!-- contenido para GESTOR -->
        <?php include 'header_gestor.php'; ?>
        <div class="mt-4 PopUpContainer">
            <div class="contentContainer">
            <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li><a href="cursos.php">Cursos</a></li><li class="active">Ver Detalle: <?php echo $res['curso_m']; ?></li></ol>
        </div>
            <!-- ====== PopUpLogin ======-->
            <?php include 'popupLogin_gestor.php'; ?>
        </div>
    <?php elseif ($user[9]=='4'): ?>
        <!-- contenido para CERTIFICACION -->
        <?php include 'header_certificacion.php'; ?>
        <div class="mt-4 PopUpContainer">
            <div class="contentContainer">
            <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li><a href="cursos.php">Cursos</a></li><li class="active">Ver Detalle: <?php echo $res['curso_m']; ?></li></ol>
        </div>
            <!-- ====== PopUpLogin ======-->
            <?php include 'popupLogin_certificacion.php'; ?>
        </div>
    <?php else: ?>
        <!-- contenido para CERTIFICACION -->
        <?php include 'header.php'; ?>
        <div class="mt-4 PopUpContainer">
            <div class="contentContainer">
            <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li><a href="cursos.php">Cursos</a></li><li class="active">Ver Detalle: <?php echo $res['curso_m']; ?></li></ol>
        </div>
            <!-- ====== PopUpLogin ======-->
            <?php include 'popupLogin.php'; ?>
        </div>
    <?php endif; ?>

    <!--<div class="contenedor-vistas">-->
    <div class="container">
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    Información del curso <?php echo $res['curso_m']; ?>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <center><img class="img-fluid mt-3" src="assets/<?php echo $res['nombre_archivo'];?>" alt="imgDelGrupo" /></center>
                    </div>
                    <div class="col-md-8 ">
                        <div class="">
                              <div class="form-group curso">
                                  <label class="control-label" for="curso"><span class="fa fa-map-marker"></span> Ciudad</label>
                                  <p><?php echo $res['municipio']; ?></p>
                              </div>
                              <div class="form-group curso">
                                  <label class="control-label" for="curso"><span class="fa fa-university"></span> Centro de formación</label>
                                  <p><?php echo $res['centro']; ?></p>
                              </div>
                              <div class="form-group curso">
                                  <label class="control-label" for="curso"><span class="fa fa-home"></span> Lugar de realización</label>
                                  <p><?php echo $res['direccion']; ?></p>
                              </div>
                              <div class="form-group curso">
                                  <label class="control-label" for="curso"><span class="fa fa-eye"></span> Nombre del programa</label>
                                  <p><?php echo $res['curso']; ?></p>
                              </div>
                              <div class="form-group curso">
                                  <label class="control-label" for="curso"><span class="fa fa-book"></span> Modalidad de formación</label>
                                  <p><?php echo $res['formacion']; ?></p>
                              </div>
                              <div class="form-group curso">
                                  <label class="control-label" for="curso"><span class="fa fa-calendar-check-o"></span> Fecha de inicio</label>
                                  <p><?php echo $res['fecha_inicio']; ?></p>
                              </div>
                           
                        </div>      
                    </div>
                </div>
                <?php 
                    $eCurso = mysqli_fetch_row(mysqli_query($conexion, "SELECT estado FROM y_inscritos_cursos where id_usuario='$user[0]' and id_curso='{$res['id']}' order by id desc limit 1"))[0];
                ?>
                <div class="form-group container">
                    <!-- Estado inscrito -->
                    <?php if(($eCurso == 1)): ?>
                        <span class="btn btn btn-outline-primary btn-block btn-sm">
                            <span class="fa fa-check-square-o"></span> Inscrito
                        </span>
                    <?php elseif($user[9] == 2 && $eCurso == 0):?>
                        <span class="btn btn btn-outline-primary btn-block btn-sm" onclick="btnInscribir(<?php echo $res['id'];?>, <?php echo $user[0];?>)">
                            <span class="fa fa-plus-square-o"></span> Inscribir
                        </span>
                    <?php else: ?>
                            <a href="sign_in.php" class="btn btn-outline-primary btn-block btn-sm">Inscribir</a>        
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<footer class="footer_new">
  <div class="container">
    <span class="">Todos los derechos <?php echo '&copy'; echo date("Y"); ?>  SENA - Políticas de privacidad y condiciones uso Portal Web SENA</span>
  </div>
</footer>

    <!-- Demo ads. Please ignore and remove. -->
    <script src="http://cdn.tutorialzine.com/misc/enhance/v2.js" async></script>
    <!-- ====== Pie de pagina ======-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://www.vivu.com.co/assets/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
	function btnInscribir(idCurso, idUsuario){
		var datos = {
			"idCurso" : idCurso,
			"idUsuario" : idUsuario
        };
		$.ajax({
			type:"POST",
			data: datos,
			url:"cursos/procesos/agregarInscripcion.php",
			success:function(r){
				if(r == 1){
					Swal.fire(
					'Correcto!',
					'Se ha inscrito correctamente!',
					'success'
					);
				}else if(r == 2){
					Swal.fire(
					'Ojo!',
					'No te puedes inscribir debido que ya cuentas con 2 inscripciones vigentes.',
					'warning'
					);
				}else{
					Swal.fire(
					'Error!',
					'No se ha guardado correctamente!',
					'error'
					);
				}
			}
		});
	}
</script>