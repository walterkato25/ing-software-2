<?php
header("Content-type: text/html; charset=utf-8");
require_once("carrito.php");
require_once("sesion.php");
require_once("config.php");
sesion();
//ValidarCarrito.php
if(isset($_SESSION["carrito"])){
	foreach($_SESSION["carrito"] as $clave => $valor){
		$ids[]=$clave;
		$cantidades[$clave]=$valor["cantidad"];
		$precios[$clave]=$valor["precio"];
	}
	$ids=implode(', ', $ids);
	$sql="SELECT * FROM Libro WHERE idLibro in ($ids) AND baja = 0";
	$query=mysql_query($sql);
	while($row = mysql_fetch_array($query)){
		$id=$row["idLibro"];
		$stock=$row["stock"];
		$precio=$row["precio"];
		if($stock<$cantidades[$id]){ //si no hay stock suficiente
			$nombre=$row["nombre"];
			modificarProducto($id,$stock);
			echo "<script language='javascript'>
				alert('Lo sentimos. \\n
				El stock del producto \"$nombre\" ha sido actualizado recientemente y no es suficiente para la compra que desea realizar. \\n
				El stock actual es de $stock. \\n
				Será enviado a la pagina anterior para revisar su pedido.'); 
				self.history.back();</script>";
		}
		if($precio!=$precios[$id]){
			$precio=number_format($precio,2,',','.');
			$_SESSION["carrito"][$id]["precio"]=$precio;
			echo "<script language='javascript'>
				alert('Lo sentimos. \\n
				El precio del producto \"$nombre\" ha sido actualizado recientemente. \\n
				El nuevo precio es de $$precio. \\n
				Será enviado a la pagina anterior para revisar su pedido.'); 
				self.history.back();</script>";
		}

	}
	$continue=$_GET["continue"];
	header("location:$continue");
}else{
	header("location:../index.php");
}
?>