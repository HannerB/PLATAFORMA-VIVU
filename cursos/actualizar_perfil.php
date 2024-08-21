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

$No_documento =0; // ($_POST['NoDocumento']) > 0  ? $_POST['NoDocumento'] : 0;


$nombre_carpeta = "cursos";

$sql_info="SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, 
  fechaRegistro, rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img, centro 
  FROM users WHERE documento = $No_documento";

//$result_ = mysqli_query($conexion,$sql_info);

$result_info = mysqli_fetch_array(mysqli_query($conexion,$sql_info));
$num_rows =1;

$datos = $result_info;

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UFT-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  
  <title>Inscritos En El Curso | Oferta Complementaria</title>
  <meta property="og:title" content="Cursos | Oferta Complementaria">

  <link rel="icon" href="../assets/logoSena.png">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <meta name="csrf-token" content="sD0hPoBuliGFd5InGhre2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />

  <link rel="stylesheet" media="all" href="../assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="../assets/grupos.css" />
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
<input type="hidden" id="id" name="id" value="<?php echo $CC ?>">
<?php if(!empty($user) && ($user[9]=='1')): ?>
  
	<!-- contenido para Administrador -->
    <?php include '../header_admin.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        <ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li><a href="#">Cursos Ofertados</a></li></ol>
        </div>
        <!-- ====== PopUpLogin ======-->
        <?php include '../popupLogin_admin.php'; ?>
    </div>
    <div class="container">
      <div class="row mt-1">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header text-center">
               Actualizar información
            </div>
            <div class="card-body">
                <form class="form-inline" id="frmConsultar" method="POST" action="actualizar_perfil.php">
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="" class="">Documento de identidad:</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputNoDocumento" class="sr-only">No. Documento</label>
                                <input type="number" class="form-control" name="NoDocumento" placeholder="No. Documento" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block mb-2">Validar identidad</button>
                        </div>
                    </div>
                </form>
                <hr>
                <?php if($datos !== ""):?>
                   
                        <?php if ($num_rows > 0):?>
                            <div class="col-md-12">
                                <hr>
                                <form class="simple_form edit_user" method="POST" id="frmEditarAprendiz">
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputNombres">Nombres</label>
                                    <input class="form-control" required="" type="text" name="txtNombres" id="txtNombres" value="<?php echo $result_info['nombres']; ?>"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputApellidos">Apellidos</label>
                                    <input class="form-control" required="" type="text" name="txtApellidos" id="txtApellidos" value="<?php echo $result_info['apellidos']; ?>" />
                                    </div>
                                </div> 

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputSexo">Sexo</label>
                                    <select class="form-control" required="" type="text" name="txtSexo" id="txtSexo" >
                                        <option selected="true" value="<?php echo $result_info['sexo']; ?>"><?php echo $result_info['sexo']; ?></option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputFechaNacimiento">Fecha de nacimiento</label>
                                    <input class="form-control" required="" type="date" name="txtFechaNacimiento" id="txtFechaNacimiento" value="<?php echo $result_info['fechaNacimiento']; ?>" />
                                    </div>
                                </div>  
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputDireccion">Dirección de correo electrónico</label>
                                    <input class="form-control" required="required" type="email" value="<?php echo $result_info['email'];?>" name="txtCorreo" id="txtCorreo" /><p class="help-block">Se le enviará un correo de confirmación</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                    <label for="inputContrasena">Contraseña actual</label>
                                    <input class="form-control" autocomplete="current-password"  type="text" name="txtPassword" id="txtPassword" value="<?php echo $result_info['password']?> "/>
                                    </div>
                                </div> 

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputTipoDocumento">Tipo documento</label>
                                    <select class="form-control form-control-sm" name="txtTipoDocumento" id="txtTipoDocumento">
                                        <option value="<?php echo $result_info['tipodocumento'];?>" selected="selected" ><?php echo $result_info['tipodocumento'];?></option>
                                        <option value="Cedula de Ciudadanía">Cedula de Ciudadanía</option>
                                        <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
                                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                    </select>              
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputDocumento">Documento</label>
                                    <input class="form-control" min="1" required="required" type="number" step="1" value="<?php echo $result_info['documento'];?>" name="txtDocumento" id="txtDocumento" />
                                    </div>
                                </div> 

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputTelefono">Telefono</label>
                                    <input class="form-control" required="required" type="number" value="<?php echo $result_info['telefono'];?>" name="txtTelefono" id="txtTelefono" />
                                    </div>
                                    <div class="form-group col-md-6">

                                    <label for="inputMunicipio">Municipio</label>
                                    <input class="form-control" autocomplete="Municipio" required="" type="text" value="<?php echo $result_info['municipio'] ?>" name="txtMunicipio" id="txtMunicipio" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label class="control-label" for="user_tipo_de_poblacion_id">Tipo de poblacion</label>
                                    <select class="form-control select" name="txtTipoPoblacion" id="txtTipoPoblacion">
                                        <option value="<?php echo $result_info['tipoPoblacion']; ?>" selected="true" ><?php echo $result_info['tipoPoblacion']; ?></option>
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
                                        <option value="Palenques">Palenques</option>
                                        <option value="Raizales">Raizales</option>
                                        <option value="ROM">ROM</option>
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

                                    <!-- boton de rol  -->
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label class="control-label" for="imputRol">Rol</label>
                                    <select class="form-control select" name="txtRol" id="txtRol">
                                        <option value="<?php echo $result_info['rol']; ?>" selected="true" ><?php echo $result_info['rol']; ?></option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Aprendiz</option>
                                        <option value="3">Orientador</option>
                                        <option value="4">Gestor</option>
                                        <option value="5">Certofocación</option>
                                    </select>              
                                  </div>
                                </div>
                                <!-- fin boton de rol -->
                                    <input type="hidden" value="<?php echo $result_info['id'];?>" name="txtUsuarioId" name="txtUsuarioId">
                                </form>    
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <button type="button" id="btnActualizarAprendiz" class="btn btn-outline-primary btn-block">Actualizar datos</button>
                                    </div>
                                </div>        
                            </div>       
                            
                        <?php else:?>
                            <table class="table table-hover small" id="cargarCursosOfertados">
                                <thead class="text-center bg-primary">
                                    <tr>
                                        <th class="text-center">Nombres</th>
                                        <th class="text-center">Apellidos</th>
                                        <th class="text-center">Documento</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Municipio</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tr class="text-center">
                                    <td colspan="6">No hay registros para el documento consultado, <br> debe registrar el aprendiz para poder continuar.<br><br>
                                        <a class="btn btn-outline-primary btn-sm" href="../registrar_aprendices.php"><span class="fa  fa-user-o"></span> Registrar Aprendiz</a>
                                    </td>
                                </tr>
                            </table>
                          <?php endif; ?>
                        
                <?php endif; ?>
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
		$('#btnActualizarAprendiz').click(function(){

			datos=$('#frmEditarAprendiz').serialize();
			
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
            var txtRol = document.getElementsByName("txtRol")[0].value;

            if ((txtNombres == "") || (txtApellidos == "")|| (txtSexo == "")|| (txtFechaNacimiento == "")|| (txtCorreo == "")|| (txtPassword == "")|| (txtTipoDocumento == "")|| (txtDocumento == "")|| (txtTelefono == "")|| (txtMunicipio == "")|| (txtTipoPoblacion == "")|| (txtRol == "")) {  //COMPRUEBA CAMPOS VACIOS
                Swal.fire({
                icon: 'error',
                text: 'Por favor revisar, hay campos vacidos.',
                showConfirmButton: false,
                timer: 1500
                });
                
            }else{      
                  $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/actualizarAprendiz.php",
                            
                    success:function(r){
                      if(r==1){
                        Swal.fire(
                        'Correcto!',
                        'Se ha guardado correctamente!',
                        'success'
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
