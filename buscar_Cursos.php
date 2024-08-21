<?php 

include "conexion1.php";

$id="";
$id=$_POST["cedula"];

/* SELECT * FROM files_concertaciones, gestion_cursos, concertaciones
WHERE files_concertaciones.id_file_concertaciones=12
AND concertaciones.id_concertacion=files_concertaciones.id_file_concertaciones
AND gestion_cursos.id_Gestion_Cursos=concertaciones.id_gestion_cursos */

$vueltas=0;

$consulta="SELECT * FROM files_concertaciones, gestion_cursos, concertaciones WHERE concertaciones.id_concertacion=files_concertaciones.id_file_concertaciones AND gestion_cursos.id_Gestion_Cursos=concertaciones.id_gestion_cursos AND files_concertaciones.id_file_concertaciones=$id";

      $query = $mysqli->query($consulta);

      

        echo '<div class="container"> 
        <label for="curso">Se han concertado los siguientes programas de formacion para esta acta:</label>
        
        <div class="form-group row">
        <div class="col-sm-3">Cursos concertados</div>
        <div class="col-sm-9">
        
        
        ';
      
      while ($row = $query->fetch_object()) {

        Echo '
        <form action="operaciones.php" method="POST">

        

     <div class="form-check">
        <input class="form-check-input" required type="checkbox" id="check'.$vueltas.'" name="check'.$vueltas.'" value="'.$row->id_Gestion_Cursos.'">
        <label class="form-check-label" for="gridCheck1">
        '.$row->Nombre_Curso.'
        </label>
      </div>

      

        <div class="form-group">
            <input hidden type="text" class="form-control" id="vueltas"  name="vueltas" value="'.$vueltas.'" name placeholder="">
        </div>';

            $vueltas=$vueltas+1;
      }

      

      echo '

      

      <input hidden type="text" class="form-control col-auto" id="operacion" value="13" name="operacion" placeholder="">
      <input hidden type="text" class="form-control col-auto" id="id_acta" value="'.$id.'" name="id_acta" placeholder="">
      
      <br>
      
      <div class="input-group mb-3">
        <select type="text" class="form-select col-6" placeholder="" name="acta_estado" id="acta_estado" aria-label="" aria-describedby="basic-addon2" required>
        <option value="" selected></option>
        <option value="Acta valida">Acta valida</option>
        <option value="Acta NO valida">Acta NO valida</option>
        
      </select>

        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Registrar</button>
        </div>
        </div>

    
        </form>
        ';


      





?>  



