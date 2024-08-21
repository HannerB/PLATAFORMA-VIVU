<?php 
session_start();

require_once "cursos/clases/conexion.php";
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
$res = mysqli_query($conexion, "SELECT UPPER(municipio) As municipio, COUNT(municipio) As ContarMunicipio FROM `cursos` GROUP BY municipio");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Dashboard | Oferta Complementaria</title>
  <link rel="icon" href="assets/logoSena.png">
  <meta property="og:title" content="Dashboard | Oferta Complementaria">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <meta name="csrf-token" content="sD0hPoBuliGFd5InGhre2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />
  <link rel="stylesheet" media="all" href="assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="assets/grupos.css" />
  <script src="assets/general.js" data-turbolinks-track="reload"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Estado', 'Contador'],  <?php

				while($row = mysqli_fetch_array($res )) {	

					echo "['".$row['municipio']."', ".$row['ContarMunicipio']."],";
				}
				?>
				]);

			var options = {
				title: 'GRAFICO PORCENTUAL DE LOS MUNICIPIO QUE SE LES HA BRINDADO CURSO.',
				is3D: true,
				pieHole: 0.4,
				width: 1270,
				height: 580,
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_municipio'));
			chart.draw(data, options);
		}
	</script>

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
<?php if(!empty($user)): ?>

  <?php if ($user[9]=='1'): ?>
     <!-- contenido para Administrador -->
    <?php include 'header_admin.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        </div>
        <!-- ====== PopUpLogin ======-->
        <?php include 'popupLogin_admin.php'; ?>
    </div>
  <?php elseif ($user[9]=='3'): ?>
    <!-- contenido para Orientador -->
    <?php include 'header_orientador.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        </div>
        <!-- ====== PopUpLogin ======-->
        <?php include 'popupLogin_orientador.php'; ?>
    </div>
  <?php elseif ($user[9]=='4'): ?>
    <!-- contenido para GESTOR -->
    <?php include 'header_gestor.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        </div>
        <!-- ====== PopUpLogin ======-->
        <?php include 'popupLogin_gestor.php'; ?>
    </div>
  <?php else: ?>
    <!-- contenido para CERTIFICACION -->
    <?php include 'header_certificacion.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        </div>
        <!-- ====== PopUpLogin ======-->
        <?php include 'popupLogin_certificacion.php'; ?>
    </div>
  <?php endif; ?>

    <div class="container">
        <div class="row mt-2">
            <div class="col-md-12">
            <div id="piechart_3d_municipio" class="img-fluid"></div>
            </div>
        </div>
    </div>

<?php else: ?>
    
  <?php echo "<script>window.location='sign_in.php';</script>"; ?>

<?php endif; ?>
<footer class="footer_new">
  <div class="container">
    <span class="">Todos los derechos <?php echo '&copy'; echo date("Y"); ?>  SENA - Políticas de privacidad y condiciones uso Portal Web SENA</span>
  </div>
</footer>
<script>
    var dummyContent = $('.dummy-content').children(),
    i;

    $('#add-content').click(function(e){
      e.preventDefault();

      if($(dummyContent[0]).is(":visible")){
        for(i=0;i<dummyContent.length;i++){
          $(dummyContent[i]).fadeOut(600);
        }
      }
      else{
        for(i=0;i<dummyContent.length;i++){
          $(dummyContent[i]).delay(600*i).fadeIn(600);
        }
      }

    });
  </script>
  <!-- Demo ads. Please ignore and remove. -->
  <script src="http://cdn.tutorialzine.com/misc/enhance/v2.js" async></script>
  <script src="assets/home.js"></script>
  <!-- ====== Pie de pagina ======-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="assets/main.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>

</html>
