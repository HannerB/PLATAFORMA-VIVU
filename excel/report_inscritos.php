<?php

require_once "../cursos/clases/conexion.php";

header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename=Reporte de inscritos en el curso de '.$_GET['id'].'.xls');
header('Pragma: no-cache');
header('Expires: 0');

$codigo_curso=$_GET['codigo'];

$obj= new conectar();
$conexion=$obj->conexion();
$tildes = $conexion->query("SET NAMES 'utf8'");
$sql="SELECT U.nombres, U.apellidos, U.tipodocumento, U.documento, U.tipoPoblacion, U.email, U.telefono, U.fechaNacimiento, C.curso, C.nombre_grupo, YIC.fecha_reg As fechaRegistro 
FROM users U
INNER JOIN y_inscritos_cursos YIC ON YIC.id_usuario = U.id
INNER JOIN cursos C ON C.codigo_curso = YIC.id_curso
WHERE YIC.estado= 1 and YIC.id_curso=$codigo_curso";
$result=mysqli_query($conexion,$sql);

$sql_="SELECT C.curso, C.nombre_grupo
FROM users U
INNER JOIN y_inscritos_cursos YIC ON YIC.id_usuario = U.id
INNER JOIN cursos C ON C.codigo_curso = YIC.id_curso
WHERE YIC.id_curso=$codigo_curso LIMIT 1";
$result_=mysqli_fetch_array(mysqli_query($conexion,$sql_));

?>
<h4 align="center"></h4>
<table border="1">
  <tr><td colspan="9" align="center" style="font-size: 23px;"><b>Inscritos en el grupo de <?php echo $result_['nombre_grupo']; ?> <br>
    En el curso de <?php echo $result_['curso']; ?></b></td></tr>
    <tr >
      <th style="background-color: #3B58B8; color: white;" class="text-center">TIPO DOCUMENTO</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">DOCUMENTO</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">NOMBRES</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">APELLIDOS</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">TIPO DE POBLACIÓN</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">TELEFONO</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">FECHA DE NACIMIENTO</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">EMAIL</th>
      <th style="background-color: #3B58B8; color: white;" class="text-center">FECHA INSCRITO</th>
    </tr>
   <?php  
   while($row=mysqli_fetch_array($result))
   {
    ?>
      <tr style="color: #2F2E2E;">
        <td><?php echo $row['tipodocumento'];?></td>
        <td><?php echo $row['documento'];?></td>
        <td><?php $n=strtolower($row['nombres']); echo ucwords($n);?></td>
        <td><?php $a=strtolower($row['apellidos']); echo ucwords($a);?></td>
        <td><?php echo $row['tipoPoblacion'];?></td>
        <td><?php echo $row['telefono'];?></td>
        <td><?php echo $row['fechaNacimiento'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['fechaRegistro'];?></td>
      </tr>
   <?php 
  } //cerrar el while
  ?>
</table>