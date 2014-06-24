<?php
	function validarBaja($tabla,$idabm,$id){
		if($tabla=="Libro"){
			return true;
		}
		require_once("config.php");
		$bd=connect();

		$tablaLibro='libro'.$tabla;
		$consulta = "SELECT * FROM `cookbook`.`$tablaLibro` WHERE `$idabm`=$id";
		$sql_consulta = mysql_query($consulta);
		$validar = mysql_num_rows($sql_consulta);
		
		if($validar==0){
			return true;
		}else{
			return false;
		}

	
	}

?>