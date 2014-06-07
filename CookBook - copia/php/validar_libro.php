<?php
	function validar_libro($isbn, $id=-1){
		require_once("config.php");
		$bd=connect();
		if($id==-1){
			$consulta = "SELECT * FROM `cookbook`.`libro` WHERE `ISBN`='$isbn'";
		}else{
			$consulta = "SELECT * FROM `cookbook`.`libro` WHERE `ISBN`='$isbn' AND `idLibro` <> $id ";
		}
		$sql_consulta = mysql_query($consulta);
		$validar = mysql_num_rows($sql_consulta);
		
		if($validar==0){
			return true;
		}else{
			return false;
		}

	
	}

?>