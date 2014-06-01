<?php
	require_once('config.php');
	
	$bd=connect();
	if(isset($_POST['abm'])){
		$abm = $_POST['abm'];
		$tabla = $abm;
		switch($abm){
			case 'Etiqueta':
			$inject = $abm.' = "'.$_POST["$abm"].'"';
			break;
			case 'Autor':
			$inject='nombre="'.$_POST["nombre"].'", apellido="'.$_POST["apellido"].'"';
			break;	
		}
		
		$id = $_POST['id'];
		$idabm = 'id'.$abm;
		
	}
	$sql = "UPDATE `$tabla` SET $inject WHERE `$idabm` = '$id'";
	mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para actualizar: ".mysql_error()."'); self.history.back();</script>");
	echo '<script language = javascript>
		alert("se ha actualizado el elemento")
		self.history.go(-2);
		</script>';

?>
