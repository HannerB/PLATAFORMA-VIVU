<?php  include "conexion1.php";?>

<?php include "header.php" ?>

<?php 

if(isset($_POST["cedula"])){

$cedula=$_POST["cedula"];


$sql="SELECT * FROM users where users.documento=".$cedula;
$consulta=0;

$resultado1 = $mysqli->query($sql);

while ($row = $resultado1->fetch_object()) {
    $id=$row->id;
    $nombres=$row->nombres;
    $apellidos=$row->apellidos;
    $sexo=$row->sexo;
    $tipodocumento=$row->tipodocumento;
    $documento=$row->documento;
    $fechaNacimiento=$row->fechaNacimiento;
    $telefono=$row->telefono;
    $tipoPoblacion=$row->tipoPoblacion;
    $email=$row->email;
    $password=$row->password;
    $rol=$row->rol;
    $municipio=$row->municipio;
    $consulta=1;

     }


    
}



?>





                <div class="container">

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

                    <form action="usuarios.php" method="POST">
                    <LAbel>Introduzca nro de documento</LAbel>
                <div class="form-group col-2">
                    <input type="number" class="form-control" required type="text" name="cedula" id="cedula" />
                    
                </div>
                <div class="form-group col-6">
                <button type="submit" id="buscar" name="buscar" class="btn btn-primary">Buscar</button>
                <?php if (!isset($documento)){ if (isset($resultado1)) echo "No se encontraron registros";}?>
                </div>
                </div>

               

                

                </form>



                

                <div class="container">
                    <div class="row">

      
       
          <form class="simple_form" id="" action="./operaciones.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="control-label" for="user_nombre">Nombres</label>
                    <input class="form-control" required type="text" value="<?php if (isset($nombres)){echo $nombres;} ?>" name="txtNombres" id="txtNombres" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputApellidos">Apellidos</label>
                    <input class="form-control" required type="text" value="<?php if (isset($apellidos)){echo $apellidos;} ?>" name="txtApellidos" id="txtApellidos"/>
                </div>
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputSexo">Sexo</label>
                    <select class="form-control form-control-sm" required aria-required="true" type="text" name="txtSexo" id="txtSexo" >
                        <option value="<?php if (isset($sexo)){echo $sexo;} ?>" selected ><?php if (isset($sexo)){echo $sexo;} ?></option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputFechaNacimiento">Fecha de nacimiento</label>
                    <input class="form-control" required type="date" value="<?php if (isset($fechaNacimiento)){echo $fechaNacimiento;} ?>" name="txtFechaNacimiento" id="txtFechaNacimiento"/>
                </div>
            </div>  
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputDireccion">Dirección de correo electrónico</label>
                    <input class="form-control" required type="email" value="<?php if (isset($email)){echo $email;} ?>" name="txtCorreo" id="txtCorreo" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputContrasena">Contraseña actual</label>
                    <input class="form-control" required  aria-required="true" type="text" value="<?php if (isset($password)){echo $password;} ?>" name="txtPassword" id="txtPassword" />
                </div>
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTipoDocumento">Tipo documento</label>
                    <select required class="form-control form-control-sm" name="txtTipoDocumento" id="txtTipoDocumento">
                        <option value="<?php if (isset($tipodocumento)){echo $tipodocumento;} ?>" selected ><?php if (isset($tipodocumento)){echo $tipodocumento;} ?></option>
                        <option value="Cedula de Ciudadanía">Cedula de Ciudadanía</option>
                        <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                        <option value="Pep">Pep</option>
                        <option value="Ppt">Ppt</option>
                    </select>              
                </div>
                <div class="form-group col-md-6">
                    <label for="inputDocumento">Documento</label>
                    <input readonly class="form-control" min="1" required="required" value="<?php if (isset($documento)){echo $documento;} ?>" type="number" step="1" name="txtDocumento" id="txtDocumento" />
                </div>
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTelefono">Telefono</label>
                    <input class="form-control" required="required" value="<?php if (isset($telefono)){echo $telefono;} ?>" type="number" name="txtTelefono" id="txtTelefono" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputMunicipio">Municipio</label>
                    <input class="form-control" required type="text" value="<?php if (isset($municipio)){echo $municipio;} ?>" name="txtMunicipio" id="txtMunicipio" />
                </div>

                <div hidden class="form-group col-md-6">
                    <label for="operacion"></label>
                    <input class="form-control" value="18" type="text" name="operacion" id="operacion" />
                    <input class="form-control" value="<?php if (isset($id)){echo $id;} ?>" type="text" name="id" id="id" />

                </div>

            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="control-label" for="user_tipo_de_poblacion_id">Tipo de poblacion</label>
                    <select class="form-control select" name="txtTipoPoblacion" id="txtTipoPoblacion" required>
                        <option value="<?php if (isset($tipoPoblacion)){echo $tipoPoblacion;} ?>" selected ><?php if (isset($tipoPoblacion)){echo $tipoPoblacion;} ?></option>
                        <option value="Desplazados por la violencia">Desplazados por la violencia</option>
                        <option value="Víctimas del conflicto armado">Víctimas del conflicto armado</option>
                        <option value="Discapacitados">Discapacitados</option>
                        <option value="Indígenas">Indígenas</option>
                        <option value="Convenio INPEC">Convenio INPEC</option>
                        <option value="Jóvenes vulnerables">Jóvenes vulnerables</option>
                        <option value="Adolescentes en conflicto con la ley penal">Adolescentes en conflicto con la ley penal</option>
                        <option value="Mujeres cabeza de hogar">Mujeres cabeza de hogar</option>
                        <option value="Negritudes">Negritudes</option>
                        <option value="Afrocolombianos">Afrocolombianos </option>
                        <option value="Palenques">Palenques</option>
                        <option value="Raizales">Raizales</option>
                        <option value="ROM">ROM</option>
                        <option value="Desplazados por fenómenos naturales y desplazados por fenómenos naturales cabeza de hogar">Desplazados por fenómenos naturales y desplazados por fenómenos naturales cabeza de hogar</option>
                        <option value="Proceso de reintegración y adolescentes desvinculados de Grupo armados organizados al margen de la ley">Proceso de reintegración y adolescentes desvinculados de Grupo armados organizados al margen de la ley</option>
                        <option value="Tercera edad">Tercera edad</option>
                        <option value="Adolescente trabajador">Adolescente trabajador</option>
                        <option value="Remitidos por el PAL">Remitidos por el PAL</option>
                        <option value="Soldados campesinos">Soldados campesinos</option>
                        <option value="Sobrevivientes minas antipersonas">Sobrevivientes minas antipersonas</option>
                        <option value="Comunidad LGBTI">Comunidad LGBTI</option>
                    </select>              
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label" for="rol">Nivel Acceso</label>
                    <select class="form-control select" name="rol" id="rol" required>
                        <option value="<?php if (isset($rol)){echo $rol;} ?>" selected > <?php 
                if (isset($rol)){
                    if ($rol==1) echo "Administrador";
                    if ($rol==2) echo "Aprendiz";
                    if ($rol==3) echo "Orientador";
                    if ($rol==4) echo "Gestor";
                    if ($rol==5) echo "Certificacion";
                
                } 
                
                ?>
</option>
                        <option value="1">Administrador</option>
                        <option value="2">Aprendiz</option>
                        <option value="3">Orientador</option>
                        <option value="4">Gestor</option>
                        <option value="5">Certificación</option>
                    </select>              
                </div>


               



            </div>

            <div class="form-row mt-2">
              <div class="form-group col-md-12">
                  <button type="submit" id="" class="btn btn-primary btn-block">Actualizar</button>
                   
              </div>
            </div>
          </form>
          
          </div>
          </div>
          
          
          






<?php include "footer.php"?>