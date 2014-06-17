<?php
	require_once('config.php');
	require_once('validar_autor.php');
	require_once('validar_libro.php');
	require_once('validar_etiqueta.php');
	
	$bd=connect();
	if(isset($_POST['abm'])){
		$abm = $_POST['abm'];
		$tabla = $abm;
		$id = $_POST['id'];
		$idabm = 'id'.$abm;
		switch($abm){
			case 'Etiqueta':
			$inject = $abm.' = "'.$_POST["$abm"].'"';
			$validacion = validar_etiqueta($_POST["$abm"]);
			break;
			case 'Autor':
			$nombre=$_POST["nombre"];
			$apellido=$_POST["apellido"];
			$inject='nombre="'.$nombre.'", apellido="'.$apellido.'"';
			$valor=$_POST["nombre"]."', '".$_POST["apellido"];
			$validacion = validar_autor($valor);
			break;	
			case 'Libro':
			$inject='cantPaginas="'.$_POST["cantPaginas"].
					'", idioma ="'.$_POST["idioma"].
					'", isbn ="'.$_POST["isbn"].
					'", nombre ="'.$_POST["nombre"].
					'", origen ="'.$_POST["origen"].
					'", precio ="'.$_POST["precio"].
					'", resumen ="'.$_POST["resumen"].
					'", stock ="'.$_POST["stock"].
					'", stockMinimo ="'.$_POST["stockMinimo"].'"';
			$isbn=$_POST["isbn"];
			$validacion = validar_libro($isbn,$id);
			break;
		}
		
		
		
	}
	if($validacion){
		$sql = "UPDATE `$tabla` SET $inject WHERE `$idabm` = $id";
		mysql_query($sql,$bd) or die("<script language = javascript> alert(\"Problema para actualizar: ".mysql_error()."\"); self.history.back();</script>");
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
		switch($abm){
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

		}
	}
?>
