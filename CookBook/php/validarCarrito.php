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
	$valida=true;
	while($row = mysql_fetch_array($query)){
		$id=$row["idLibro"];
		$stock=$row["stock"];
		$precio=$row["precio"];
		$nombre=$row["nombre"];
		if($stock<$cantidades[$id]){ //si no hay stock suficiente
			modificarCantidad($id,$stock);
			$valida=false;
			?><script language='javascript'>
				alert('Lo sentimos.\nEl stock del producto "<?php echo $nombre; ?>" ha sido actualizado recientemente y no es suficiente para la compra que desea realizar.\nEl stock actual es de <?php echo $stock; ?>.\nSerá enviado a la pagina anterior para revisar su pedido.'); 
				self.history.back();
				</script>
				<?php
		}
		if($precio!=$precios[$id]){
			$valida=false;
			$_SESSION["carrito"][$id]["precio"]=$precio;
			$precio=number_format($precio,2,',','.');
			?>

			<script language='javascript'>
				alert('Lo sentimos.\nEl precio del producto "<?php echo $nombre; ?>" ha sido actualizado recientemente.\nEl nuevo precio es de $<?php echo $precio; ?>.\nSerá enviado a la pagina anterior para revisar su pedido.'); 
				self.history.back();
				</script>

				<?php
		}

	}
	if ($valida) {
		$continue=$_GET["continue"];
		header("location:$continue");
	}
	
}else{
	header("location:../index.php");
}
?>