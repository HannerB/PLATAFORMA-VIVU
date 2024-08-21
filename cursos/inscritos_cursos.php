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

$CC = $_GET['id'];
$nombreC = mysqli_fetch_row(mysqli_query($conexion, "SELECT curso FROM cursos where codigo_curso=$CC"))[0];

$nombre_carpeta = "cursos";

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
<input type="hidden" id="id" name="id" value="<?php echo $CC ?>">
<?php if(!empty($user) && ($user[9]=='1')): ?>
  
	<!-- contenido para Administrador -->
    <?php include '../header_admin.php'; ?>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        <ol class="breadcrumb"><li><a href="../index.php">Inicio</a></li><li><a href="cursos_ofertados.php">Cursos Ofertados</a></li><li class="active"><?php echo $nombreC; ?></li></ol>
        </div>
        <!-- ====== PopUpLogin ======-->
        <?php include '../popupLogin_admin.php'; ?>
    </div>
    <div class="container">
      <div class="row mt-1">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header text-center">
                Inscritos En El Curso De <?php echo $nombreC; ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                      <a class="btn btn-outline-primary btn-block" href="../excel/report_inscritos.php?codigo=<?php echo $CC;?>"><span class="fa  fa-file-excel-o"></span> Generar Excel</a>
                    </div>
                    <div class="col-md-6">
                        <span class="btn btn-outline-primary btn-block" onclick="btnVaciarCurso(<?php echo $CC;?>)">
                            <span class="fa fa-plus-square-o"></span> Cerrar curso
                        </span>
                    </div>                        
                </div>                        
              <hr>
              <div id="cargarCursos"></div>
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
	$(document).ready(function(){
        var id = $("#id").val();
		$('#cargarCursos').load('tabla_detalle_inscritos.php?id='+id);
	});

  function btnVaciarCurso(idCurso){
		
		const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-outline-success',
			cancelButton: 'btn btn-outline-danger'
		},
		buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
		title: '¿Está seguro?',
		text: "¡No podrás revertir esto!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: '¡Si, bórralo!',
		cancelButtonText: '¡No, cancela!',
		reverseButtons: true
		}).then((result) => {
		if (result.isConfirmed) {
      	var datos = {
			    "idCurso" : idCurso
        };

			$.ajax({
        
				type:"POST",
				data: datos,
				url:"procesos/vaciarCurso.php",
				success:function(r){
					if(r==1){
						let valor = $('#id').val();
						$('#cargarCursos').load('tabla_detalle_inscritos.php?id='+idCurso);
						swalWithBootstrapButtons.fire(
						'¡Eliminado!',
						'El curso ha sido vaciado, se desactivará.',
						'success'
						)
					}else{
						swalWithBootstrapButtons.fire(
						'¡Eliminado!',
						'El curso no pudo ser vaciado.',
						'error'
						)
					}
				}
			});
			
		} else if (
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
			'Cancelado',
			'El curso está seguro, ha cancelado la eliminación.',
			'error'
			)
		}
		});
	}
</script>
