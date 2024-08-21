<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datos=array(
				$_POST['idCursoU'],
				$_POST['cursoU'],
				$_POST['jornadaU'],
				$_POST['nombre_grupoU'],
				$_POST['centroU'],
				$_POST['horarioU'],
				$_POST['intensidadU'],
				$_POST['fecha_inicioU'],
				$_POST['municipioU'],
				$_POST['direccionU'],
				$_POST['formacionU'],
				$_POST['estadoU'],
				$_POST['descripcionU']
			);



	echo $obj->actualizar($datos);
	

 ?>