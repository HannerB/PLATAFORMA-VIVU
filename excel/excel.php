<?php
require_once('conexion.php');

header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename=Reporte de egresados '.$date=date('y-m-d').'.xls');
header('Pragma: no-cache');
header('Expires: 0');
$conn=new Conexion();
$link = $conn->conectarse();

$query="SELECT Nombres,Apellido, Sexo, Reconocido, TipoDocumento,NumeroDocumento , CentroFormacion,NivelFormacion,modalidad, ProgramaFormacion, Certificado, Trabajando, Sueldo, Funciones, Empresa, Complementar, FechaUltimo, Tiempo, Graduarte, Sugerencia FROM `registro_egresados`";
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
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("Tipo de Población"); ?></th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("Centro De Formación"); ?></th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("Nivel De Formación"); ?></th>
    <th class="text-center" style="text-transform: uppercase;">Modalidad</th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("Programa De Formación"); ?></th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("¿Estás certificado?"); ?></th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("¿Estás trabajando?"); ?></th>
    <th class="text-center" style="text-transform: uppercase;">Rango salarial</th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("En su trabajo aplica los conocimiento que adquirió en el SENA"); ?></th>
    <th class="text-center" style="text-transform: uppercase;">Escriba el nombre de la empresa donde trabaja actualmente</th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("Si estás desempleado, que programa de formación complementaria necesitas para mejorar tú perfil"); ?></th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("En que fecha inició su ultimo empleo"); ?></th>
    <th class="text-center" style="text-transform: uppercase;">Cuanto tiempo demoraste en certificarte (meses)</th>
    <th class="text-center" style="text-transform: uppercase;"><?php echo utf8_decode("Despues de graduarte, cuanto tiempo demoraste en encontrar tú primer empleo (meses)"); ?></th>
    <th class="text-center" style="text-transform: uppercase;">Sugerencia</th>
  </tr>
  <?php  
   while($row=mysqli_fetch_assoc($result))
  {
  ?>
    <tr style="color: #2F2E2E;">
      <td><?php echo utf8_decode(strtoupper($row['Nombres']));?></td>
      <td><?php echo utf8_decode(strtoupper($row['Apellido']));?></td>
      <td><?php echo utf8_decode($row['Sexo']);?></td>
      <td><?php echo utf8_decode($row['TipoDocumento']);?></td>
      <td><?php echo utf8_decode($row['NumeroDocumento']);?></td>
      <td><?php echo utf8_decode($row['Reconocido']);?></td>
      <td><?php echo utf8_decode($row['CentroFormacion']);?></td>
      <td><?php echo utf8_decode($row['NivelFormacion']);?></td>
      <td><?php echo utf8_decode($row['modalidad']);?></td>
      <td><?php echo utf8_decode($row['ProgramaFormacion']);?></td>
      <td><?php echo utf8_decode($row['Certificado']);?></td>
      <td><?php echo utf8_decode($row['Trabajando']);?></td>
      <td><?php echo utf8_decode($row['Sueldo']);?></td>
      <td><?php echo utf8_decode($row['Funciones']);?></td>
      <td><?php echo utf8_decode($row['Empresa']);?></td>
      <td><?php echo utf8_decode($row['Complementar']);?></td>
      <td><?php echo utf8_decode($row['FechaUltimo']);?></td>
      <td><?php echo utf8_decode($row['Tiempo']);?></td>
      <td><?php echo utf8_decode($row['Graduarte']);?></td>
      <td><?php echo utf8_decode($row['Sugerencia']);?></td>
    
    </tr>
  <?php 
  } //cerrar el while
  ?>
</table>