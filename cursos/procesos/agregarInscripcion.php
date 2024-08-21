<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['idCurso'],
		$_POST['idUsuario']
				);

	$contarId = $obj->consultarInscripcion($datos);
	if($contarId == 2){
		echo "2";
	}else{
		echo $obj->agregarInscripcion($datos);
	}

 ?>