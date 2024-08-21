<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, fechaRegistro,rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="icon" href="assets/logoSena.png">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Consultar Emprendimiento | Oferta Complementaria</title>
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <meta name="csrf-token" content="sD0hPoBuliGFd5InGhre2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />
  <link rel="stylesheet" media="all" href="assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="assets/home.css" />
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
  <?php if(!empty($user)): ?>

   <?php  include 'header_gestor.php';?>

   <div class="mt-1 PopUpContainer">
    <div class="contentContainer">
      <ol class="breadcrumb"><li><a href="micuenta.php">Inicio</a></li><li><a>Emprendimiento</a></li></ol>
    </div>
    <?php  include 'popupLogin_gestor.php';?>

  </div>

  <!--<div class="contenedor-vistas">-->
    <div class="container down">
      <h4 ><a href="emprendimiento.php" style="color: #FF6C00;">Llenar formulario de Emprendimiento</a></h4>

      <div class="container down">
        <h3 class="text-center text-light">Solicitudes Emprendimiento</h3>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped">
              <thead class="cabecera">
                <tr>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Documento</th>
                  <th scope="col">Genero</th>
                  <th scope="col">Correo Personal</th>
                  <th scope="col">Telefono Personal</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
               <?php 
               include ("conexion.php");
               $sql="SELECT id, regional, centroFormacion, codigoProyecto, nombresPersonal, apellidosPersonal, documentoPersonal, fechaNacimiento, ciudadNacimiento, departamentoNacimiento, correoPersonal, genero, telefonoOficinaPersonal, telefonoMovilPersonal, direccionResidencia, ciudadResidencia, departamentoResidencia, tipoPoblacionPersonal, formacionAcademica, programaFormacion, institucionAcademica, estadoAcademica, servicioRequerido, nombreEmpresa, nitEmpresa, estatusEmpresa, fechaConstitucionEmpresa, representanteEmpresa, tamanoEmpresa, actividadEconomicaEmpresa, sectorEconomicoEmpresa, tipoSociedadEmpresa, direccionEmpresa, paginaWebEmpresa, ciudadEmpresa, departamentoEmpresa, correoEmpresa, empleadosFormales, empleadosInformales, descripcionProductosEmpresa, internetEmpresa, negocioEnCasa FROM emprendimiento";
               $res=mysqli_query($cn,$sql);

               while ($data=mysqli_fetch_array($res))
               {
                ?>
                <tr>
                  <td><?php echo $data['nombresPersonal'];?></td>
                  <td><?php echo $data['apellidosPersonal'];?></td>
                  <td><?php echo $data['documentoPersonal'];?></td>
                  <td><?php echo $data['genero'];?></td>
                  <td><?php echo $data['correoPersonal'];?></td>
                  <td><?php echo $data['telefonoMovilPersonal'];?></td>
                  <td>Descargar</td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
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
  <script src="assets/nombre_grupos-e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855.js"></script>
  <!-- ====== Pie de pagina ======-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="assets/main.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>

</html>

