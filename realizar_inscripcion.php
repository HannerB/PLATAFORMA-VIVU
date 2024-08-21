<?php
session_start();



if (isset($_POST["user_id"]) & isset($_POST["poblacion"])) {

    include 'conexion1.php';

    $usuario = $_POST["user_id"];

    $poblacion = $_POST["poblacion"];
    $correo = $_POST["txtCorreo"];
    $telefono = $_POST["txtTelefono"];
    $modo_Guardar = $_POST["documento"];
    $curso = $_POST["id_curso"];

    $sql = "UPDATE users SET tipoPoblacion='$poblacion', email='$correo', telefono='$telefono' WHERE users.id=" . $usuario;

    $resultado2 = $mysqli->query($sql);
} else {

    $poblacion = $_POST["txtTipoPoblacion"];
    $correo = $_POST["txtCorreo"];
    $telefono = $_POST["txtTelefono"];

    $txtNombres = $_POST["txtNombres"];
    $txtApellidos = $_POST["txtApellidos"];
    $txtSexo = $_POST["txtSexo"];

    $txtFechaNacimiento = $_POST["txtFechaNacimiento"];
    $txtPassword = $_POST["txtPassword"];

    $txtTipoDocumento = $_POST["txtTipoDocumento"];
    $txtDocumento = $_POST["txtDocumento"];

    $txtMunicipio = $_POST["txtMunicipio"];


    $modo_Guardar = $_POST["documento"];
    $curso = $_POST["id_curso"];



    include 'conexion1.php';

    $sql = "INSERT INTO users (nombres, apellidos, sexo, tipodocumento, documento, fechaNacimiento, telefono, tipoPoblacion, municipio, email, password, rol) VALUES ('$txtNombres','$txtApellidos','$txtSexo','$txtTipoDocumento','$txtDocumento','$txtFechaNacimiento','$telefono','$poblacion','$txtMunicipio','$correo','$txtPassword','2')";

    $resultado1 = $mysqli->query($sql);

    //var_dump($resultado1);

    $sql = "SELECT * FROM users where users.documento=" . $txtDocumento;
    $query = $mysqli->query($sql);

    while ($row = $query->fetch_object()) {
        $usuario = $row->id;
    }
}


//codigo para evitar varios registros










$registro_sofia = $_POST["inscritoSofia"];
if ($registro_sofia == "No") {

    $pais_nacimiento = $_POST["Pais"];
    $departamento_nacimiento = $_POST["Departamento"];
    $municipio_nacimiento = $_POST["Municipio"];
    $fecha_exped_cedula = $_POST["expedicion"];
    $pais_cedula = $_POST["Pais2"];
    $departamento_cedula = $_POST["Departamento2"];
    $municipio_cedula = $_POST["Municipio2"];

    $sql = "INSERT INTO no_inscritos_sofiaplus (pais_nacimiento, departamento_nacimiento, municipio_nacimiento, fecha_exped_cedula, pais_cedula, departamento_cedula, municipio_cedula, id_users, registro_sofia, curso_id) VALUES ('$pais_nacimiento','$departamento_nacimiento','$municipio_nacimiento','$fecha_exped_cedula','$pais_cedula','$departamento_cedula', '$municipio_cedula','$usuario','$registro_sofia','$curso')";

    $resultado1 = $mysqli->query($sql);
}





$sql1 = "SELECT cupo FROM gestion_cursos WHERE gestion_cursos.id_Gestion_Cursos=" . $curso;

    $resultado2 = $mysqli->query($sql1);

    while ($row1 = $resultado2->fetch_object()) {
        $cupo = $row1->cupo;
    }




if ($modo_Guardar == 1) {

    $fichero = $_FILES["filePDF"];

    $InformacionArchivo = pathinfo($_FILES['filePDF']['name']);
    $NombreArchivo = $_FILES['filePDF']['name'];
    $NombreArchivo = $InformacionArchivo['filename'];
    $Extension = $InformacionArchivo['extension'];
    $ArchivoPDF = $usuario . "." . $Extension;

    var_dump($fichero);

    $Ubicacion = 'files/' . $ArchivoPDF;
    copy($_FILES['filePDF']['tmp_name'], $Ubicacion);

    include 'conexion1.php';

    $sql = "INSERT INTO files (id_users, ruta) VALUES ('$usuario','$Ubicacion')";

    $resultado1 = $mysqli->query($sql);


    $sql = 'SELECT * FROM files WHERE files.id_users=' . $usuario;

    $query = $mysqli->query($sql);

    while ($row = $query->fetch_object()) {
        $id_archivo = $row->id;
    }


    $sql = "INSERT INTO cursos_detalle (id_users, id_gestion_cursos, modo_Documento, id_Docuemnto) VALUES ('$usuario','$curso','documento anexo','$id_archivo')";

    $resultado1 = $mysqli->query($sql);


    $_SESSION['estado'] = "Se ha registrado Correctamente en el Curso";
    $_SESSION['valor'] = 1;

    $sql = "SELECT COUNT(*) AS inscrito FROM cursos_detalle WHERE cursos_detalle.id_gestion_cursos=" . $curso;

    $resultado1 = $mysqli->query($sql);

    while ($row = $resultado1->fetch_object()) {
        $inscrito = $row->inscrito;
    }

    if ($inscrito > $cupo) {

        $sql = "UPDATE gestion_cursos SET Estado_Curso='Cerrado por alta demanda' WHERE id_Gestion_Cursos=" . $curso;

        $resultado1 = $mysqli->query($sql);
    }

    header('Location:' . getenv('HTTP_REFERER'));
    //header("Location: cursosReg.php");
}

if ($modo_Guardar == 2) {

    $fichero1 = $_FILES["filePDF1"];
    $fichero2 = $_FILES["filePDF2"];

    $InformacionArchivo = pathinfo($_FILES['filePDF1']['name']);
    $Extension = $InformacionArchivo['extension'];
    $ArchivoPDF = $usuario . "-1" . "." . $Extension;
    $Ubicacion1 = 'files/' . $ArchivoPDF;

    copy($_FILES['filePDF1']['tmp_name'], $Ubicacion1);

    $InformacionArchivo = pathinfo($_FILES['filePDF2']['name']);
    $Extension = $InformacionArchivo['extension'];
    $ArchivoPDF = $usuario . "-2" . "." . $Extension;
    $Ubicacion2 = 'files/' . $ArchivoPDF;

    copy($_FILES['filePDF2']['tmp_name'], $Ubicacion2);

    try {

        require("fpdf/fpdf.php");

        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->Image($Ubicacion1, 60, 30, 90, 0, 'JPEG');
        $pdf->AddPage();
        $pdf->Image($Ubicacion2, 60, 30, 90, 0, 'JPEG');
        $pdf->Output('files/' . $usuario . '.pdf', 'F');

        include 'conexion1.php';

        $sql = "INSERT INTO files (id_users, ruta) VALUES ('$usuario','files/" . $usuario . ".pdf')";

        $resultado1 = $mysqli->query($sql);


        $sql = 'SELECT * FROM files WHERE files.id_users=' . $usuario;

        $query = $mysqli->query($sql);

        while ($row = $query->fetch_object()) {
            $id_archivo = $row->id;
        }


        $sql = "INSERT INTO cursos_detalle (id_users, id_gestion_cursos, modo_Documento, id_Docuemnto) VALUES ('$usuario','$curso','documento anexo','$id_archivo')";

        $resultado1 = $mysqli->query($sql);

        $_SESSION['estado'] = "Se ha registrado Correctamente en el Curso";
        $_SESSION['valor'] = 1;

        $sql = "SELECT COUNT(*) AS inscrito FROM cursos_detalle WHERE cursos_detalle.id_gestion_cursos=" . $curso;

        $resultado1 = $mysqli->query($sql);

        while ($row = $resultado1->fetch_object()) {
            $inscrito = $row->inscrito;
        }

        if ($inscrito > $cupo) {

            $sql = "UPDATE gestion_cursos SET Estado_Curso='Cerrado por alta demanda' WHERE id_Gestion_Cursos=" . $curso;

            $resultado1 = $mysqli->query($sql);
        }


        header('Location:' . getenv('HTTP_REFERER'));
        //header("Location: cursosReg.php");


    } catch (\Throwable $th) {

        $_SESSION['estado'] = " por favor verifique el formato de la foto";
        $_SESSION['valor'] = 2;

        header('Location:' . getenv('HTTP_REFERER'));
    }
}

if ($modo_Guardar == 3) {

    include 'conexion1.php';

    $sql = "INSERT INTO cursos_detalle (id_users, id_gestion_cursos, modo_Documento) VALUES ('$usuario','$curso','entregar doc fisico')";

    $resultado1 = $mysqli->query($sql);

    $_SESSION['estado'] = "Se ha registrado Correctamente en el Curso";
    $_SESSION['valor'] = 1;



    $sql = "SELECT COUNT(*) AS inscrito FROM cursos_detalle WHERE cursos_detalle.id_gestion_cursos=" . $curso;

    $resultado1 = $mysqli->query($sql);

    while ($row = $resultado1->fetch_object()) {
        $inscrito = $row->inscrito;
    }

    if ($inscrito > $cupo) {

        $sql = "UPDATE gestion_cursos SET Estado_Curso='Cerrado por alta demanda' WHERE id_Gestion_Cursos=" . $curso;

        $resultado1 = $mysqli->query($sql);
    }
    
    header('Location:' . getenv('HTTP_REFERER'));
    //header("Location: cursosReg.php");



}
