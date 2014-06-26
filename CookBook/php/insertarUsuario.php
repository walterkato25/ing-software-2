<?php
require_once("SQLfunctions.php");
require_once("config.php");
require_once("funcionExiste.php");

	if($_POST["password"]!=$_POST["contraseña2"]){
		echo '<script language = javascript>
		alert("Verifique contraseña")
		self.historyback();
		</script>';
	}
			
	$fecha=date("Y/m/d");
	$atributos=array();
	foreach ($_POST as $clave => $valor) {
		$atributos[$clave]=$valor;
	}
	$atributos["fechaAlta"]=$fecha;
	$atributos["categoria"]="usuario";
	$atributos["idUsuario"]=NULL;
	$existeUsuario=existeDatoUsuario("nombreDeUsuario",$atributos["nombreDeUsuario"]);
	$existeDni=existeDatoUsuario("dni/cuit",$atributos["dni/cuit"]);
	$existeMail=existeDatoUsuario("mail",$atributos["mail"]);
	if($existeUsuario){
		echo '<script language = javascript>
		alert("No se ha podido agregar usuario. Nombre de usuario existente.");
		self.history.back();
		</script>';	
	}	
	if($existeDni){
		echo '<script language = javascript>
		alert("No se ha podido agregar usuario. DNI de usuario existente.");
		self.history.back();
		</script>';
	}	
	if($existeMail){
			echo '<script language = javascript>
			alert("No se ha podido agregar usuario. Mail de usuario existente.");
			self.history.back();
			</script>';
	}	
	if($existeUsuario==false && $existeDni==false && $existeMail==false){
		unset($atributos["contraseña2"]);
		unset($atributos["enviar"]);
		insert("usuario",$atributos);	
		echo '<script language = javascript>
		alert("se ha agregado el usuario")
		self.location = "../index.php";
		</script>';
	}
	


?>