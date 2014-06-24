<?php

function crearCarrito(){
	if(!isset($_SESSION["carrito"])){
		$_SESSION["carrito"]=array();	
	}
}
function destruirCarrito()
		$_SESSION["carrito"]=array();	
}
function agregarProducto($id,$cantidad){
	$sql="SELECT precio FROM Libro WHERE idLibro=$id"
	$query=mysql_query($sql);
	$precio=mysql_fetch_assoc($query);
	$producto["cantidad"]=$cantidad;
	$producto["precio"]=$precio["precio"];
	$_SESSION["carrito"][$id]=$producto;
}

function eliminarProducto($id){
	unset($_SESSION["carrito"][$id]);
}

function modificarCantidad($id,$cantidad){
	$_SESSION["carrito"][$id]["cantidad"]=$cantidad;
}


?>