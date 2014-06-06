<?php
	function validar_libro($isbn){
		require_once("config.php");
		$bd=connect();
		$consulta = "SELECT * FROM `cookbook`.`libro` WHERE `ISBN`='$isbn'";
		$sql_consulta = mysql_query($consulta);
		$validar = mysql_num_rows($sql_consulta);
		
		if($validar==0){
			return true;
		}else{
			return false;
		}

	
	}

?>