<?php
require_once('conexion.php');

header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename=Reporte de egresados taller '.$date=date('y-m-d').'.xls');
header('Pragma: no-cache');
header('Expires: 0');
$conn=new Conexion();
$link = $conn->conectarse();

$query="SELECT  nombres, apellidos, sexo, tipoDocumento, numeroDocumento, nacionalidad, CiudadNacimiento, FechaNacimiento, Edad, Celular, Departamento, MunicipioResidencia, DireccionResidencia, Correo, FechaTaller, TipoDiscapacidad, TipoPoblacion, BuscadorEmpleo, NivelFormacion, Modalidad, ProgramaFormacion, CargoInteres FROM registro_taller";
$result=mysqli_query($link, $query);
?>
<h4 align="center"></h4>
<table border="1">
  <tr><td colspan="20" align="center" style="font-size: 23px;"><b>Reporte de egresados APE</b></td></tr>
  <tr style="background-color: #3B58B8; color: white;">
    <th class="text-center" style="text-transform: uppercase;">Nombres</th>
    <th class="text-center" style="text-transform: uppercase;">Apellidos</th>
    <th class="text-center" style="text-transform: uppercase;">Sexo</th>
    <th class="text-center" style="text-transform: uppercase;">Tipo Documento</th>
    <th class="text-center" style="text-transform: uppercase;">No. Documento</th>
    <th class="text-center" style="text-transform: uppercase;">Nacionalidad</th>
    <th class="text-center" style="text-transform: uppercase;">Ciudad de nacimiento</th>
    <th class="text-center" style="text-transform: uppercase;">Fecha de nacimiento</th>
    <th class="text-center" style="text-transform: uppercase;">Edad</th>
    <th class="text-center" style="text-transform: uppercase;">Celular</th>
    <th class="text-center" style="text-transform: uppercase;">Departamento Residencia</th>
    <th class="text-center" style="text-transform: uppercase;">Municipio Residencia</th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("Dirección");?> Residencia</th>
    <th class="text-center" style="text-transform: uppercase;">Correo</th>
    <th class="text-center" style="text-transform: uppercase;">Fecha de Taller</th>
    <th class="text-center" style="text-transform: uppercase;">Tipo discapacidad</th>
    <th class="text-center" style="text-transform: uppercase;">Tipo <?php echo utf8_decode("población"); ?></th>
    <th class="text-center" style="text-transform: uppercase;">Buscador de empleo</th>
    <th class="text-center" style="text-transform: uppercase;">Nivel de <?php echo utf8_decode("formación");?></th>
    <th class="text-center" style="text-transform: uppercase;">Modalidad</th>
    <th class="text-center" style="text-transform: uppercase;">Programa de <?php echo utf8_decode("formación"); ?></th>
    <th class="text-center" style="text-transform: uppercase;">Cargo interes</th>
  </tr>
  <?php  
   while($row=mysqli_fetch_assoc($result))
  {
  ?>
    <tr style="color: #2F2E2E;">
      <td><?php echo utf8_decode(strtoupper($row['nombres']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['apellidos']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['sexo']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['tipoDocumento']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['numeroDocumento']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['nacionalidad']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['CiudadNacimiento']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['FechaNacimiento']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['Edad']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['Celular']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['Departamento']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['MunicipioResidencia']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['DireccionResidencia']));?></td>
      <td><?php echo utf8_decode($row['Correo']);?></td>
      <td><?php echo utf8_decode(strtoupper($row['FechaTaller']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['TipoDiscapacidad']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['TipoPoblacion']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['BuscadorEmpleo']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['NivelFormacion']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['Modalidad']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['ProgramaFormacion']));?></td>
      <td><?php echo utf8_decode($row['CargoInteres']);?></td>
    
    </tr>
  <?php 
  } //cerrar el while
  ?>
</table>