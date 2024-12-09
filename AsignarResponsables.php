<?php

//var_dump($_SESSION['estado']);
include "conexion1.php";
session_start();
?>

<?php
include "header.php"
?>

<?php

//$tildes = $conexion->query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM users WHERE rol =3";
$resultado = $mysqli->query($consulta);


?>

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


  <div class="container center-fluid">
    <form action="operaciones.php" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Municipio</label>
        <select name="municipio" id="municipio" class="form-select" required>
          <option value="" disabled="" selected="">Seleccione...</option>
          <option value="BARANOA">BARANOA</option>
          <option value="BARRANQUILLA">BARRANQUILLA</option>
          <option value="CAMPO DE LA CRUZ">CAMPO DE LA CRUZ</option>
          <option value="CANDELARIA">CANDELARIA</option>
          <option value="GALAPA">GALAPA</option>
          <option value="JUAN DE ACOSTA">JUAN DE ACOSTA</option>
          <option value="LURUACO">LURUACO</option>
          <option value="MALAMBO">MALAMBO</option>
          <option value="MANATÍ">MANATÍ</option>
          <option value="PALMAR DE VARELA">PALMAR DE VARELA</option>
          <option value="PIOJO">PIOJO</option>
          <option value="POLONUEVO">POLONUEVO</option>
          <option value="PONEDERA">PONEDERA</option>
          <option value="PUERTO COLOMBIA">PUERTO COLOMBIA</option>
          <option value="REPELÓN">REPELÓN</option>
          <option value="SABANAGRANDE">SABANAGRANDE</option>
          <option value="SABANALARGA">SABANALARGA</option>
          <option value="SANTA LUCÍA">SANTA LUCÍA</option>
          <option value="SANTO TOMÁS">SANTO TOMÁS</option>
          <option value="SOLEDAD">SOLEDAD</option>
          <option value="SUÁN">SUÁN</option>
          <option value="TUBARA">TUBARA</option>
          <option value="USIACURI">USIACURI</option>
        </select>



      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Orientador</label>
        <div class="input-group mb-3">
          <select class="form-select" aria-label="Default select example" id='orientador' name='orientador' required>
            <option selected value=0></option>
            <?php
            while ($obj = $resultado->fetch_object()) {
              echo '<option value="' . $obj->id . '">' . $obj->nombres . ' ' . $obj->apellidos . '</option>';
            }

            ?>
          </select>

        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Selecione Periodo</label>
        <input type="text" class="form-control" id="periodo" name='periodo' placeholder="Periodo" required>
      </div>

      <input type="text" value=0 style="display: none;" id="operacion" name='operacion'>

      <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
  </div>

  <div class="container center-fluid">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="page-header">
          Orientadores Asignados
        </h1>




        <!-- TABLA INICIA -->
        <table id="tabla" class="table table-striped">
          <thead>
            <tr>
              <th style="width:160px">Nombres y Apellidos</th>
              <th style="width:160px">Municipio</th>
              <th style="width:220px">Vigencia</th>
              <th style="width:140px">Estado</th>
              <th style="width:140px">Gestion</th>
            </tr>
            <tr>
              <td colspan="4">
                <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
              </td>
            </tr>
          </thead>
          <tbody>

            <?php


            $consulta = "SELECT asignar_municipios.id, asignar_municipios.municipio, estado, periodo, users.nombres, users.apellidos 
      FROM asignar_municipios, users WHERE asignar_municipios.id_responsable = users.id ORDER BY asignar_municipios.id DESC";

            $query = $mysqli->query($consulta);

            //var_dump($query);

            while ($row = $query->fetch_object()) {

              echo '<tr> 
                    <td class="gfgnombres">' . $row->nombres . ' ' . $row->apellidos . '</td> 
                    <td class="gfgmunicipio">' . $row->municipio . '</td>
                    <td class="gfgperiodo">' . $row->periodo . '</td> 
                    <td class="gfgestado">' . $row->estado . '</td> 
                    <td class="gfgid" style="display:none" >' . $row->id . '</td> 
                    <td> <button class="gfgselect btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span ></span>Editar</button>
                    <button class="gfgdelete btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdropDelete"><span ></span>Borrar</button></td>
              </tr>';
            }




            ?>
          </tbody>
        </table>
        <!-- TABLA FINALIZA -->


      </div>
    </div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Actualizar Registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="GFGclass"
            id="divGFG"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="staticBackdropDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Desea Eliminar el Registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="delete" id="delete"></div>
        </div>
      </div>
    </div>
  </div>




  <?php

  include "footer.php";
  ?>

  <script type="text/javascript">
    $(function() {
      // ON SELECTING ROW
      $(".gfgselect").click(function() {
        //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
        var a = $(this).parents("tr").find(".gfgnombres").text();
        var c = $(this).parents("tr").find(".gfgmunicipio").text();
        var d = $(this).parents("tr").find(".gfgperiodo").text();
        var e = $(this).parents("tr").find(".gfgestado").text();
        var z = $(this).parents("tr").find(".gfgid").text();
        var p = "";
        // CREATING DATA TO SHOW ON MODEL
        p += '<div class="container center-fluid">' +
          '<form action="operaciones.php" method="POST">' +
          '<div class="form-group">' +
          '<label for="exampleInputEmail1">Municipio</label>' +
          '<select name="municipio" id="municipio" class="form-select" required>' +
          '<option value="' + c + '" selected="">' + c + '</option>' +
          '<option value="BARANOA">BARANOA</option>' +
          '<option value="BARRANQUILLA">BARRANQUILLA</option>' +
          '<option value="CAMPO DE LA CRUZ">CAMPO DE LA CRUZ</option>' +
          '<option value="CANDELARIA">CANDELARIA</option>' +
          '<option value="GALAPA">GALAPA</option>' +
          '<option value="JUAN DE ACOSTA">JUAN DE ACOSTA</option>' +
          '<option value="LURUACO">LURUACO</option>' +
          '<option value="MALAMBO">MALAMBO</option>' +
          '<option value="MANATÍ">MANATÍ</option>' +
          '<option value="PALMAR DE VARELA">PALMAR DE VARELA</option>' +
          '<option value="PIOJO">PIOJO</option>' +
          '<option value="POLONUEVO">POLONUEVO</option>' +
          '<option value="PONEDERA">PONEDERA</option>' +
          '<option value="PUERTO COLOMBIA">PUERTO COLOMBIA</option>' +
          '<option value="REPELÓN">REPELÓN</option>' +
          '<option value="SABANAGRANDE">SABANAGRANDE</option>' +
          '<option value="SABANALARGA">SABANALARGA</option>' +
          '<option value="SANTA LUCÍA">SANTA LUCÍA</option>' +
          '<option value="SANTO TOMÁS">SANTO TOMÁS</option>' +
          '<option value="SOLEDAD">SOLEDAD</option>' +
          '<option value="SUÁN">SUÁN</option>' +
          '<option value="TUBARA">TUBARA</option>' +
          '<option value="USIACURI">USIACURI</option>' +
          '</select> </div>';

        p += '<div class="form-group">' +
          '<label for="exampleInputPassword1">Orientador</label>' +
          '<div class="input-group mb-3">' +
          '<input class="form-control" aria-label="Default select example" id="orientador" name="orientador" disabled="disabled" value="' + a + '"></div></div>';

        p += '<div class="form-group">' +
          '<label for="exampleInputPassword1">Selecione Periodo</label>' +
          '<input type="text" class="form-control" id="periodo" name="periodo" placeholder="Periodo" value="' + d + '" required>' +
          '</div>';

        p += '<div class="form-group">' +
          '<label for="exampleInputEmail1">Estado</label>' +
          '<select name="estado" id="estado" class="form-select" required>' +
          '<option value="' + e + '" selected="">' + e + '</option>' +
          '<option value="activo">activo</option>' +
          '<option value="inactivo">inactivo</option></div>'

          +
          '<input type="text" value=1 style="display: none;" id="operacion" name="operacion">' +
          '<input type="text" value="' + z + '" style="display: none;" id="id" name="id">';


        p += '<div class="modal-footer">' +
          '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
          '<button type="submit" class="btn btn-primary">Actualizar</button>' +
          '</div>';




        //CLEARING THE PREFILLED DATA
        $("#divGFG").empty();
        //WRITING THE DATA ON MODEL
        $("#divGFG").append(p);
      });
    });




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

    $(function() {
      // ON SELECTING ROW
      $(".gfgdelete").click(function() {
        //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
        var a = $(this).parents("tr").find(".gfgnombres").text();
        var c = $(this).parents("tr").find(".gfgmunicipio").text();
        var d = $(this).parents("tr").find(".gfgperiodo").text();
        var e = $(this).parents("tr").find(".gfgestado").text();
        var z = $(this).parents("tr").find(".gfgid").text();
        var p = "";
        // CREATING DATA TO SHOW ON MODEL
        p += '<div class="container center-fluid">' +
          '<form action="operaciones.php" method="POST">' +
          '<div class="form-group">' +
          '<label for="exampleInputEmail1">Municipio</label>' +
          '<select name="municipio" id="municipio" class="form-select" required disabled="disabled">' +
          '<option value="' + c + '" selected="">' + c + '</option>' +

          '</select> </div>';

        p += '<div class="form-group">' +
          '<label for="exampleInputPassword1">Orientador</label>' +
          '<div class="input-group mb-3">' +
          '<input class="form-control" aria-label="Default select example" id="orientador" name="orientador" disabled="disabled" value="' + a + '"></div></div>';

        p += '<div class="form-group">' +
          '<label for="exampleInputPassword1">Selecione Periodo</label>' +
          '<input type="text" class="form-control" id="periodo" name="periodo" placeholder="Periodo" value="' + d + '" required disabled="disabled">' +
          '</div>';

        p += '<div class="form-group">' +
          '<label for="exampleInputEmail1">Estado</label>' +
          '<select name="estado" id="estado" class="form-select" required disabled="disabled">' +
          '<option value="' + e + '" selected="">' + e + '</option>' +
          '<option value="activo">activo</option>' +
          '<option value="inactivo">inactivo</option></div>'

          +
          '<input type="text" value=2 style="display: none;" id="operacion" name="operacion">' +
          '<input type="text" value="' + z + '" style="display: none;" id="id" name="id">';


        p += '<div class="modal-footer">' +
          '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
          '<button type="submit" class="btn btn-danger">Eliminar</button>' +
          '</div>';







        //CLEARING THE PREFILLED DATA
        $("#delete").empty();
        //WRITING THE DATA ON MODEL
        $("#delete").append(p);

      });
    });
  </script>