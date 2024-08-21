<?php
session_start();

require_once "clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
  $tildes = $conexion->query("SET NAMES 'utf8'");
  $sql="SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, 
  fechaRegistro, rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img, centro 
  FROM users WHERE id = $id";
  $result_login = mysqli_fetch_row(mysqli_query($conexion,$sql));
  $user = null;

  if (count($result_login) > 0) {
    $user = $result_login;
  }
}

$No_documento = ($_POST['NoDocumento']) > 0  ? $_POST['NoDocumento'] : 0;

$CC = ($_GET['id'] > 0 ) ? $_GET['id'] : $_POST['idCurso'];


$nombreC = mysqli_fetch_row(mysqli_query($conexion, "SELECT curso FROM cursos where codigo_curso=$CC"))[0];
$id_C = mysqli_fetch_row(mysqli_query($conexion, "SELECT id FROM cursos where codigo_curso=$CC"))[0];

$nombre_carpeta = "cursos";

$sql_info="SELECT id, nombres, apellidos, tipodocumento, documento, tipoPoblacion, email, password, 
  fechaRegistro, rol, fecha_sesion, telefono, fechaNacimiento, municipio, sexo, img, centro 
  FROM users WHERE documento = $No_documento";
$result_info = mysqli_query($conexion,$sql_info);

$num_rows = mysqli_num_rows($result_info);

$datos = $result_info;

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UFT-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  
  <title>Inscritos En El Curso | Oferta Complementaria</title>
  <meta property="og:title" content="Cursos | Oferta Complementaria">

  <link rel="icon" href="../assets/logoSena.png">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <meta name="csrf-token" content="sD0hPoBuliGFd5InGhre2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />

  <link rel="stylesheet" media="all" href="../assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="../assets/grupos.css" />
  <?php require_once "scripts.php";  ?>


  <style type="text/css">
    .footer_new {
      bottom: 0;
      text-align: center;
      font-size: 15px;
      width: 100%;
      height: 50px; /* Set the fixed height of the footer here */
      line-height: 44px; /* Vertically center the text there */
      background-color: #FF6C00;
      color: white;
    }
    .col-xs-6{
      width: 50%;
    }
    .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
      position: relative;
      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px;
    }
    .efectoa img {
      border-radius: 20px 20px 0px 0px;
      -webkit-transition: .2s;
      -moz-transition: .2s;
      -o-transition: .2s;
      -ms-transition: .2s;
      transition: .2s;
    }
  </style>
</head>
<body>
<input type="hidden" id="id" name="id" value="<?php echo $id_C ?>">
<?php if(!empty($user) && ($user[9]=='1')): ?>
  
	<!-- contenido para Administrador -->
    <?php include '../header_admin.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        <ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li><a href="inscribir_aprendiz.php">Cursos Ofertados</a></li><li class="active"><?php echo $nombreC; ?></li></ol>
        </div>
        <!-- ====== PopUpLogin ======-->
        <?php include '../popupLogin_admin.php'; ?>
    </div>
    <div class="container">
      <div class="row mt-1">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header text-center">
                Inscribir En El Curso De <?php echo $nombreC; ?>
            </div>
            <div class="card-body">
                <form class="form-inline" id="frmConsultar" method="POST" action="inscribir_aprendiz_.php">
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="" class="">Documento de identidad:</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputNoDocumento" class="sr-only">No. Documento</label>
                                <input type="number" class="form-control" name="NoDocumento" placeholder="No. Documento" min="0">
                                <input type="hidden" class="form-control" name="idCurso" value="<?php echo $CC; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block mb-2">Validar identidad</button>
                        </div>
                    </div>
                </form>
                <hr>
                <?php if($datos !== ""):?>
                    <table class="table table-hover small" id="cargarCursosOfertados">
                        <thead class="text-center bg-primary">
                            <tr>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">Apellidos</th>
                                <th class="text-center">Documento</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">Municipio</th>
                                <th class="text-center">Población</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <?php if ($num_rows > 0):?>
                            <?php 
                                while ($mostrar=mysqli_fetch_row($result_info)) {
                                    ?>
                                        <tr class="text-center">
                                            <td><?php echo strtoupper($mostrar[1]); ?></td>
                                            <td><?php echo strtoupper($mostrar[2]); ?></td>
                                            <td><?php echo strtoupper($mostrar[4]); ?></td>
                                            <td><?php echo strtoupper($mostrar[11]); ?></td>
                                            <td><?php echo strtoupper($mostrar[13]); ?></td>
                                            <td><?php echo strtoupper($mostrar[5]); ?></td>
                                            <?php 
                                                $eCurso = mysqli_fetch_row(mysqli_query($conexion, "SELECT estado FROM y_inscritos_cursos where id_usuario='$mostrar[0]' and id_curso='$CC' order by id desc limit 1"))[0];
                                            ?>
                                            <td style="text-align: center;" >
                                                <!-- Estado inscrito -->
                                                <?php if(($eCurso == 1)): ?>
                                                    <span class="btn btn-outline-secondary btn-sm">
                                                        <span class="fa fa-check-square-o"></span> Inscrito
                                                    </span>
                                                <?php else:?>
                                                    <span class="btn btn-outline-secondary btn-sm" onclick="btnInscribir(<?php echo $mostrar[0];?>, <?php echo $CC;?>)">
                                                        <span class="fa fa-plus-square-o"></span> Inscribir
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        <?php else:?>
                            <tr class="text-center">
                                <td colspan="6">No hay registros para el documento consultado, <br> debe registrar el aprendiz para poder continuar.<br><br>
                                    <a class="btn btn-outline-primary btn-sm" href="../registrar_aprendices.php"><span class="fa  fa-user-o"></span> Registrar Aprendiz</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>

                <?php else:?>
                        
                <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php endif; ?>

<footer class="footer_new text-center mt-3">
  <div class="">
    <span class="">Todos los derechos <?php echo '&copy'; echo date("Y"); ?>  SENA - Políticas de privacidad y condiciones uso Portal Web SENA</span>
  </div>
</footer>

</body>
</html>

<script type="text/javascript">
    
	function btnInscribir(idUsuario,idCurso){
		var datos = {
			"idCurso" : idCurso,
			"idUsuario" : idUsuario
        };
		$.ajax({
			type:"POST",
			data: datos,
			url:"procesos/agregarInscripcion.php",
			success:function(r){
				if(r == 1){
					Swal.fire({
                    title: 'Correcto',
                    icon: 'success' , 
                    text: 'Se ha inscrito correctamente!',
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Continuar',
                    denyButtonText: `Don't save`,
                    }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                    });
				}else if(r == 2){
					Swal.fire(
					'Ojo!',
					'No te puedes inscribir debido que ya cuentas con 2 inscripciones vigentes.',
					'warning'
					);
				}else{
					Swal.fire(
					'Error!',
					'No se ha guardado correctamente!',
					'error'
					);
				}
			}
		});
	}
</script>
