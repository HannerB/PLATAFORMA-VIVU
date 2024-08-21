
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
$tildes = $conexion->query("SET NAMES 'utf8'");
$sql="SELECT YIC.id, YIC.id_curso, C.curso, C.jornada,  C.horario,  C.intensidad,  C.fecha_inicio,  C.municipio,  C.direccion,  C.formacion,  C.centro,  C.descripcion, U.documento, YE.nombre
FROM y_inscritos_cursos YIC
INNER JOIN cursos C ON C.codigo_curso = YIC.id_curso
INNER JOIN users U ON U.id = YIC.id_usuario
INNER JOIN y_estado YE ON YE.id = YIC.estado
WHERE YIC.id_usuario = {$user[0]} AND YIC.estado = 1";
$result=mysqli_query($conexion,$sql);

?>

<div>
	<div class="table-responsive">

		<table class="table table-hover small" id="cargarDetalle">
			<thead class="text-center bg-primary">
				<tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Centro</th>
                    <th class="text-center">Jornada</th>
                    <th class="text-center">Horario</th>
                    <th class="text-center">Intensidad</th>
                    <th class="text-center">Inicio</th>
                    <th class="text-center">Municipio</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Formación</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Estado</th>
				</tr>
			</thead>
			
			<tbody >
				<?php 
				while ($mostrar=mysqli_fetch_row($result)) {
					?>
						<tr class="text-center">
							<td><?php echo strtoupper($mostrar[2]); ?></td>
							<td><?php echo strtoupper($mostrar[10]); ?></td>
							<td><?php echo strtoupper($mostrar[3]); ?></td>
							<td><?php echo strtoupper($mostrar[4]); ?></td>
							<td><?php echo strtoupper($mostrar[5]); ?></td>
							<td><?php echo strtoupper($mostrar[6]); ?></td>
							<td><?php echo strtoupper($mostrar[7]); ?></td>
							<td><?php echo strtoupper($mostrar[8]); ?></td>
							<td><?php echo strtoupper($mostrar[9]); ?></td>
							<td><?php echo strtoupper($mostrar[11]); ?></td>
							<td><?php echo strtoupper($mostrar[13]); ?></td>
						</tr>
					<?php 
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {
		$('#cargarDetalle').DataTable();
	} );

	var table = $('#cargarDetalle').DataTable({
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