<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['txtNombres'],
		$_POST['txtApellidos'],
		$_POST['txtSexo'],
		$_POST['txtFechaNacimiento'],
		$_POST['txtCorreo'],
		$_POST['txtPassword'],
		$_POST['txtTipoDocumento'],
		$_POST['txtDocumento'],
		$_POST['txtTelefono'],
		$_POST['txtMunicipio'],
		$_POST['txtRol'],
		$_POST['txtTipoPoblacion']
				);

    if($datos[7] > 0){
          
        $contarId = $obj->consultarAprendiz($datos);
        if($contarId > 0){
            echo "2";
        }else{
            echo $obj->guardarAprendiz($datos);
        }    
    }else{
      echo "0";
    }
                    

	

 ?>