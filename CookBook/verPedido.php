<?php
header("Content-type: text/html; charset=utf-8");
require_once("php/config.php");
require_once("php/sesion.php");
require_once("php/html.php");
sesion();
if(!isset($_SESSION["categoria"])){
	header("location:index.php");
}
if(!isset($_GET["idPedido"])){
	header("location:index.php");
}

function contenido(){
	$idPedido=$_GET["idPedido"];
	$sql="SELECT * FROM pedido WHERE idPedido=$idPedido";
	$query=mysql_query($sql);
	$pedido=mysql_fetch_assoc($query);
	$monto=$pedido["monto"];
	$estado=$pedido["estado"];
	$idUsuario=$pedido["idUsuario"];
	$sql="SELECT * FROM usuario WHERE idUsuario=$idUsuario";
	$query=mysql_query($sql);
	$usuario=mysql_fetch_assoc($query);
	$nombreDeUsuario=$usuario["nombreDeUsuario"];
	$calle=$usuario["calle"];
	$nro=$usuario["nro"];
	$depto=$usuario["depto"];
	$piso=$usuario["piso"];
	$cp=$usuario["cp"];
	$localidad=$usuario["localidad"];
	$nombre=$usuario["nombre"];
	$apellido=$usuario["apellido"];
	$mail=$usuario["mail"];
	$telefono=$usuario["tel"];
	$baja=$usuario["baja"];
?>
	<div id="pedido">
		<div style="float:left;width: 45%">
		<fieldset>
			<legend>Pedido:</legend>
			
			<div id="info-pedido">
				<table style="margin:10 0">
					<tr>
					<th>Estado</th>
					<th>Monto</th>
					<?php
					if($_SESSION["categoria"]=="administrador"){ ?>
					<th>Marcar como...</th>
					<?php } ?>
					</tr>
					<tr>
						<td><?php echo $estado ?></td>
						<td><?php echo  "$".number_format($monto,2,',','.') ?></td>
						<?php
						if($_SESSION["categoria"]=="administrador"){
						if($estado!="Recibido"){
								if($estado=="Pendiente"){
									$nuevoEstado="Enviado";
								}
								if($estado=="Enviado"){
									$nuevoEstado="Recibido";
								}?>
								<td>
									<a href='php/cambiarEstado.php?idPedido=<?php echo $idPedido?>' onclick= 'if(!confirm("¿Desea marcar el pedido como <?php echo $nuevoEstado ?>?"))return false'>
										<?php echo $nuevoEstado ?>
									</a>
								</td>
								<?php
							}
						}
						?>
					</tr>

				</table>
			</div>
		</fieldset>
			
			<?php if($_SESSION["categoria"]=="administrador"){
				?>
				<style type="text/css">#info-usuario th{text-align: right; width:180;} #info-usuario td{text-align: left} </style>
				<div id="info-usuario">
				<fieldset>
				
					<legend> Información de Usuario: </legend>
					<table>
						<tr>
							<th>Usuario:</th><td><?php echo $nombreDeUsuario ?></td>
						</tr>
						<tr>
							<th>Apellido y Nombre:</th><td><?php echo $apellido.', '.$nombre; ?></td>
						</tr>
						<tr>
							<th>Estado de cuenta:</th><td>
							<?php
							if($baja){echo "Eliminada";}else{echo "Activa";}
							?></td>
						</tr>
						<tr>
							<th>E-Mail:</th><td><?php echo $mail; ?></td>
						</tr>
						<tr>
							<th>Teléfono:</th><td><?php echo $telefono; ?></td>
						</tr>
						<tr>
							<th>Domicilio:</th><td><?php echo $calle.' n° '.$nro.'<br> piso: '.$piso.' departamento: '.$depto.'<br> Código Postal:  '.$cp.' Localidad: '.$localidad; ?></td>
						</tr>
					</table>
				
					</fieldset>
					</div>
				<?php
			} ?>
			</div>
			<div id="lista-libros" style="float: right;width: 55%">
			<fieldset >
			
				<legend> Lista de libros en pedido: </legend>
			
			<table  style="margin:10 0">
				<tr>
					<th >   Cantidad   </th>
					<th >   Libro   </th>
				</tr>
				<?php
					$sql="SELECT * FROM pedidoLibro WHERE idPedido=$idPedido";
					$query= mysql_query($sql);
					while($row=mysql_fetch_array($query)){
						$id[]=$row["idLibro"];
						$cantidades[$row["idLibro"]]=$row["cantidad"];
					}
					$ids=implode(", ",$id);
					$sql="SELECT * FROM libro WHERE idLibro in ($ids)";
					$query= mysql_query($sql);
					while( $row = mysql_fetch_array($query)){
						?>
							<tr>
							<?php
							$nombreLibro= $row["nombre"];
							$id=$row["idLibro"];
							$cantidad=$cantidades[$id];
							echo '<td style="text-align: center">'.$cantidad.'</td>';
							echo '<td>'.$nombreLibro.'</td>';
							?>
							</tr>
							<?php
						
					} ?>
				
			</table>		
		</fieldset>
		</div>
	</div>

<?php	
}
$pagina="verPedido.php";
head("");
body($pagina);

?>