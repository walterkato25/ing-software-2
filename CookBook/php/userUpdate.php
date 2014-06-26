<?php
	require_once('config.php');
	require_once('SQLfunctions.php');
	require_once('funcionExiste.php');
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$tabla='Usuario';
		$valida=true;
		foreach( $_POST as $atributo => $valor){
			if(($atributo=="nombreDeUsuario") || ($atributo=="dni/cuit") || ($atributo == "mail")){
				$valida=!(existeDatoUsuario($atributo, $valor));
			}
			$toUpdate[$atributo]=$valor;
		}
		unset($toUpdate["id"]);
		if($valida){
			update($tabla, $toUpdate, $id);
			echo '<script language = javascript  charset="UTF-8">
			alert("Se ha actualizado el elemento correctamente.")
			self.history.back();
			</script>';
		}else{
			if($atributo=="nombreDeUsuario"){$atributo="nombre de usuario";}
			echo "<script charset='UTF-8'> 
			alert(\"Error al realizar la modificacion. El $atributo '$valor' ya está en uso.\"); 
			self.history.back();</script>";
		}
	}
?>