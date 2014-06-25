<?php
require_once("config.php");
require_once("sesion.php");
sesion();

function crearCarrito(){
	if(!isset($_SESSION["carrito"])){
		$_SESSION["carrito"]=array();
	}
}
function destruirCarrito(){
		$_SESSION["carrito"]=array();	
}
function agregarProducto($id,$cantidad,$precio){
	$producto["cantidad"]=$cantidad;
	$producto["precio"]=$precio	;
	$_SESSION["carrito"][$id]=$producto;
}

function eliminarProducto($id){
	unset($_SESSION["carrito"][$id]);
}

function modificarCantidad($id,$cantidad){
	if($cantidad==0){
		eliminarProducto($id);
	}else{
		$_SESSION["carrito"][$id]["cantidad"]=$cantidad;
	}
}

if(isset($_SESSION["carrito"])){
	if(isset($_POST["agregar"])){
		agregarProducto($_GET["idLibro"],$_GET["cantidad"],$_GET["precio"]);
		echo "<script language=javascript> alert('Se ha agregado el producto en el carrito.'); self.history.back(); </scrip>";

	}
	if(isset($_POST["eliminar"])){
		eliminarProducto($_POST["id"]);
		echo "<script language='javascript'> alert('Se ha eliminado el producto del carrito.'); self.history.back(); </script>";
	}

	if(isset($_POST["vaciar"])){
		destruirCarrito();
		echo "<script language='javascript'> alert('Su carrito esta vacío.'); self.history.back(); </script>";
	}
	if(isset($_POST["modificar"])){
		modificarCantidad($_POST["id"], $_POST["cantidad"]);
		echo "<script language='javascript'> alert('Se ha modificado correctamente.'); self.history.back(); </script>";	
	}
}

?>