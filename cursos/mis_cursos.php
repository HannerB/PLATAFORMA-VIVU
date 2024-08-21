<?php
session_start();

require_once "clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
  $tildes = $conexion->query("SET NAMES 'utf8'");
  $sql="SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, 
  fechaRegistro, rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img, centro 
  FROM users WHERE id = $id";
  $result_login = mysqli_fetch_row(mysqli_query($conexion,$sql));
  $user = null;

  if (count($result_login) > 0) {
    $user = $result_login;
  }
}

$nombre_carpeta = "cursos";

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UFT-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  
  <title>Mis Cursos Inscritos| Oferta Complementaria</title>
  <meta property="og:title" content="Cursos | Oferta Complementaria">

  <link rel="icon" href="../assets/logoSena.png">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <meta name="csrf-token" content="sD0hPoBuliGFd5InGhre2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />

  <link rel="stylesheet" media="all" href="../assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="../assets/grupos.css" />
  <script src="http://www.vivu.com.co/assets/general.js" data-turbolinks-track="reload"></script>
  <?php require_once "scripts.php";  ?>


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
    .col-xs-6{
      width: 50%;
    }
    .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
      position: relative;
      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px;
    }
    .efectoa img {
      border-radius: 20px 20px 0px 0px;
      -webkit-transition: .2s;
      -moz-transition: .2s;
      -o-transition: .2s;
      -ms-transition: .2s;
      transition: .2s;
    }
  </style>
</head>
<body>

<?php if(!empty($user) && ($user[9]=='2')): ?>
  
	<!-- contenido para Aprendiz -->
	<?php require_once '../header_aprendiz.php'; ?>

	<div class="mt-4 PopUpContainer">
		<div class="contentContainer">
		<ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li class="active">Mis Cursos Inscritos</li></ol>
		</div>
		<?php require_once '../popupLogin_aprendiz.php'; ?>
	</div>

	<div class="container">
		<div class="row mt-1">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-center">
						Mis Cursos Inscritos
					</div>
					<div class="card-body">
						<div id="cargarDetalleInscripciones"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

  <?php endif; ?>

<footer class="footer_new text-center mt-3">
  <div class="">
    <span class="">Todos los derechos <?php echo '&copy'; echo date("Y"); ?>  SENA - Políticas de privacidad y condiciones uso Portal Web SENA</span>
  </div>
</footer>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cargarDetalleInscripciones').load('tabla_mis_cursos.php');
	});
</script>
