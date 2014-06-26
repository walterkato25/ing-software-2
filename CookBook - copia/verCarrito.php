<?php
require_once("php/config.php");
require_once("php/sesion.php");
require_once("php/html.php");
sesion();
if(!isset($_SESSION["carrito"])){
	header("location:index.php");
}
/*function prueba(){
	if(empty($_SESSION["carrito"])){
	require_once("php/carrito.php");
	agregarProducto("42",1,54.3);	
	agregarProducto("43",3,20.25);
	agregarProducto("46",2,134);
}
}*/
function contenido(){
?>
	<div id="carrito">
		<fieldset>
			<legend>Carrito de compras</legend>
			<div id="lista-carrito">
			<?php 
				if(empty($_SESSION["carrito"])){
					echo "<h4><p>Su carrito está vacío.</p></h4>";

				}else{
			?>
			<table>
				<tr>
					<th style="padding:6px">   Cantidad   </th>
					<th style="padding:6px">   Libro   </th>
					<th style="padding:6px">   Precio Unitario   </th>
					<th style="padding:6px">   Subtotal   </th>
				</tr>
				<?php
					$sql="SELECT * FROM Libro WHERE baja = 0";
					$query= mysql_query($sql);
					$total=0;
					while( $row = mysql_fetch_array($query)){
						if(isset($_SESSION["carrito"][$row["idLibro"]])){
							?>
							<tr>
							<?php
							$stock=$row["stock"];
							$nombre= $row["nombre"];
							$id=$row["idLibro"];
							$cantidad=$_SESSION["carrito"][$row["idLibro"]]["cantidad"];
							$precio=$_SESSION["carrito"][$row["idLibro"]]["precio"];
							$subtotal=$precio*$cantidad;
							$total+=$subtotal;
							echo '<td>'.$cantidad.'</td>';
							echo '<td>'.$nombre.'</td>';
							echo '<td style="text-align:center">$'.number_format($precio,2,',','.').'</td>';
							echo '<td style="text-align:center">$'.number_format($subtotal,2,',','.').'</td>'; ?>
							<td>
								<form method="POST" action="php/carrito.php" onsubmit="if(!confirm('Modificar la cantidad?'))return false">
									<input type="hidden" name="idLibro" value="<?php echo $id ?>" />
									<input name="cantidad" style="width:40px" type="number" min="1" max="<?php echo $stock ?>" value="<?php echo $cantidad ?>" />
									<input type="submit" name="modificar" value="Modificar cantidad" />
								</form>
							</td>
							<td>
								<form method="POST" action="php/carrito.php" onsubmit="if(!confirm('Desea eliminar <?php echo $nombre ?>?'))return false">
									<input type="hidden" name="idLibro" value="<?php echo $id ?>" />
									<input type="submit" name="eliminar" value="Quitar producto" />
								</form>
							</td>
							</tr>
							<?php
						}
					} ?>
				<tr>
					<td></td><td></td>
					<td style="text-align:right">
						<b>TOTAL:</b>
					</td>
					<td style="text-align:center">
						<b>$<?php
						echo number_format($total,2,',','.');
						?>
					</b>
					</td>
			<td>
			<form style="margin: auto" method="POST" action="php/carrito.php">							
				<input type="submit" name="vaciar" value="Vaciar Carrito" />
			</form>
			</td>
			<td>
			<a id="comprar" href="validarCarrito.php"> Comprar </a>
			</table>
			</td>
		</div>
		</fieldset>
	</div>
<?php
	}	
}
$pagina="verCarrito.php";
head("");
body($pagina);

?>