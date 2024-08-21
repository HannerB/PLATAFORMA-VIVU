<?php

require_once "cursos/clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

$tildes = $conexion->query("SET NAMES 'utf8'");

$res=mysqli_query($conexion,"SELECT U.rol AS rol, U.id 
FROM users U");


$v = [];

foreach ($res as $d) {
    $id = $d['id'];

    
    echo "Usuario Id => ".$d['id']." - Rol => ".$d['rol']."<br>";

    if ($d['rol'] == "Administrador") {
        $rol = 1;
        $res=mysqli_query($conexion,"UPDATE users SET rol ='$rol' WHERE id = $id");

    }else if ($d['rol'] == "Aprendiz") {
        $rol = 2;
        $res=mysqli_query($conexion,"UPDATE users SET rol ='$rol' WHERE id = $id");

    }else if ($d['rol'] == "Certificacion") {
        $rol = 5;
        $res=mysqli_query($conexion,"UPDATE users SET rol ='$rol' WHERE id = $id");

    }else if ($d['rol'] == "Gestor") {
        $rol = 4;
        $res=mysqli_query($conexion,"UPDATE users SET rol ='$rol' WHERE id = $id");

    }else if ($d['rol'] == "ORIENTADOR") {
        $rol = 3;
        $res=mysqli_query($conexion,"UPDATE users SET rol ='$rol' WHERE id = $id");

    }


    
}
