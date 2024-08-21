<?php 
include ("conexion.php");

$Regional=$_POST['txtRegional'];
$Centro=$_POST['txtCentro'];
$CodigoProyecto=$_POST['txtCodigoProyecto'];
$Nombres=$_POST['txtNombres'];
$Apellidos=$_POST['txtApellidos'];
$Documento=$_POST['txtDocumento'];
$FechaNacimiento=$_POST['txtFechaNacimiento'];
$CiudadNacimiento=$_POST['txtCiudadNacimiento'];
$Correo=$_POST['txtCorreo'];
$DepartamentoNacimiento=$_POST['txtDepartamentoNacimiento'];
$Genero=$_POST['txtGenero'];
$TelefonoOficina=$_POST['txtTelefonoOficina'];
$TelefonoMovil=$_POST['txtTelefonoMovil'];
$Direccion=$_POST['txtDireccion'];
$CiudadResidencia=$_POST['txtCiudadResidencia'];
$DepartamentoResidencia=$_POST['txtDepartamentoResidencia'];
$Caracterizacion=$_POST['txtCaracterizacion'];

//Academicos
$Formacion=$_POST['txtFormacion'];
$ProgramaFormacion=$_POST['txtProgramaFormacion'];
$Institucion=$_POST['txtInstitucion'];
$EstadoInstitucion=$_POST['txtEstadoInstitucion'];
$Servicio=$_POST['txtServicio'];

//Empresa
$Empresa=$_POST['txtEmpresa'];
$Nit=$_POST['txtNit'];
$Estatus=$_POST['txtEstatus'];
$FechaConstitucion=$_POST['txtFechaConstitucion'];
$RepresentanteLegal=$_POST['txtRepresentanteLegal'];
$TamanoEmpresa=$_POST['txtTamanoEmpresa'];
$ActividadEconomica=$_POST['txtActividadEconomica'];
$SectorEconomico=$_POST['txtSectorEconomico'];
$TipoSociedad=$_POST['txtTipoSociedad'];
$DireccionEmpresa=$_POST['txtDireccionEmpresa'];
$PaginaWeb=$_POST['txtPaginaWeb'];
$CiudadEmpresa=$_POST['txtCiudadEmpresa'];
$DepartamentoEmpresa=$_POST['txtDepartamentoEmpresa'];
$CorreoEmpresa=$_POST['txtCorreoEmpresa'];
$NumeroEmpleosFormales=$_POST['txtNumeroEmpleosFormales'];
$NumeroEmpleosInformales=$_POST['txtNumeroEmpleosInformales'];
$VendeInternet=$_POST['txtVendeInternet'];
$NegocioCasa=$_POST['txtNegocioCasa'];
$Descripcion=$_POST['txtDescripcion'];


$sql_c="SELECT count(documentoPersonal) As ConteoPass FROM emprendimiento where documentoPersonal='$Documento'";
$res_c=mysqli_query($cn,$sql_c);

$data_C=mysqli_fetch_array($res_c);

$Conteo=$data_C['ConteoPass'];
if ($Conteo<1) {

	$sql="INSERT INTO emprendimiento ( `regional`, `centroFormacion`, `codigoProyecto`, `nombresPersonal`, `apellidosPersonal`, `documentoPersonal`, `fechaNacimiento`, `ciudadNacimiento`, `departamentoNacimiento`, `correoPersonal`, `genero`, `telefonoOficinaPersonal`, `telefonoMovilPersonal`, `direccionResidencia`, `ciudadResidencia`, `departamentoResidencia`, `tipoPoblacionPersonal`, `formacionAcademica`, `programaFormacion`, `institucionAcademica`, `estadoAcademica`, `servicioRequerido`, `nombreEmpresa`, `nitEmpresa`, `estatusEmpresa`, `fechaConstitucionEmpresa`, `representanteEmpresa`, `tamanoEmpresa`, `actividadEconomicaEmpresa`, `sectorEconomicoEmpresa`, `tipoSociedadEmpresa`, `direccionEmpresa`, `paginaWebEmpresa`, `ciudadEmpresa`, `departamentoEmpresa`, `correoEmpresa`, `empleadosFormales`, `empleadosInformales`, `descripcionProductosEmpresa`, `internetEmpresa`, `negocioEnCasa`) VALUE ('$Regional','$Centro','$CodigoProyecto','$Nombres','$Apellidos','$Documento','$FechaNacimiento','$CiudadNacimiento','$DepartamentoNacimiento','$Correo','$Genero','$TelefonoOficina','$TelefonoMovil','$Direccion','$CiudadResidencia','$DepartamentoResidencia','$Caracterizacion','$Formacion','$ProgramaFormacion','$Institucion','$EstadoInstitucion','$Servicio','$Empresa','$Nit','$Estatus','$FechaConstitucion','$RepresentanteLegal','$TamanoEmpresa','$ActividadEconomica','$SectorEconomico','$TipoSociedad','$DireccionEmpresa','$PaginaWeb','$CiudadEmpresa','$DepartamentoEmpresa','$CorreoEmpresa','$NumeroEmpleosFormales','$NumeroEmpleosInformales','$Descripcion','$VendeInternet','$NegocioCasa')";

	$res=mysqli_query($cn,$sql);

	$data=mysqli_fetch_array($res);  
	echo "<script>alert('Usted ha enviado su formato de inscripción al servicio de asesoría, correctamente.');window.location='emprendimiento.php';</script>";
}
else {
	echo "<script>alert('Lo sentimos, ha ocurrido un error al momento de enviar su inscripción, usted ya tiene una inscripción en proceso.');window.location='emprendimiento.php';</script>";
}

/*echo $Regional."<br>";
echo $Centro."<br>";
echo $CodigoProyecto."<br>";
echo $Nombres."<br>";
echo $Apellidos."<br>";
echo $Documento."<br>";
echo $Correo."<br>";
echo $FechaNacimiento."<br>";
echo $CiudadNacimiento."<br>";
echo $DepartamentoNacimiento."<br>";
echo $Genero."<br>";
echo $TelefonoOficina."<br>";
echo $TelefonoMovil."<br>";
echo $Direccion."<br>";
echo $CiudadResidencia."<br>";
echo $DepartamentoResidencia."<br>";
echo $Caracterizacion."<br>";
echo $Formacion."<br>";
echo $ProgramaFormacion."<br>";
echo $Institucion."<br>";
echo $EstadoInstitucion."<br>";
echo $Servicio."<br>";
echo $Empresa."<br>";
echo $Nit."<br>";
echo $Estatus."<br>";
echo $FechaConstitucion."<br>";
echo $RepresentanteLegal."<br>";
echo $TamanoEmpresa."<br>";
echo $ActividadEconomica."<br>";
echo $SectorEconomico."<br>";
echo $TipoSociedad."<br>";
echo $DireccionEmpresa."<br>";
echo $PaginaWeb."<br>";
echo $CiudadEmpresa."<br>";
echo $DepartamentoEmpresa."<br>";
echo $CorreoEmpresa."<br>";
echo $NumeroEmpleosFormales."<br>";
echo $NumeroEmpleosInformales."<br>";
echo $VendeInternet."<br>";
echo $NegocioCasa."<br>";
echo $Descripcion."<br>";
*
?>