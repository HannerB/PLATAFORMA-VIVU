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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Noticias | Oferta Complementaria</title>
  <link rel="icon" href="assets/logoSena.png">
  <meta property="og:title" content="Noticias | Oferta Complementaria">
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
<?php include "header.php" ?>
    <div class="text-center">
      <div class="container">
       
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
              <li class="bg-primary" data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li class="bg-primary" data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li class="bg-primary" data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              <li class="bg-primary" data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              <li class="bg-primary" data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
          <div class="carousel-item active">
              <img class="d-block w-100" src="assets/img/slider_0.jpg" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="assets/img/slider_1.jpg" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="assets/img/slider_2.jpg" alt="Second slide">
              <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="assets/img/img_4_.jpeg" alt="Third slide">
              <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="assets/img/slider_4.jpg" alt="Third slide">
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

        <div class="row mt-2 mx-auto">
            <div class="col-md-8">
                <div class="form-group col-md-6">
                    <div class="card h-100" style="width: 22rem;">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video width="400" controls>
                                <source src="assets/video/video_1.mp4" type="video/mp4">
                            </video>                           
                        </div>
                        <div class="card-body mt-1">
                            <h5 class="card-title">Emprendedora SENA</h5>
                            <p class="card-text">1° Feria de emprendedores pertenecientes a la población víctima y vulnerable.</p>
                        </div>
                        
                        <div class="card-footer">
                        <!-- <a href="#" class="btn btn-outline-primary">Go somewhere</a> -->
                            <small class="text-muted">Última actualización 15/09/2021.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="card h-100" style="width: 22rem;">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video width="400" controls>
                                <source src="assets/video/video_2.mp4" type="video/mp4">
                            </video>   
                        </div>
                        <div class="card-body mt-1">
                            <h5 class="card-title">Emprendedora SENA</h5>
                            <p class="card-text">1° Feria de emprendedores pertenecientes a la población víctima y vulnerable.</p>
                        </div>
                        <div class="card-footer">
                        <!-- <a href="#" class="btn btn-outline-primary">Go somewhere</a> -->
                            <small class="text-muted">Última actualización 15/09/2021.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="card h-100" style="width: 22rem;">
                        <img class=" img-fluid" src="assets/img/imgPortada2.jpeg">
                        <div class="card-body mt-1">
                            <h5 class="card-title">Apertura de la fería de emprendimiento población</h5>
                            <p class="card-text">1° Feria de emprendedores pertenecientes a la población víctima y vulnerable.</p>
                        </div>
                        <div class="card-footer">
                        <!-- <a href="#" class="btn btn-outline-primary">Go somewhere</a> -->
                            <small class="text-muted">Última actualización 15/09/2021.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="card h-100" style="width: 22rem;">
                        <img class=" img-fluid" src="assets/img/imgPortada1.jpeg">
                        <div class="card-body mt-1">
                            <h5 class="card-title">Cronograma de la fería de emprendimiento población</h5>
                            <p class="card-text">1° Feria de emprendedores pertenecientes a la población víctima y vulnerable.</p>
                        </div>
                        
                        <div class="card-footer">
                        <!-- <a href="#" class="btn btn-outline-primary">Go somewhere</a> -->
                            <small class="text-muted">Última actualización 15/09/2021.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 overflow-auto" >
                <iframe  src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FsenaAtlantico&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="320" height="460" style="border:none;overflow:hidden; border-radius:10px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                <a class="twitter-timeline" data-width="320" data-height="460" data-theme="dark" href="https://twitter.com/SenaAtlantico?ref_src=twsrc%5Etfw">Tweets by SenaAtlantico</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>        
            </div>
        </div>
      </div>
    </div>

    

 
   

    


<footer class="footer_new mt-2">
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
  <!-- ====== Pie de pagina ======-->
  <link rel="stylesheet" href="assets/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>

</html>
