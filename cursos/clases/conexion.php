<?php

// class conectar{
// 	public function conexion(){
// 		$conexion=mysqli_connect('localhost',
// 									'u249939424_vivuWeb',
// 									'1.VivuWeb-*',
// 									'u249939424_vivuWeb');
// 		return $conexion;
// 	}
// }

class conectar
{
	public function conexion()
	{
		$conexion = mysqli_connect('localhost', 'root', '', 'u249939424_vivuWeb', null, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');
		return $conexion;
	}
}


?>