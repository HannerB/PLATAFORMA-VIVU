<?php
	require_once "./cursos/clases/conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();
	$tildes = $conexion->query("SET NAMES 'utf8'");

	$fecha=date('y-m-d');

	$Correo_Electronico=$_POST['email'];
	$sql="UPDATE users SET fecha_sesion='$fecha' WHERE email='$Correo_Electronico'";

	$stmt = mysqli_query($conexion, $sql);

?>