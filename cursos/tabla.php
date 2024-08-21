
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

$user = null;

if($_GET['name_group'] == "Salud"){
	$group = "Salud Ocupacional";
}else{
	$group = $_GET['name_group'];
}
$tildes = $conexion->query("SET NAMES 'utf8'");
$sql="SELECT id, codigo_curso, curso, jornada, horario, intensidad, fecha_inicio, municipio, direccion, formacion, centro, descripcion, nombre_grupo, estado FROM cursos where estado='Activo' AND nombre_grupo='$group'";
$result=mysqli_query($conexion,$sql);
?>

<div>
	<div class="table-responsive">

		<table class="table table-hover small" id="cargarListadoCursos">
			<thead class="text-center bg-primary">
				<tr>
					<td>Curso</td>
					<td>Jornada</td>
					<td>Horario</td>
					<td>Intensidad</td>
					<td>Inicia</td>
					<td>Municipio</td>
					<td>Lugar</td>
					<td>Descripción</td>
					<?php if(!empty($user) && ($user=='1') || ($user=='2')): ?>
						<td width="16%">Acciones</td>
					<?php else: ?>
						<td width="16%">Acciones</td>
					<?php endif; ?>
				</tr>
			</thead>
			
			<tbody >
				<?php 
				while ($mostrar=mysqli_fetch_row($result)) {
					?>
						<tr class="text-center">
							<td><?php echo strtoupper($mostrar[2]); ?></td>
							<td><?php echo strtoupper($mostrar[3]); ?></td>
							<td><?php echo strtoupper($mostrar[4]); ?></td>
							<td><?php echo strtoupper($mostrar[5]); ?></td>
							<td><?php echo strtoupper($mostrar[6]); ?></td>
							<td><?php echo strtoupper($mostrar[7]); ?></td>
							<td><?php echo strtoupper($mostrar[8]); ?></td>
							<td><?php echo strtoupper($mostrar[11]); ?></td>
							<?php if(!empty($user) && ($user[9]=='1')): ?>
								<td style="text-align: center;" >
									<span class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[0] ?>')">
										<span class="fa fa-pencil-square-o"></span>
									</span>

									<a class="btn btn-outline-info btn-sm" href="../ver_detalle.php?id=<?php echo $mostrar[1] ?>"><span class="fa fa-eye"></span></a>
								
									<span class="btn btn-outline-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0] ?>')">
										<span class="fa fa-trash"></span>
									</span>
								</td>
							<?php elseif(!empty($user) && ($user[9]=='2')): ?>
								<?php 
									$eCurso = mysqli_fetch_row(mysqli_query($conexion, "SELECT estado FROM y_inscritos_cursos where id_usuario='$user[0]' and id_curso='$mostrar[0]' order by id desc limit 1"))[0];
								
								?>
								<td style="text-align: center;" >
									<!-- Estado inscrito -->
									<?php if(($eCurso == 1)): ?>
										<span class="btn btn-outline-secondary btn-sm">
											<span class="fa fa-check-square-o"></span> Inscrito
										</span>
									<?php else:?>
										<span class="btn btn-outline-secondary btn-sm" onclick="btnInscribir(<?php echo $mostrar[1];?>, <?php echo $user[0];?>)">
											<span class="fa fa-plus-square-o"></span> Inscribir
										</span>
									<?php endif; ?>

									<a class="btn btn-outline-info btn-sm" href="../ver_detalle.php?id=<?php echo $mostrar[1] ?>"><span class="fa fa-eye"></span></a>

								</td>
							<?php elseif(!empty($user) && ($user[9]=='3')): ?>
								<?php 
									$eCurso = mysqli_fetch_row(mysqli_query($conexion, "SELECT estado FROM y_inscritos_cursos where id_usuario='$user[0]' and id_curso='$mostrar[0]'"))[0];
                          		?>
								<td style="text-align: center;" >
									<span class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalVer" onclick="">
										<span class="fa fa-eye"></span>
									</span>
								</td>
							<?php else: ?>
								<td style="text-align: center;" >
									<a href="../sign_in.php" class="btn btn-outline-secondary btn-sm"><span class="fa fa-plus-square-o"></span> Inscribir</a>
									
									<a class="btn btn-outline-info btn-sm" href="../ver_detalle.php?id=<?php echo $mostrar[1] ?>"><span class="fa fa-eye"></span></a>

								</td>
							<?php endif; ?>
						</tr>
					<?php 
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	function btnInscribir(idCurso, idUsuario){
		var datos = {
			"idCurso" : idCurso,
			"idUsuario" : idUsuario
        };
		$.ajax({
			type:"POST",
			data: datos,
			url:"procesos/agregarInscripcion.php",
			success:function(r){
				if(r == 1){
					let valor = $('#valor').val();
					$('#tablaDatatable').load('tabla.php?name_group='+valor);
					Swal.fire(
					'Correcto!',
					'Se ha inscrito correctamente!',
					'success'
					);
				}else if(r == 2){
					Swal.fire(
					'Ojo!',
					'No te puedes inscribir debido que ya cuentas con 2 inscripciones vigentes.',
					'warning'
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
	$('#btnInscribir').click(function(){
			datos=$('#frmInscribir').serialize();

			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/agregarInscripcion.php",
				success:function(r){
					if(r==1){
						let valor = $('#valor').val();
						$('#tablaDatatable').load('tabla.php?name_group='+valor);
						Swal.fire(
						'Correcto!',
						'Se ha inscrito correctamente!',
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
		});

	$(document).ready(function() {
		$('#cargarListadoCursos').DataTable();
	} );

	var table = $('#cargarListadoCursos').DataTable({
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
        "infoEmpty": "Mostrando 0 de 0 de 0 Registros",
        "infoFiltered": "(Filtrado de _MAX_ total Registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
});
</script>