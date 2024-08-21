<?php include "conexion1.php";?>

<?php include "header.php" ?>

<div class="container content-center">


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

  <form class="row g-3" action="cursosReg.php" method="GET">
  
  <div class="input-group">

    <div class="col-auto">
    <label for="filtrar">Filtrar por municipio </label>
    </div>
  <div class="col-4">
  <select class="form-select col-auto" id="filtro" name="filtro" aria-label="Example select with button addon" required>
                                    <option value="" selected >Seleccione</option>
                                    <option value="" >Atlantico - todos los cursos</option>
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

  <div>
  <button class="btn btn-outline-secondary" type="submit">Buscar</button>
  

  </div>
</div>

</form>

<?php

$municipiofiltro="";
$poa="";

if(isset($_GET['filtro'])){
$municipiofiltro=$_GET['filtro'];

}

if(isset($_GET['poa'])){
  $poa=$_GET['poa'];
  }



?>

<br>
  <button id="ocultar" onclick="ocultar()" class="ocultar btn btn-primary btn-xs" name="ocultar" >Ocultar / Mostar Detalle</button>

<br><br>
<table id="tabla" class="table table-striped">
      <thead>
        <tr>
          <th style="width:80px">Municipio</th>
          <th class="columna1" style="width:80px">Nivel Formacion</th>
          <th style="width:80px">Programa</th>
          <th style="width:80px">Direccion</th>
          <th class="columna1" style="width:80px">Categoria</th>
          <th class="columna1" style="width:80px">Mes de ejecucion</th>
          <th class="columna1" style="width:80px">Alianza</th>
          <th style="width:50px">Gestion</th>

        </tr>
        <tr>
          <td colspan="8">
            <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
          </td>
        </tr>
      </thead>
      <tbody>
      <?php


$consulta='SELECT * FROM gestion_cursos, poa WHERE gestion_cursos.Estado_Curso="activo" AND gestion_cursos.id_nombre_poa=poa.id_poa AND  gestion_cursos.Municipio_Curso LIKE "%'.$municipiofiltro.'%" AND poa.id_poa LIKE "%'.$poa.'%"';

$query = $mysqli->query($consulta);

//obtener municipio

//var_dump($query);

while ($row = $query->fetch_object()) {
  
    echo '<tr> 

    <td class="gfgMunicipio_Curso">'.$row->Municipio_Curso.'</td>
    <td class="gfgNivel_Formacion">'.$row->Nivel_Formacion.'</td> 
    <td class="gfgNombre_Curso">'.$row->Nombre_Curso.'</td>     
    <td class="gfgDireccion">'.$row->Direccion.'</td>
    <td class="gfgcategoria">'.$row->categoria.'</td>  
    <td class="gfgMes_Poa">'.$row->Mes_Poa.'</td>      
    <td class="gfgNombre_Poa">'.$row->Nombre_Poa.'</td>     
    <td class="gfgid" style="display:none" >'.$row->id_Gestion_Cursos.'</td> 
    <td> 

    <button class="gfgInscripcion btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span ></span>Inscribirme</button>
    
    </td>
    
</tr>';
          
}


//var_dump($municipio);

 ?> 
 </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
       <div class="GFGclass" 
        id="divGFG">
        

      </div>
        
        <form class="row g-3">
  
          <div class="col-auto input-group">
            <label for="InputDocumento" class="visually-hidden">Ingrese su nro de documento</label>
            <input type="number" class="form-control" id="cedula"  name="cedula" placeholder="nro documento" required>
            <div class="col-auto col-4">
            <input type="number" class="form-control" id="anio"  name="anio" placeholder="año nac" required>
            <input type="number" hidden value="" class="form-control" id="curso"  name="curso" placeholder="" >
            </div>
            <button type="button" class="btn btn-primary mb-3" onclick="buscar($('#cedula','#anio','#curso').val());" >Verificar</button>
          </div>
          <div class="col-auto">
          </div>
        </form>

        <div id="resultado"></div>


      </div>
      
    </div>
  </div>
</div>


<p></p>

<?php include "footer.php" ?>

<script type="text/javascript">

function pais(){

        if (document.getElementById("#Pais")){
          pais= document.getElementById("#Pais").value;
          alert(pais);
           
            if (pais =="Colombia") {
                $("#Departamento").html("<OPTION value=9>boaco</OPTION><OPTION value=59>teustepe</OPTION>");
            }
            else if (pais =="Venezuela") {
                $("#Departamento").html("<OPTION value=01>jinotepe</OPTION><OPTION value=41>diriamba</OPTION>");
            };


        }
          
          }
    






var c="";



function cerrar() {
    document.querySelector("#cedula").value=""
    document.querySelector("#anio").value=""
    document.querySelector("#curso").value=""
    $("#resultado").empty();
    

  };

  


function buscar(cedula,anio, curso) {
  $("#resultado").empty();
  if (document.getElementById("cedula").value==""){
  alert("Por favor ingrese su nro de documento");
  return;
}
if (document.getElementById("anio").value==""){
  alert("Por favor ingrese su año de nacimiento");
  return;
}

        var cedula = document.getElementById("cedula").value;
        var anio = document.getElementById("anio").value;
        var curso = document.getElementById("curso").value;

     var parametros = {"cedula": cedula,"anio": anio, "curso":curso };
     
$.ajax({
    data:parametros,
    url:'buscar_inscritos.php',
    type: 'post',
    beforeSend: function () {
        $("#resultado").html("Procesando, espere por favor");
    },
    success: function (response) {   
        $("#resultado").html(response);
    }
});
}


var c="";

$(function () {
                // ON SELECTING ROW
                $(".gfgInscripcion").click(function () {
   //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
                    var a = $(this).parents("tr").find(".gfgNombre_Curso").text();
                        c = $(this).parents("tr").find(".gfgid").text();
                        $("#curso").val(c);
                    
                    var p = "";
                    // CREATING DATA TO SHOW ON MODEL
                    p += '<div class="modal-header">'+
        '<h5 class="modal-title" id="staticBackdropLabel">Realizar inscripcion formacion en '+a+'</h5>'+
        '<button type="button" id="cerrar" name="cerrar" onclick="cerrar()" class="cerrar btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
      '</div> <div class="container center-fluid">';


                   

                      
                    //CLEARING THE PREFILLED DATA
                    $("#divGFG").empty();
                    //$("#resultado").empty();
                    //$("#cedula").value("");
                    //document.querySelector("#cedula").empty();
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

    var opcionDocumento="";
    if (document.getElementById("documento")){opcionDocumento =document.getElementById("documento").value} 
      

    function seleccionDocumento() { 
     opcionDocumento = document.getElementById("documento").value;
    //alert (opcionDocumento);
    var subir_Documento="";


if (opcionDocumento==1){
  $('#filePDF').prop("required", true);
  $('#filePDF1').removeAttr("required");
  $('#filePDF2').removeAttr("required");
  $('#opcion2').css('display', 'none');
  $('#opcion1').css('display', 'block');
  document.getElementById('id_curso').value="";
  document.getElementById('id_curso').value=c;
  
  
}

if (opcionDocumento==2){
  $('#filePDF1').prop("required", true)
  $('#filePDF2').prop("required", true)
  $('#filePDF').removeAttr("required");
  $('#opcion1').css('display', 'none');
  $('#opcion2').css('display', 'block');
  document.getElementById('id_curso').value="";
  document.getElementById('id_curso').value=c;

}

if (opcionDocumento==3){
  $('#filePDF').removeAttr("required");
  $('#filePDF1').removeAttr("required");
  $('#filePDF2').removeAttr("required");
  $('#opcion1').css('display', 'none');
  $('#opcion2').css('display', 'none');
  document.getElementById('id_curso').value="";
  document.getElementById('id_curso').value=c;

  
}

  
  };



  function ocultar(){

$(".columna1").toggle();
$('td:nth-child(2)').toggle();
$('td:nth-child(5)').toggle();
$('td:nth-child(6)').toggle();
$('td:nth-child(7)').toggle();

};


document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });


    function validar(){ 

      txtPassword="";
      txtTelefono="";
      txtCorreo="";
      Poblacion="";
      modo=0;

      if (document.getElementById("txtNombres") ){txtNombres=document.getElementById("txtNombres").value;};
      if (document.getElementById("txtApellidos") ){txtApellidos=document.getElementById("txtApellidos").value;};
      if (document.getElementById("txtSexo")){txtSexo=document.getElementById("txtSexo").value;};
      if (document.getElementById("txtFechaNacimiento") ){txtFechaNacimiento=document.getElementById("txtFechaNacimiento").value;};
      if (document.getElementById("txtCorreo") ){txtCorreo=document.getElementById("txtCorreo").value;};
      if (document.getElementById("txtPassword") ){txtPassword=document.getElementById("txtPassword").value;};
      if (document.getElementById("txtTipoDocumento")){txtTipoDocumento=document.getElementById("txtTipoDocumento").value;};
      if (document.getElementById("txtTelefono")){txtTelefono=document.getElementById("txtTelefono").value;};
      if (document.getElementById("txtMunicipio") ){txtMunicipio=document.getElementById("txtMunicipio").value;};
      if (document.getElementById("txtTipoPoblacion")){txtTipoPoblacion=document.getElementById("txtTipoPoblacion").value;};
      if (document.getElementById("poblacion")){txtTipoPoblacion=document.getElementById("poblacion").value;};
      if (document.getElementById("tipoform")){modo=document.getElementById("tipoform").value;};


      


      
      if (modo==1){
      if(txtNombres==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtApellidos==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtSexo==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtFechaNacimiento==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtCorreo==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtPassword==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtTipoDocumento==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtTelefono==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtMunicipio==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      if(txtTipoPoblacion==""){alert("Faltan datos por registrar! por favor registre sus datos");return;}
      
      }



      if (txtTelefono==""){
        alert("Faltan datos por registrar! por favor registre sus datos");return
      } 

      if ( txtCorreo=="" ){
       alert("Faltan datos por registrar! por favor registre sus datos");return
      } 

      if ( txtTipoPoblacion==""){
       alert("Faltan datos por registrar! por favor registre sus datos");return
      } 
 

      validar1=document.getElementById('filePDF').value;
      validar2=document.getElementById('filePDF1').value;
      validar3=document.getElementById('filePDF2').value;


      validar1 = validar1.split('.'); 
      validar2 = validar2.split('.'); 
      validar3 = validar3.split('.');    
      control1=0;
      control2=0;
      control3=0;

      if (opcionDocumento==""){
      alert ("Por favor Seleccione una opcion para anexar documento");
      }

      if (opcionDocumento==1){

        if(validar1[validar1 .length-1] == 'pdf')  {

          control1=1;
          } else{alert('Por favor anexar un archivo en formato pdf')       
          return} 

      }

      if (opcionDocumento==2){
      
      if(validar2[validar2 .length-1] == 'jpg' || validar2[validar2 .length-1] == 'jpge' ){

        control2=1;
      }else{alert('Por favor anexar un archivo en formato imagen o foto');       
      return} 
      }

      if (opcionDocumento==2){
      if(validar3[validar3 .length-1] == 'jpg' || validar3[validar2 .length-1] == 'jpge'){
       control3=1;
      }else{alert('Por favor anexar un archivo en formato imagen o foto');       
      return} 
      }

      
      
      if (opcionDocumento==1 & control1==1){

      $('#form1').css('display', 'none');
      $('#form2').css('display', 'block');
      $("#atras").show(); 
      //$("#inscribir").show(); 
      $("#gfgcerrar").hide(); 
      $("#continuar").hide();
      $("#inscribir").show();  
    
      document.getElementById("inscritoSofia").value="";
      }

      if (opcionDocumento==2 & control2==1 & control3==1){

        $('#form1').css('display', 'none');
      $('#form2').css('display', 'block');
      $("#atras").show(); 
      //$("#inscribir").show(); 
      $("#gfgcerrar").hide(); 
      $("#continuar").hide();
      $("#inscribir").show();  
    
      document.getElementById("inscritoSofia").value="";
      }

      if (opcionDocumento==3){
        $('#form1').css('display', 'none');
      $('#form2').css('display', 'block');
      $("#atras").show(); 
      //$("#inscribir").show(); 
      $("#gfgcerrar").hide(); 
      $("#continuar").hide();
      $("#inscribir").show(); 
      
      document.getElementById("inscritoSofia").value="";
    
        
      }



      


      control1=0;
      control2=0;
      control3=0;
      opcionDocumento="";

      
      
                
      

      
      
    
    } 

    var formsofiaplis="";

      function sofiaPlus(){

      formsofiaplis = document.getElementById("inscritoSofia").value;


      if (formsofiaplis==""){
        alert("Por favor Seleccione una opcion");
      }

      if (formsofiaplis=="No"){
        $('#form4').css('display', 'block');
        $('#Pais').prop("required", true)
        $('#Departamento').prop("required", true)
        $('#Municipio').prop("required", true)
        $('#expedicion').prop("required", true)
        $('#Pais2').prop("required", true)
        $('#Departamento2').prop("required", true)
        $('#Municipio2').prop("required", true)
      }
      if (formsofiaplis=="Si"){
        $('#form4').css('display', 'none');
        //$('#Pais').prop("required", true)
        $('#Pais').removeAttr("required");
        $('#Departamento').removeAttr("required");
        $('#Municipio').removeAttr("required");
        $('#expedicion').removeAttr("required");
        $('#Pais2').removeAttr("required");
        $('#Departamento2').removeAttr("required");
        $('#Municipio2').removeAttr("required");



      }

      //formsofiaplis="";

      }

      function regresar(){
        $('#form1').css('display', 'block');
        $('#form2').css('display', 'none');
        $('#form4').css('display', 'none');
        $("#gfgcerrar").show();
        $("#continuar").show();
        $("#inscribir").hide();
        $("#atras").hide();
        document.getElementById("documento").value="";

      }



      









      
       

      
    
    

</script>
