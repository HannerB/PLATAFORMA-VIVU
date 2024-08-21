<?php include "conexion1.php"; session_start()?>

<?php include "header.php" ?>

<?php 


if (isset($_GET['id'])){
$id=$_GET['id'];
$_SESSION['id_poa']=$id;

}

$id=$_SESSION['id_poa'];



//var_dump($_SESSION['id_poa']);

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

<?php

$consulta='SELECT * FROM gestion_cursos, poa WHERE poa.id_poa='.$_SESSION['id_poa'].' AND poa.id_poa=gestion_cursos.id_nombre_poa AND Estado_Curso="Concertado por validar"';

$query = $mysqli->query($consulta);

$valores=0;

while ($row = $query->fetch_object()) {
  
 
$valores=$valores+1;
 }
 echo '<button onclick="ocultar()" class="btn btn-warning">Ocultar / Mostrar Registrar Nuevos Cursos</button>';
 if ($_SESSION['alianza']==1 or $valores == 0){}else{echo ' <button  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropconcertaciones" >Mis Concertaciones</button>
   
   
   ';}
   //<button  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropentregacurso" >Formaciones Pendientes por entregar al centro de formacion</button>
 
 ?>




<div class="ocular" id="ocultar" name="ocultar" >
  

<div class="container center-fluid">
    
<form action="operaciones.php" method="POST">
  <div class="form-group">
  <br>
    <label for="exampleInputEmail1">Centro de Formacion</label>
    <select name="Centro_Formacion" id="Centro_Formacion" class="form-select" required>
    <option selected value=""></option>
    <option select value="CENTRO DE COMERCIO Y SERVICIOS">CENTRO DE COMERCIO Y SERVICIOS</option>
    <option select value="CENTRO INDUSTRIAL Y DE AVIACION">CENTRO INDUSTRIAL Y DE AVIACION</option>
    <option select value="CENTRO NACIONAL COLOMBO ALEMAN">CENTRO NACIONAL COLOMBO ALEMAN</option>
    <option select value="CEDAGRO">CEDAGRO</option>
    </select>
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Nivel de Formacion</label>
    <select name="Nivel_Formacion" id="Nivel_Formacion" class="form-select" required>
    <option selected value=""></option>
    <option select value="Formacion Complementaria">Formacion Complementaria</option>
    <option select value="Formacion Titulada">Formacion Titulada</option>
    <option select value="Certificacion por competencias Laborales">Certificacion por competencias Laborales</option>
    <option select value="Evento divulgacion Tecnologica">Evento divulgacion Tecnologica</option>
    </select>
    </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Nombre programa de Formacion</label>
    <input type="text" class="form-control" id="Nombre_Curso" name='Nombre_Curso' placeholder="Nombre del programa de formacion" required>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Categoria</label>
    <select type="text" class="form-control" id="categoria" name='categoria' placeholder="Categoria" required>
    <option selected value=""></option>
    <option select value="Tecnología">Tecnología</option>
    <option select value="Salud Ocupacional">Salud Ocupacional</option>
    <option select value="Emprendimiento">Emprendimiento</option>
    <option select value="Confección">Confección</option>
    <option select value="Cocina">Cocina</option>
    <option select value="Gestión">Gestión</option>
    <option select value="Artesanías">Artesanías</option>
    <option select value="Ética">Ética</option>
    <option select value="Pedagogía">Pedagogía</option>
    <option select value="Construcción">Construcción</option>
    <option select value="Belleza">Belleza</option>
    <option select value="Agricultura">Agricultura</option>
    <option select value="LGBTIQ">LGBTIQ</option>
    <option select value="Discapacidad">Discapacidad</option>
    <option select value="Logistica">Logistica</option>
    <option select value="Etnias">Etnias</option>
    <option select value="Ingles">Ingles</option>
    <option select value="Electricidad">Electricidad</option>

    </select>


  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Mes de ejecucion</label>
    <select name="Mes_Poa" id="Mes_Poa" class="form-select" required>
    <option selected value=""></option>
    <option select value="Enero">Enero</option>
    <option select value="Febrero">Febrero</option>
    <option select value="Marzo">Marzo</option>
    <option select value="Abril">Abril</option>
    <option select value="Mayo">Mayo</option>
    <option select value="Junio">Junio</option>
     <option select value="Julio">Julio</option>
    <option select value="Agosto">Agosto</option>
    <option select value="Septiembre">Septiembre</option>
    <option select value="Octubre">Octubre</option>
    <option select value="Noviembre">Noviembre</option>
    <option select value="Diciembre">Diciembre</option>
    </select>
    <input type="text" value=4 style="display: none;" id="operacion" name='operacion'>
<br>

<?php


$consulta='SELECT poa.id_asignar_municipios, asignar_municipios.municipio 
FROM poa, asignar_municipios WHERE poa.id_poa='.$id.' AND asignar_municipios.id=(SELECT poa.id_asignar_municipios FROM poa WHERE poa.id_poa='.$id.')AND asignar_municipios.estado="activo"';

$query = $mysqli->query($consulta);

//obtener municipio

//var_dump($query);

while ($row = $query->fetch_object()) {
  
 echo '<input type="text" value="'.$row->municipio.'" style="display: none;" id="Municipio_Curso" name="Municipio_Curso">';        
}


$consulta="SELECT poa.Nombre_Poa, poa.id_poa FROM poa WHERE poa.id_poa='$id'";

$query = $mysqli->query($consulta);

//obtener municipio

//var_dump($query);

while ($row = $query->fetch_object()) {
  
 echo '<input type="text" value="'.$row->id_poa.'" style="display: none;" id="Nombre_Poa" name="Nombre_Poa">';        
}




 ?> 


<button type="submit" class="btn btn-primary">Registrar</button>
</div>
</form>
</div>

</div>

<br><br>

<table id="tabla" class="table table-striped">
      <thead>
        <tr>
          <th style="width:80px">Municipio Curso</th>
          <th style="width:80px">Centro Formacion</th>
          <th style="width:50px">Nivel Formacion</th>
          <th style="width:150px">Nombre Curso</th>
          <th style="width:80px">Categoria</th>
          <th style="width:80px">Mes</th>
          <th style="width:50px">Estado</th>
          <th style="width:30px">Direccion</th>
          <th style="width:30px">Cupo</th>
          <th style="width:30px">inscritos</th>
          <th style="width:300px">Gestion</th>

        </tr>
        <tr>
          <td colspan="8">
            <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
          </td>
        </tr>
      </thead>
      <tbody>
      <?php


$consulta="SELECT * FROM gestion_cursos, poa WHERE poa.id_poa='$id' AND gestion_cursos.id_nombre_poa='$id' ORDER BY gestion_cursos.id_Gestion_Cursos DESC";

$query = $mysqli->query($consulta);

//obtener municipio

//var_dump($query);

while ($row = $query->fetch_object()) {

  $consulta2="SELECT COUNT(*) AS inscritos FROM gestion_cursos, cursos_detalle WHERE cursos_detalle.id_gestion_cursos=gestion_cursos.id_Gestion_Cursos AND gestion_cursos.id_Gestion_Cursos=".$row->id_Gestion_Cursos;

  $query2 = $mysqli->query($consulta2);

    echo '<tr> 

    <td class="gfgMunicipio_Curso">'.$row->Municipio_Curso.'</td> 
    <td class="gfgCentro_Formacion">'.$row->Centro_Formacion.'</td>
    <td class="gfgNivel_Formacion">'.$row->Nivel_Formacion.'</td>
    <td class="gfgNombre_Curso">'.$row->Nombre_Curso.'</td> 
    <td class="gfgcategoria">'.$row->categoria.'</td> 
    <td class="gfgMes_Poa">'.$row->Mes_Poa.'</td> 
    <td class="gfgEstado_Curso">'.$row->Estado_Curso.'</td> 
    <td class="gfgdireccion">'.$row->Direccion.'</td>
    <td class="gfgcupo">'.$row->cupo.'</td>';
    while ($row2 = $query2->fetch_object()) {
      echo '<td class="gfginscritos">'.$row2->inscritos.'</td>'; 
    }

    echo '
    <td class="gfgid" style="display:none" >'.$row->id_Gestion_Cursos.'</td> 
    <td> ';
    
     echo '<button class="gfgselect btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span ></span>Editar</button>';
    if ($_SESSION['alianza']==2){}else{echo '<button class="gfgdelete btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdropDelete"><span ></span>Borrar</button>';}
   echo '
    <a href=cursos_detalle.php?id='.$row->id_Gestion_Cursos.' <button class="btn btn-warning btn-xs" ><span ></span>Ver Detalle</button></a> 
    
    </td>
    
</tr>';
              
}


//var_dump($municipio);

 ?> 







</tbody>
</table>

<br>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Actualizar Programa de formacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="divGFG" 
        id="divGFG"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdropDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Eliminar programa de formacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="delete" id="delete"></div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="staticBackdropconcertaciones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Mis concertaciones</h5>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

       <form action="operaciones.php" method="POST" enctype="multipart/form-data" >

       <div class="form-group">
    <label for="Mes_Poa">Mes de la concertacion</label>
    <select name="Mes_Poa" id="Mes_Poa" class="form-select" required>
    <option selected value=""></option>
    <option select value="Enero">Enero</option>
    <option select value="Febrero">Febrero</option>
    <option select value="Marzo">Marzo</option>
    <option select value="Abril">Abril</option>
    <option select value="Mayo">Mayo</option>
    <option select value="Junio">Junio</option>
    <option select value="Julio">Julio</option>
    <option select value="Agosto">Agosto</option>
    <option select value="Septiembre">Septiembre</option>
    <option select value="Octubre">Octubre</option>
    <option select value="Noviembre">Noviembre</option>
    <option select value="Diciembre">Diciembre</option>
    </select> 
    </div>

    <div class="form-group">
    <label for="Vigencia">Vigencia</label>
    <input type="number" required class="form-control" id="Vigencia" name="Vigencia" aria-describedby="emailHelp" placeholder="">
    <small id="emailHelp" class="form-text text-muted"></small>
    </div>

    <div class="form-group row">
    <div class="col-sm-3">Cursos concertados</div>
    <div class="col-sm-9">
    <?php

$consulta='SELECT * FROM gestion_cursos, poa WHERE poa.id_poa='.$_SESSION['id_poa'].' AND poa.id_poa=gestion_cursos.id_nombre_poa AND Estado_Curso="Concertado por validar"';

$query = $mysqli->query($consulta);

$valores=0;

while ($row = $query->fetch_object()) {
  
  echo '   
  
<div class="form-check">
  <input class="form-check-input" required type="checkbox" id="check'.$valores.'" name="check'.$valores.'" value="'.$row->id_Gestion_Cursos.'">
  <label class="form-check-label" for="gridCheck1">
  '.$row->Nombre_Curso." - ".$row->Mes_Poa.'
  </label>
</div>';
$valores=$valores+1;
 }

 if ($valores==0){

  echo ' No existen formaciones concertadas, para habilitar esta opcion debe concertar formaciones';
 }

?>
      

    </div>
  </div>

  <input style="display:none;" type="text" class="form-control" id="valores" name="valores" placeholder="" value="<?php echo $valores-1;?>">
  <input style="display:none;" type="text" class="form-control" id="operacion" name="operacion" placeholder="" value="12">







                <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione Acta de concertacion</label>
                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
                <input class="form-control" type="file" id="fileconcertacion" name="fileconcertacion" required accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf">
                </div>
                


   
    
       </div>

       <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
       <?php if (($valores-1)>-1){echo '<button type="submit" class="btn btn-primary">Registrar</button>';}?>
      </div>

      </form>

      </div>
    </div>
  </div>






<script type="text/javascript">

function verificar(){
var suma = 0;
var los_cboxes = document.getElementsByClassName('gfg form-check-input');
j = los_cboxes.length;

for (var i = 0; i < j; i++) {
    
    if(los_cboxes[i].checked == true){
    suma++;
    }
}
 
if(suma == 0){
alert('Debe seleccionar por lo menos una formacion');
return false;
}else{
return true;
}
 
}

</script>




  <div class="modal fade" id="staticBackdropentregacurso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Paquetes por entregar a los centros de formacion</h5>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

       <form action="operaciones.php" method="POST" enctype="multipart/form-data" name = "form" onsubmit ="return verificar();">

       <div class="form-group">
    <label for="Mes_Poa">Mes entrega del acta</label>
    <select name="Mes_Poa" id="Mes_Poa" class="form-select" required>
    <option selected value=""></option>
    <option select value="Enero">Enero</option>
    <option select value="Febrero">Febrero</option>
    <option select value="Marzo">Marzo</option>
    <option select value="Abril">Abril</option>
    <option select value="Mayo">Mayo</option>
    <option select value="Junio">Junio</option>
    <option select value="Agosto">Agosto</option>
    <option select value="Septiembre">Septiembre</option>
    <option select value="Octubre">Octubre</option>
    <option select value="Noviembre">Noviembre</option>
    <option select value="Diciembre">Diciembre</option>
    </select> 
    </div>

    <div class="form-group">
    <label for="Vigencia">Vigencia entrega del acta</label>
    <input type="number" required class="form-control" id="Vigencia" name="Vigencia" aria-describedby="emailHelp" placeholder="">
    <small id="emailHelp" class="form-text text-muted"></small>
    </div>

    <div class="form-group row">
    <div class="col-sm-3">Formaciones cerradas por entregar</div>
    <div class="col-sm-9">
    <?php

$consulta='SELECT * FROM gestion_cursos, poa WHERE poa.id_poa='.$_SESSION['id_poa'].' AND poa.id_poa=gestion_cursos.id_nombre_poa AND Estado_Curso="Cerrado por alta demanda"';

$query = $mysqli->query($consulta);

$valores=0;

while ($row = $query->fetch_object()) {
  
  echo '   
  
<div class="form-check">
  <input class="gfg form-check-input" type="checkbox" id="check'.$valores.'" name="check'.$valores.'" value="'.$row->id_Gestion_Cursos.'">
  <label class="form-check-label" for="gridCheck1">
  '.$row->Nombre_Curso." DEL MES DE ".$row->Mes_Poa." PARA EL ".$row->Centro_Formacion.'
  </label>
</div>';
$valores=$valores+1;
 }

 if ($valores==0){

  echo ' No existen formaciones pendientes por entregar al centro';
 }

?>
      

    </div>
  </div>

  <input style="display:none;" type="text" class="form-control" id="valores" name="valores" placeholder="" value="<?php echo $valores-1;?>">
  <input style="display:none;" type="text" class="form-control" id="operacion" name="operacion" placeholder="" value="17">



                <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione Acta de entrega al centro</label>
                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
                <input required class="form-control" type="file" id="fileconcertacion" name="fileconcertacion" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf">
                </div>
                




   
    
       </div>

       <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
       <?php if (($valores-1)>-1){echo '<button type="submit" class="btn btn-primary">Registrar</button>';}?>
      </div>

      </form>

      </div>
    </div>
  </div>












</div>


<?php include "footer.php" ?>

<script type="text/javascript">

function ocultar(){$("#ocultar").toggle();}
$("#ocultar").toggle();

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

function required(){

  estado=document.getElementById("Estado").value;
  if (estado=="Concertado_por_validar"){

    $('#Direccion').prop("required", true)
    }
  if (estado=="registrado"){
    $('#Direccion').removeAttr("required");
  }



}


    $(function () {
                // ON SELECTING ROW
                $(".gfgselect").click(function () {
   //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
                    a="";
                    b="";
                    c="";
                    d="";
                    e="";
                    f="";
                    g="";
                    h="";

                    b = $(this).parents("tr").find(".gfgCentro_Formacion").text();
                    c = $(this).parents("tr").find(".gfgNivel_Formacion").text();
                    d = $(this).parents("tr").find(".gfgNombre_Curso").text();
                    e = $(this).parents("tr").find(".gfgcategoria").text();
                    f = $(this).parents("tr").find(".gfgMes_Poa").text();
                    g = $(this).parents("tr").find(".gfgEstado_Curso").text();
                    h = $(this).parents("tr").find(".gfgdireccion").text();
                    cupo = $(this).parents("tr").find(".gfgcupo").text();
                    a = $(this).parents("tr").find(".gfgid").text();
                     

                    var p="";
                    
   if(g=="Concertado por validar" || g=="Concertado acta"){

    p+=' <form>'+
                    '<div class="form-group">'+
                      '<label for="gfgnombres">Mensaje</label>'+
                      '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede modificar un curso que ha sido CONCERTADO con el enlace</textarea>'+
                    '</div>';
                    p+='<div class="modal-footer">'+

       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
       
      '</div></form>'




  } else if (g=="Activo"){


    p+=' <form>'+
                    '<div class="form-group">'+
                      '<label for="gfgnombres">Mensaje</label>'+
                      '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede modificar un curso que se encuentra activo, el mismo esta habilitado para inscripciones</textarea>'+
                    '</div>';
                    p+='<div class="modal-footer">'+

       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
       
      '</div></form>'




  }else if (g=="Cerrado por baja demanda"){


p+=' <form>'+
                '<div class="form-group">'+
                  '<label for="gfgnombres">Mensaje</label>'+
                  '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede modificar un curso que se encuentra cerrado por baja demanda</textarea>'+
                '</div>';
                p+='<div class="modal-footer">'+

   '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
   
  '</div></form>'




}else if (g=="Cerrado por alta demanda"){


p+=' <form>'+
                '<div class="form-group">'+
                  '<label for="gfgnombres">Mensaje</label>'+
                  '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede modificar un curso que se encuentra cerrado por alta demanda</textarea>'+
                '</div>';
                p+='<div class="modal-footer">'+

   '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
   
  '</div></form>'




}else{
   
   
  p+=' <div class="container center-fluid">'+
    
    '<form action="operaciones.php" method="POST">'+
     ' <div class="form-group">'+
      '<br>'+
        '<label for="exampleInputEmail1">Centro de Fromacion</label>'+
        '<select name="Centro_Formacion" id="Centro_Formacion" class="form-select" required>'+
        '<option selected value="'+b+'">'+b+'</option>'+
        '<option select value="CENTRO DE COMERCIO Y SERVICIOS">CENTRO DE COMERCIO Y SERVICIOS</option>'+
        '<option select value="CENTRO INDUSTRIAL Y DE AVIACION">CENTRO INDUSTRIAL Y DE AVIACION</option>'+
        '<option select value="CENTRO NACIONAL COLOMBO ALEMAN">CENTRO NACIONAL COLOMBO ALEMAN</option>'+
        '<option select value="CEDAGRO">CEDAGRO</option>'+
        '</select>'+
        '</div>'+
    
        '<div class="form-group">'+
        '<label for="exampleInputPassword1">Nivel de Formacion</label>'+
        '<select name="Nivel_Formacion" id="Nivel_Formacion" class="form-select" required>'+
        '<option selected value="'+c+'">'+c+'</option>'+
        '<option select value="Formacion Complementaria">Formacion Complementaria</option>'+
        '<option select value="Formacion Titulada">Formacion Titulada</option>'+
        '<option select value="Certificacion por competencias Laborales">Certificacion por competencias Laborales</option>'+
        '<option select value="Evento divulgacion Tecnologica">Evento divulgacion Tecnologica</option>'+
        '</select>'+
        '</div>'+
    
      '<div class="form-group">'+
        '<label for="exampleInputPassword1">Nombre programa de Formacion</label>'+
        '<input type="text" class="form-control" id="Nombre_Curso" name="Nombre_Curso" placeholder="Nombre del programa de formacion" value="'+d+'" required>'+
      '</div>'+
    
      '<div class="form-group">'+
        '<label for="exampleInputPassword1">Categoria</label>'+
        '<select type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria" required>'+
        '<option selected value="'+e+'">'+e+'</option>'+
        '<option select value="Tecnología">Tecnología</option>'+
        '<option select value="Salud Ocupacional">Salud Ocupacional</option>'+
        '<option select value="Emprendimiento">Emprendimiento</option>'+
        '<option select value="Confección">Confección</option>'+
        '<option select value="Cocina">Cocina</option>'+
        '<option select value="Gestión">Gestión</option>'+
        '<option select value="Artesanías">Artesanías</option>'+
        '<option select value="Ética">Ética</option>'+
        '<option select value="Pedagogía">Pedagogía</option>'+
        '<option select value="Construcción">Construcción</option>'+
        '<option select value="Belleza">Belleza</option>'+
        '<option select value="Agricultura">Agricultura</option>'+
        '<option select value="LGBTIQ">LGBTIQ</option>'+
        '<option select value="Discapacidad">Discapacidad</option>'+
        '<option select value="Logistica">Logistica</option>'+
        '<option select value="Etnias">Etnias</option>'+
        '<option select value="Ingles">Ingles</option>'+
        '<option select value="Electricidad">Electricidad</option>'+
    
        '</select>'+
    
    
      '</div>'+
    
      '<div class="form-group">'+
        '<label for="exampleInputPassword1">Mes de ejecucion</label>'+
        '<select name="Mes_Poa" id="Mes_Poa" class="form-select" required>'+
        '<option selected value="'+f+'">'+f+'</option>'+
        '<option select value="Enero">Enero</option>'+
        '<option select value="Marzo">Marzo</option>'+
        '<option select value="Abril">Abril</option>'+
        '<option select value="Mayo">Mayo</option>'+
        '<option select value="Junio">Junio</option>'+
        '<option select value="Agosto">Agosto</option>'+
        '<option select value="Septiembre">Septiembre</option>'+
        '<option select value="Octubre">Octubre</option>'+
        '<option select value="Noviembre">Noviembre</option>'+
        '<option select value="Diciembre">Diciembre</option>'+
        '</select>'+
        '</div>'+

        '<div class="form-group">'+
        '<label for="cupo">Cupo</label>'+
        '<input required type="number" required class="form-control" id="cupo" name="cupo" placeholder="cupo de la formacion para cerrar el programa" value="'+cupo+'">'+
        '</div>'+

        '<div class="form-group">'+
        '<label for="Direccion">Direccion</label>'+
        '<input type="text" required class="form-control" id="Direccion" name="Direccion" placeholder="Direccion" value="'+h+'">'+
      '</div>'+

        '<div class="form-group">'+
        '<label for="Estado">Estado</label>'+
        '<select name="Estado" id="Estado" class="form-select">'+
        '<option selected value="'+g+'">'+g+'</option>'+
        '<option select value="Concertado por validar">Concertado por validar</option>'+
        '</select>'+

  
  '<input style="display:none;" type="text" class="form-control" id="operacion" name="operacion" placeholder="" value="10">'+
  '<input style="display:none;" type="text" class="form-control" id="poa_id" name="poa_id" placeholder="" value="'+a+'">'

  p+='<div class="modal-footer">'+
       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
       '<button onclick="required()" type="submit" class="btn btn-primary">Actualizar</button>'+
      '</div></form>'
  ;}
  

      
                    $("#divGFG").empty();
                    //WRITING THE DATA ON MODEL
                    $("#divGFG").append(p);

                  
                    

                   
                  });
            });





            $(function () {
                // ON SELECTING ROW
                $(".gfgdelete").click(function () {
   //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
                    a="";
                    b="";
                    c="";
                    d="";
                    e="";
                    f="";
                    g="";
                    h="";

                    b = $(this).parents("tr").find(".gfgCentro_Formacion").text();
                    c = $(this).parents("tr").find(".gfgNivel_Formacion").text();
                    d = $(this).parents("tr").find(".gfgNombre_Curso").text();
                    e = $(this).parents("tr").find(".gfgcategoria").text();
                    f = $(this).parents("tr").find(".gfgMes_Poa").text();
                    g = $(this).parents("tr").find(".gfgEstado_Curso").text();
                    h = $(this).parents("tr").find(".gfgdireccion").text();
                    a = $(this).parents("tr").find(".gfgid").text();
                     

                    var p="";
                    
   if(g=="Concertado por validar" || g=="Concertado acta"){

    p+=' <form>'+
                    '<div class="form-group">'+
                      '<label for="gfgnombres">Mensaje</label>'+
                      '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede ELIMINAR un curso que ha sido CONCERTADO con el enlace</textarea>'+
                    '</div>';
                    p+='<div class="modal-footer">'+

       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
       
      '</div></form>'




  }else if (g=="Activo"){


p+=' <form>'+
                '<div class="form-group">'+
                  '<label for="gfgnombres">Mensaje</label>'+
                  '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede eliminar un curso que se encuentra activo, el mismo esta habilitado para inscripciones</textarea>'+
                '</div>';
                p+='<div class="modal-footer">'+

   '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
   
  '</div></form>'




}else if (g=="Cerrado por baja demanda"){


p+=' <form>'+
                '<div class="form-group">'+
                  '<label for="gfgnombres">Mensaje</label>'+
                  '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede ELIMINAR un curso que se encuentra cerrado por baja demanda</textarea>'+
                '</div>';
                p+='<div class="modal-footer">'+

   '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
   
  '</div></form>'




}else if (g=="Cerrado por baja demanda"){


p+=' <form>'+
                '<div class="form-group">'+
                  '<label for="gfgnombres">Mensaje</label>'+
                  '<textarea  type="text area" readonly required class="form-control" id="gfgmensaje" name="gfgmensaje">No se puede ELIMINAR un curso que se encuentra cerrado por alta demanda</textarea>'+
                '</div>';
                p+='<div class="modal-footer">'+

   '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
   
  '</div></form>'




} else{
   
   
  p+=' <div class="container center-fluid">'+
    
    '<form action="operaciones.php" method="POST">'+
     ' <div class="form-group">'+
      '<br>'+
        '<label for="exampleInputEmail1">Centro de Fromacion</label>'+
        '<select readonly name="Centro_Formacion" id="Centro_Formacion" class="form-control" required>'+
        '<option selected value="'+b+'">'+b+'</option>'+
        '</select>'+
        '</div>'+
    
        '<div class="form-group">'+
        '<label for="exampleInputPassword1">Nivel de Formacion</label>'+
        '<select readonly name="Nivel_Formacion" id="Nivel_Formacion" class="form-control" required>'+
        '<option selected value="'+c+'">'+c+'</option>'+
        '</select>'+
        '</div>'+
    
      '<div class="form-group">'+
        '<label for="exampleInputPassword1">Nombre programa de Formacion</label>'+
        '<input readonly type="text" class="form-control" id="Nombre_Curso" name="Nombre_Curso" placeholder="Nombre del programa de formacion" value="'+d+'" required>'+
      '</div>'+
    
      '<div class="form-group">'+
        '<label for="exampleInputPassword1">Categoria</label>'+
        '<select readonly type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria" required>'+
        '<option selected value="'+e+'">'+e+'</option>'+
        '</select>'+
    
    
      '</div>'+
    
      '<div class="form-group">'+
        '<label for="exampleInputPassword1">Mes de ejecucion</label>'+
        '<select readonly name="Mes_Poa" id="Mes_Poa" class="form-control" required>'+
        '<option selected value="'+f+'">'+f+'</option>'+
        '</select>'+
        '</div>'+

        '<div class="form-group">'+
        '<label for="Direccion">Direccion</label>'+
        '<input readonly type="text" required class="form-control" id="Direccion" name="Direccion" placeholder="Direccion" value="'+h+'">'+
      '</div>'+

        '<div class="form-group">'+
        '<label for="Estado">Estado</label>'+
        '<select readonly name="Estado" id="Estado" class="form-control">'+
        '<option selected value="'+g+'">'+g+'</option>'+
        '</select>'+

  
  '<input style="display:none;" type="text" class="form-control" id="operacion" name="operacion" placeholder="" value="11">'+
  '<input style="display:none;" type="text" class="form-control" id="poa_id" name="poa_id" placeholder="" value="'+a+'">'

  p+='<div class="modal-footer">'+
       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
       '<button type="submit" class="btn btn-danger">Eliminar</button>'+
      '</div></form>'
  ;}
  

      
                    $("#delete").empty();
                    //WRITING THE DATA ON MODEL
                    $("#delete").append(p);

                  
                    

                   
                  });
            });






















</script>