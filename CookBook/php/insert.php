<?php
require_once('config.php');
if(isset($_POST['abm'])){
	$abm = $_POST['abm'];
	$tabla = $abm;
	$idabm = 'id'.$abm;
	switch($abm){
		case 'Etiqueta':
			$valor = $_POST["$abm"];
			$atrib=$abm;
		break;
		case 'Autor':
			$valor = $_POST["nombre"]."', '".$_POST["apellido"];
			$atrib = "nombre`, `apellido";
		break;
		case 'Libro':
			$valor = $_POST["isbn"]."', '".$_POST["stock"]."', '".$_POST["stockMinimo"]."', '".$_POST["origen"]."', '".$_POST["nombre"]."', '".$_POST["resumen"]."', '".$_POST["idioma"]."', '".$_POST["precio"]."', '".$_POST["cantPaginas"];
			$atrib = "isbn`, `stock`, `stockMinimo`, `origen`, `nombre`, `resumen`, `idioma`, `precio`, `cantPaginas";
			$isbn = $_POST["isbn"];
			
	}
	$inj_col = "`$idabm`,`$atrib`";
	$inj_val = "NULL, '$valor'";
	
	$sql = "INSERT INTO `$tabla` ($inj_col) values ($inj_val)";
	mysql_query($sql) or die("<script language = javascript> alert(\"Problema para agregar: ".mysql_error()."\"); self.history.back() </script>");
	if($abm=='Libro'){
		//insertar Autores
			if (isset($_POST["idAutor"])){
				$sql = "SELECT `idLibro` FROM `Libro` WHERE `isbn` = '$isbn'";
				$query = mysql_query($sql) or die("<script language = javascript> alert(\"Problema para encontrar isbn: ".mysql_error()."\"); self.history.back() </script>");
				$idlibroarray = mysql_fetch_array($query);
				$idlibro = $idlibroarray['idLibro'];
				$autors = array();
				$autors = $_POST["idAutor"];
				$tabla = "libroautor";
				$idabm = "idLibro";
				//realizar conexion a tabla Autor
				foreach ($autors as $valor){
					$sql = "INSERT INTO `$tabla` (`idLibroAutor`,`idLibro`,`idAutor`) values (NULL,'$idlibro','$valor')";
					mysql_query($sql) or die("<script language = javascript> alert(\"Problema para agregar tabla libroAutor: ".mysql_error()."\"); self.history.back() </script>");
				}
			}
			//insertar Etiquetas
			if (isset($_POST["idEtiqueta"])){
				$sql = "SELECT `idLibro` FROM `Libro` WHERE `isbn` = '$isbn'";
				$query = mysql_query($sql) or die("<script language = javascript> alert(\"Problema para encontrar isbn: ".mysql_error()."\"); self.history.back() </script>");
				$idlibroarray = mysql_fetch_array($query);
				$idlibro = $idlibroarray['idLibro'];
				$Etiquetas = array();
				$Etiquetas = $_POST["idEtiqueta"];
				$tabla = "libroetiqueta";
				$idabm = "idLibro";
				//realizar conexion a tabla Etiqueta
				foreach ($Etiquetas as $valor){
					$sql = "INSERT INTO `$tabla` (`idLibroEtiqueta`,`idLibro`,`idEtiqueta`) values (NULL,'$idlibro','$valor')";
					mysql_query($sql) or die("<script language = javascript> alert(\"Problema para actualizar tabla libroEtiqueta: ".mysql_error()."\"); self.history.back() </script>");
				}
			}
	}
	
	
	echo '<script language = javascript>
	alert("se ha agregado el elemento")
	self.history.go(-2);
	</script>';
	
}
?>
