<?php
header("Content-type: text/html; charset=utf-8");
require_once("SQLfunctions.php");
require_once("config.php");
require_once("funcionExiste.php");
require_once("sesion.php");
sesion();
if($_POST["password"]!=$_POST["contraseña2"]){
		echo '<script language = "javascript">
		alert("Las contraseñas no coinciden.")
		self.history.back();
		</script>';
}else{
	$atributos=array();
	foreach ($_POST as $clave => $valor) {
		$atributos[$clave]=$valor;
	}
	$categoria='usuario';
	if(isset($_SESSION['categoria'])){
		$categoria=$_SESSION['categoria'];
	}
	$atributos["categoria"]=$categoria;
	$existeUsuario=existeDatoUsuario("nombreDeUsuario",$atributos["nombreDeUsuario"]);
	$existeDni=existeDatoUsuario("dni_cuit",$atributos["dni_cuit"]);
	$existeMail=existeDatoUsuario("mail",$atributos["mail"]);
	if($existeUsuario){
		echo '<script language = "javascript">
		alert("No se ha podido agregar el usuario. El nombre de usuario ingresado está en uso.");
		self.history.back();
		</script>';	
	}	
	if($existeDni){
		echo '<script language = "javascript">
		alert("No se ha podido agregar usuario. Existe un usuario con el mismo DNI/CUIT.");
		self.history.back();
		</script>';
	}	
	if($existeMail){
			echo '<script language = "javascript">
			alert("No se ha podido agregar usuario. El e-mail ingresado está en uso.");
			self.history.back();
			</script>';
	}	
	if($existeUsuario==false && $existeDni==false && $existeMail==false){
		unset($atributos["contraseña2"]);
		unset($atributos["enviar"]);
		insert("usuario",$atributos);	
		echo '<script language = "javascript">
		alert("Bienvenido, '.$atributos["nombreDeUsuario"].'.\nAhora tienes una cuenta en Cookbook.")
		self.location = "../menuUsuario.php";
		</script>';
	}
	
}

?>