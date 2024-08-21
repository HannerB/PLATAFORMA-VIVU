<?php 
include ("conexion.php");

include_once 'config.inc.php';
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$ruta = $_FILES['archivo']['tmp_name'];

$destino = "assets/" .time().$nombre;
$destinon = time().$nombre;


$Nombre_Grupo=$_POST['txtNombre'];


$sql_c="SELECT count(nombre_grupo) As Conteo FROM grupos where nombre_grupo='$Nombre_Grupo' group by nombre_grupo";

$res_c=mysqli_query($cn,$sql_c);

$data_C=mysqli_fetch_array($res_c);

$Conteo=$data_C['Conteo'];

if ($Conteo<1) {

	if ($nombre != "") {
		if (copy($ruta, $destino)) {	
			
			$sql="INSERT INTO grupos (nombre_grupo, tipo_archivo, nombre_archivo) VALUE('$Nombre_Grupo','$tipo','$destinon')";

			$res=mysqli_query($cn,$sql);

			$data=mysqli_fetch_array($res);

			echo "<script>alert('Se ha creado un nuevo grupo correctamente.'); window.location='cursos.php';</script>";
		}
	}
}else {
	echo 'Lo sentimos, ha ocurrido un error al momento de crear el grupo.';
}
?>