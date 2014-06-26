<?php
require_once("sesion.php");
sesion();
require_once("config.php");
require_once("SQLfunctions.php");
$bd=connect();
require_once("validarBaja.php");
function bajaAutor($abm,$idabm,$id){
	if(validarBaja($abm,$idabm,$id)){
		delete($abm,$id);
	}else{
		echo '<script language=javascript> alert("No se puede eliminar el elemento, porque existe un libro asociado."); self.history.back();</script>';
	}
}
function bajaLibro($abm,$idabm,$id){
	logic_delete($abm, $id);
}
function bajaEtiqueta($abm,$idabm,$id){
	if(validarBaja($abm,$idabm,$id)){
		delete($abm,$id);
	}else{
		echo '<script language=javascript> alert("No se puede eliminar el elemento, porque existe un libro asociado."); self.history.back();</script>';
	}
}
function bajaUsuario($abm,$idabm,$id){
	$sql="SELECT * FROM pedido WHERE idUsuario=$id AND estado in ('pendiente', 'enviado')";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)==0){
		if($_SESSION["idUsuario"]==$id){
			session_destroy();
		}
		logic_delete($abm, $id);
	}
}
if(isset($_GET["abm"])){
	$abm=$_GET["abm"];
	$idabm='id'.$abm;
	$funcionBaja='baja'.$abm;
	if(isset($_GET["id"])){
		$id=$_GET["id"];
		$funcionBaja($abm,$idabm,$id);
		echo '<script type="text/javascript" charset="UTF-8">
			alert("Se ha eliminado el elemento correctamente.")
			self.history.back();
			</script>';
				
			
		/*if($abm=="Libro"){
			$sql="DELETE FROM `cookbook`.`libroAutor` WHERE `libroAutor`.`$idabm` =$id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para eliminar de tabla libroAutor: ".mysql_error()."'); self.history.back();</script>");
			$sql="DELETE FROM `cookbook`.`libroEtiqueta` WHERE `libroEtiqueta`.`$idabm` =$id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para eliminar de tabla libroEtiqueta: ".mysql_error()."'); self.history.back();</script>");
		}*/
		

	}else{echo '<script language=javascript > alert("No se ha seleccionado elemento a eliminar")</script>';}
}else{echo '<script language=javascript> alert("No se ha seleccionado tabla de donde eliminar")</script>';}
?>
