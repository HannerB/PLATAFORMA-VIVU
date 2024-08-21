<?php

require 'database.php';


  $Nombres=$_POST['txtNombres'];
  $Apellidos=$_POST['txtApellidos'];
  $Telefono=$_POST['txtTelefono'];
  $Correo=$_POST['txtCorreo'];
  $NombreDelCurso=$_POST['txtNombreDelCurso'];
  
  $Fecha=date('y-m-d');
  $sql = "INSERT INTO cursos_solicitados(`nombres`, `apellidos`, `telefono`, `correo`, `nombreCursoSolicitado`, fechaRegistro) VALUES ('$Nombres','$Apellidos','$Telefono', '$Correo','$NombreDelCurso','$Fecha')";
  $stmt = $conn->prepare($sql);

  if ($stmt->execute()) {
    echo "<script>alert('Su solicitud ha sido registrada con exito, pronto recibirá respuesta en el correo que suministró.');window.location='cursos.php';</script>";

    /*ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "concurso@planeacionsat.com";
    $to = "lcricom@sena.edu.co,rcervantes@sena.edu.co";
    $subject = "Hola, soy ".$Nombre." ya me registré satisfactoriamente.";
    $message = "Mis datos son los siguientes:
    Nombres y Apellidos: ".$Nombre." ".$Apellido.".
    Tipo de documento es ".$TipoDocumento.", mi número de documento es: ".$Documento.".
    Mi correo electronico es: ".$Correo.".
    Tengo ".$Edad." años, soy del genero: ".$Sexo.".
    Mi número de teléfono es: ".$Telefono.".
    Vivo en el municipio de ".$Municipio.", en la dirección: ".$Direccion.".
    Estudio ".$Nivel." en ".$Programa." de la ficha de caracterización: ".$Ficha." y estoy en ".$Trimestre.".";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);*/

  } else {
    echo  "<script>alert('Lo sentimos, debe haber habido un problema al guardar su solicitud.');window.location='cursos.php';</script>";

  }

?>