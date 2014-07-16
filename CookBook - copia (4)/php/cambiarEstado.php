<?php
require_once("config.php");
require_once("sesion.php");
require_once("SQLfunctions.php");
sesion();
if(!isset($_SESSION["categoria"]) || $_SESSION["categoria"]!="administrador"){
	header("location:../index.php");
}
if(isset($_GET["idPedido"])){
	$idPedido=$_GET["idPedido"];
	$sql="SELECT * FROM pedido WHERE idPedido=$idPedido";
	$query=mysql_query($sql);
	$pedido=mysql_fetch_assoc($query);
	$estado=$pedido["estado"];
	if($estado=="Pendiente"){ $nuevoEstado="Enviado";}
	if($estado=="Enviado"){$nuevoEstado="Recibido";}
	if(isset($nuevoEstado)){
		$atribval["estado"]=$nuevoEstado;
		update("pedido",$atribval,$idPedido);
		echo '<script language = "javascript">
			alert("Se ha actualizado el estado del pedido a '.$nuevoEstado.'.")
			self.history.back();
			</script>';
	}else{
		echo '<script language="javascript"> 
			alert("No se puede modificar el estado de un pedido Recibido"); 
			self.history.back();
			</script>';
	}
}
?>