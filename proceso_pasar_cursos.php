<?php

require_once "cursos/clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();


$res=mysqli_query($conexion,"SELECT U.id AS idUsuario, IC.codigo_curso As idCurso, IC.estado As estado 
FROM users U 
INNER JOIN `inscritos-cursos` IC ON IC.documento = U.documento ORDER BY `U`.`documento` ASC");


$v = [];

foreach ($res as $d) {
    $documentoReal = $d['documento'];

    
    echo "Usuario Id => ".$d['idUsuario']." - idCurso => ".$d['idCurso']." - Estado => ".$d['estado']."<br>";

    if ($d['estado'] == "Inscrito") {
        $estado = 1;
    }else{
        $estado = 0;
    }

    $res=mysqli_query($conexion,"INSERT INTO y_inscritos_cursos (`id_curso`, `id_usuario`, `estado`) VALUES ({$d['idCurso']}, {$d['idUsuario']}, $estado)");

    
}
