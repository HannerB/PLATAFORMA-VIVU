<?php include "conexion1.php"; ?>

<?php include "header.php" ?>


<div class="container contenedor">
  <?php


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


  <table id="tabla" class="table table-striped">
    <thead>
      <tr>
        <th style="width:100px">Mes de concertacion</th>
        <th style="width:80px">Periodo</th>
        <th style="width:100px">Orientador</th>
        <th style="width:100px">Municipio</th>
        <th style="width:150px">Poa</th>
        <th style="width:150px">estado</th>
        <th style="width:80px">Formaciones</th>
        <th style="width:200px">Gestion</th>

      </tr>
      <tr>
        <td colspan="7">
          <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
        </td>
      </tr>
    </thead>
    <tbody>
      <?php
      $consulta = "SELECT DISTINCT (gestion_cursos.Municipio_Curso), files_concertaciones.id_file_concertaciones, files_concertaciones.mes_concertacion, 
      files_concertaciones.ruta, files_concertaciones.estado, users.id,
        users.nombres,users.apellidos, files_concertaciones.vigencia, poa.Nombre_Poa
        FROM files_concertaciones, users, poa, concertaciones, gestion_cursos
        WHERE users.id=files_concertaciones.users_id
        AND concertaciones.id_gestion_cursos=gestion_cursos.id_Gestion_Cursos AND poa.id_poa=gestion_cursos.id_nombre_poa AND files_concertaciones.id_file_concertaciones=concertaciones.id_concertacion
        ORDER BY files_concertaciones.id_file_concertaciones DESC";

      $query = $mysqli->query($consulta);

      //obtener municipio

      //var_dump($query);

      // SELECT COUNT(*) FROM concertaciones WHERE concertaciones.id_concertacion=6

      while ($row = $query->fetch_object()) {

        $consulta2 = "SELECT COUNT(*) as formacion FROM concertaciones WHERE concertaciones.id_concertacion=" . $row->id_file_concertaciones;

        $query2 = $mysqli->query($consulta2);

        echo '<tr> 

        <td class="gfgmes_concertacion">' . $row->mes_concertacion . '</td> 
        <td class="gfgvigencia">' . $row->vigencia . '</td>
        <td class="gfgorientador">' . $row->nombres . " " . $row->apellidos . '</td>
        <td class="gfgorientador">' . $row->Municipio_Curso . '</td>
        <td class="gfgorientador">' . $row->Nombre_Poa . '</td>
        <td class="gfgestado">' . $row->estado . '</td>';

        while ($row2 = $query2->fetch_object()) {
          echo '<td class="gfgformaciones">' . $row2->formacion . '</td>';
        }

        echo '
        
        <td hidden class="gfgid_concertaciones">' . $row->id_file_concertaciones . '</td> 
        <td> 
        <a href=./' . $row->ruta . ' <button class="gfgdownload btn btn-danger btn-xs" ><span ></span>Descargar</button></a>
        <button class="gfgselect btn btn-warning btn-xs" onclick="hacer_click()" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span ></span>Ver detalle</button>

        </td>
        
    </tr>';
      }

      ?>

      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Acta de concertacion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="cursos_ver" id="cursos_ver" name="cursos_ver"> </div>

              <button type="button" id="ver_cursos" hidden class="ver_cursos btn btn-primary mb-3" onclick="buscar($('#cedula').val());">Ver cursos concertados</button>
              <div class="resultado" id="resultado" name="resultado"></div>

              <div class="inactivo" id="inactivo" name="inactivo"></div>
              </form>

            </div>
          </div>




        </div>
      </div>
</div>
</div>
</div>



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

  function hacer_click() {
    document.querySelector("#ver_cursos").click();
  }

  $(function() {
    // ON SELECTING ROW
    $(".gfgselect").click(function() {

      //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
      var a = "";
      var b = "";
      a = $(this).parents("tr").find(".gfgid_concertaciones").text();
      b = $(this).parents("tr").find(".gfgestado").text();

      var p = "";

      p += '<form class="row g-3">' +
        '<input type="text"  class="form-control" id="cedula" hidden name="cedula" placeholder="" value="' + a + '">';

      $("#cursos_ver").empty();
      $("#cursos_ver").append(p);
      $('#cursos_ver').css('display', 'block');
      $('#resultado').css('display', 'block');
      $("#inactivo").empty();

      if (b == "Acta No valida") {
        z = "";
        z += ' <form>' +
          '<div class="form-group">' +
          '<label for="gfgnombres">Mensaje</label>' +
          '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede modificar esta acta, ya fue revisada y su estado es "Acta No valida"</textarea>' +
          '</div>';
        z += '<div class="modal-footer">' +

          '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +

          '</div></form>'
        $("#inactivo").empty();
        $("#inactivo").append(z);
        $('#cursos_ver').css('display', 'none');
        $('#resultado').css('display', 'none');
      }

      if (b == "Acta valida") {
        z = "";
        z += ' <form>' +
          '<div class="form-group">' +
          '<label for="gfgnombres">Mensaje</label>' +
          '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede modificar esta acta, ya fue revisada y su estado es "Acta valida"</textarea>' +
          '</div>';
        z += '<div class="modal-footer">' +

          '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +

          '</div></form>';

        $("#inactivo").empty();
        $("#inactivo").append(z);
        $('#resultado').css('display', 'none');
        $('#cursos_ver').css('display', 'none');

      }








    });
  });





  $(".gfgselect").click(function() {
    document.querySelector("#ver_cursos").click();
  });

  function buscar(cedula) {

    $(".gfgselect").click(function() {
      document.querySelector("#ver_cursos").click();
    });

    $("#resultado").empty();
    var cedula = "";
    cedula = document.getElementById("cedula").value;
    var parametros = {
      "cedula": cedula
    };

    $.ajax({
      data: parametros,
      url: 'buscar_Cursos.php',
      type: 'post',
      beforeSend: function() {
        $("#resultado").html("Procesando, espere por favor");
      },
      success: function(response) {
        $("#resultado").html(response);
      }
    });
  }
</script>