
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
$CC = $_GET['id'];
$tildes = $conexion->query("SET NAMES 'utf8'");
$sql="SELECT U.nombres, U.apellidos, U.tipodocumento, U.documento, U.tipoPoblacion, U.email, U.telefono, YIC.fecha_reg, YIC.id_curso As codigoCurso, YIC.`id` As id_inscrito, U.id As idUser 
FROM y_inscritos_cursos YIC 
INNER JOIN users U ON U.id = YIC.id_usuario
INNER JOIN cursos C ON C.codigo_curso = YIC.id_curso
WHERE YIC.estado = 1 AND C.codigo_curso = $CC";
$result=mysqli_query($conexion,$sql);

?>
<input type="hidden" id="id" name="" value="<?php echo $CC; ?>">
<div >
	<div class="table-responsive">

		<table class="table table-hover small" id="cargarCursosOfertados">
			<thead class="text-center bg-primary">
				<tr>
					<th class="text-center">No.</th>
					<th class="text-center">Nombres y apellidos</th>
					<th class="text-center">Tipo de Documento</th>
					<th class="text-center">Documento</th>
					<th class="text-center">Tipo de población</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Email</th>
					<th class="text-center">Fecha de Reg.</th>                      
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			
			<tbody >
				<?php 
				    while ($mostrar=mysqli_fetch_row($result)) {
					    ?>
						<tr class="text-center">
							<td><b><?php $i=$i+1; echo $i; ?></b></td>
							<td><?php echo strtoupper($mostrar[0]." ".$mostrar[1]); ?></td>
							<td><?php echo strtoupper($mostrar[2]); ?></td>
							<td><?php echo strtoupper($mostrar[3]); ?></td>
							<td><?php echo strtoupper($mostrar[4]); ?></td>
							<td><?php echo strtoupper($mostrar[6]); ?></td>
							<td><?php echo strtoupper($mostrar[5]); ?></td>
							<td><?php echo strtoupper($mostrar[7]); ?></td>
							<td>
								<span class="btn btn-outline-danger btn-sm" onclick="btnEliminarAprendiz(<?php echo $mostrar[9];?>,<?php echo $CC;?>)">
									<span class="fa fa-trash"></span>
								</span>
							</td>
                           
						</tr>
					<?php 
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">


function btnEliminarAprendiz(id, idCurso){
		
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
      	var datos = {
			"id" : id,
			"idCurso" : idCurso
        };

			$.ajax({
        
				type:"POST",
				data: datos,
				url:"procesos/eliminar_arendiz_curso.php",
				success:function(r){
					if(r==1){
						let valor = $('#id').val();
						$('#cargarCursos').load('tabla_detalle_inscritos.php?id='+idCurso);
						swalWithBootstrapButtons.fire(
						'¡Eliminado!',
						'El aprendiz ha sido eliminado del curso.',
						'success'
						)
					}else{
						swalWithBootstrapButtons.fire(
						'¡Eliminado!',
						'El aprendiz no ha sido eliminado.',
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

	$(document).ready(function() {
		$('#cargarCursosOfertados').DataTable();
	} );

	var table = $('#cargarCursosOfertados').DataTable({
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