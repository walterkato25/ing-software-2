<?php
function validarUsuario($nombre,$mail){
		require_once("config.php");
		$consulta1 = "SELECT * FROM `cookbook`.`usuario` WHERE `nombreDeUsuario`='$nombre'";
		$consulta2 = "SELECT * FROM `cookbook`.`usuario` WHERE `mail`='$mail'";
		$sql_consulta1 = mysql_query($consulta1);
		$sql_consulta2 = mysql_query($consulta2);
		$validarUsuario = mysql_num_rows($sql_consulta1);
		$validarMail = mysql_num_rows($sql_consulta2);
		
		if($validarUsuario==0 && $validarMail==0){
			return 0;
		}else{
			if($validarUsuario!=0){
				return 1;	
			}else{
				return 2;
			}

			
		}
}

?>