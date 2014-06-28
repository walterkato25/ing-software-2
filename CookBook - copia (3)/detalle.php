
<?php 
require_once("php/config.php");
require_once("php/sesion.php");
require_once("php/html.php");
sesion();

if(!isset($_GET["id"])){
	header("location:index.php");
}


function contenido(){
	$id=$_GET["id"];
	$sql="SELECT * FROM libro WHERE idLibro = $id AND baja=0";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)==0){
		?>
		<script type="text/javascript"> alert('No existe el libro.'); self.history.back(); </script>
		<?php
	}else{
		$libro=mysql_fetch_assoc($query);
		$sql="SELECT * FROM autor WHERE idAutor in (SELECT idAutor FROM libroAutor WHERE idLibro=$id)";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$autores[$row["idAutor"]]["apellido"]=$row["apellido"];
			$autores[$row["idAutor"]]["nombre"]=$row["nombre"];
		}
		$sql="SELECT * FROM etiqueta WHERE idEtiqueta in (SELECT idEtiqueta FROM libroEtiqueta WHERE idLibro=$id)";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$etiquetas[$row["idEtiqueta"]]=$row["Etiqueta"];		
		}
		?>
		<fieldset>
			<legend><?php echo $libro["nombre"]; ?></legend>
			<div id="imagen" style="float:left"><img width="300" src=".<?php echo $libro["img"]; ?>" /></div>
			<div id="info-libro" style="float:left; width:550;">
			</br></br>
				<table >
					<tr>
						<td style="width:80px"><label>Autor<?php if(sizeof($autores)>1){ echo 'es';} ?>: </label></td>
						<td id="infodetalle">
							<?php
							foreach ($autores as $key => $value) {
								echo $value["apellido"].', '.$value["nombre"].' - ';
							}
							?>
						</td>
					</tr>
					<tr>
						<td><label>Origen: </label></td>
						<td id="infodetalle"><?php echo $libro["origen"]; ?></td>
					</tr>
					<tr>
						<td><label>Idioma: </label></td>
						<td id="infodetalle"><?php echo $libro["idioma"]; ?></td>
					</tr>
					<tr>
						<td><label>ISBN: </label></td>
						<td id="infodetalle"><?php echo $libro["isbn"] ?></td>
					</tr>
					<tr>
						<td><label>Páginas: </label></td>
						<td id="infodetalle"><?php echo $libro["cantPaginas"]; ?></td>
					</tr>
					<tr>
						<td><label>Etiqueta<?php if(sizeof($etiquetas)>1){ echo 's';} ?>: </label></td>
						<td id="infodetalle"><?php 
						foreach ($etiquetas as $key => $value) {
						 	echo $value.'   ';
						 }  ?></td>
					</tr>
				</table>
			</div>
			<div id="info-comercial" style="float:right">
			</br>
			<table>
				<tr>
			<?php
			if(isset($_SESSION["carrito"])&&(isset($_SESSION["carrito"][$_GET["id"]]))){
			?>
				<div id="agregado"><td style="width:200px;text-align:right"><label>Producto agregado.<label></td>
				<td><form method="POST" action="php/carrito.php" onsbmit="if(!confirm('Desea eliminar el producto del carrito?'))return false">
				<input type="hidden"  name="idLibro" value="<?php echo $libro["idLibro"] ?>" />
				<input type="submit" name="eliminar" value="Eliminar" />
				</form></td></tr>
				<tr><td><label>Cantidad: </label> </td><td id="infodetalle"><?php echo $_SESSION["carrito"][$_GET["id"]]["cantidad"] ?> </td></div>
				
			<?php
			}else{
			?>
				<form method="POST" action="php/carrito.php" onsbmit="if(!confirm('Desea agregar el producto al carrito?'))return false">
				<input type="hidden" name="precio" value="<?php echo $libro["precio"] ?>" />
				<input type="hidden"  name="idLibro" value="<?php echo $libro["idLibro"] ?>" />
				<td style="text-align:right"><input name="cantidad" type="number" min="1" max="<?php echo $libro["stock"] ?>" value="1" /></td>
				<td><input type="submit" name="agregar" value="Agregar a Carrito" /></td>
				</form>
			<?php
			}
			?>
				</tr>
				<tr>
					<td><label>Precio: </label></td>
					<td id="infodetalle">$<?php echo number_format($libro["precio"],2,',','.'); ?></td>
				</tr>
				<tr>
					<td><label>Stock: </label></td>
					<td id="infodetalle"><?php echo $libro["stock"]; ?></td>
				</tr>	
			</table>
			</div>
		</br>
			<div id="resumen" style="float:left;">
				<h4><p> Resumen: </p></h4>
				<textarea disabled style="background-color: #EBEDF4;width:900;height:300;color:black;border-color:black"><?php echo $libro["resumen"]; ?></textarea>
				<br>
			</div>
		</fieldset>	
	<?php
	}
}
$pagina="detalle.php";
head("");
body($pagina);
?>