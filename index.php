<?php
session_start();

require_once "cursos/clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
  $tildes = $conexion->query("SET NAMES 'utf8'");
  $sql = "SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, 
fechaRegistro, rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img, centro 
FROM users WHERE id = $id";
  $result_login = mysqli_fetch_row(mysqli_query($conexion, $sql));
  $user = null;

  if (count($result_login) > 0) {
    $user = $result_login;
  }
}

$nombre_carpeta = "cursos";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="icon" href="assets/logoSena.png">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Inicio | Oferta Complementaria</title>
  <meta property="og:title" content="Inicio | Oferta Complementaria">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
      height: 50px;
      /* Set the fixed height of the footer here */
      line-height: 44px;
      /* Vertically center the text there */
      background-color: green;
      color: white;
    }

    .modal {
      text-align: center;
      padding: 0 !important;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }
  </style>

  <script>
    $(document).ready(function() {
      $('#exampleModalCenter').modal('toggle')
    });
  </script>
</head>

<body>
  <?php include "header.php" ?>
  <div class="container down">


    <main class="contentContainer">

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="assets/slider3.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="assets/slider4.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="assets/slider2.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="assets/slider1.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="assets/slider0.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="cardHome">
        <div class="cardHomeHeader">
          <span>Formación complementaria</span>
        </div>
        <div class="cardHomeContent">
          <div class="cardHomeContentImage">
            <img src="assets/formacion_complementaria.jpg" alt="Logosena" />
          </div>
          <div class="cardHomeContentDescription">
            <div class="description" style="font-size:17px;">
              <p>La formación complementaria está orientada a preparar al aprendiz para desempeñar oficios y ocupaciones requeridas por los sectores productivos y sociales, con el fin de satisfacer necesidades del nuevo talento o de cualificación de trabajadores que estén o no vinculados al mundo laboral, a través de cursos cortos de formación.</p>
            </div>
            <div class="button">
              <a href="cursosReg.php" class="Link">Inscribirse</a>
            </div>
          </div>
        </div>
      </div>


      <div class="cardHome">
        <div class="cardHomeHeader">
          <span>Emprendimiento</span>
        </div>
        <div class="cardHomeContent">
          <div class="cardHomeContentImage">
            <img src="assets/formacion_emprendimiento.jpg" alt="Emprendimiento" />
          </div>
          <div class="cardHomeContentDescription">
            <div class="description" style="font-size:17px;">
              <p>Fomentar la cultura del emprendimiento identificando oportunidades e ideas de negocio con valores diferenciales impulsando y fortaleciendo el desarrollo empresarial para la generación de ingresos y el empleo formal y decente. Acompañamos a los emprendedores en la creación y puesta en marcha de sus empresas. <br>
                Con nuestra asesoría los emprendedores podran: identificar modelos de negocio, formulación de plan de negocio, creación de empresa, asesoría en la fase inicial, diagnóstico empresarial, desarrollo de nuevos productos, encadenamientos productivos y gestión para acceder a fuentes de financiación.</p>
            </div>
            <div class="button">
              <a href="emprendimiento.php" class="Link">Inscribirse</a>
            </div>
          </div>
        </div>
      </div>


      <div class="cardHome">
        <div class="cardHomeHeader">
          <span>Certificación por competencias</span>
        </div>
        <div class="cardHomeContent">
          <div class="cardHomeContentImage">
            <img src="assets/formacion_certificacion.jpg" alt="Certificacion" />
          </div>
          <div class="cardHomeContentDescription">
            <div class="description" style="font-size:17px;">
              <p>La certificación por competencias u oficios es un programa orientado a desempeñar oficios y ocupaciones, basados en su experiencia y el desempeño actual de sus habilidades en un campo especifico, guiándolo a través del proceso de certificación, con lo cual le garantiza al sector productivo que es un aliado integral no solo competente en su saber y hacer, sino también en su ser.</p>
            </div>
            <div class="button">
              <a href="certificacion_competencias.php" class="Link">Inscribirse</a>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>

  <footer class="footer_new">
    <div class="container">
      <span class="">Todos los derechos <?php echo '&copy';
                                        echo date("Y"); ?> SENA - Políticas de privacidad y condiciones uso Portal Web SENA</span>
    </div>
  </footer>

  <script>
    var dummyContent = $('.dummy-content').children(),
      i;


    $('#add-content').click(function(e) {
      e.preventDefault();

      if ($(dummyContent[0]).is(":visible")) {
        for (i = 0; i < dummyContent.length; i++) {
          $(dummyContent[i]).fadeOut(600);
        }
      } else {
        for (i = 0; i < dummyContent.length; i++) {
          $(dummyContent[i]).delay(600 * i).fadeIn(600);
        }
      }

    });
  </script>
  <!-- Demo ads. Please ignore and remove. -->
  <script src="assets/home.js"></script>
  <!-- ====== Pie de pagina ======-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

</body>

</html>