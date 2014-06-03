<?php
	require_once('config.php');
	
	$bd=connect();
	if(isset($_POST['abm'])){
		$abm = $_POST['abm'];
		$tabla = $abm;
		switch($abm){
			case 'Etiqueta':
			$inject = $abm.' = "'.$_POST["$abm"].'"';
			break;
			case 'Autor':
			$inject='nombre="'.$_POST["nombre"].'", apellido="'.$_POST["apellido"].'"';
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
		}
		
		$id = $_POST['id'];
		$idabm = 'id'.$abm;
		
	}
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


	echo '<script language = javascript>
		alert("se ha actualizado el elemento")
		self.history.go(-2);
		</script>';

?>
