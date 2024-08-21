<?php include "conexion1 .php"; ?>

<?php include "header.php" ?>

<?php

if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
  $consulta = 'SELECT id, municipio, periodo, estado FROM asignar_municipios WHERE asignar_municipios.id_responsable=' . $id . ' AND asignar_municipios.estado="activo" ';
  $resultado = $mysqli->query($consulta);

  //var_dump($resultado);
}
?>

<script src="https://unpkg.com/qrious@4.0.2/dist/qrious.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>


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




  <br>
  <?php
  if (!isset($_SESSION['alianza'])) {
    $_SESSION['alianza'] = '';
  }

  if ($_SESSION['alianza'] == 1) {
  } else {
    echo '

<button onclick="ocultar()" class="btn btn-warning">Ocultar / Mostrar Registrar nuevos POA</button>';
  }
  ?>

  <div class="ocular" id="ocultar" name="ocultar">
    <div class="container center-fluid">




      <form action="operaciones.php" method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Municipio</label>
          <select name="municipio" id="municipio" class="form-select" required>
            <option selected value=""></option>
            <?php
            while ($obj = $resultado->fetch_object()) {
              echo '<option value="' . $obj->id . '">' . $obj->municipio . ' - ' . $obj->periodo . '</option>';
            }
            ?>
          </select>
          <div class="form-group">
            <label for="exampleInputPassword1">Nombre del Poa</label>
            <input type="text" class="form-control" id="Nombre_Poa" name='Nombre_Poa' placeholder="Nombre_Poa" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Persona o Enlace</label>
            <input type="text" class="form-control" id="Persona_Enlace" name='Persona_Enlace'
              placeholder="Persona_Enlace" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Telefono del Enlace</label>
            <input type="number" class="form-control" id="Telefono_Enlace" name='Telefono_Enlace'
              placeholder="Telefono_Enlace" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Correo del Enlace</label>
            <input type="email" class="form-control" id="Correo_Enlace" name='Correo_Enlace' placeholder="Correo_Enlace"
              required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Poblacion del Poa</label>
            <input type="text" class="form-control" id="Poblacion" name='Poblacion' placeholder="Poblacion" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Ocupacion_Productiva</label>
            <input type="text" class="form-control" id="Ocupacion_Productiva" name='Ocupacion_Productiva'
              placeholder="Ocupacion_Productiva" required>
          </div>

          <input type="text" value=3 style="display: none;" id="operacion" name='operacion'>

          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
      </form>

    </div>

    <br>
  </div>
  <br><br>
  <table id="tabla" class="table table-striped">
    <thead>
      <tr>
        <th style="width:80px">Nombre Poa</th>
        <th style="width:80px">Municipio</th>
        <th style="width:50px">Vigencia</th>
        <th style="width:100px">Enlace</th>
        <th style="width:50px">Telefono</th>
        <th style="width:80px">Tipo Poblacion</th>
        <th style="width:80px">Vocacion Productiva</th>
        <th style="width:30px">Cursos</th>
        <th style="width:280px">Gestion del Poa</th>

      </tr>
      <tr>
        <td colspan="8">
          <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
        </td>
      </tr>
    </thead>
    <tbody>

      <?php

      if ($_SESSION['rol'] == 1) {

        $consulta = "SELECT * FROM asignar_municipios, poa WHERE poa.id_asignar_municipios=asignar_municipios.id ORDER BY poa.id_poa DESC";

      }
      if ($_SESSION['rol'] == 3) {

        $consulta = 'SELECT * FROM asignar_municipios, poa WHERE poa.id_asignar_municipios=asignar_municipios.id AND asignar_municipios.id_responsable=' . $id . ' AND asignar_municipios.estado="activo" ORDER BY poa.id_poa DESC';



      }
      if ($_SESSION['alianza'] == 1) {


        $consulta = 'SELECT * FROM alianza_municipio, poa WHERE alianza_municipio.poa_id=poa.id_poa AND alianza_municipio.estado="activo" AND alianza_municipio.id_User=' . $_SESSION['user_id'] . ' ORDER BY poa.id_poa DESC';


      }







      //var_dump($query);
      $query = $mysqli->query($consulta);

      while ($row = $query->fetch_object()) {

        $consulta2 = "SELECT COUNT(*) AS CURSOS FROM gestion_cursos WHERE gestion_cursos.id_nombre_poa=" . $row->id_poa;
        $query2 = $mysqli->query($consulta2);

        echo '<tr> 

                    <td class="gfgnombres">' . $row->Nombre_Poa . '</td> 
                    <td class="gfgmunicipio">' . $row->municipio . '</td>
                    <td class="gfgperiodo">' . $row->periodo . '</td>
                    <td class="gfgPersona_Enlace">' . $row->Persona_Enlace . '</td> 
                    <td class="gfgTelefono_Enlace">' . $row->Telefono_Enlace . '</td> 
                    <td class="gfgPoblacion">' . $row->Poblacion . '</td> 
                    <td class="gfgOcupacion_Productiva">' . $row->Ocupacion_Productiva . '</td>';

        while ($row2 = $query2->fetch_object()) {
          echo '<td class="gfgcursos">' . $row2->CURSOS . '</td>';
        }

        echo '
                    <td class="gfgid" style="display:none" >' . $row->id_poa . '</td> 
                    <td>';
        if ($_SESSION['alianza'] == 1) {
        } else {
          echo '<button class="gfgselect btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span ></span>Editar</button>
                    
                    <button class="gfgdelete btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdropDelete"><span ></span>Borrar</button>';
        }
        echo '
                    <a href=Gestion_cursos.php?id=' . $row->id_poa . ' <button class="gfg btn btn-warning btn-xs" ><span ></span>Ver Cursos</button></a> 

                    <button class="gfgenlace btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdropenlace"><span ></span>Enlace</button>
                    
                    </td>
                    
              </tr>';
      }




      ?>







    </tbody>
  </table>

  <br>

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Actualizar Registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="divGFG" id="divGFG"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="staticBackdropDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Registro POA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="delete" id="delete"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="staticBackdropenlace" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Link para compartir con enlace Municipio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="enlace" id="enlace"></div>
          <div class="codigo" id="codigo"></div>
          <div class="pie" id="pie"></div>
        </div>
      </div>
    </div>
  </div>






  <?php include "footer.php" ?>

  <script type="text/javascript">


    var busqueda = document.getElementById('buscar');
    var table = document.getElementById("tabla").tBodies[0];

    buscaTabla = function () {
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
    $(function () {
      // ON SELECTING ROW
      $(".gfgselect").click(function () {
        //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
        a = "";
        b = "";
        c = "";
        d = "";
        e = "";
        f = "";
        g = "";

        b = $(this).parents("tr").find(".gfgnombres").text();
        c = $(this).parents("tr").find(".gfgPersona_Enlace").text();
        d = $(this).parents("tr").find(".gfgTelefono_Enlace").text();
        e = $(this).parents("tr").find(".gfgOcupacion_Productiva").text();
        f = $(this).parents("tr").find(".gfgmunicipio").text();
        g = $(this).parents("tr").find(".gfgPoblacion").text();
        a = $(this).parents("tr").find(".gfgid").text();


        var p = "";


        p += ' <form method="POST" action="operaciones.php">' +
          '<div class="form-group">' +
          '<label for="gfgnombres">Nombre del Poa</label>' +
          '<input type="text" required class="form-control" id="gfgnombres" name="gfgnombres" placeholder="Nombre persona enlace" value="' + b + '">' +
          '</div>' +

          '<div class="form-group">' +
          '<label for="gfgPersona_Enlace">Persona enlace Poa</label>' +
          '<input  type="text" required class="form-control" id="gfgPersona_Enlace" name="gfgPersona_Enlace" placeholder="" value="' + c + '">' +
          '</div> ' +

          '<div class="form-group">' +
          '<label for="gfgTelefono_Enlace">Telefono del enlace Poa</label>' +
          '<input type="number" required class="form-control" id="gfgTelefono_Enlace" name="gfgTelefono_Enlace" placeholder="" value="' + d + '">' +
          '</div> ' +

          '<div class="form-group">' +
          '<label for="gfgmunicipio">Municipio del POA</label>' +
          '<input readonly type="text" class="form-control" id="gfgmunicipio" name="gfgmunicipio" placeholder="" value="' + f + '">' +
          '</div> ' +

          '<div class="form-group">' +
          '<label for="gfgmunicipio">Vocacion Productiva</label>' +
          '<input type="text" required class="form-control" id="gfgOcupacion_Productiva" name="gfgOcupacion_Productiva" placeholder="" value="' + e + '">' +
          '</div> ' +

          '<div class="form-group">' +
          '<label for="gfgPoblacion">Poblacion del POA</label>' +
          '<input readonly type="text" class="form-control" id="gfgPoblacion" name="gfgPoblacion" placeholder="" value="' + g + '">' +
          '</div> ' +

          '<input style="diplay:none;" hidden type="text" class="form-control" id="operacion" name="operacion" placeholder="" value="8">' +
          '<input style="diplay:none;" hidden type="text" class="form-control" id="poa_id" name="poa_id" placeholder="" value="' + a + '">'

          ;
        p += '<div class="modal-footer">' +
          '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
          '<button type="submit" class="btn btn-primary">Actualizar</button>' +
          '</div></form>'


        $("#divGFG").empty();
        //WRITING THE DATA ON MODEL
        $("#divGFG").append(p);

      });
    });


    function download() {

      axios({
        url: 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=https://www.vivu.com.co/vivuWeB/cursosReg.php?poa=' + a + '',
        method: 'GET',
        responseType: 'blob'
      })
        .then((response) => {
          const url = window.URL
            .createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'imageQR.jpg');
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        })
    };


    $(function () {
      // ON SELECTING ROW
      $(".gfgenlace").click(function () {
        //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
        a = "";
        a = $(this).parents("tr").find(".gfgid").text();
        //alert ("el link que se debe compartir es :\n\n https://www.vivu.com.co/vivuWev/cursosReg.php?poa="+a);
        var p = "";
        var z = "";
        var qr = "";
        p += '<div class="form-group">' +
          '<label for="exampleInputPassword1">Compartir Enlace</label>' +
          '<input readonly type="text" class="form-control" id="periodo" name="periodo" placeholder="Periodo" value="https://www.vivu.com.co/vivuWeb/cursosReg.php?poa=' + a + '">' +
          '</div>';
        z += '<div class="modal-footer">' +
          '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
          '<button type="button" onclick="download()" class="btn btn-primary">Descargar Codigo QR</button>' +
          '</div>'

        qr += '<img style="display: block;-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;"' +
          'src="https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;choe=UTF-8&amp;chl=https://www.vivu.com.co/vivuWeb/cursosReg.php?poa=' + a + '">'

        $("#enlace").empty();
        $("#codigo").empty();
        $("#pie").empty();
        //WRITING THE DATA ON MODEL
        $("#enlace").append(p);
        $("#pie").append(z);
        $("#codigo").append(qr);



      });
    });


    function download() {

      axios({
        url: 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=https://www.vivu.com.co/vivuWeB/cursosReg.php?poa=' + a + '',
        method: 'GET',
        responseType: 'blob'
      })
        .then((response) => {
          const url = window.URL
            .createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'imageQR.jpg');
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        })
    }

    function ocultar() { $("#ocultar").toggle(); }

    $("#ocultar").toggle();


    $(function () {
      // ON SELECTING ROW
      $(".gfgdelete").click(function () {

        h = $(this).parents("tr").find(".gfgcursos").text();

        if (h > 0) {

          var p = "";


          p += ' <form>' +
            '<div class="form-group">' +
            '<label for="gfgnombres">Mensaje</label>' +
            '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede eliminar este POA - tiene formaciones registradas</textarea>' +
            '</div>';
          p += '<div class="modal-footer">' +

            '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +

            '</div></form>'


        }

        if (h == 0) {

          a = "";
          b = "";
          c = "";
          d = "";
          e = "";
          f = "";
          g = "";

          b = $(this).parents("tr").find(".gfgnombres").text();
          c = $(this).parents("tr").find(".gfgPersona_Enlace").text();
          d = $(this).parents("tr").find(".gfgTelefono_Enlace").text();
          e = $(this).parents("tr").find(".gfgOcupacion_Productiva").text();
          f = $(this).parents("tr").find(".gfgmunicipio").text();
          g = $(this).parents("tr").find(".gfgPoblacion").text();
          a = $(this).parents("tr").find(".gfgid").text();


          var p = "";


          p += ' <form method="POST" action="operaciones.php">' +
            '<div class="form-group">' +
            '<label for="gfgnombres">Nombre del Poa</label>' +
            '<input readonly type="text" required class="form-control" id="gfgnombres" name="gfgnombres" placeholder="Nombre persona enlace" value="' + b + '">' +
            '</div>' +

            '<div class="form-group">' +
            '<label for="gfgPersona_Enlace">Persona enlace Poa</label>' +
            '<input  readonly type="text" required class="form-control" id="gfgPersona_Enlace" name="gfgPersona_Enlace" placeholder="" value="' + c + '">' +
            '</div> ' +

            '<div class="form-group">' +
            '<label for="gfgTelefono_Enlace">Telefono del enlace Poa</label>' +
            '<input readonly type="number" required class="form-control" id="gfgTelefono_Enlace" name="gfgTelefono_Enlace" placeholder="" value="' + d + '">' +
            '</div> ' +

            '<div class="form-group">' +
            '<label for="gfgmunicipio">Municipio del POA</label>' +
            '<input readonly type="text" class="form-control" id="gfgmunicipio" name="gfgmunicipio" placeholder="" value="' + f + '">' +
            '</div> ' +

            '<div class="form-group">' +
            '<label for="gfgmunicipio">Vocacion Productiva</label>' +
            '<input readonly type="text" required class="form-control" id="gfgOcupacion_Productiva" name="gfgOcupacion_Productiva" placeholder="" value="' + e + '">' +
            '</div> ' +

            '<div class="form-group">' +
            '<label for="gfgPoblacion">Poblacion del POA</label>' +
            '<input readonly type="text" class="form-control" id="gfgPoblacion" name="gfgPoblacion" placeholder="" value="' + g + '">' +
            '</div> ' +

            '<input style="diplay:none;" hidden type="text" class="form-control" id="operacion" name="operacion" placeholder="" value="9">' +
            '<input style="diplay:none;" hidden type="text" class="form-control" id="poa_id" name="poa_id" placeholder="" value="' + a + '">'

            ;
          p += '<div class="modal-footer">' +
            '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
            '<button type="submit" class="btn btn-danger">Eliminar</button>' +
            '</div></form>'


        }

        //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES



        $("#delete").empty();
        //WRITING THE DATA ON MODEL
        $("#delete").append(p);

      });
    });
















  </script>