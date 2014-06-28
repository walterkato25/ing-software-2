<?php
header("Content-type: text/html; charset=utf-8");
require_once("sesion.php");
sesion();
require_once("config.php");
require_once("SQLfunctions.php");
$bd=connect();
require_once("validarBaja.php");
function bajaAutor($abm,$idabm,$id){
	if(validarBaja($abm,$idabm,$id)){
		delete($abm,$id);
		return true;
	}else{
		echo '<script language=javascript> alert("No se puede eliminar el elemento porque existe un libro asociado."); self.history.back();</script>';
		return false;
	}

}
function bajaLibro($abm,$idabm,$id){
	logic_delete($abm, $id);
	return true;
}
function bajaEtiqueta($abm,$idabm,$id){
	if(validarBaja($abm,$idabm,$id)){
		delete($abm,$id);
		return true;
	}else{
		echo '<script language=javascript> alert("No se puede eliminar el elemento porque existe un libro asociado."); self.history.back();</script>';
		return false;
	}
}
function bajaUsuario($abm,$idabm,$id){
	$sql="SELECT * FROM pedido WHERE idUsuario=$id AND estado in ('pendiente', 'enviado')";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)==0){
		if($_SESSION["idUsuario"]==$id){
			session_unset();
			session_destroy();
		}
		logic_delete($abm, $id);
		return true;
	}else{
		echo '<script language=javascript > alert("No puedes eliminar la cuenta si tienes pedidos pendientes o enviados.");self.history.back();</script>';
		return false;
	}
}
if(isset($_GET["abm"])){
	$abm=$_GET["abm"];
	$idabm='id'.$abm;
	$funcionBaja='baja'.$abm;
	if(isset($_GET["id"])){
		$id=$_GET["id"];
		if($funcionBaja($abm,$idabm,$id)){
			echo '<script type="text/javascript" charset="UTF-8">
			alert("Se ha eliminado correctamente.")
			self.history.back();
			</script>';
		}
		
				
			
		/*if($abm=="Libro"){
			$sql="DELETE FROM `cookbook`.`libroAutor` WHERE `libroAutor`.`$idabm` =$id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para eliminar de tabla libroAutor: ".mysql_error()."'); self.history.back();</script>");
			$sql="DELETE FROM `cookbook`.`libroEtiqueta` WHERE `libroEtiqueta`.`$idabm` =$id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para eliminar de tabla libroEtiqueta: ".mysql_error()."'); self.history.back();</script>");
		}*/
		

	}else{echo '<script language=javascript > alert("No se ha seleccionado elemento a eliminar")</script>';}
}else{echo '<script language=javascript> alert("No se ha seleccionado tabla de donde eliminar")</script>';}
?>
