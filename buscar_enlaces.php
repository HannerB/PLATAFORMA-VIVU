
<?php

    $id_cedula=$_POST["cedula"];


    

include "conexion1.php";




$consulta='SELECT * FROM users WHERE users.documento='.$id_cedula;

$query = $mysqli->query($consulta);

 if ($query->num_rows==1){


while ($row = $query->fetch_object()) {
  
    echo '
          <form enctype="multipart/form-data" action="realizar_inscripcion.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="control-label" for="user_nombre">Nombres</label>
                    <input class="form-control" required="required" type="text" name="txtNombres" id="txtNombres" value="'.$row->nombres.'" disabled />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputApellidos">Apellidos</label>
                    <input class="form-control" required="required" type="text" name="txtApellidos" id="txtApellidos" value="'.$row->apellidos.'" disabled/>
                </div>
            </div> 
            <input type="text" style="display: none;" value="'.$row->id.'" id="user_id" name="user_id">';  

           
}

}


if ($query->num_rows==0){
    echo '<p> No se encontraron registros </p> ';
}











?>