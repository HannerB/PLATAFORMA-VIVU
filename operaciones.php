<?php
session_start();

$o="";

/* 
operacion 0 = registrar asignacion municipios orientadores
operacion 1 = actualizar registro asignacion municipios orientadores
operacion 2 = Eliminar registro asignacion municipios orientadores
operacion 3 = registrar poa
operacion 4 = registrar curso
operacion 5 = registrar enlace
operacion 6 = actualizar alianza municipio
operacion 7 = registro eliminado alianza
operacion 8 = actualizar poa
operacion 9 = eliminar poa
operacion 10 = actualizar curso que no este concertado
operacion 11 = eliminar curso que no este concertado
operacion 12 = subir actas de concertacion
operacion 13 = validar acta de concertacion
operacion 14 = registrar nuevos usuarios
operacion 15 = eliminar usuarios registrados en cursos
operacion 16 = cerrar programa de formacion por baja demanda
operacion 17 = entregar formaciones al centro de formacion
operacion 18 = actualizar usuarios



 */



$o=$_POST['operacion'];

$_SESSION['estado']='';



switch ($o) {
    case 0:

        try {
            include 'conexion1.php';
            $municipio=$_POST['municipio'];
            $orientador=(int)$_POST['orientador'];
            $periodo=$_POST['periodo'];

        $sql = "INSERT INTO asignar_municipios (municipio, id_responsable, periodo, estado) VALUES ('$municipio', '$orientador', '$periodo','activo')";
        $resultado1 = $mysqli->query($sql);
        $_SESSION['estado'] = "Orientador Registrado Correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        
        header("Location: AsignarResponsables.php");
        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: AsignarResponsables.php");
            $mysqli->close();
        }
    
        //var_dump($_SESSION['estado']);
        break;

    case 1:

        try {
            include 'conexion1.php';

            $municipio=$_POST['municipio'];
            $estado=$_POST['estado'];
            $periodo=$_POST['periodo'];
            $id=(int)$_POST['id'];

        $sql = "UPDATE asignar_municipios SET municipio='$municipio', periodo='$periodo',estado='$estado' WHERE id=$id";

        $resultado1 = $mysqli->query($sql);

        $_SESSION['estado'] = "Registro Actualizado correctamente";
        $_SESSION['valor'] = "1";
        $mysqli->close();
        
        header("Location: AsignarResponsables.php");
        
        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: Poa.php");
            $mysqli->close();
        }
        //var_dump($_SESSION);
        break;


    case 2:

        try {
            include 'conexion1.php';

           
            $id=(int)$_POST['id'];

        $sql = "DELETE from asignar_municipios  WHERE id=$id";

    
        $resultado1 = $mysqli->query($sql);

        $_SESSION['estado'] = "Registro Eliminado correctamente";
        $_SESSION['valor'] = "1";
        $mysqli->close();
        
        header("Location: AsignarResponsables.php");
        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: AsignarResponsables.php");
            $mysqli->close();
        }
        //var_dump($_SESSION);

        break;

    case 3:
        
        try {
            include 'conexion1.php';

            $Nombre_Poa=$_POST['Nombre_Poa'];
            $Persona_Enlace=$_POST['Persona_Enlace'];
            $Telefono_Enlace=$_POST['Telefono_Enlace'];
            $Correo_Enlace=$_POST['Correo_Enlace'];
            $Poblacion=$_POST['Poblacion'];
            $Ocupacion_Productiva=$_POST['Ocupacion_Productiva'];
            $municipio=(int)$_POST['municipio'];
            

        $sql = "INSERT INTO poa (id_asignar_municipios, Nombre_Poa, Persona_Enlace, Telefono_Enlace, Correo_Enlace, Poblacion, Ocupacion_Productiva) VALUES ('$municipio', '$Nombre_Poa', '$Persona_Enlace', '$Telefono_Enlace', '$Correo_Enlace', '$Poblacion', '$Ocupacion_Productiva')";

        $resultado1 = $mysqli->query($sql);
        $_SESSION['estado'] = "Poa Registrado Correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        
        header("Location: Poa.php");
        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: Poa.php");
            $mysqli->close();
        }
    
        //var_dump($_SESSION['estado']);
    
        break;

    case 4:   
        try {
            include 'conexion1.php';

            $Municipio_Curso=$_POST['Municipio_Curso'];
            $Centro_Formacion=$_POST['Centro_Formacion'];
            $Nivel_Formacion=$_POST['Nivel_Formacion'];
            $Nombre_Curso=$_POST['Nombre_Curso'];
            $categoria=$_POST['categoria'];
            $Mes_Poa=$_POST['Mes_Poa'];
            $Estado_Curso="registrado";
            $Nombre_Poa=(int)$_POST['Nombre_Poa'];

        $sql = "INSERT INTO gestion_cursos (Municipio_Curso, Centro_Formacion, Nivel_Formacion, Nombre_Curso, categoria, Mes_Poa, Estado_Curso, id_nombre_poa) VALUES ('$Municipio_Curso', '$Centro_Formacion', '$Nivel_Formacion', '$Nombre_Curso', '$categoria', '$Mes_Poa', '$Estado_Curso','$Nombre_Poa')";

        $resultado1 = $mysqli->query($sql);
        $_SESSION['estado'] = "Operacion Registrada Correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        
        header("Location: Gestion_cursos.php");

        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: Gestion_cursos.php");
            $mysqli->close();
        }
    
        //var_dump($_SESSION['estado']);
        break;
    case 5: 
        
        try {
            include 'conexion1.php';

            $id_User=(int)$_POST['user_id'];
            $municipio=$_POST['municipio'];
            $periodo=$_POST['periodo'];
            $enlace_poblacion=$_POST['poblacion'];
            $cargo=$_POST['cargo'];
            $poa_id=$_POST['poa'];
            
            var_dump($id_User,$municipio,$periodo,$enlace_poblacion,$cargo,$poa_id);

        $sql = "INSERT INTO alianza_municipio (id_User, municipio, periodo, enlace_poblacion, cargo, poa_id, estado) VALUES ('$id_User', '$municipio', '$periodo', '$enlace_poblacion', '$cargo', '$poa_id', 'activo')";

        $resultado1 = $mysqli->query($sql);
        $_SESSION['estado'] = "Operacion Registrada Correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        //echo '<br>';
       // var_dump($resultado1);
        
        header("Location: AsignarEnlaces.php");

        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: AsignarEnlaces.php");
            $mysqli->close();
        }
    
        //var_dump($_SESSION['estado']);




        
        break; 
    case 6:  
        
        try {
            include 'conexion1.php';

            $id_User=$_POST['user_id'];
            $estado=$_POST['estado'];
            
            
            //var_dump($id_User,$municipio,$periodo,$enlace_poblacion,$cargo,$poa_id);

        $sql = "UPDATE alianza_municipio SET estado='$estado' WHERE id_alianza=".$id_User;

        $resultado1 = $mysqli->query($sql);
        $_SESSION['estado'] = "Operacion Registrada Correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        //echo '<br>';
       var_dump($resultado1,$id_User,$estado);
        
        header("Location: AsignarEnlaces.php");

        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: AsignarEnlaces.php");
            $mysqli->close();
        }
    
        //var_dump($_SESSION['estado']);
        break;

    case 7:  

        
        try {
            include 'conexion1.php';

           
            $id=(int)$_POST['user_id'];

        $sql = "DELETE from alianza_municipio  WHERE id_alianza=$id";

    
        $resultado1 = $mysqli->query($sql);

        $_SESSION['estado'] = "Registro Eliminado correctamente";
        $_SESSION['valor'] = "1";
        $mysqli->close();
        
        header("Location: AsignarEnlaces.php");
        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: AsignarEnlaces.php");
            $mysqli->close();
        }
        //var_dump($_SESSION);



        break; 
    case 8: 
        
        try {
            include 'conexion1.php';

            $Nombre_Poa=$_POST['gfgnombres'];
            $Persona_Enlace=$_POST['gfgPersona_Enlace'];
            $Telefono_Enlace=$_POST['gfgTelefono_Enlace'];
            $Ocupacion_Productiva=$_POST['gfgOcupacion_Productiva'];
            $id_poa=$_POST['poa_id'];
            
            
            //var_dump($id_User,$municipio,$periodo,$enlace_poblacion,$cargo,$poa_id);

        $sql = "UPDATE poa SET Nombre_Poa='$Nombre_Poa', Persona_Enlace='$Persona_Enlace', Telefono_Enlace='$Telefono_Enlace', Ocupacion_Productiva='$Ocupacion_Productiva' WHERE id_poa='$id_poa'";

        $resultado1 = $mysqli->query($sql);
        $_SESSION['estado'] = "Operacion Registrada Correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        //echo '<br>';
       //var_dump($Nombre_Poa,$Persona_Enlace,$Telefono_Enlace,$Ocupacion_Productiva,$id_poa);
        
        header("Location: Poa.php");

        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: Poa.php");
            $mysqli->close();
        }
    
        //var_dump($_SESSION['estado']);
        break;
        



        
       break; 
    case 9:   
     try {
        include 'conexion1.php';

       
        $poa_id=(int)$_POST['poa_id'];

      $sql = "DELETE from poa  WHERE id_poa=$poa_id";


       $resultado1 = $mysqli->query($sql);

         $_SESSION['estado'] = "Registro Eliminado correctamente";
          $_SESSION['valor'] = "1";
         $mysqli->close();
    
            header("Location: Poa.php");
            } catch (Exception $e) {
                $_SESSION['estado'] =$e->getMessage();
                header("Location: Poa.php");
                $mysqli->close();
            }
            //var_dump($_SESSION);



       break;

    case 10: 
        try {
            include 'conexion1.php';

        
            $curso_id=$_POST['poa_id'];

            
            $Centro_Formacion=$_POST['Centro_Formacion'];
            $Nivel_Formacion=$_POST['Nivel_Formacion'];
            $Nombre_Curso=$_POST['Nombre_Curso'];
            $categoria=$_POST['categoria'];
            $Mes_Poa=$_POST['Mes_Poa'];
            $Estado_Curso=$_POST['Estado'];
            $Direccion=$_POST['Direccion'];
            $cupo=$_POST['cupo'];


        $sql = "UPDATE gestion_cursos SET Centro_Formacion='$Centro_Formacion', Nivel_Formacion='$Nivel_Formacion', Nombre_Curso='$Nombre_Curso', categoria='$categoria', Mes_Poa='$Mes_Poa', cupo='$cupo', Estado_Curso='$Estado_Curso', Direccion='$Direccion' WHERE id_Gestion_Cursos=$curso_id";


        $resultado1 = $mysqli->query($sql);

            $_SESSION['estado'] = "Registro actualizado correctamente";
            $_SESSION['valor'] = "1";
            $mysqli->close();
        
                header("Location: Gestion_cursos.php");
                } catch (Exception $e) {
                    $_SESSION['estado'] =$e->getMessage();
                    header("Location: Gestion_cursos.php");
                    $mysqli->close();
                }
                //var_dump($_SESSION);
        




            break;

    case 11:  
        try {
            include 'conexion1.php';

        
            $id=$_POST['poa_id'];

        $sql = "DELETE from gestion_cursos WHERE id_Gestion_Cursos=$id";


        $resultado1 = $mysqli->query($sql);

        $_SESSION['estado'] = "Registro Eliminado correctamente";
        $_SESSION['valor'] = "1";
        $mysqli->close();
        
        header("Location: Gestion_cursos.php");
        } catch (Exception $e) {
            $_SESSION['estado'] =$e->getMessage();
            header("Location: Gestion_cursos.php");
            $mysqli->close();
        }
        //var_dump($_SESSION); 
                break;



    case 12:   
        include 'conexion1.php';

        
        $valores=$_POST['valores'];
        $usuario=$_SESSION["user_id"];
        $Mes_Poa=$_POST["Mes_Poa"];
        $Vigencia=$_POST["Vigencia"];

        $fichero = $_FILES["fileconcertacion"];

        $InformacionArchivo = pathinfo($_FILES['fileconcertacion']['name']);
        $NombreArchivo = $_FILES['fileconcertacion']['name'];
        $NombreArchivo = $InformacionArchivo['filename'];
        $Extension = $InformacionArchivo['extension'];
        $ArchivoPDF = time().".".$Extension;

        $Ubicacion = 'concertaciones/'.$ArchivoPDF;
        copy( $_FILES['fileconcertacion']['tmp_name'], $Ubicacion);



        $sql = "INSERT INTO files_concertaciones (mes_concertacion, ruta, users_id, estado, vigencia, tipo) VALUES ('$Mes_Poa','$Ubicacion', '$usuario','por validar','$Vigencia', 'concertacion')";

        $resultado1 = $mysqli->query($sql);


        $sql = "SELECT * FROM files_concertaciones WHERE ruta='$Ubicacion'";

        $query = $mysqli->query($sql);

        while ($row = $query->fetch_object()) {
            $id_archivo=$row->id_file_concertaciones;
            }

            // echo  $id_archivo;
        
        
            for ($i=0; $i<=$valores; $i++){
            
                $cursos_id=$_POST["check$i"];

                $sql = "INSERT INTO concertaciones (id_concertacion, id_usuario, id_gestion_cursos) VALUES ('$id_archivo','$usuario','$cursos_id')";

                $resultado1 = $mysqli->query($sql);

                $sql = "UPDATE gestion_cursos SET Estado_Curso='Concertado acta' WHERE id_Gestion_Cursos=$cursos_id";

                $resultado1 = $mysqli->query($sql);


            }

        

        $_SESSION['estado'] = "Se ha registrado correctamente acta de concertacion";
        $_SESSION['valor'] = 1;
        
        //var_dump($resultado1);
        $mysqli->close();
        header("Location: Gestion_cursos.php"); 










        break;






    case 13: 

        include 'conexion1.php';

        
        $valores=$_POST['vueltas'];
        $acta_estado=$_POST['acta_estado'];
        $id_acta=$_POST['id_acta'];


        if ($acta_estado=="Acta valida"){


            for ($i=0; $i<=$valores; $i++){
            
                $cursos_id=$_POST["check$i"];

                $sql = "UPDATE gestion_cursos SET Estado_Curso='Activo' WHERE id_Gestion_Cursos=$cursos_id";

                $resultado1 = $mysqli->query($sql);

            }

            $sql = "UPDATE files_concertaciones SET estado='Acta valida' WHERE id_file_concertaciones=$id_acta";

            $resultado1 = $mysqli->query($sql);


        }

        if ($acta_estado=="Acta NO valida"){


            for ($i=0; $i<=$valores; $i++){
            
                $cursos_id=$_POST["check$i"];

                $sql = "UPDATE gestion_cursos SET Estado_Curso='registrado' WHERE id_Gestion_Cursos=$cursos_id";

                $resultado1 = $mysqli->query($sql);

            }

            $sql = "UPDATE files_concertaciones SET estado='Acta No valida' WHERE id_file_concertaciones=$id_acta";

            $resultado1 = $mysqli->query($sql);


        }

    
        $_SESSION['estado'] = "Se ha registrado correctamente el estado de la acta de concertacion";
        $_SESSION['valor'] = 1;
        
        //var_dump($resultado1);
        $mysqli->close();
        header("Location: actas_concertacion.php"); 

     break;

    case 14: 

        include 'conexion1.php';

        
        
        $poblacion=$_POST["txtTipoPoblacion"];
        $correo=$_POST["txtCorreo"];
        $telefono=$_POST["txtTelefono"];
        
        $txtNombres=$_POST["txtNombres"];
        $txtApellidos=$_POST["txtApellidos"];
        $txtSexo=$_POST["txtSexo"];
        
        $txtFechaNacimiento=$_POST["txtFechaNacimiento"];
        $txtPassword=$_POST["txtPassword"];
        
        $txtTipoDocumento=$_POST["txtTipoDocumento"];
        $txtDocumento=$_POST["txtDocumento"];
        
        $txtMunicipio=$_POST["txtMunicipio"];
        
        $sql = "SELECT * FROM users where documento=".$txtDocumento;

        $resultado1 = $mysqli->query($sql);

        if(mysqli_num_rows($resultado1)>0) {

            $_SESSION['estado'] = "Usted ya se encuentre registrado, por favor inicie sesion";
            $_SESSION['valor'] = 1;

            $mysqli->close();
            header("Location: ../sign_in.php"); 


        } else {
        

        $sql = "INSERT INTO users (nombres, apellidos, sexo, tipodocumento, documento, fechaNacimiento, telefono, tipoPoblacion, municipio, email, password, rol) VALUES ('$txtNombres','$txtApellidos','$txtSexo','$txtTipoDocumento','$txtDocumento','$txtFechaNacimiento','$telefono','$poblacion','$txtMunicipio','$correo','$txtPassword','2')";

        $resultado1 = $mysqli->query($sql);
    
        $_SESSION['estado'] = "Se ha registrado correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        header("Location: ../sign_in.php"); 
    
            }
        break;

    case 15:

        include 'conexion1.php';

        $poa_id=$_POST["poa_id"];

        $sql = "DELETE from cursos_detalle  WHERE id_cursos_detalle=".$poa_id;

        $resultado1 = $mysqli->query($sql);
    
        $_SESSION['estado'] = "Operacion realizada correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        header("Location: cursos_detalle.php"); 
        break;



    case 16:

        //echo "5";

        include 'conexion1.php';

        $_SESSION['id_curso'];
        $poa_id=$_POST["poa_id"];

        $sql = "UPDATE gestion_cursos SET Estado_Curso='Cerrado por baja demanda' WHERE id_Gestion_Cursos=".$_SESSION['id_curso'];

        $query = $mysqli->query($sql);

        $_SESSION['estado'] = "Programa de formacion cerrado correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        header("Location: Gestion_cursos.php"); 
        break;

        
    case 17:

        include 'conexion1.php';

        
        $valores=$_POST['valores'];
        $usuario=$_SESSION["user_id"];
        $Mes_Poa=$_POST["Mes_Poa"];
        $Vigencia=$_POST["Vigencia"];

        $fichero = $_FILES["fileconcertacion"];

        $InformacionArchivo = pathinfo($_FILES['fileconcertacion']['name']);
        $NombreArchivo = $_FILES['fileconcertacion']['name'];
        $NombreArchivo = $InformacionArchivo['filename'];
        $Extension = $InformacionArchivo['extension'];
        $ArchivoPDF = time().".".$Extension;

        $Ubicacion = 'ActaGestionCursos/'.$ArchivoPDF;
        copy( $_FILES['fileconcertacion']['tmp_name'], $Ubicacion);



        $sql = "INSERT INTO files_concertaciones (mes_concertacion, ruta, users_id, estado, vigencia, tipo) VALUES ('$Mes_Poa','$Ubicacion', '$usuario','por validar','$Vigencia','GestionCursos')";

        $resultado1 = $mysqli->query($sql);


        $sql = "SELECT * FROM files_concertaciones WHERE ruta='$Ubicacion'";

        $query = $mysqli->query($sql);

        while ($row = $query->fetch_object()) {
            $id_archivo=$row->id_file_concertaciones;
            }

            // echo  $id_archivo;
        
        
            for ($i=0; $i<=$valores; $i++){
            
                if (isset($_POST["check$i"])){

                    $cursos_id=$_POST["check$i"];

                    $sql = "INSERT INTO concertaciones (id_concertacion, id_usuario, id_gestion_cursos) VALUES ('$id_archivo','$usuario','$cursos_id')";
    
                    $resultado1 = $mysqli->query($sql);
    
                    $sql = "UPDATE gestion_cursos SET Estado_Curso='Entregado al centro' WHERE id_Gestion_Cursos=$cursos_id";
    
                    $resultado1 = $mysqli->query($sql);
                }
               


            }

        

        $_SESSION['estado'] = "Se ha registrado correctamente acta de entrega curso";
        $_SESSION['valor'] = 1;
        
        //var_dump($resultado1);
        $mysqli->close();
        header("Location: Gestion_cursos.php"); 





        break;
    case 18:

        include 'conexion1.php';

        $id=$_POST['id'];

        
        $nombres=$_POST['txtNombres'];
        $apellidos=$_POST['txtApellidos'];
        $sexo=$_POST['txtSexo'];
        $tipodocumento=$_POST['txtTipoDocumento'];
        $documento=$_POST['txtDocumento'];
        $fechaNacimiento=$_POST['txtFechaNacimiento'];
        $telefono=$_POST['txtTelefono'];
        $tipoPoblacion=$_POST['txtTipoPoblacion'];
        $email=$_POST['txtCorreo'];
        $password=$_POST['txtPassword'];
        $rol=$_POST['rol'];
        $municipio=$_POST['txtMunicipio'];

        $poa_id=$_POST["poa_id"];

        $sql = "UPDATE users SET nombres='$nombres', apellidos='$apellidos', sexo='$sexo', tipodocumento='$tipodocumento', fechaNacimiento='$fechaNacimiento', telefono='$telefono', tipoPoblacion='$tipoPoblacion', email='$email', password='$password', rol='$rol', municipio='$municipio', documento='$documento' WHERE users.id=".$id;

        $query = $mysqli->query($sql);

        $_SESSION['estado'] = "Usuario Actualizado correctamente";
        $_SESSION['valor'] = 1;
        $mysqli->close();
        header("Location: usuarios.php"); 












        break;
        }





?>