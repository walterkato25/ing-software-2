<?php
require_once('config.php');
require_once('validar_autor.php');
require_once('validar_etiqueta.php');
require_once('validar_libro.php');
require_once('SQLfunctions.php');

function insertarEtiqueta(){
	if(validar_Etiqueta($_POST["Etiqueta"])){
		return true;
	}else{
		echo '<script language=javascript> alert("Error al realizar la carga. Ya existe una etiqueta con ese nombre."); history.back();</script>';
		$se_agrego=false;
	}
}

function insertarAutor(){
	if (validar_Autor($_POST["nombre"]."', '".$_POST["apellido"])){
		return true;
	}else{
		echo '<script language=javascript> alert("Error al realizar la carga. Ya existe un autor con ese nombre."); history.back();</script>';	
		$se_agrego=false;
	}
}

function insertarLibro(){
	if(validar_Libro($_POST["isbn"])){
		return true;
	}else{
		echo '<script language=javascript> alert("Error al realizar la carga. Ya existe un libro con ese mismo ISBN."); history.back();</script>';
		$se_agrego=false;
	}
}

function insertarUsuario(){
	
}
if(isset($_POST['abm'])){
	$se_agrego = False;
	$abm = $_POST['abm'];
	$tabla = $abm;
	$idabm = 'id'.$abm;
	$funcionInsertar="insertar$abm";
	foreach($_POST as $atributo => $valor){
		$atributosvalores[$atributo]=$valor;
	}
	unset($atributosvalores["abm"]);
	unset($atributosvalores["Enviar"]);
	if($abm=="Libro"){
		$isbn=$_POST["isbn"];
		unset($atributosvalores["idAutor"]);
		unset($atributosvalores["idEtiqueta"]);
	}
	$atributosvalores[$idabm]="NULL";
	if($funcionInsertar()){
		insert($tabla, $atributosvalores);
		$se_agrego=true;
	}

	if($se_agrego){
		//insertar Autores
		if (isset($_POST["idAutor"])){
				$sql = "SELECT `idLibro` FROM `Libro` WHERE `isbn` = '$isbn'";
				$query = mysql_query($sql) or die("<script language = javascript> alert(\"Problema para encontrar isbn: ".mysql_error()."\"); self.history.back() </script>");
				$idlibroarray = mysql_fetch_array($query);
				$idlibro = $idlibroarray["idLibro"];
				$autors = array();
				$autors = $_POST["idAutor"];
				$tabla = "libroautor";
				$idabm = "idLibro";
				//realizar conexion a tabla Autor
				foreach ($autors as $valor){
					$sql = "INSERT INTO `$tabla` (`idLibroAutor`,`idLibro`,`idAutor`) values (NULL,'$idlibro','$valor')";
					mysql_query($sql) or die("<script language = javascript> alert(\"Problema para agregar tabla libroAutor: ".mysql_error()."\"); self.history.back() </script>");
				}
				$se_agrego = True;
			}
			//insertar Etiquetas
		if (isset($_POST["idEtiqueta"])){
				$sql = "SELECT `idLibro` FROM `Libro` WHERE `isbn` = '$isbn'";
				$query = mysql_query($sql) or die("<script language = javascript> alert(\"Problema para encontrar isbn: ".mysql_error()."\"); self.history.back() </script>");
				$idlibroarray = mysql_fetch_array($query);
				$idlibro = $idlibroarray["idLibro"];
				$Etiquetas = array();
				$Etiquetas = $_POST["idEtiqueta"];
				$tabla = "libroetiqueta";
				$idabm = "idLibro";
				//realizar conexion a tabla Etiqueta
				foreach ($Etiquetas as $valor){
					$sql = "INSERT INTO `$tabla` (`idLibroEtiqueta`,`idLibro`,`idEtiqueta`) values (NULL,'$idlibro','$valor')";
					mysql_query($sql) or die("<script language = javascript> alert(\"Problema para actualizar tabla libroEtiqueta: ".mysql_error()."\"); self.history.back() </script>");
				}
				$se_agrego = True;
			}
	}
	if($se_agrego){
	echo '<script language = javascript  charset="UTF-8">
	alert("Se ha agregado el elemento correctamente.")
	self.history.go(-2);
	</script>';
	}

	
}

?>
