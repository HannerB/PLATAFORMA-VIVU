<?php
session_start(); // Asegúrate de iniciar la sesión

include "conexion1.php";
include "header.php";

// Verificar si 'id_curso' está en la sesión
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $_SESSION['id_curso'] = $id;
}

if (!isset($_SESSION['id_curso'])) {
  die("ID de curso no definido en la sesión.");
}

$id = $mysqli->real_escape_string($_SESSION['id_curso']);

// Verificar si 'user_id' está en la sesión
if (!isset($_SESSION['user_id'])) {
  die("ID de usuario no definido en la sesión.");
}

$user_id = $mysqli->real_escape_string($_SESSION['user_id']);

$sql1 = "SELECT * FROM gestion_cursos, poa, asignar_municipios 
         WHERE poa.id_poa=gestion_cursos.id_nombre_poa 
         AND asignar_municipios.id=poa.id_asignar_municipios
         AND gestion_cursos.id_Gestion_Cursos='$id' 
         AND asignar_municipios.id_responsable='$user_id'";

$consulta1 = $mysqli->query($sql1);
if (!$consulta1) {
  die("Error en la consulta: " . $mysqli->error);
}

$editar = false;

while ($row = $consulta1->fetch_object()) {
  if ($row->id_responsable == $user_id) {
    $editar = true;
  }

  if ($_SESSION['rol'] == 1) {
    $editar = true;
  }
}
//var_dump($_SESSION['id_poa']);

?>


<div class="container content-center">

  <?php

  $inscritos = 0;
  $Nombre_Curso = "";
  $estadocurso = "";

  $sql = "SELECT Nombre_Curso, Estado_Curso FROM gestion_cursos WHERE id_Gestion_Cursos=" . $_SESSION['id_curso'];

  $consulta = $mysqli->query($sql);

  while ($row = $consulta->fetch_object()) {

    $Nombre_Curso = $row->Nombre_Curso;

    $estadocurso = $row->Estado_Curso;
  }



  if (!isset($_SESSION['estado'])) {
    $_SESSION['estado'] = '';
    $_SESSION['valor'] = '';
  }

  if ($_SESSION['valor'] == 1) {
  ?>
    <div class="alert alert-dismissible alert-success" style="margin-top:20px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <span class="icon-checkmark"></span> <?php echo $_SESSION['estado']; ?>
    </div>
  <?php

    unset($_SESSION['estado']);
  } elseif ($_SESSION['estado'] == !null) {
  ?>
    <div class="alert alert-dismissible alert-danger" style="margin-top:20px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <span class="icon-checkmark"></span> <?php echo "Operacion NO Realizada :" . $_SESSION['estado']; ?>
    </div>
  <?php

    unset($_SESSION['estado']);
  }



  ?>

  <form action="./files/descargar.php" method="POST">
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Resumen inscritos</label>
      <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

    </div>
    <div>


      <div class="input-group">

        <div class="col-auto">
          <label for="filtrar">Seleccione una opcion de descarga </label>
        </div>
        <div class="col-3">
          <select class="form-select col-auto" id="filtro" name="filtro" aria-label="Example select with button addon" required>
            <option value="" selected>Seleccione</option>
            <option value="1">Descargar Listado inscritos excel</option>
            <option value="2">Generar / Actualizar Paquete inscritos</option>


          </select>
        </div>

        <div>
          <button class="btn btn-secondary" type="submit">Seleccionar</button>

          <?php

          if (file_exists("./files/Archivo" . $_SESSION['id_curso'] . ".zip")) {
            echo '<a href=./files/Archivo' . $_SESSION['id_curso'] . '.zip' . ' <button class="gfgdownload btn btn-success btn-xs" ><span> 
        </span>Descargar Paquete Inscritos</button> </a>';
          }


          if ($_SESSION['alianza'] == 1 || $editar == false) {
          } else {
            if ($estadocurso == "Activo") {
              echo '
<button class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#staticBackdropcerrarCurso"  type="button">Cerrar Programa de formacion</button>';
            }
          }


          ?>



        </div>
      </div>

  </form>

</div>

<br><br>
<table id="tabla" class="table table-striped">
  <thead>
    <tr>
      <th style="width:80px">Residencia</th>
      <th style="width:80px">Tipo documento</th>
      <th style="width:80px">Documento</th>
      <th style="width:80px">Nombres y apellidos</th>
      <th style="width:80px">Telefono</th>
      <th style="width:50px">Correo</th>
      <th style="width:80px">Tipo Poblacion</th>
      <th style="width:80px">Soporte documento</th>
      <th style="width:80px">Inscrito Sofia Plus</th>
      <th style="width:200px">Gestion</th>

    </tr>
    <tr>
      <td colspan="9">
        <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
      </td>
    </tr>
  </thead>
  <tbody>
    <?php


    $consulta = "SELECT * FROM cursos_detalle, users, gestion_cursos WHERE users.id=cursos_detalle.id_users AND gestion_cursos.id_Gestion_Cursos=cursos_detalle.id_gestion_cursos AND cursos_detalle.id_gestion_cursos=" . $id;

    $query = $mysqli->query($consulta);

    //obtener municipio

    //var_dump($query);

    while ($row = $query->fetch_object()) {
      $inscritos = $inscritos + 1;

      echo '<tr> 

    <td class="gfgmunicipio">' . $row->municipio . '</td>
    <td class="gfgtipodocumento">' . $row->tipodocumento . '</td>
    <td class="gfgdocumento">' . $row->documento . '</td>
    <td class="gfgnombrecompleto">' . $row->nombres . ' ' . $row->apellidos . '</td> 
    <td class="gfgtelefono">' . $row->telefono . '</td>   
    <td class="gfgemail">' . $row->email . '</td>  
    <td class="gfgtipoPoblacion">' . $row->tipoPoblacion . '</td>     
    <td class="gfgmodo_Documento">' . $row->modo_Documento . '</td>  ';

      $consulta2 = "SELECT * FROM no_inscritos_sofiaplus, users WHERE users.id = no_inscritos_sofiaplus.id_users AND no_inscritos_sofiaplus.id_users=" . $row->id;

      $query2 = $mysqli->query($consulta2);

      if ($query2->num_rows >= 1) {
        echo '<td class="gfgperiodo">No</td> ';
      } else {
        echo '<td class="gfgperiodo">Si</td> ';
      }



      echo  '
    <td class="gfgid" style="display:none" >' . $row->id_cursos_detalle . '</td> 
    <td class="gfgEstado_Curso" style="display:none" >' . $row->Estado_Curso . '</td>';

      $consulta3 = "SELECT DISTINCT (id_users), ruta AS ruta1 FROM files, users WHERE users.id = files.id_users AND files.id_users=" . $row->id;
      $query3 = $mysqli->query($consulta3);
      echo '<td>';
      while ($row3 = $query3->fetch_object()) {


        if ($row->modo_Documento == "documento anexo") {
          echo '<a href=./' . $row3->ruta1 . ' <button class="gfgdownload btn btn-warning btn-xs" ><span> 
      </span>Descargar</button> </a>';
        }
      }

      if ($_SESSION['alianza'] == 1 || $editar == false) {
      } else {
        if ($estadocurso == "Cerrado por baja demanda" || $estadocurso == "Entregado al centro") {
        } else {
          echo '<button class="gfgselect btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdropdelete"> <span></span>Borrar</button>';
        }

        echo '</td>

    </tr>';
      }
    }


    ?>







  </tbody>
</table>



<div class="modal fade" id="staticBackdropdelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Eliminar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="delete" id="delete"></div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="staticBackdropcerrarCurso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cerrar Programa de Formacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="estado modal-body">

        <form method="POST" action="operaciones.php">
          <div class="form-group">
            <label for="nombrecurso">Programa de formacion</label>
            <input readonly type="text" required class="form-control" id="nombrecurso" name="nombrecurso" placeholder="Nombre persona enlace" value="<?php echo $Nombre_Curso; ?>">
          </div>

          <div class="form-group">
            <label for="inscritos">Inscritos</label>
            <input readonly type="text" required class="form-control" id="inscritos" name="inscritos" placeholder="" value="<?php echo $inscritos; ?>">
          </div>

          <div class="form-group">
            <label for="Estado">Estado</label>
            <select type="text" required class="form-control select" id="Estado" name="Estado" placeholder="" value="">

              <option selected disabled value=""><?php echo $estadocurso; ?></option>
              <option value="Cerrar Por baja demanda">Cerrar por baja demanda</option>
            </select>
          </div>

          <input hidden type="text" value="16" id="operacion" name="operacion">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <?php if ($estadocurso == "Cerrado por baja demanda" || $estadocurso == "Concertado acta") {
            } else {
              echo '<button type="submit" class="btn btn-danger">Realizar operacion</button>';
            }
            ?>




          </div>
        </form>



        <!-- <div class="estadocurso" id="estadocurso"></div>
       <div class="entregadocentro" id="entregadocentro"></div>
       <div class="botones" id="botones"></div> -->
      </div>
    </div>
  </div>
</div>





<?php include "footer.php" ?>

<script type="text/javascript">
  var busqueda = document.getElementById('buscar');
  var table = document.getElementById("tabla").tBodies[0];

  buscaTabla = function() {
    texto = busqueda.value.toLowerCase();
    var r = 0;
    while (row = table.rows[r++]) {
      if (row.innerText.toLowerCase().indexOf(texto) !== -1)
        row.style.display = null;
      else
        row.style.display = 'none';
    }
  }

  busqueda.addEventListener('keyup', buscaTabla);


  var a = "";
  $(function() {
    // ON SELECTING ROW
    $(".gfgselect").click(function() {
      //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
      a = "";
      b = "";
      c = "";
      d = "";
      e = "";
      f = "";
      g = "";
      h = "";

      b = $(this).parents("tr").find(".gfgtipodocumento").text();
      c = $(this).parents("tr").find(".gfgdocumento").text();
      d = $(this).parents("tr").find(".gfgnombrecompleto").text();
      e = $(this).parents("tr").find(".gfgtelefono").text();
      f = $(this).parents("tr").find(".gfgemail").text();
      g = $(this).parents("tr").find(".gfgtipoPoblacion").text();
      a = $(this).parents("tr").find(".gfgid").text();
      h = $(this).parents("tr").find(".gfgEstado_Curso").text();



      var p = "";


      p += ' <form method="POST" action="operaciones.php">' +
        '<div class="form-group">' +
        '<label for="gfgnombres">Tipo Documento</label>' +
        '<input readonly type="text" required class="form-control" id="gfgnombres" name="gfgnombres" placeholder="Nombre persona enlace" value="' + b + '">' +
        '</div>' +

        '<div class="form-group">' +
        '<label for="gfgPersona_Enlace">Numero de Documento</label>' +
        '<input  readonly type="text" required class="form-control" id="gfgPersona_Enlace" name="gfgPersona_Enlace" placeholder="" value="' + c + '">' +
        '</div> ' +

        '<div class="form-group">' +
        '<label for="gfgTelefono_Enlace">Nombres y apellidos</label>' +
        '<input readonly type="text" required class="form-control" id="gfgTelefono_Enlace" name="gfgTelefono_Enlace" placeholder="" value="' + d + '">' +
        '</div> ' +

        '<div class="form-group">' +
        '<label for="gfgmunicipio">Correo Electronico</label>' +
        '<input readonly type="text" class="form-control" id="gfgmunicipio" name="gfgmunicipio" placeholder="" value="' + f + '">' +
        '</div> ' +

        '<div class="form-group">' +
        '<label for="gfgmunicipio">Telefono</label>' +
        '<input readonly type="text" required class="form-control" id="gfgOcupacion_Productiva" name="gfgOcupacion_Productiva" placeholder="" value="' + e + '">' +
        '</div> ' +

        '<div class="form-group">' +
        '<label for="gfgPoblacion">Poblacion</label>' +
        '<input readonly type="text" class="form-control" id="gfgPoblacion" name="gfgPoblacion" placeholder="" value="' + g + '">' +
        '</div> ' +

        '<input style="diplay:none;" hidden type="text" class="form-control" id="operacion" name="operacion" placeholder="" value="15">' +
        '<input style="display:none;" type="text" class="form-control" id="poa_id" name="poa_id" placeholder="" value="' + a + '">'

      ;
      p += '<div class="modal-footer">' +
        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
        '<button type="submit" class="btn btn-danger">Borrar</button>' +
        '</div></form>'


      $("#delete").empty();
      //WRITING THE DATA ON MODEL
      $("#delete").append(p);

    });
  });



  $(document).ready(function() {

    $("#Pais").change(function() {

      alert(this.value);

      if (this.value == "Venezuela") {
        $("#Departamento").html("<OPTION value=9>boaco</OPTION><OPTION value=59>teustepe</OPTION>");
      } else if (this.value == "Colombia") {
        $("#Departamento").html("<OPTION value=01>jinotepe</OPTION><OPTION value=41>diriamba</OPTION>");
      }


    });
  });
</script>