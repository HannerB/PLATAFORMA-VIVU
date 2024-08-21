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
		$_POST['txtTipoDocumento'],
		$_POST['txtDocumento'],
		$_POST['txtTelefono'],
		$_POST['txtMunicipio'],
		$_POST['txtTipoPoblacion'],
		$_POST['txtOcupacion']
				);

    if($datos[6] > 0){
          
        $contarId = $obj->consultarAprendizC($datos);
        if($contarId > 0){
            echo "2";
        }else{
            echo $obj->guardarAprendizC($datos);
        }    
    }else{
      echo "0";
    }
                    

	

 ?>