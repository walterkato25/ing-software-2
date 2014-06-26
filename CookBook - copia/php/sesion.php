<?php
	function sesion(){
		require_once("config.php");
		//conect();

		//Iniciar Sesión
		if(!isset($_SESSION)){
		session_start();
	}

		//Validar si se está ingresando con sesión correctamente
		
		
		if (isset($_SESSION['categoria'])) {
			global $usuario;
			global $categoria;
			global $idUsuario;
			$categoria = $_SESSION['categoria'];
			$usuario = $_SESSION['Usuario'];
			$idUsuario = $_SESSION["idUsuario"];
		}
		
	}

?>
