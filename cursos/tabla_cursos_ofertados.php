
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
$centro = $user[16];

if ($centro == "" || $centro == "OFICINA") {
	$centro = "";
}else{
	$centro = "WHERE centro = '{$user[16]}'";
}

$tildes = $conexion->query("SET NAMES 'utf8'");
$sql="SELECT id, codigo_curso, curso, jornada, horario, intensidad, fecha_inicio, municipio, direccion, formacion, centro, descripcion, estado FROM cursos $centro";
$result=mysqli_query($conexion,$sql);

?>

<div>
	<div class="table-responsive">

		<table class="table table-hover small" id="cargarCursosOfertados">
			<thead class="text-center bg-primary">
				<tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Jornada</th>
                    <th>Horario</th>
                    <th>Intensidad</th>
                    <th>Inicio</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Centro</th>
                    <th>Estado</th>
                    <th>No. Inscritos</th>
                    <th>Ver Detalle</th>
                    <th>Inscribir</th>
				</tr>
			</thead>
			
			<tbody >
				<?php 
				    while ($mostrar=mysqli_fetch_row($result)) {
					    ?>
						<tr class="text-center">

							<td><?php echo strtoupper($mostrar[1]); ?></td>
							<td><?php echo strtoupper($mostrar[2]); ?></td>
							<td><?php echo strtoupper($mostrar[3]); ?></td>
							<td><?php echo strtoupper($mostrar[4]); ?></td>
							<td><?php echo strtoupper($mostrar[5]); ?></td>
							<td><?php echo strtoupper($mostrar[6]); ?></td>
							<td><?php echo strtoupper($mostrar[7]); ?></td>
							<td><?php echo strtoupper($mostrar[8]); ?></td>
							<td><?php echo strtoupper($mostrar[10]); ?></td>
							<td><?php echo strtoupper($mostrar[12]); ?></td>
							<td>
                                <?php echo "<b>".$contarInscritos = mysqli_fetch_row(mysqli_query($conexion, "SELECT COUNT(YIC.id_curso) AS ContarInscritos, C.curso FROM y_inscritos_cursos YIC
																												INNER JOIN users U ON U.id = YIC.id_usuario 
																												INNER JOIN cursos C ON C.codigo_curso = YIC.id_curso
																												WHERE YIC.estado = 1 AND C.codigo_curso =".$mostrar[1].""))[0]."</b>";?>
                            </td>
                            <td>
							    <a href="inscritos_cursos.php?id=<?php echo $mostrar[1] ?>" class="btn btn-outline-info btn-sm"><span class="fa fa-eye"></span> </a>
                            </td>
                            <td>
							    <a href="inscribir_aprendiz_.php?id=<?php echo $mostrar[1] ?>" class="btn btn-outline-success btn-sm"><span class="fa fa-user-o"></span> </a>
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