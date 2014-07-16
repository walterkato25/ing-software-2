<?php
require_once("php/sesion.php");
require_once("php/config.php");
require_once("php/html.php");
sesion();
if(!(isset($_SESSION["categoria"])) || $_SESSION["categoria"]!="administrador"){
	header("location:index.php");
}
if(isset($_GET['mes'])){
		$meses=array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$mes=$_GET['mes'];
		$anio=substr($mes, 0, 4);
		$num_mes=intval(substr($mes, 5))-1;
		$nombre="Cookbook - Reporte mensual para ".$meses[$num_mes]." de $anio";
}
head("",$nombre);
//body("reporte.php");


function contenido(){
	if(isset($_GET['mes'])){
		$meses=array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$mes=$_GET['mes'];
		$anio=substr($mes, 0, 4);
		$num_mes=intval(substr($mes, 5))-1;
		
		$sql="SELECT * FROM pedido WHERE timestamp LIKE \"$mes%\"";
		$query=mysql_query($sql);
		?>
			<fieldset style='width:600;margin:auto'><legend>Reporte mensual para <?php echo $meses[$num_mes].' de '.$anio; ?>:</legend>
		<?php
		if(mysql_num_rows($query)==0){
			echo '<h4><p>No se registran pedidos en '.$meses[$num_mes].' de '.$anio.'.</p></h4>';
		}else{
			$total=0;
			?>
			<table rules="rows">
				<tr>
					<th id='orden'><span>Pedido</span></th>
					<th id='orden'><span>Subtotal</span></th>
				</tr>
			<?php
			while($row=mysql_fetch_array($query)){
				$idPedido=$row['idPedido'];
				$monto=$row['monto'];
				$total+=$monto;
				$fecha=$row['timestamp'];
				$idUsuario=$row['idUsuario'];
				?>
				<tr>
					<td><a target="_blank" title="Ver detalle de pedido" href="verPedido.php?idPedido=<?php echo $idPedido ?>">Pedido #<?php echo $idPedido; ?></a></td>
					<td style='text-align:right;padding-right:20'> $<?php echo number_format($monto,2,',','.') ?></td>
				</tr>
				<?php
			}
			?>
				<tr style=''>

					<th style='text-align:right'>Total:</th>
					<th style='text-align:right;padding-right:20'> $<?php echo number_format($total,2,',','.') ?></td>
				</tr>
				<tr><td></td><td><input type="button" id="print" value="Imprimir reporte" onclick="imprimir_reporte()"></td></tr>
			</table>
			<script type="text/javascript">
				function imprimir_reporte(){
					document.getElementById("print").hidden=true;
					window.print();
					document.getElementById("print").hidden=false;
				}
			</script>
			<?php
		}
		echo '</fieldset>';
	}else{
		?>
		<h4><p>Debe elegir un mes para realizar el reporte.</p></h4>
		<?php
	}
}
contenido();
?>