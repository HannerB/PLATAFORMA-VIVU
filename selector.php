<?php

$html = "";


$pais=$_POST["cedula1"];

if ($_POST["cedula1"]=="Colombia") {
	$html = '
	<option value="1">4</option>
	<option value="2">5</option>
	<option value="3">7</option>
	<option value="4">21</option>
	
	';	
}

if ($_POST["cedula1"]=="Venezuela") {
	$html = '
	
	<option value="5">Scennic</option>
	<option value="6">Traffic</option>
	';	
}


$html='<option value="6">Traffic</option>';
echo $html;	

?>