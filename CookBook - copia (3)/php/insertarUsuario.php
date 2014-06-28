<?php
header("Content-type: text/html; charset=utf-8");
require_once("SQLfunctions.php");
require_once("config.php");
require_once("funcionExiste.php");

if($_POST["password"]!=$_POST["contraseña2"]){
		echo '<script language = "javascript">
		alert("Las contraseñas no coinciden.")
		self.history.back();
		</script>';
}else{
			
	$fecha=date("Y/m/d");
	$atributos=array();
	foreach ($_POST as $clave => $valor) {
		$atrib=$clave;
		if($clave=="dnicuit"){
			$atrib="dni/cuit";
		}
		$atributos[$atrib]=$valor;
	}
	$atributos["fechaAlta"]=$fecha;
	$atributos["categoria"]="usuario";
	$atributos["idUsuario"]=NULL;
	$existeUsuario=existeDatoUsuario("nombreDeUsuario",$atributos["nombreDeUsuario"]);
	$existeDni=existeDatoUsuario("dni/cuit",$atributos["dni/cuit"]);
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
		alert("Se ha agregado el usuario con éxito.")
		self.location = "../menuUsuario.php";
		</script>';
	}
	
}

?>