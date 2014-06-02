<?php
require_once("sesion.php");
sesion();
require_once("config.php");
$bd=connect();
if(isset($_GET["abm"])){
	$abm=$_GET["abm"];
	$tabla=$abm;
	$idabm='id'.$abm;
	if(isset($_GET["id"])){
		$id=$_GET["id"];
		$sql="DELETE FROM  `cookbook`.`$tabla` WHERE  `$tabla`.`$idabm` =$id LIMIT 1";
		mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para eliminar de '$tabla': ".mysql_error()."'); self.history.back();</script>");
		if($abm=="Libro"){
			if(){
			$sql="DELETE FROM `cookbook`.`libroAutor` WHERE `libroAutor`.`$idabm` =$id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para eliminar de tabla libroAutor: ".mysql_error()."'); self.history.back();</script>");
		$sql="DELETE FROM `cookbook`.`libroEtiqueta` WHERE `libroEtiqueta`.`$idabm` =$id";
		mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para eliminar de tabla libroEtiqueta: ".mysql_error()."'); self.history.back();</script>");
		}
		echo '<script language = javascript>
		alert("se ha borrado el elemento")
		self.history.back();
		</script>';

	}else{echo '<script language=javascript> alert("No se ha seleccionado elemento a eliminar")</script>';}
}else{echo '<script language=javascript> alert("No se ha seleccionado tabla de donde eliminar")</script>';}
?>
