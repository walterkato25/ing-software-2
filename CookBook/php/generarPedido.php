<?php
header("Content-type: text/html; charset=utf-8");
require_once("carrito.php");
require_once("sesion.php");
require_once("config.php");
require_once("SQLfunctions.php");
sesion();
if(!isset($_SESSION["carrito"]) || empty($_SESSION["carrito"])){
	header("location:../index.php");
}
$total=0;
	foreach($_SESSION["carrito"] as $id => $producto){
		$ids[]=$id;
		$total+=$producto["cantidad"]*$producto["precio"];
	}
	$atributosvalorespedido["estado"]="Pendiente";
	$atributosvalorespedido["idUsuario"]=$_SESSION["idUsuario"];
	$atributosvalorespedido["monto"]=$total;
	insert("pedido", $atributosvalorespedido);
	$ids=implode(', ',$ids);
	$sql="SELECT * FROM libro WHERE idLibro in ($ids) AND baja=0";
	$query=mysql_query($sql);
	$sql="SELECT * FROM pedido WHERE idUsuario=".$_SESSION['idUsuario']." ORDER BY timestamp DESC LIMIT 0,1";
	$pedido=mysql_query($sql);
	$pedido=mysql_fetch_assoc($pedido);
	while($row=mysql_fetch_array($query)){
		$atributosvaloreslibro["stock"]=$row["stock"]-$_SESSION["carrito"][$row["idLibro"]]["cantidad"];
		update("libro",$atributosvaloreslibro,$row["idLibro"]);
		$atributosvalorespedidolibro["idLibro"]=$row["idLibro"];
		$atributosvalorespedidolibro["idPedido"]=$pedido["idPedido"];
		$atributosvalorespedidolibro["cantidad"]=$_SESSION["carrito"][$row["idLibro"]]["cantidad"];
		insert("pedidoLibro", $atributosvalorespedidolibro);
	}
	destruirCarrito();
echo '<script language = "javascript">
		alert("La compra se ha realizado con éxito")
		self.location = "../menuUsuario.php?menu=Pedidos";
		</script>';