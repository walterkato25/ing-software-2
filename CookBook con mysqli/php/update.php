<?php
	require_once('config.php');
	require_once('validar_autor.php');
	require_once('validar_libro.php');
	require_once('validar_etiqueta.php');
	require_once('SQLfunctions.php');

function claveEtiqueta(){
	return $_POST["Etiqueta"];
}	
function claveAutor(){
	return $_POST["nombre"].', '.$_POST["apellido"];
}
function claveLibro(){
	return $_POST["isbn"];
}
function reject($tabla, $clave, $valor){
	echo '<script charset="UTF-8"> 
			alert("Error al realizar la modificacion. Ya existe '.$tabla.' con la clave '.$clave().'."); 
			self.history.back();</script>';
}
	$bd=connect();
	if(isset($_POST['abm'])){
		$abm = $_POST['abm'];
		$tabla = $abm;
		$id = $_POST['id'];
		$idabm = 'id'.$abm;
		foreach( $_POST as $valor => $atributo){
			$toUpdate[$valor]=$atributo;
		}
		unset($toUpdate["Enviar"]);
		unset($toUpdate["id"]);
		unset($toUpdate["abm"]);
		if($abm=="Libro"){
			unset($toUpdate["idAutor"]);
			unset($toUpdate["idEtiqueta"]);
		}
		$funcionValidar="validar_$abm";
		$clave="clave$abm";
		$validacion=$funcionValidar($clave());
	}
	if($validacion){
		update($abm, $toUpdate, $id);
		if($abm=='Libro'){
			$sql="DELETE FROM `libroAutor` WHERE idLibro=$id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert(\"Problema para eliminar de tabla libroAutor: ".mysql_error()."\"); self.history.back();</script>");
			foreach ($_POST["idAutor"] as $valor){
						$sql = "INSERT INTO `libroautor` (`idLibroAutor`,`idLibro`,`idAutor`) values (NULL,'$id','$valor')";
						mysql_query($sql) or die("<script language = javascript> alert(\"Problema para agregar tabla libroAutor: ".mysql_error()."\"); self.history.back() </script>");
			}
			$sql="DELETE FROM `libroEtiqueta` WHERE idLibro=$id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert(\"Problema para eliminar de tabla libroEtiqueta: ".mysql_error()."\"); self.history.back();</script>");
			foreach ($_POST["idEtiqueta"] as $valor){
						$sql = "INSERT INTO `libroetiqueta` (`idLibroEtiqueta`,`idLibro`,`idEtiqueta`) values (NULL,'$id','$valor')";
						mysql_query($sql) or die("<script language = javascript> alert(\"Problema para actualizar tabla libroEtiqueta: ".mysql_error()."\"); self.history.back() </script>");
			}
		}	
	
	
		echo '<script language = javascript  charset="UTF-8">
			alert("Se ha actualizado el elemento correctamente.")
			self.history.go(-2);
			</script>';
	}else{
		reject($abm,$clave,$valor);
		/*switch($abm){
			case 'Etiqueta':
			echo '<script language=javascript> 
			alert("Error al realizar la modificacion. Ya existe una etiqueta con ese nombre."); 
			self.history.back();</script>';
			break;
			case 'Autor':
			echo '<script language=javascript> 
			alert("Error al realizar la modificacion. Ya existe un autor con ese nombre."); 
			self.history.back();</script>';
			break;
			case 'Libro':
			echo '<script language=javascript> 
			alert("Error al realizar la modificacion. Ya existe un Libro con ese ISBN."); 
			self.history.back();</script>';
			break;

		}*/
	}
?>
