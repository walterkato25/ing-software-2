<?php
require_once("php/carrito.php")
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
				alert('<strong>Lo sentimos.</strong></br>
				El stock del producto \"$nombre\" ha sido actualizado recientemente y no es suficiente para la compra que desea realizar. </br>
				El stock actual es de $stock. </br>
				Será enviado a la pagina anterior para revisar su pedido.'); 
				self.history.back();</script>";
			}
		if($precio!=$precios[$id]){
			$precio=number_format($precio,2,',','.');
			$_SESSION["carrito"][$id]["precio"]=$precio;
			echo "<script language='javascript'>
				alert('<strong>Lo sentimos.</strong></br>
				El precio del producto \"$nombre\" ha sido actualizado recientemente. </br>
				El nuevo precio es de $$precio. </br>
				Será enviado a la pagina anterior para revisar su pedido.'); 
				self.history.back();</script>";
		}
	}
}
?>