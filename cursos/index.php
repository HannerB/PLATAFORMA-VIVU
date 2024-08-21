<?php
header("Location: ../index.php");
session_start();

require_once "clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();
$tildes = $conexion->query("SET NAMES 'utf8'");
$sql="SELECT id, nombre_grupo, nombre_archivo FROM grupos";
$result_cursos=mysqli_query($conexion,$sql);

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

$group = $_GET['name_group'];
if($group == "Salud Ocupacional"){
	$group = "Salud";
}
$group = (strlen($group) > 0 ) ? $group : '';

$nombre_carpeta = "cursos";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UFT-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  
  <title>Cursos | Oferta Complementaria</title>
  <meta property="og:title" content="Cursos | Oferta Complementaria">

  <link rel="icon" href="../assets/logoSena.png">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">

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

<?php if(!empty($user) && ($user[9]=='1')): ?>
  
  <!-- contenido para Administrador -->
  <?php require_once '../header_admin.php'; ?>

  <div class="mt-4 PopUpContainer">
    <div class="contentContainer">
      <ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li class="active">Cursos</li></ol>
    </div>
    <?php require_once '../popupLogin_admin.php'; ?>
  </div>

	<input type="hidden" value="<?php echo $group?>" name= "valor" id="valor">
	<div class="container">
		<div class="row mt-1">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-center">
						Curso Disponibles En El Área <?php $group_ = (strlen($group) > 0 ) ? "De <b>". $group."</b>" : '' ; echo ($group_) ?>
					</div>
					<div class="card-body">
						<span class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
							<span class="fa fa-plus-square-o"></span> Agregar nuevo curso 
						</span>
						<hr>
						<div id="tablaDatatable"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Agregar-->
	<div class="modal fade bd-example-modal-lg" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agrega nuevo curso</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="inputCodigo4">Codigo</label>
								<input type="number" class="form-control input-sm" id="idCurso" name="idCurso" required="">
							</div>
							<div class="form-group col-md-9">
								<label for="inputNombre4">Nombre</label>
								<input type="text" class="form-control input-sm" id="curso" name="curso" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputGrupo4">Grupo</label>
								<input type="text" class="form-control input-sm" id="nombre_grupo" name="nombre_grupo" value="<?php echo $_GET['name_group']?>" required="">
							</div>
							<div class="form-group col-md-8">
								<label for="inputJornada4">Centro de formación</label>
								<!--<input type="text" class="form-control input-sm" id="centro" name="centro" required="">-->
								<select name="centro" id="centro" class="form-control input-sm" required="">
									<option value="" disabled="" selected="">Seleccione...</option>
								    <option value="CENTRO DE COMERCIO Y SERVICIOS">CENTRO DE COMERCIO Y SERVICIOS</option>
									<option value="CENTRO NACIONAL COLOMBO ALEMAN">CENTRO NACIONAL COLOMBO ALEMAN</option>
									<option value="CENTRO INDUSTRIAL Y DE AVIACION">CENTRO INDUSTRIAL Y DE AVIACION</option>
									<option value="CENTRO PARA EL DESARROLLO AGROECOLÓGICO Y AGROINDUSTRIAL">CENTRO PARA EL DESARROLLO AGROECOLÓGICO Y AGROINDUSTRIAL</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="inputHorario4">Horario</label>
								<select name="horario" id="horario" class="form-control input-sm" required="">
									<option value="" disabled="" selected="">Seleccione...</option>
									<option value="Mañana">Mañana</option>
									<option value="Tarde">Tarde</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="inputIntensidad4">Intensidad / Horas</label>
								<input type="number" class="form-control input-sm" id="intensidad" name="intensidad" required="">
							</div>
							<div class="form-group col-md-3">
								<label for="inputFecha4">Fecha Inicio</label>
								<input type="date" class="form-control input-sm" name="fecha_inicio"  id="fecha_inicio" required="">
							</div>
							<div class="form-group col-md-3">
								<label for="inputMunicipio4">Municipio</label>
								<!--<input type="text" class="form-control input-sm" name="municipio"  id="municipio" required="">-->
								<select name="municipio" id="municipio" class="form-control input-sm" required="">
                                    <option value="" disabled="" selected="">Seleccione...</option>
                                    <option value="BARANOA">BARANOA</option>
                                    <option value="BARRANQUILLA">BARRANQUILLA</option>
                                    <option value="CAMPO DE LA CRUZ">CAMPO DE LA CRUZ</option>
                                    <option value="CANDELARIA">CANDELARIA</option>
                                    <option value="GALAPA">GALAPA</option>
                                    <option value="JUAN DE ACOSTA">JUAN DE ACOSTA</option>
                                    <option value="LURUACO">LURUACO</option>
                                    <option value="MALAMBO">MALAMBO</option>
                                    <option value="MANATÍ">MANATÍ</option>
                                    <option value="PALMAR DE VARELA">PALMAR DE VARELA</option>
                                    <option value="PIOJO">PIOJO</option>
                                    <option value="POLONUEVO">POLONUEVO</option>
                                    <option value="PONEDERA">PONEDERA</option>
                                    <option value="PUERTO COLOMBIA">PUERTO COLOMBIA</option>
                                    <option value="REPELÓN">REPELÓN</option>
                                    <option value="SABANAGRANDE">SABANAGRANDE</option>
                                    <option value="SABANALARGA">SABANALARGA</option>
                                    <option value="SANTA LUCÍA">SANTA LUCÍA</option>
                                    <option value="SANTO TOMÁS">SANTO TOMÁS</option>
                                    <option value="SOLEDAD">SOLEDAD</option>
                                    <option value="SUÁN">SUÁN</option>
                                    <option value="TUBARA">TUBARA</option>
                                    <option value="USIACURI">USIACURI</option>
                                </select>

							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="inputDireccion4">Dirección</label>
								<input type="text" class="form-control input-sm" id="direccion" name="direccion" required="">
							</div>
							<div class="form-group col-md-3">
								<label for="inputTipo4">Tipo formación</label>
								<select name="formacion" id="formacion" class="form-control input-sm">
									<option value="" disabled="" selected="">Seleccione...</option>
									<option value="Virtual">Virtual</option>
									<option value="Presencial">Presencial</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="inputEstado4">Estado</label>
								<select name="estado" id="estado" class="form-control input-sm">
									<option value="" disabled="" selected="">Seleccione...</option>
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="inputJornada4">Jornada</label>
								<select name="jornada" id="jornada" class="form-control input-sm">
									<option value="" disabled="" selected="">Seleccione...</option>
									<option value="Diurna">Diurna</option>
									<option value="Nocturna">Nocturna</option>
									<option value="Mixta">Mixta</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputDescripcion4">Descripción</label>
								<textarea name="descripcion" id="descripcion" class="form-control input-sm" cols="30" rows="5"></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevo" class="btn btn-outline-secondary">Agregar nuevo</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Editar-->
	<div class="modal fade bd-example-modal-lg" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar curso <span id="nombreU"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<div class="form-row">
							<div class="form-group col-md-9">
								<label for="inputNombre4">Nombre</label>
								<input type="text" class="form-control input-sm" id="cursoU" name="cursoU" required="">
								<input type="text" hidden="" id="idCursoU" name="idCursoU">
							</div>
							<div class="form-group col-md-3">
								<label for="inputJornada4">Jornada</label>
								<input type="text" class="form-control input-sm" id="jornadaU" name="jornadaU" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputGrupo4">Grupo</label>
								<input type="text" class="form-control input-sm" id="nombre_grupoU" name="nombre_grupoU" required="">
							</div>
							<div class="form-group col-md-8">
								<label for="inputJornada4">Centro de formación</label>
								<input type="text" class="form-control input-sm" id="centroU" name="centroU" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="inputHorario4">Horario</label>
								<input type="text" class="form-control input-sm" id="horarioU" name="horarioU" required="">
							</div>
							<div class="form-group col-md-3">
								<label for="inputIntensidad4">Intensidad</label>
								<input type="text" class="form-control input-sm" id="intensidadU" name="intensidadU" required="">
							</div>
							<div class="form-group col-md-3">
								<label for="inputFecha4">Fecha Inicio</label>
								<input type="date" class="form-control input-sm" name="fecha_inicioU"  id="fecha_inicioU" required="">
							</div>
							<div class="form-group col-md-3">
								<label for="inputMunicipio4">Municipio</label>
								<input type="text" class="form-control input-sm" name="municipioU"  id="municipioU" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputDireccion4">Dirección</label>
								<input type="text" class="form-control input-sm" id="direccionU" name="direccionU" required="">
							</div>
							<div class="form-group col-md-4">
								<label for="inputTipo4">Tipo formación</label>
								<input type="text" class="form-control input-sm" id="formacionU" name="formacionU" required="">
							</div>
							<div class="form-group col-md-4">
								<label for="inputEstado4">Estado</label>
								<input type="text" class="form-control input-sm" name="estadoU"  id="estadoU" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputDescripcion4">Descripción</label>
								<textarea name="descripcionU" id="descripcionU" class="form-control input-sm" cols="30" rows="5"></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-outline-secondary" id="btnActualizar">Actualizar</button>
				</div>
			</div>
		</div>
	</div>

<?php elseif(!empty($user) && ($user[9]=='2')): ?>
  
	<!-- contenido para Aprendiz -->
	<?php require_once '../header_aprendiz.php'; ?>

	<div class="mt-4 PopUpContainer">
		<div class="contentContainer">
		<ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li class="active">Cursos</li></ol>
		</div>
		<?php require_once '../popupLogin_aprendiz.php'; ?>
	</div>

	<input type="hidden" value="<?php echo $group?>" name= "valor" id="valor">
	<div class="container">
		<div class="row mt-1">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-center">
						Curso Disponibles En El Área <?php $group_ = (strlen($group) > 0 ) ? "De <b>". $group."</b>" : '' ; echo ($group_) ?>
					</div>
					<div class="card-body">
						<div id="tablaDatatable"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php elseif(!empty($user) && ($user[9]=='3')): ?>
  
	<!-- contenido para Orientador -->
	<?php require_once '../header_orientador.php'; ?>

	<div class="mt-4 PopUpContainer">
		<div class="contentContainer">
		<ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li class="active">Cursos</li></ol>
		</div>
		<?php require_once '../popupLogin_orientador.php'; ?>
	</div>

	<input type="hidden" value="<?php echo $group?>" name= "valor" id="valor">
	<div class="container">
		<div class="row mt-1">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-center">
						Curso Disponibles En El Área <?php $group_ = (strlen($group) > 0 ) ? "De <b>". $group."</b>" : '' ; echo ($group_) ?>
					</div>
					<div class="card-body">
						<div id="tablaDatatable"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php else: ?>
  
	<?php require_once '../header.php'; ?>

	<div class="mt-4 PopUpContainer">
		<div class="contentContainer">
		<ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li class="active">Cursos</li></ol>
		</div>
	</div>

	<input type="hidden" value="<?php echo $group?>" name= "valor" id="valor">
	<div class="container">
		<div class="row mt-1">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-center">
						Curso Disponibles En El Área <?php $group_ = (strlen($group) > 0 ) ? "De <b>". $group."</b>" : '' ; echo ($group_) ?>
					</div>
					<div class="card-body">
						<div id="tablaDatatable"></div>
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
		$('#btnAgregarnuevo').click(function(){
			datos=$('#frmnuevo').serialize();
			
			var idCurso = document.getElementsByName("idCurso")[0].value;
            var curso = document.getElementsByName("curso")[0].value;
            var nombre_grupo = document.getElementsByName("nombre_grupo")[0].value;
            var centro = document.getElementsByName("centro")[0].value;
            var horario = document.getElementsByName("horario")[0].value;
            var intensidad = document.getElementsByName("intensidad")[0].value;
            var fecha_inicio = document.getElementsByName("fecha_inicio")[0].value;
            var municipio = document.getElementsByName("municipio")[0].value;
            var direccion = document.getElementsByName("direccion")[0].value;
            var formacion = document.getElementsByName("formacion")[0].value;
            var estado = document.getElementsByName("estado")[0].value;
			var jornada = document.getElementsByName("jornada")[0].value;
			var descripcion = document.getElementsByName("descripcion")[0].value;

            if ((idCurso == "") || (curso == "")|| (nombre_grupo == "")|| (centro == "")|| (horario == "")|| (intensidad == "")|| (fecha_inicio == "")
            || (municipio == "")|| (direccion == "")|| (formacion == "")|| (estado == "")|| (jornada == "")|| (descripcion == "")) {  //COMPRUEBA CAMPOS VACIOS
                Swal.fire({
                icon: 'error',
                text: 'Por favor revisar, hay campos vacidos.',
                showConfirmButton: false,
                timer: 1500
                })
			}else{
				$.ajax({
					type:"POST",
					data:datos,
					url:"procesos/agregar.php",
					success:function(r){
						if(r==1){
							$('#agregarnuevosdatosmodal').modal('toggle');
							$('#frmnuevo')[0].reset();
							let valor = $('#valor').val();
							$('#tablaDatatable').load('tabla.php?name_group='+valor);
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

		$('#btnActualizar').click(function(){
			datos=$('#frmnuevoU').serialize();
			var cursoU = document.getElementsByName("cursoU")[0].value;
            var jornadaU = document.getElementsByName("jornadaU")[0].value;
            var nombre_grupoU = document.getElementsByName("nombre_grupoU")[0].value;
            var centroU = document.getElementsByName("centroU")[0].value;
            var horarioU = document.getElementsByName("horarioU")[0].value;
            var intensidadU = document.getElementsByName("intensidadU")[0].value;
            var fecha_inicioU = document.getElementsByName("fecha_inicioU")[0].value;
            var municipioU = document.getElementsByName("municipioU")[0].value;
            var direccionU = document.getElementsByName("direccionU")[0].value;
            var formacionU = document.getElementsByName("formacionU")[0].value;
            var estadoU = document.getElementsByName("estadoU")[0].value;
			var descripcionU = document.getElementsByName("descripcionU")[0].value;

            if ((cursoU == "") || (jornadaU == "")|| (nombre_grupoU == "")|| (centroU == "")|| (horarioU == "")|| (intensidadU == "")|| (fecha_inicioU == "")
            || (municipioU == "")|| (direccionU == "")|| (formacionU == "")|| (estadoU == "")|| (descripcionU == "")) {  //COMPRUEBA
                Swal.fire({
                icon: 'error',
                text: 'Por favor revisar, hay campos vacidos.',
                showConfirmButton: false,
                timer: 1500
                })
			}else{
				$.ajax({
					type:"POST",
					data:datos,
					url:"procesos/actualizar.php",
					success:function(r){
						if(r==1){
							$('#modalEditar').modal('toggle');
							let valor = $('#valor').val();
							$('#tablaDatatable').load('tabla.php?name_group='+valor);
							Swal.fire(
							'Correcto!',
							'Se ha actualizado correctamente!',
							'success'
							);					
						}else{
							Swal.fire(
							'Error!',
							'No se ha actualizado correctamente!',
							'error'
							);					
						}
					}
				});
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		let valor = $('#valor').val();
		$('#tablaDatatable').load('tabla.php?name_group='+valor);
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(idCurso){
		$.ajax({
			type:"POST",
			data:"id=" + idCurso,
			url:"procesos/obtenDatos.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idCursoU').val(datos['id']);
				$('#cursoU').val(datos['curso']);
				$('#jornadaU').val(datos['jornada']);
				$('#nombre_grupoU').val(datos['nombre_grupo']);
				$('#centroU').val(datos['centro']);
				$('#horarioU').val(datos['horario']);
				$('#intensidadU').val(datos['intensidad']);
				$('#fecha_inicioU').val(datos['fecha_inicio']);
				$('#municipioU').val(datos['municipio']);
				$('#direccionU').val(datos['direccion']);
				$('#formacionU').val(datos['formacion']);
				$('#estadoU').val(datos['estado']);
				$('#descripcionU').val(datos['descripcion']);
			}
		});
	}

	function eliminarDatos(idCurso){
		const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-outline-success',
			cancelButton: 'btn btn-outline-danger'
		},
		buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
		title: '¿Está seguro?',
		text: "¡No podrás revertir esto!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: '¡Si, bórralo!',
		cancelButtonText: '¡No, cancela!',
		reverseButtons: true
		}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type:"POST",
				data:"id=" + idCurso,
				url:"procesos/eliminar.php",
				success:function(r){
					if(r==1){
						let valor = $('#valor').val();
						$('#tablaDatatable').load('tabla.php?name_group='+valor);
						swalWithBootstrapButtons.fire(
						'¡Eliminado!',
						'El curso ha sido eliminado.',
						'success'
						)
					}else{
						swalWithBootstrapButtons.fire(
						'¡Eliminado!',
						'El curso no ha sido eliminado.',
						'error'
						)
					}
				}
			});
			
		} else if (
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
			'Cancelado',
			'El curso está seguro, ha cancelado la eliminación.',
			'error'
			)
		}
		});
	}

	
</script>
