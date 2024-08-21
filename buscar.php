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
	$result_login = mysqli_fetch_array(mysqli_query($conexion,$sql));
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
    <link rel="icon" href="assets/logoSena.png">
  
  <title>Cursos | Oferta Complementaria</title>
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
  <?php if(!empty($user) && ($user['rol']=='1')): ?>

  <!-- menu-->
  <?php include 'header_admin.php'; ?>


  <div class="mt-1 PopUpContainer">
    <div class="contentContainer">
      <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li class="active">Cursos</li></ol>
    </div>
    <?php include 'popupLogin_admin.php'; ?>
  </div>
  <!--<div class="contenedor-vistas">-->
    <div class="container down">
      <section class="down">
        <h2 class="text-center"> Ofertas por área</h2>
        <form method="post" class="form" action="buscar.php">
          <div class="col-md-6">
            <label class="sr-only" for="inlineFormInput">Curso</label>
            <input  name="PalabraClave" type="text" class="form-control" id="inlineFormInput"  placeholder="Busca por palabra o el curso que deseas..." value="<?php echo $_POST['PalabraClave'];?>">  
          </div>

          <div class="col-md-3">
           <button type="submit" name="search" id="search-btn" class="btn form-control" style="background-color: #FF6C00; color: white; font-size: 13px;"><i class="fa fa-search"></i></button>     
         </div>
       </form>
       
       <div class="col-md-3">
        <a href="" class="btn"  data-toggle="modal" data-target="#exampleModal"  style="background-color: #FF6C00; color: white;"><i class="fa fa-plus"></i> Nuevo grupo</a>
      </div>
      <?php
      include 'buscador_conexion.php';

      if(!empty($_POST))
      {
        $aKeyword = explode(" ", $_POST['PalabraClave']);
        $query ="SELECT * FROM grupos WHERE nombre_grupo like '%" . $aKeyword[0] . "%'";

        for($i = 1; $i < count($aKeyword); $i++) {
          if(!empty($aKeyword[$i])) {
            $query .= " OR nombre_grupo like '%" . $aKeyword[0] . "%'";
          }
        }

        $result = $db->query($query);
//      echo "Has buscado la palabra clave:<b> ". $_POST['PalabraClave']."</b>";

        if(mysqli_num_rows($result) > 0) {
          $row_count=0;
  //      echo "<br>Resultados encontrados: ";
          While($row = $result->fetch_assoc()) {   
            $row_count++;                   
            ?>      
            <div class="full-width container-category">
              <a href="view_cursos.php?name=<?php echo $row['nombre_grupo'];?>">
                <div class="full-width post">
                 <figure class="full-width post-img">
                   <!-- Tamaño de la imagen 248x186 pixeles-->
                   <img src="assets/<?php echo $row['nombre_archivo'];?>" alt="Defaultimage" />
                   <div class="divider"></div>

                 </figure>
               </figure>
               <div class="full-width post-info">
                <p class="full-width post-info-price nom_gru"><?php $nombre=$row['nombre_grupo']; echo $row['nombre_grupo'];?></p>
                <p class="full-width color_norm nom_gru">Cursos Abiertos: <?php 
                include ("conexion.php");
                $sql_c="SELECT COUNT(curso) As contar_1 FROM cursos where nombre_grupo='$nombre' and estado='Activo'";
                $res_c=mysqli_query($cn,$sql_c);

                $data_C=mysqli_fetch_array($res_c);
                if ($data_C['contar_1']>=1) {
                  echo $data_C['contar_1'];
                }else{
                  echo "0";                 
                }
                ?>
              </p>

            </div>
          </div>
        </a>                 
      </div>
      <?php 
    }
  }
  else {
    echo "<br>Resultados encontrados: Ninguno";

  }
}

?>

</div> <?php elseif(!empty($user) && ($user['rol']=='2')): ?>
    <!-- ====== Barra de navegacion ======-->
    <?php  include 'header_orientador.php';?>


    <div class="mt-1 PopUpContainer">
      <div class="contentContainer">
        <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li class="active">Cursos</li></ol>
      </div>
      <!-- ====== PopUpLogin ======-->
      <?php  include 'popupLogin_orientador.php';?>

    </div>

  <!--<div class="contenedor-vistas">-->
    <div class="container down">
      <section class="down">
        <h2 class="text-center"> Ofertas por área</h2>
        <form method="post" class="form" action="buscar.php">
          <div class="col-md-9">
            <label class="sr-only" for="inlineFormInput">Curso</label>
            <input  name="PalabraClave" type="text" class="form-control" id="inlineFormInput"  placeholder="Busca por palabra o el curso que deseas..." value="<?php echo $_POST['PalabraClave'];?>">  
          </div>

          <div class="col-md-3">
           <button type="submit" name="search" id="search-btn" class="btn form-control" style="background-color: #FF6C00; color: white; font-size: 13px;"><i class="fa fa-search"></i></button>     
         </div>
       </form>
       
      
      <?php
      include 'buscador_conexion.php';

      if(!empty($_POST))
      {
        $aKeyword = explode(" ", $_POST['PalabraClave']);
        $query ="SELECT * FROM grupos WHERE nombre_grupo like '%" . $aKeyword[0] . "%'";

        for($i = 1; $i < count($aKeyword); $i++) {
          if(!empty($aKeyword[$i])) {
            $query .= " OR nombre_grupo like '%" . $aKeyword[0] . "%'";
          }
        }

        $result = $db->query($query);
//      echo "Has buscado la palabra clave:<b> ". $_POST['PalabraClave']."</b>";

        if(mysqli_num_rows($result) > 0) {
          $row_count=0;
  //      echo "<br>Resultados encontrados: ";
          While($row = $result->fetch_assoc()) {   
            $row_count++;                   
            ?>      
            <div class="full-width container-category">
              <a href="view_cursos.php?name=<?php echo $row['nombre_grupo'];?>">
                <div class="full-width post">
                 <figure class="full-width post-img">
                   <!-- Tamaño de la imagen 248x186 pixeles-->
                   <img src="assets/<?php echo $row['nombre_archivo'];?>" alt="Defaultimage" />
                   <div class="divider"></div>

                 </figure>
               </figure>
               <div class="full-width post-info">
                <p class="full-width post-info-price nom_gru"><?php $nombre=$row['nombre_grupo']; echo $row['nombre_grupo'];?></p>
                <p class="full-width color_norm nom_gru">Cursos Abiertos: <?php 
                include ("conexion.php");
                $sql_c="SELECT COUNT(curso) As contar_1 FROM cursos where nombre_grupo='$nombre' and estado='Activo'";
                $res_c=mysqli_query($cn,$sql_c);

                $data_C=mysqli_fetch_array($res_c);
                if ($data_C['contar_1']>=1) {
                  echo $data_C['contar_1'];
                }else{
                  echo "0";                 
                }
                ?>
              </p>

            </div>
          </div>
        </a>                 
      </div>
      <?php 
    }
  }
  else {
    echo "<br>Resultados encontrados: Ninguno";

  }
}

?>
</div>
  <?php elseif(!empty($user) && ($user['rol']=='3')): ?>
  <!-- menu-->
  <?php include 'header_aprendiz.php'; ?>


  <div class="mt-1 PopUpContainer">
    <div class="contentContainer">
      <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li class="active">Cursos</li></ol>
    </div>
    <?php include 'popupLogin_aprendiz.php'; ?>
  </div>
  <!--<div class="contenedor-vistas">-->
    <div class="container down">
      <section class="down">
        <h2 class="text-center"> Ofertas por área</h2>
        <form method="post" class="form" action="buscar.php">
          <div class="col-md-9">
            <label class="sr-only" for="inlineFormInput">Curso</label>
            <input  name="PalabraClave" type="text" class="form-control" id="inlineFormInput"  placeholder="Busca por palabra o el curso que deseas..." value="<?php echo $_POST['PalabraClave'];?>">  
          </div>

          <div class="col-md-3">
           <button type="submit" name="search" id="search-btn" class="btn form-control" style="background-color: #FF6C00; color: white; font-size: 13px;"><i class="fa fa-search"></i></button>     
         </div>
       </form>
       
       <?php
       include 'buscador_conexion.php';

       if(!empty($_POST))
       {
        $aKeyword = explode(" ", $_POST['PalabraClave']);
        $query ="SELECT * FROM grupos WHERE nombre_grupo like '%" . $aKeyword[0] . "%'";

        for($i = 1; $i < count($aKeyword); $i++) {
          if(!empty($aKeyword[$i])) {
            $query .= " OR nombre_grupo like '%" . $aKeyword[0] . "%'";
          }
        }

        $result = $db->query($query);
//      echo "Has buscado la palabra clave:<b> ". $_POST['PalabraClave']."</b>";

        if(mysqli_num_rows($result) > 0) {
          $row_count=0;
  //      echo "<br>Resultados encontrados: ";
          While($row = $result->fetch_assoc()) {   
            $row_count++;                   
            ?>      
            <div class="full-width container-category">
              <a href="view_cursos.php?name=<?php echo $row['nombre_grupo'];?>">
                <div class="full-width post">
                 <figure class="full-width post-img">
                   <!-- Tamaño de la imagen 248x186 pixeles-->
                   <img src="assets/<?php echo $row['nombre_archivo'];?>" alt="Defaultimage" />
                   <div class="divider"></div>

                 </figure>
               </figure>
               <div class="full-width post-info">
                <p class="full-width post-info-price nom_gru"><?php $nombre=$row['nombre_grupo']; echo $row['nombre_grupo'];?></p>
                <p class="full-width color_norm nom_gru">Cursos Abiertos: <?php 
                include ("conexion.php");
                $sql_c="SELECT COUNT(curso) As contar_1 FROM cursos where nombre_grupo='$nombre' and estado='Activo'";
                $res_c=mysqli_query($cn,$sql_c);

                $data_C=mysqli_fetch_array($res_c);
                if ($data_C['contar_1']>=1) {
                  echo $data_C['contar_1'];
                }else{
                  echo "0";                 
                }
                ?>
              </p>

            </div>
          </div>
        </a>                 
      </div>
      <?php 
    }
  }
  else {
    echo "<br>Resultados encontrados: Ninguno";

  }
}

?>

</div>
<?php else: ?>
  <!-- menu-->
  <?php include 'header.php'; ?>


  <div class="mt-1 PopUpContainer">
    <div class="contentContainer">
      <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li class="active">Cursos</li></ol>
    </div>
  </div>
  <!--<div class="contenedor-vistas">-->
    <div class="container down">
      <section class="down">
        <h2 class="text-center"> Ofertas por área</h2>
        <form method="post" class="form" action="buscar.php">
          <div class="col-md-9">
            <label class="sr-only" for="inlineFormInput">Curso</label>
            <input  name="PalabraClave" type="text" class="form-control" id="inlineFormInput"  placeholder="Busca por palabra o el curso que deseas..." value="<?php echo $_POST['PalabraClave'];?>">  
          </div>

          <div class="col-md-3">
           <button type="submit" name="search" id="search-btn" class="btn form-control" style="background-color: #FF6C00; color: white; font-size: 13px;"><i class="fa fa-search"></i></button>     
         </div>
       </form>
       
       <?php
       include 'buscador_conexion.php';

       if(!empty($_POST))
       {
        $aKeyword = explode(" ", $_POST['PalabraClave']);
        $query ="SELECT * FROM grupos WHERE nombre_grupo like '%" . $aKeyword[0] . "%'";

        for($i = 1; $i < count($aKeyword); $i++) {
          if(!empty($aKeyword[$i])) {
            $query .= " OR nombre_grupo like '%" . $aKeyword[0] . "%'";
          }
        }

        $result = $db->query($query);
      //      echo "Has buscado la palabra clave:<b> ". $_POST['PalabraClave']."</b>";

        if(mysqli_num_rows($result) > 0) {
          $row_count=0;
  //      echo "<br>Resultados encontrados: ";
          While($row = $result->fetch_assoc()) {   
            $row_count++;                   
            ?>      
            <div class="full-width container-category">
              <a href="view_cursos.php?name=<?php echo $row['nombre_grupo'];?>">
                <div class="full-width post">
                 <figure class="full-width post-img">
                   <!-- Tamaño de la imagen 248x186 pixeles-->
                   <img src="assets/<?php echo $row['nombre_archivo'];?>" alt="Defaultimage" />
                   <div class="divider"></div>

                 </figure>
               </figure>
               <div class="full-width post-info">
                <p class="full-width post-info-price nom_gru"><?php $nombre=$row['nombre_grupo']; echo $row['nombre_grupo'];?></p>
                <p class="full-width color_norm nom_gru">Cursos Abiertos: <?php 
                include ("conexion.php");
                $sql_c="SELECT COUNT(curso) As contar_1 FROM cursos where nombre_grupo='$nombre' and estado='Activo'";
                $res_c=mysqli_query($cn,$sql_c);

                $data_C=mysqli_fetch_array($res_c);
                if ($data_C['contar_1']>=1) {
                  echo $data_C['contar_1'];
                }else{
                  echo "0";                 
                }
                ?>
              </p>

            </div>
          </div>
        </a>                 
      </div>
      <?php 
    }
  }
  else {
    echo "<br>Resultados encontrados: Ninguno";

  }
}

?>

</div>
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>

</html>
