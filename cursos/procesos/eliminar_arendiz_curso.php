<?php 
	
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";

	$obj= new crud();

	echo $obj->eliminar_arendiz($_POST['id'], $_POST['idCurso']);

 ?>