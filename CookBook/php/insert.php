<?php
require_once('config.php');
if(isset($_POST['abm'])){
	$abm = $_POST['abm'];
	$tabla = $abm;
	$idabm = 'id'.$abm;
	switch($abm){
		case 'Etiqueta':
		$valor = $_POST["$abm"];
		break;
		case 'Autor':
		$valor = $_POST["nombre"]."', '".$_POST["apellido"];
		$abm = "nombre`, `apellido";
		break;
	}
	$inj_col = "`$idabm`,`$abm`";
	$inj_val = "NULL, '$valor'";
	
	$sql = "INSERT INTO `$tabla` ($inj_col) values ($inj_val)";
	mysql_query($sql) or die("<script language = javascript> alert('Problema para agregar: ".mysql_error()."'); self.history.back();</script>");
	echo '<script language = javascript>
	alert("se ha agregado el elemento")
	self.history.go(-2);
	</script>';
}
?>
