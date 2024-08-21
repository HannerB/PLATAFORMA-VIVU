<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();
	$datos=array(
				$_POST['txtId'],
				$_POST['txtNombres'],
				$_POST['txtApellidos'],
				$_POST['txtSexo'],
				$_POST['txtFechaNacimiento'],
				$_POST['txtCorreo'],
				$_POST['txtTipoDocumento'],
				$_POST['txtDocumento'],
				$_POST['txtTelefono'],
				$_POST['txtMunicipio'],
				$_POST['txtTipoPoblacion'],
				$_POST['new_password'],
				$_POST['password'],
				$_POST['archivo']
			);

        

	echo $obj->actualizarPerfil($datos);
	

 ?>