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
  
  <meta content="sD0hPo5InGhre.php2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />
  <link rel="stylesheet" media="all" href="assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="assets/grupos.css" />
  <script src="assets/general.js" data-turbolinks-track="reload"></script>
  <style type="text/css">
    .footer_new {
      bottom:0; align-content: center;
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
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="container-login">
          <i class="fa fa-user container-login-icon" aria-hidden="true"></i>
          <h3 class="text-center" >Registrarme</h3>
        </div>
          <form class="simple_form" id="" action="operaciones.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="control-label" for="user_nombre">Nombres</label>
                    <input class="form-control" required type="text" name="txtNombres" id="txtNombres" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputApellidos">Apellidos</label>
                    <input class="form-control" required type="text" name="txtApellidos" id="txtApellidos"/>
                </div>
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputSexo">Sexo</label>
                    <select class="form-control form-control-sm" required aria-required="true" type="text" name="txtSexo" id="txtSexo" >
                        <option value="" disabled="" selected="">Seleccione...</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputFechaNacimiento">Fecha de nacimiento</label>
                    <input class="form-control" required type="date" name="txtFechaNacimiento" id="txtFechaNacimiento"/>
                </div>
            </div>  
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputDireccion">Dirección de correo electrónico</label>
                    <input class="form-control" required type="email" name="txtCorreo" id="txtCorreo" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputContrasena">Contraseña actual</label>
                    <input class="form-control" required  aria-required="true" type="password" name="txtPassword" id="txtPassword" />
                </div>
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTipoDocumento">Tipo documento</label>
                    <select required class="form-control form-control-sm" name="txtTipoDocumento" id="txtTipoDocumento">
                        <option value="" disabled="" selected="">Seleccione...</option>
                        <option value="Cedula de Ciudadanía">Cedula de Ciudadanía</option>
                        <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                        <option value="Pep">Pep</option>
                        <option value="Ppt">Ppt</option>
                    </select>              
                </div>
                <div class="form-group col-md-6">
                    <label for="inputDocumento">Documento</label>
                    <input class="form-control" min="1" required="required" type="number" step="1" name="txtDocumento" id="txtDocumento" />
                </div>
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTelefono">Telefono</label>
                    <input class="form-control" required="required" type="number" name="txtTelefono" id="txtTelefono" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputMunicipio">Municipio</label>
                    <input class="form-control" required type="text" name="txtMunicipio" id="txtMunicipio" />
                </div>

                <div hidden class="form-group col-md-6">
                    <label for="operacion"></label>
                    <input class="form-control" value="14" type="text" name="operacion" id="operacion" />
                </div>

            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="control-label" for="user_tipo_de_poblacion_id">Tipo de poblacion</label>
                    <select class="form-control select" name="txtTipoPoblacion" id="txtTipoPoblacion" required>
                        <option value="" disabled="" selected="">Seleccione...</option>
                        
                        <option value="Ninguno">Ninguno</option>
                        <option value="Desplazados por la violencia">Desplazados por la violencia</option>
                        <option value="Víctimas del conflicto armado">Víctimas del conflicto armado</option>
                        <option value="Discapacitados">Discapacitados</option>
                        <option value="Indígenas">Indígenas</option>
                        <option value="Convenio INPEC">Convenio INPEC</option>
                        <option value="Jóvenes vulnerables">Jóvenes vulnerables</option>
                        <option value="Adolescentes en conflicto con la ley penal">Adolescentes en conflicto con la ley penal</option>
                        <option value="Mujeres cabeza de hogar">Mujeres cabeza de hogar</option>
                        <option value="Negritudes">Negritudes</option>
                        <option value="Afrocolombianos">Afrocolombianos </option>
                        <option value="Colombianos Retornados">Colombianos Retornados </option>
                        <option value="Migrantes">Migrantes </option>
                        <option value="Palenques">Palenques</option>
                        <option value="Raizales">Raizales</option>
                        <option value="ROM">ROM</option>
                        <option value="Migrantes">Migrantes</option>
                        
                        <option value="Desplazados por fenómenos naturales y desplazados por fenómenos naturales cabeza de hogar">Desplazados por fenómenos naturales y desplazados por fenómenos naturales cabeza de hogar</option>
                        <option value="Proceso de reintegración y adolescentes desvinculados de Grupo armados organizados al margen de la ley">Proceso de reintegración y adolescentes desvinculados de Grupo armados organizados al margen de la ley</option>
                        <option value="Tercera edad">Tercera edad</option>
                        <option value="Adolescente trabajador">Adolescente trabajador</option>
                        <option value="Remitidos por el PAL">Remitidos por el PAL</option>
                        <option value="Soldados campesinos">Soldados campesinos</option>
                        <option value="Sobrevivientes minas antipersonas">Sobrevivientes minas antipersonas</option>
                        <option value="Comunidad LGBTI">Comunidad LGBTI</option>
                    </select>              
                </div>
            </div>

            <div class="form-row mt-2">
              <div class="form-group col-md-12">
                  <button type="submit" id="" class="btn btn-outline-success btn-block">Registrar</button>
                  <a href="sign_in.php"  class="btn btn-outline-success btn-block mt-1">Iniciar sesión</a>      
              </div>
            </div>
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

<!-- Demo ads. Please ignore and remove. -->
<script src="http://cdn.tutorialzine.com/misc/enhance/v2.js" async></script>
<!-- ====== Pie de pagina ======-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="assets/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>

</html>
<script type="text/javascript">
    
	$(document).ready(function(){
		$('#btnGuardarAprendiz').click(function(){
			datos=$('#frmGuardarAprendiz').serialize();

            var txtNombres = document.getElementsByName("txtNombres")[0].value;
            var txtApellidos = document.getElementsByName("txtApellidos")[0].value;
            var txtSexo = document.getElementsByName("txtSexo")[0].value;
            var txtFechaNacimiento = document.getElementsByName("txtFechaNacimiento")[0].value;
            var txtCorreo = document.getElementsByName("txtCorreo")[0].value;
            var txtPassword = document.getElementsByName("txtPassword")[0].value;
            var txtTipoDocumento = document.getElementsByName("txtTipoDocumento")[0].value;
            var txtDocumento = document.getElementsByName("txtDocumento")[0].value;
            var txtTelefono = document.getElementsByName("txtTelefono")[0].value;
            var txtMunicipio = document.getElementsByName("txtMunicipio")[0].value;
            var txtTipoPoblacion = document.getElementsByName("txtTipoPoblacion")[0].value;

            if ((txtNombres == "") || (txtApellidos == "")|| (txtSexo == "")|| (txtFechaNacimiento == "")|| (txtCorreo == "")|| (txtPassword == "")|| (txtTipoDocumento == "")
            || (txtDocumento == "")|| (txtTelefono == "")|| (txtMunicipio == "")|| (txtTipoPoblacion == "")) {  //COMPRUEBA CAMPOS VACIOS
                Swal.fire({
                icon: 'error',
                text: 'Por favor revisar, hay campos vacios.',
                showConfirmButton: false,
                timer: 1500
                })

                
            }else{
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"cursos/procesos/guardarAprendiz.php",
                    
                    success:function(r){
                        if(r==1){
                            $('#frmGuardarAprendiz')[0].reset();

                            Swal.fire(
                            'Correcto!',
                            'Se ha guardado correctamente!',
                            'success'
                            );
                        }else if(r==2){
                            Swal.fire(
                            'Error!',
                            'El aprendiz ya se encuentra inscrito!',
                            'error'
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
		});
    });

</script>
