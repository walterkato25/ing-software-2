<?php
	function validar_autor($nomApe){
		require_once("config.php");
		$bd=connect();
		list($nom, $ape) = explode( "', '",$nomApe);
		$consulta = "SELECT * FROM `cookbook`.`autor` WHERE `nombre`='$nom' and `apellido`='$ape'";
		$sql_consulta = mysql_query($consulta);
		$validar = mysql_num_rows($sql_consulta);
		
		if($validar==0){
			return true;
		}else{
			return false;
		}

	
	}

?>