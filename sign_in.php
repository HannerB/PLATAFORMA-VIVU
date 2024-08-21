<?php 
session_start();

require_once "cursos/clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();
$tildes = $conexion->query("SET NAMES 'utf8'");


 $nombre_carpeta="";


$Correo_Electronico="";


if (isset($_POST['email'])) {
  $Correo_Electronico=$_POST['email'];
}



if (isset($_SESSION['user_id'])) {
  header('Location: micuenta.php');
}

if (!empty($_POST['email']) && !empty($_POST['password'])) {

	$sql="SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, 
	fechaRegistro, rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img, centro 
	FROM users WHERE documento = '$Correo_Electronico'";
	$result_login = mysqli_fetch_row(mysqli_query($conexion,$sql));
	$user = null;
  
	if (count($result_login) > 0) {
	  $user = $result_login;
	}

  if (count($result_login) > 0 && ($_POST['password']==$user[7])) {
    $_SESSION['user_id'] = $user[0];
    $_SESSION['rol']= $user[9];
    $_SESSION['nombre']= $user[1];
    $_SESSION['apellido']= $user[2];
    $_SESSION['alianza']=0; 
    $fecha=date('y-m-d');
    include 'save-fecha-sesion.php';

    header("Location: micuenta.php");

  } else {
    echo "<script>alert('Lo sentimos, su correo o contraseña son erroneos, por favor verifique nuevamente su información y accede al aplicativo.');</script>";
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
  <title>Iniciar sesión | Oferta Complementaria</title>
  <meta property="og:title" content="Iniciar sesión | Oferta Complementaria">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" media="all" href="./assets/general.css" data-turbolinks-track="reload" />
  <style type="text/css">
    .footer_new {
      bottom: 0;
      text-align: center;
      font-size: 15px;
      width: 100%;
      height: 50px; /* Set the fixed height of the footer here */
      line-height: 44px; /* Vertically center the text there */
      background-color: green !important;
      color: white;
    }
  </style>
</head>
<body>

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel" style="font-size: 28px; text-align:center;"><i class="fa fa-envelope-open" aria-hidden="true"></i> ¿Olvidaste tu contraseña?<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h5>
        
      </div>
      <div class="modal-body">
        <form action="recover.php" method="POST" autocomplete="off">
          <div class="form-group">
            <label for="txtCorreo" class="col-form-label" requerid><i class="fa fa-envelope" aria-hidden="true"></i> Documento:</label>
            <input type="number" autocomplete="off" class="form-control" id="txtCorreo" name="txtCorreo" required="" >
          </div>

        </div>
        <div class="modal-footer">
         <input type="submit" value="Recuperar contraseña" class="btn" style="background-color: #FF6C00; color: white; border-color: #FF6C00; ">
       </form>
     </div>
   </div>
 </div>
</div>

<?php  include 'header.php';?>


<div class="mt-1 PopUpContainer">
  <div class="contentContainer">
    <ol class="breadcrumb"><li><a class="text-success" href="index.php">Inicio</a></li><li class="active">Iniciar sesión</li></ol>
  </div>
</div>
</div>

<!--<div class="contenedor-vistas">-->
  <div class="container down">

    <div class="container">


    <?php
    

    if (!isset($_SESSION['estado'])){
      $_SESSION['estado']='';
      $_SESSION['valor']='';
    }

        if($_SESSION['valor']==1){
            ?>
            <div class="alert alert-dismissible alert-success" style="margin-top:20px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="icon-checkmark"></span> <?php echo $_SESSION['estado'] ; ?>
            </div>
            <?php

            unset($_SESSION['estado']);

        }elseif($_SESSION['estado']==!null){
          ?>
            <div class="alert alert-dismissible alert-danger" style="margin-top:20px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="icon-checkmark"></span> <?php echo "Operacion NO Realizada :".$_SESSION['estado'] ; ?>
            </div>
            <?php

           unset($_SESSION['estado']);

        }
    ?>



      <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
          <div class="full-width container-login">
            <i class="fa fa-user container-login-icon" aria-hidden="true"></i>
            <h2 class="text-center text-light" >Iniciar Sesión</h2>
            <br>
            <form class="simple_form new_user" id="new_user" action="sign_in.php" accept-charset="UTF-8" method="post">
              <div class="form-group">
                <div class="form-group email optional user_email">
                  <label class="control-label users optional" for="user_email"><i class="fa fa-user" aria-hidden="true"></i> Nro de documento</label>
                  <input class="form-control string users optional form-control input-lg" autocomplete="" autofocus="autofocus" placeholder="Usuario" required=""  type="number" value="" name="email" id="user_email" />
                </div>
              </div>
              <div class="form-group">
               <div class="form-group password optional user_password">
                <label class="control-label password optional" for="user_password"><i class="fa fa-key" aria-hidden="true"></i> Password</label>
                <input class="form-control password optional form-control input-lg" autocomplete="current-password" placeholder="Contraseña" required="" type="password" name="password" id="user_password" />
              </div>
            </div>
            <a  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-key" aria-hidden="true"></i> ¿Olvidaste tu contraseña?</a>
            <button class="btn btn-success btn-block" type="submit"> Iniciar sesión  </button>
          </form>  
          <a href="sign_up.php" class="btn btn-success btn-block">Registrarme</a>        
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






  

</body>

</html>
