<?php
require 'database.php';


include_once 'config.inc.php';
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$ruta = $_FILES['archivo']['tmp_name'];

$destino = "assets/" .time().$nombre;
$destinon = time().$nombre;
if ($nombre != "") {
	if (copy($ruta, $destino)) {
		$Codigo=$_POST['txtCodigo'];
		$Nombres=$_POST['txtNombres'];
		$Apellidos=$_POST['txtApellidos'];
		$tipoDocumento=$_POST['txtTipoDocumento'];
		$Documento=$_POST['txtDocumento'];
		$TipoPoblacion=$_POST['txtTipoPoblacion'];
		$Sexo=$_POST['txtSexo'];
		$Municipio=$_POST['txtMunicipio'];
		$Nacimiento=$_POST['txtFechaNacimiento'];
		$Correo=$_POST['txtCorreo'];
		$Telefono=$_POST['txtTelefono'];

		$sql="UPDATE users SET nombres='$Nombres',apellidos='$Apellidos',sexo='$Sexo',tipodocumento='$tipoDocumento	',documento='$Documento',fechaNacimiento='$Nacimiento',telefono='$Telefono',tipoPoblacion='$TipoPoblacion',municipio='$Municipio',email='$Correo',img='$destinon', tipo_archivo='$tipo' WHERE id='$Codigo'";

		$stmt = $conn->prepare($sql);

		if ($stmt->execute()) {
			echo "<script>alert('Usted ha modificado su perfil, correctamente.');window.location='perfil.php';</script>";
		}  else {
			echo 'Lo sentimos, ha ocurrido un error al momento de modificar.';
		}
	}
}else{
	$Codigo=$_POST['txtCodigo'];
	$Nombres=$_POST['txtNombres'];
	$Apellidos=$_POST['txtApellidos'];
	$tipoDocumento=$_POST['txtTipoDocumento'];
	$Documento=$_POST['txtDocumento'];
	$TipoPoblacion=$_POST['txtTipoPoblacion'];
	$Sexo=$_POST['txtSexo'];
	$Municipio=$_POST['txtMunicipio'];
	$Nacimiento=$_POST['txtFechaNacimiento'];
	$Correo=$_POST['txtCorreo'];
	$Telefono=$_POST['txtTelefono'];

	$sql="UPDATE users SET nombres='$Nombres',apellidos='$Apellidos',sexo='$Sexo',tipodocumento='$tipoDocumento',documento='$Documento',fechaNacimiento='$Nacimiento',telefono='$Telefono',tipoPoblacion='$TipoPoblacion',municipio='$Municipio',email='$Correo' WHERE id='$Codigo'";

	$stmt = $conn->prepare($sql);

	if ($stmt->execute()) {
		echo "<script>alert('Usted ha modificado su perfil, correctamente.');window.location='perfil.php';</script>";
	}  else {
		echo 'Lo sentimos, ha ocurrido un error al momento de modificar.';
	}
}
	?>