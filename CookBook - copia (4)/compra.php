<?php
require_once("php/sesion.php");
require_once("php/html.php");
if(!(isset($_SESSION["carrito"])) || empty($_SESSION["carrito"])){
	header("location:catalogo.php");
}
sesion();
head("js/validar_formularios.js");
function contenido(){
?>
			<fieldset>
			<legend>Compra:</legend>
			<div id="lista-carrito">
				<table style="margin: auto">
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
							
							echo '<tr>';
						
							$stock=$row["stock"];
							$nombre= $row["nombre"];
							$id=$row["idLibro"];
							$cantidad=$_SESSION["carrito"][$row["idLibro"]]["cantidad"];
							$precio=$_SESSION["carrito"][$row["idLibro"]]["precio"];
							$subtotal=$precio*$cantidad;
							$total+=$subtotal;
							echo '<td style="text-align: center">'.$cantidad.'</td>';
							echo '<td>'.$nombre.'</td>';
							echo '<td style="text-align:center">$'.number_format($precio,2,',','.').'</td>';
							echo '<td style="text-align:center">$'.number_format($subtotal,2,',','.').'</td>'; 
							echo '</tr>';
						}
					} 
				?>	
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
			</table>
			</td>
		</div>
		</fieldset>
		<h4><p>IMPORTANTE: antes de terminar la compra revise los datos de su domicilio para el envío.</p></h4>
		<fieldset style="width:420; float:left">
			<legend>Datos de Tarjeta</legend>
		<!--<form id="contacto" name="login" method="POST" action="php/generarPedido.php">-->
			<table>
				<tr>
					<td><label>Banco:</label></td>
					<td style="text-align:left"><select required style="width:200" id="banco">
							<option value="">Seleccione Banco...</option>
							<option value="Banco Provincia">Banco Provincia</option>
							<option value="Banco Nacion">Banco Nacion</option>
							<option value="Banco Galicia">Banco Galicia</option>
							<option value="Banco Santander">Banco Santander</option>
							<option value="Banco Frances">Banco Frances</option>
						</select>
						<span id="obligatorio">*</span></td>
				</tr>
				<tr>
					<td><label>Tarjeta:</label></td>
					<td style="text-align:left"><select required style="width:200" id="tarjeta">
							<option value="">Seleccione Tarjeta...</option>
							<option value="Visa">Visa</option>
							<option value="Master Card">Master Card</option>
							<option value="American Expres">American Expres</option>
						</select>
							<span id="obligatorio">*</span></td>
				</tr>
				<tr>
					<td><label>Nonmbre del titular:</label></td>
					<td style="text-align:left"><input required style="width:200" type="text" id="nombreTitular" required><span id="obligatorio">*</span></td>
				</tr>
				<tr>
					<td><label>Numero de tarjeta:</label></td>
					<td style="text-align:left"><input style="width:200" maxlength="16" type="text" id="numTarjeta" required>
						<span id="obligatorio">*</span></td>
				</tr>
				<tr>
					<td><label>Fecha de vencimiento:</label></td>
					<td style="text-align:left"><input required style="width:200" type="month" min="<?php echo date('Y-m'); ?>" id="fechaVencimiento" required>
						<span id="obligatorio">*</span></td>
				</tr>
				<tr>
					<td><label>Codigo de validacion:</label></td>
					<td style="text-align:left"><input required style="width:200" maxlength="3" type="password" value="" id="codigoTarjeta" required>
						<span id="obligatorio">*</span></td>
				</tr>
				<tr><td></td>
					<td><a style="margin: auto" id="comprar" onclick="return validar_tarjeta();" href="php/validarCarrito.php?continue=generarPedido.php"> Comprar </a></td>
				</tr>	
			</table>
			<span id= "obligatorio">Los campos con * deben llenarse obligatoriamente</span>

		<!--</form> -->
    	</fieldset> 
  <?php
    	require_once("php/editarPerfil.php");
    	editarDomicilio(getDataCliente($_SESSION["idUsuario"]));

} 

body("compra.php");

?>
