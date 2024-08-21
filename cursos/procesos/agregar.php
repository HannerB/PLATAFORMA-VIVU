<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['idCurso'],
		$_POST['curso'],
		$_POST['jornada'],
		$_POST['nombre_grupo'],
		$_POST['centro'],
		$_POST['horario'],
		$_POST['intensidad'],
		$_POST['fecha_inicio'],
		$_POST['municipio'],
		$_POST['direccion'],
		$_POST['formacion'],
		$_POST['estado'],
		$_POST['descripcion']
				);

	echo $obj->agregar($datos);
	

 ?>