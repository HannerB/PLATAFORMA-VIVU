<?php

//var_dump($_SESSION['estado']);
include "conexion1.php"; session_start();
?>

<?php
include "header.php"
?>

<?php



//$tildes = $conexion->query("SET NAMES 'utf8'");



?>

<div class="container contenedor">
    <?php
    

    if (!isset($_SESSION['estado'])){
      $_SESSION['estado']='';
      $_SESSION['valor']='';
    }

        if($_SESSION['valor']==1){
            ?>
            <div class="alert alert-dismissible alert-success" style="margin-top:20px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="icon-checkmark"></span> <?php echo $_SESSION['estado'] ; ?>
            </div>
            <?php

            unset($_SESSION['estado']);

        }elseif($_SESSION['estado']==!null){
          ?>
            <div class="alert alert-dismissible alert-danger" style="margin-top:20px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="icon-checkmark"></span> <?php echo "Operacion NO Realizada :".$_SESSION['estado'] ; ?>
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
    <label for="exampleInputPassword1">Enlace</label>
    <div class="input-group mb-3">
      <input type="number" required class="form-control col-3"  id="cedula" name="cedula" placeholder="ingrese cedula del enlace">
        
        <button class="btn btn-primary" type="button" onclick="buscar($('#cedula').val());"> buscar</button>

</div>

<div class="resultado" id="resultado" name="resultado"> </div>

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Selecione Periodo</label>
    <input type="text" class="form-control" id="periodo" name='periodo' placeholder="Periodo" required>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Enlace para el tipo de poblacion</label>
    <input type="text" class="form-control" id="poblacion" name='poblacion' placeholder="tipo poblacion" required>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Cargo o Rol</label>
    <input type="text" class="form-control" id="cargo" name='cargo' placeholder="Cargo" required>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">POA</label>
    <div class="input-group mb-3">
    <select class="form-select" aria-label="Default select example" id='poa' name='poa' required>
  <option selected value=0></option>
  <?php
  $consulta="SELECT poa.id_poa, poa.Nombre_Poa, asignar_municipios.municipio, asignar_municipios.periodo, nombres, apellidos FROM poa, asignar_municipios, users WHERE poa.id_asignar_municipios=asignar_municipios.id AND users.id=asignar_municipios.id_responsable AND asignar_municipios.estado='activo'";

  $resultado = $mysqli->query($consulta);
  while ($obj = $resultado->fetch_object()) {echo '<option value="'.$obj->id_poa.'">'.$obj->Nombre_Poa.' - Municipio de '.$obj->municipio.' - '.$obj->periodo.' - '.$obj->nombres." ".$obj->apellidos.'</option>';}
  
  ?>
  </select>

</div>
  </div>
  
    <input type="text" value=5 style="display: none;" id="operacion" name='operacion'>

  <button type="submit" class="btn btn-primary">Registrar</button>
</form>
</div>



<div class="container center-fluid">
<div class="row">
  <div class="col-xs-12">
    <h1 class="page-header">
      Enlaces Asignados
    </h1>

    
    
    
    <!-- TABLA INICIA -->
    <table id="tabla" class="table table-striped">
      <thead>
        <tr>
          <th style="width:160px">Nombres y Apellidos</th>
          <th style="width:160px">Municipio</th>
          <th style="width:220px">Vigencia</th>
          <th style="width:140px">Atencion a Poblacion</th>
          <th style="width:140px">Estado</th>
          <th style="width:140px">Gestion</th>
        </tr>
        <tr>
          <td colspan="5">
            <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
          </td>
        </tr>
      </thead>
      <tbody>

      <?php


      $consulta="SELECT *, alianza_municipio.municipio AS municipio1 FROM alianza_municipio, users WHERE alianza_municipio.id_User=users.id ORDER BY alianza_municipio.id_alianza DESC";
      
      $query = $mysqli->query($consulta);

      //var_dump($query);
      
      while ($row = $query->fetch_object()) {
        
        echo '<tr> 
                    <td class="gfgnombres">'.$row->nombres.' '.$row->apellidos.'</td> 
                    <td class="gfgmunicipio">'.$row->municipio1.'</td>
                    <td class="gfgperiodo">'.$row->periodo.'</td> 
                    <td class="gfgpoblacion">'.$row->enlace_poblacion.'</td> 
                    <td class="gfgestado">'.$row->estado.'</td> 
                    <td class="gfgid" style="display:none" >'.$row->id_alianza.'</td> 
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

$(function () {
                // ON SELECTING ROW
                $(".gfgselect").click(function () {
   //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
                    var a = $(this).parents("tr").find(".gfgnombres").text();
                    var c = $(this).parents("tr").find(".gfgmunicipio").text();
                    var d = $(this).parents("tr").find(".gfgperiodo").text();
                    var e = $(this).parents("tr").find(".gfgestado").text();
                    var z = $(this).parents("tr").find(".gfgid").text();
                    var p = "";
                    // CREATING DATA TO SHOW ON MODEL
                    p += '<div class="container center-fluid">'+
'<form action="operaciones.php" method="POST">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Municipio</label>'+
'<select name="municipio" id="municipio" class="form-select" required disabled="disabled">'+
        '<option value="'+c+'" selected="">'+c+'</option>'+
                                    '<option value="BARANOA">BARANOA</option>'+
                                    '<option value="BARRANQUILLA">BARRANQUILLA</option>'+
                                    '<option value="CAMPO DE LA CRUZ">CAMPO DE LA CRUZ</option>'+
                                    '<option value="CANDELARIA">CANDELARIA</option>'+
                                    '<option value="GALAPA">GALAPA</option>'+
                                    '<option value="JUAN DE ACOSTA">JUAN DE ACOSTA</option>'+
                                    '<option value="LURUACO">LURUACO</option>'+
                                    '<option value="MALAMBO">MALAMBO</option>'+
                                    '<option value="MANATÍ">MANATÍ</option>'+
                                    '<option value="PALMAR DE VARELA">PALMAR DE VARELA</option>'+
                                    '<option value="PIOJO">PIOJO</option>'+
                                    '<option value="POLONUEVO">POLONUEVO</option>'+
                                    '<option value="PONEDERA">PONEDERA</option>'+
                                    '<option value="PUERTO COLOMBIA">PUERTO COLOMBIA</option>'+
                                    '<option value="REPELÓN">REPELÓN</option>'+
                                    '<option value="SABANAGRANDE">SABANAGRANDE</option>'+
                                    '<option value="SABANALARGA">SABANALARGA</option>'+
                                    '<option value="SANTA LUCÍA">SANTA LUCÍA</option>'+
                                    '<option value="SANTO TOMÁS">SANTO TOMÁS</option>'+
                                    '<option value="SOLEDAD">SOLEDAD</option>'+
                                    '<option value="SUÁN">SUÁN</option>'+
                                    '<option value="TUBARA">TUBARA</option>'+
                                    '<option value="USIACURI">USIACURI</option>'+
                                '</select> </div>';
                    
                    p +='<div class="form-group">'+
    '<label for="exampleInputPassword1">Enlace</label>'+
    '<div class="input-group mb-3">'+
    '<input class="form-control" aria-label="Default select example" id="orientador" name="orientador" disabled="disabled" value="'+a+'"></div></div>';

                    p +='<div class="form-group">'+
    '<label for="exampleInputPassword1">Selecione Periodo</label>'+
    '<input type="text" class="form-control" id="periodo" name="periodo" placeholder="Periodo" value="'+d+'" required disabled="disabled">'+
  '</div>';

  p +='<div class="form-group">'+
'<label for="exampleInputEmail1">Estado</label>'+
'<select name="estado" id="estado" class="form-select" required>'+
        '<option value="'+e+'" selected="">'+e+'</option>'+
        '<option value="activo">activo</option>'+
        '<option value="inactivo">inactivo</option></div>'
        
  +'<input type="text" value=6 style="display: none;" id="operacion" name="operacion">'
  +'<input type="text" value="'+z+'" style="display: none;" id="user_id" name="user_id">';
  

  p +='<div class="modal-footer">'+
       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
       '<button type="submit" class="btn btn-primary">Actualizar</button>'+
      '</div>';



                    
                    //CLEARING THE PREFILLED DATA
                    $("#divGFG").empty();
                    //WRITING THE DATA ON MODEL
                    $("#divGFG").append(p);
                });
            });




var busqueda = document.getElementById('buscar');
    var table = document.getElementById("tabla").tBodies[0];

    buscaTabla = function(){
      texto = busqueda.value.toLowerCase();
      var r=0;
      while(row = table.rows[r++])
      {
        if ( row.innerText.toLowerCase().indexOf(texto) !== -1 )
          row.style.display = null;
        else
          row.style.display = 'none';
      }
    }

    busqueda.addEventListener('keyup', buscaTabla);

    $(function () {
                // ON SELECTING ROW
                $(".gfgdelete").click(function () {
   //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
   var a = $(this).parents("tr").find(".gfgnombres").text();
                    var c = $(this).parents("tr").find(".gfgmunicipio").text();
                    var d = $(this).parents("tr").find(".gfgperiodo").text();
                    var e = $(this).parents("tr").find(".gfgestado").text();
                    var z = $(this).parents("tr").find(".gfgid").text();
                    var p = "";
                    // CREATING DATA TO SHOW ON MODEL
                    p += '<div class="container center-fluid">'+
'<form action="operaciones.php" method="POST">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Municipio</label>'+
'<select name="municipio" id="municipio" class="form-select" required disabled="disabled">'+
        '<option value="'+c+'" selected="">'+c+'</option>'+
                                   
                                '</select> </div>';
                    
                    p +='<div class="form-group">'+
    '<label for="exampleInputPassword1">Enlace</label>'+
    '<div class="input-group mb-3">'+
    '<input class="form-control" aria-label="Default select example" id="orientador" name="orientador" disabled="disabled" value="'+a+'"></div></div>';

                    p +='<div class="form-group">'+
    '<label for="exampleInputPassword1">Selecione Periodo</label>'+
    '<input type="text" class="form-control" id="periodo" name="periodo" placeholder="Periodo" value="'+d+'" required disabled="disabled">'+
  '</div>';

  p +='<div class="form-group">'+
'<label for="exampleInputEmail1">Estado</label>'+
'<select name="estado" id="estado" class="form-select" required disabled="disabled">'+
        '<option value="'+e+'" selected="">'+e+'</option>'+
        '<option value="activo">activo</option>'+
        '<option value="inactivo">inactivo</option></div>'
        
  +'<input type="text" value=7 style="display: none;" id="operacion" name="operacion">'
  +'<input type="text" value="'+z+'" style="display: none;" id="user_id" name="user_id">';
  

  p +='<div class="modal-footer">'+
       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
       '<button type="submit" class="btn btn-danger">Eliminar</button>'+
      '</div>';



                    
                


                   //CLEARING THE PREFILLED DATA
                    $("#delete").empty();
                    //WRITING THE DATA ON MODEL
                    $("#delete").append(p);

                  });
            });

            function buscar(cedula) {
  $("#resultado").empty();
  if (document.getElementById("cedula").value==""){
  alert("Por favor ingrese el nro de documento del enlace");
  return;
}


     var parametros = {"cedula":cedula};
$.ajax({
    data:parametros,
    url:'buscar_enlaces.php',
    type: 'post',
    beforeSend: function () {
        $("#resultado").html("Procesando, espere por favor");
    },
    success: function (response) {   
        $("#resultado").html(response);
    }
});
}

    </script>

