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

function subMenu(){
	?>
	<div id="sub-menu">
		<ul id="navegacion" style="margin:auto; width:900px; "><li style="float:right"><a  href="javascript:void(0)" onclick="self.history.back()"> Volver </a></li></ul>
		
	</div>
	<?php
}

function contenido(){
	$url=$_SERVER["REQUEST_URI"];
		if (isset($_GET["orden"])){
			$lenght=strlen($url)-(9+strlen($_GET["orden"]));
			$url=substr($url, 0, $lenght);
		}
	if(isset($_GET["orden"])){
		$orden=$_GET["orden"];
	}else{
		$orden="nombre";
	}
	$idPedido=$_GET["idPedido"];
	$sql="SELECT * FROM pedido WHERE idPedido=$idPedido";
	$query=mysql_query($sql);
	$pedido=mysql_fetch_assoc($query);
	$monto=$pedido["monto"];
	$estado=$pedido["estado"];
	$fechayhora=$pedido["timestamp"];
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
	<div style="display:flex;" id="pedido">
		<div style="display:inline-block;width: 45%">
		<fieldset>
			<legend>Pedido:</legend>
			<style type="text/css">
					#info-usuario th{text-align: left; width:180;} 
					#info-pedido th{text-align: left;}
					#info-pedido td{text-align: center;}
					#info-usuario td {text-align: left} 
					<?php if($_SESSION["categoria"]=="usuario"){
				?>
				#info-usuario{display: none;}
				<?php
			} ?>

				</style>
			<div id="info-pedido">
				<table rules="rows" style="margin:10 0">
					<tr>
					<th ><span>Estado: </span></th>
					<td id="estado" style="background-color:#01214A;color:#EBEDF4"><span ><b><?php echo $estado ?></b></span></td>
					</tr>
					<tr>
						<?php
					if($_SESSION["categoria"]=="administrador"){ ?>
					<th ><span>Marcar como:</span></th>
					<?php
						if($_SESSION["categoria"]=="administrador"){
						if($estado!="Recibido"){
								if($estado=="Pendiente"){
									$nuevoEstado="Enviado";
								}
								if($estado=="Enviado"){
									$nuevoEstado="Recibido";
								}?>
								<td style="padding: 0">
									<a id="agregar" style="display:inline-block; width:50%;padding:3 0; margin:5 0" href='php/cambiarEstado.php?idPedido=<?php echo $idPedido?>' onclick= 'if(!confirm("¿Desea marcar el pedido como <?php echo $nuevoEstado ?>?"))return false'>
										<?php echo $nuevoEstado ?>
									</a>
								</td>
								<?php
							}
						}
						?>
					</tr>
					<tr>
					<?php } ?>
					<th ><span>Monto:</span></th>
					<td><?php echo  "$".number_format($monto,2,',','.') ?></td>
					</tr>
					<tr>
					<th ><span>Fecha y Hora:</span></th>
					<td><?php echo  $fechayhora ?></td>
					</tr>
				</table>
			</div>
		</fieldset>
			
			
				
				<div id="info-usuario">
				<fieldset>
				
					<legend> Información de Usuario: </legend>
					<table rules="rows">
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
				
			</div>
			<div id="lista-libros" style="display: inline-block; width: 55%">
			<fieldset >
			
				<legend> Lista de libros en pedido: </legend>
			
			<table  rules="rows" style="margin:10 0">
				<tr>
					<th id="orden"> <span>Cantidad</span>     </th>
					<th id="orden">
						<a href="
						<?php 
							if(isset($_GET["orden"]) && $_GET["orden"]=="nombre DESC"){
								echo $url.'&orden=nombre ASC';
							}else{
								echo $url.'&orden=nombre DESC';} ?>
								" title="Ordenar por nombre" >Libro
						</a>
					</th>
				</tr>
				<?php
					$sql="SELECT * FROM pedidoLibro WHERE idPedido=$idPedido";
					$query= mysql_query($sql);
					while($row=mysql_fetch_array($query)){
						$id[]=$row["idLibro"];
						$cantidades[$row["idLibro"]]=$row["cantidad"];
					}
					$ids=implode(", ",$id);
					$sql="SELECT * FROM libro WHERE idLibro in ($ids) ORDER BY $orden";
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
$pagina="pedidos.php";
head("");
body($pagina);

?>