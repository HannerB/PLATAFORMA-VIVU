<?php include "conexion1.php";?>

<?php include "header.php" ?>


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


<form class="row g-3" action="planeacion.php" method="GET">
  
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






<br><br>

<table id="tabla" class="table table-striped">
      <thead>
        <tr>
          <th style="width:80px">Municipio Curso</th>
          <th style="width:80px">Orientador</th>
          <th style="width:80px">Poa</th>
          <th style="width:50px">Nivel Formacion</th>
          <th style="width:150px">Nombre Curso</th>
          <th style="width:80px">Categoria</th>
          <th style="width:80px">Mes</th>
          <th style="width:50px">Estado</th>
          <th style="width:30px">Direccion</th>
          <th style="width:30px">inscritos</th>
          <th style="width:300px">Gestion</th>

        </tr>
        <tr>
          <td colspan="10">
            <input id="buscar" type="text" class="form-control" placeholder="filtrar" />
          </td>
        </tr>
      </thead>
      <tbody>
      <?php

if (isset($_GET['filtro'])){
  $municipio=$_GET['filtro'];
}else{$municipio="";}


$consulta='SELECT * FROM gestion_cursos, poa, asignar_municipios, users WHERE poa.id_poa=gestion_cursos.id_nombre_poa AND asignar_municipios.id=poa.id_asignar_municipios AND users.id=asignar_municipios.id_responsable AND gestion_cursos.Municipio_Curso LIKE "%'.$municipio.'%" ORDER BY gestion_cursos.id_Gestion_Cursos DESC';

$query = $mysqli->query($consulta);

//obtener municipio

//var_dump($query);

while ($row = $query->fetch_object()) {

  $consulta2="SELECT COUNT(*) AS inscritos FROM gestion_cursos, cursos_detalle WHERE cursos_detalle.id_gestion_cursos=gestion_cursos.id_Gestion_Cursos AND gestion_cursos.id_Gestion_Cursos=".$row->id_Gestion_Cursos;

  $query2 = $mysqli->query($consulta2);

    echo '<tr> 

    <td class="gfgMunicipio_Curso">'.$row->Municipio_Curso.'</td> 
    <td class="gfgCentro_Formacion">'.$row->nombres." ".$row->apellidos.'</td>
    <td class="gfgCentro_Formacion">'.$row->Nombre_Poa.'</td>
    <td class="gfgNivel_Formacion">'.$row->Nivel_Formacion.'</td>
    <td class="gfgNombre_Curso">'.$row->Nombre_Curso.'</td> 
    <td class="gfgcategoria">'.$row->categoria.'</td> 
    <td class="gfgMes_Poa">'.$row->Mes_Poa." ".$row->periodo.'</td> 
    <td class="gfgEstado_Curso">'.$row->Estado_Curso.'</td> 
    <td class="gfgdireccion">'.$row->Direccion.'</td>';
    while ($row2 = $query2->fetch_object()) {
      echo '<td class="gfginscritos">'.$row2->inscritos.'</td>'; 
    }

    echo '
    <td class="gfgid" style="display:none" >'.$row->id_Gestion_Cursos.'</td> 
    <td> ';
    
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



    

</script>