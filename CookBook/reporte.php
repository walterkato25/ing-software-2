<?php
require_once("php/sesion.php");
require_once("php/config.php");
require_once("php/html.php");
sesion();
head("");
body("reporte.php");
function subMenu(){
	?>
	<div id="sub-menu" style='height:auto'>
		<form method="GET" id="catalogo" onsubmit="return validar_rango_fecha(this);">
			<table style='width:850; margin:auto'>
				<tr>
					<th rowspan='2'>
						Ingrese un mes para generar el reporte:
					</th>	
				</tr>
				<tr>
					<td><input type='month' name='mes' required
						<?php
							if (isset($_GET['mes'])){
								echo ' value="'.$_GET['mes'].'"';
							}
						?>

					></td>
					<td><input type='submit' value='Enviar'></td>
				</tr>
			</table>
		</form>
	</div>	
			<?php
}
function contenido(){
	if(isset($_GET['mes'])){
		$mes=$_GET['mes'];
		$sql="SELECT * FROM pedido WHERE timestamp LIKE \"$mes%\"";
		$query=mysql_query($sql);
		?>
			<fieldset style='width:600;margin:auto'><legend>Reporte Mensual:</legend>
		<?php
		if(mysql_num_rows($query)==0){
			echo '<h4><p>En ese mes no se han realizado pedidos.</p></h4>';
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
					<td><a href="verPedido.php?idPedido=<?php echo $idPedido ?>">Pedido #<?php echo $idPedido; ?></a></td>
					<td style='text-align:right;padding-right:20'> $<?php echo number_format($monto,2,',','.') ?></td>
				</tr>
				<?php
			}
			?>
				<tr style=''>

					<th style='text-align:right'>Total:</th>
					<th style='text-align:right;padding-right:20'> $<?php echo number_format($total,2,',','.') ?></td>
				</tr>
			</table>
			<?php
		}
		echo '</fieldset>';
	}else{
		?>
		<h4><p>Seleccione un mes para realizar el reporte.</p></h4>
		<?php
	}
}

?>