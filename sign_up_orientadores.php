<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="icon" href="assets/logoSena.png">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Registrarme | Oferta Complementaria</title>
  <meta property="og:title" content="Registrarme | Oferta Complementaria">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  
  <meta naf-token.php" content="sD0hPo5InGhre.php2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />
  <link rel="stylesheet" media="all" href="assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="assets/grupos.css" />
  <script src="assets/general.js" data-turbolinks-track="reload"></script>
  <style type="text/css">
  .footer_new {
    bottom: 0;xt-alig.phpn: center;
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
  <!-- ====== Barra de navegacion ======-->
  <?php  include 'header.php';?>


  <div class="mt-1 PopUpContainer">
    <div class="contentContainer">
      <ol class="breadcrumb"><li><a href="index.php">Inicio</a></li><li class="active">Registrarme</li></ol>
    </div>
  </div>
</div>

<!--<div class="contenedor-vistas">-->
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="full-width container-login">
          <i class="fa fa-user container-login-icon" aria-hidden="true"></i>
          <h2 class="text-center" >Registrarme</h2>
          <br>
          <form class="simple_form new_user" id="new_user" action="save_sign_up_orientadores.php" accept-charset="UTF-8" method="post">

            <div class="form-group">
              <div class="form-group user_nombre">
                <label class="control-label" for="user_nombre">Nombres</label>
                <input class="form-control" autofocus="autofocus" required="" aria-required="true" type="text" name="txtNombres" id="user_nombre" />
              </div>
              <div class="form-group user_apellidos">
                <label class="control-label" for="user_apellidos">Apellidos</label>
                <input class="form-control" autofocus="autofocus" required="" aria-required="true" type="text" name="txtApellidos" id="user_apellidos" />
              </div>
              <div class="form-group user_apellidos">
                <label class="control-label" for="user_apellidos">Sexo</label>
                <select class="form-control" autofocus="autofocus" required="" aria-required="true" type="text" name="txtSexo" id="user_Sexo" >
                  <option selected="true" disabled="true">Elige</option>
                  <option value="Femenino">Femenino</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="form-group user_tipo_documento">
                <label class="control-label" for="user_tipo_documento_id">Tipo documento</label>
                <select class="form-control" min="1" name="txtTipoDocumento" id="user_tipo_documento_id" required="">
                  <option value="Cedula de Ciudadanía">Cedula de Ciudadanía</option>
                  <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
                  <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="user_documento">Número de Documento</label>
              <input class="form-control" min="1" autofocus="autofocus" required="" aria-required="true" type="number" step="1" name="txtDocumento" id="user_documento" />
            </div>
            <div class="form-group">
              <label class="control-label" for="user_documento">Fecha de nacimiento</label>
              <input class="form-control" min="1" autofocus="autofocus" required="" aria-required="true" type="date" step="1" name="txtFechaNacimiento" id="user_FechaNacimiento" />
            </div>
            <div class="form-group user_tipo_documento">
              <label class="control-label" for="user_tipo_documento_id">Centro de Formación</label>
              <select class="form-control select required form-control input-lg" min="1" aria-required="true" name="txtCentro" id="curso_centro_id">
                <option selected="selected" >Seleccione...</option>
                <option value="OFICINA">OFICINA</option>
                <option value="CENTRO COLOMBO ALEMAN">CENTRO COLOMBO ALEMAN</option>
                <option value="CENTRO COMERCIO Y SERVICIOS">CENTRO COMERCIO Y SERVICIOS</option>
                <option value="CENTRO INDUSTRIAL Y DE AVIACION">CENTRO INDUSTRIAL Y DE AVIACION</option>
                <option value="CENTRO DESARROLLO AGROECOLOGICO Y AGROINDUSTRIAL">CENTRO DESARROLLO AGROECOLOGICO Y AGROINDUSTRIAL</option>
              </select>
            </div>
            <div class="form-group user_tipo_documento">
              <label class="control-label" for="user_tipo_documento_id">Rol</label>
              <select class="form-control select required form-control input-lg" min="1" required="required" aria-required="true" name="txtRol" id="curso_centro_id">
                <option selected="selected" >Seleccione...</option>
                <option value="ORIENTADOR">ORIENTADOR</option>
                <option value="Gestor">GESTOR</option>
                <option value="Certificacion">CERTIFICACIÓN</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label" for="user_email">Municipio</label>
              <input class="form-control" autocomplete="Municipio" autofocus="autofocus" required="" aria-required="true" type="text" value="" name="txtMunicipio" id="user_Municipio" />
            </div>
            <div class="form-group">
              <label class="control-label" for="user_email">Email</label>
              <input class="form-control" autocomplete="email" autofocus="autofocus" required="" aria-required="true" type="email" value="" name="txtCorreo" id="user_email" />
            </div>
            <div class="form-group">
              <label class="control-label" for="user_password">Password</label>
              <input class="form-control" autocomplete="new-password" required="" aria-required="true" type="password" name="txtPassword" id="user_password" />
              <p class="help-block">6 caracteres minimo.</p>
            </div>
            <a href="sign_in.php" >Iniciar sesión</a><br>
            <center> <input type="submit" name="" value="Registrarse" class="btn text-center" style="background-color: #FF6C00; color: white; border-color: #FF6C00;"></center>
          </form>         
        </div>
      </div>
    </div>
  </div>

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

  <!-- ====== Pie de pagina ======-->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="/assets/main-817f5c201c0e3c8b60d1b39dc9deda557b6afd7d716d4ee778732e68924afd3e.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>

</html>
