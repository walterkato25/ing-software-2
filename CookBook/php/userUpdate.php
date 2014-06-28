<?php
header("Content-type: text/html; charset=utf-8");
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
			if($atributo=="dnicuit"){
				$atrib="dni/cuit";
			}else{
				$atrib=$atributo;
			}
			$toUpdate[$atrib]=$valor;
		}
		unset($toUpdate["id"]);
		if($valida){
			update($tabla, $toUpdate, $id);
			echo '<script language = "javascript"  >
			alert("Se ha actualizado el elemento correctamente.")
			self.history.back();
			</script>';
		}else{
			if($atributo=="nombreDeUsuario"){$atributo="nombre de usuario";}
			echo "<script language = 'javascript'> 
			alert(\"Error al realizar la modificación. El $atributo '$valor' ya está en uso.\"); 
			self.history.back();</script>";
		}
	}
?>