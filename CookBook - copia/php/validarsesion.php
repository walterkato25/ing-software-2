<?php

	require_once("config.php");
			
	if (!isset($_SESSION)) {
		session_start();
	}
			
	$username = $_POST["user"]; //recibo los datos ingresados en el formulario login.php
	$password = $_POST["pass"];
					
	$consulta = "SELECT * FROM `usuario` WHERE `nombreDeUsuario` = \"$username\" AND `password` = \"$password\" AND `baja` = 0"; //consulto a la bd si los datos estan guardados
	$resultado = mysql_query($consulta);
	$fila = mysql_fetch_array($resultado);
	
				
	if (!$fila[0]) //si no existe o los datos son incorrectos
		{
			echo '<script language = javascript>	
					alert("Usuario o Password incorrectos, por favor verifique.")
					self.location = "../login.php"
					</script>';
		}else //Usuario logueado correctamente
		{
			$_SESSION['idUsuario'] = $fila['idUsuario'];
			$_SESSION['Usuario'] = $fila['nombreDeUsuario'];
			$_SESSION['categoria']	= $fila['categoria'];
			if($_SESSION['categoria']=="usuario"){
				$_SESSION['carrito'] = array();
			}
			header("Location: ../index.php");
		}

	
?>  
			
