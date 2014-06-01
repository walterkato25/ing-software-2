<?php
	function sesion(){
		require_once("config.php");

		//Iniciar Sesión
		session_start();

		//Validar si se está ingresando con sesión correctamente
		
		
		if ($_SESSION) {
			global $usuario;
			$usuario = $_SESSION['Usuario'];	
		}
		
	}

?>
