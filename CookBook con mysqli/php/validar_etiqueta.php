<?php
	function validar_Etiqueta($nom){
		require_once("config.php");
		$bd=connect();
		$consulta = "SELECT * FROM `etiqueta` WHERE `Etiqueta`='$nom'";
		$sql_consulta = mysql_query($consulta);
		$validar = mysql_num_rows($sql_consulta);
		
		if($validar==0){
			return true;
		}else{
			return false;
		}

	
	}

?>