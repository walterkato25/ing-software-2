<?php
require_once("php/sesion.php");
require_once("php/config.php");
require_once("php/html.php");
sesion();
if(!(isset($_SESSION["categoria"])) || $_SESSION["categoria"]!="administrador"){
	header("location:index.php");
}
$nombre="Cookbook - Libros de cocina";
if(isset($_GET['tipo'])){
		$meses=array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$mes=$_GET['fecha'];
		$anio=substr($mes, 0, 4);
		$num_mes=intval(substr($mes, 5))-1;
		$nombre="Cookbook - Reporte ";
		if($_GET["tipo"]=="month"){
			$nombre.="mensual para ".$meses[$num_mes]." de $anio";
		}
		if($_GET["tipo"]=="number"){
			$nombre.="anual de $anio";
		}
		if($_GET["tipo"]=="date"){
			$nombre.="entre ".$_GET['fecha']." y ".$_GET['fecha2'];
		}
		
}
head("js/validar_formularios.js",$nombre);
body("reporte.php");
function subMenu(){
	?>
	<div id="sub-menu" style='height:auto'>
		<form method="GET" id="reporte" onsubmit="return validar_reporte(this)"  action="reporte.php">
			<table style='width:850; margin:auto'>
				<tr>
					<th >
						Tipo de Reporte:
					</th>	
					<td>
						<?php
							if(isset($_GET["tipo"])){
								$tipo=$_GET["tipo"];
								$fecha=$_GET["fecha"];
								$fecha2=$_GET["fecha2"];
							}
						?>
						
						<select id="tipo-reporte" onchange="generar_formulario_reporte();" name="tipo">
							<option value="">Seleccione tipo...</option>
							<option value="date">Rango de fechas</option>
							<option value="month">Mensual</option>
							<option value="number">Anual</option>
						</select>
						<script type="text/javascript">
							function generar_formulario_reporte(){
								var f=new Date();
								var label_fecha=document.getElementById("label_fecha");
								var label_fecha2=document.getElementById("label_fecha2");
								var y=f.getFullYear();
								var m=('0'+(f.getMonth()+1)).slice(-2).toString();
								var d=('0'+f.getDate()).slice(-2).toString();
								var select=document.getElementById("tipo-reporte").value;
								var fecha=document.getElementById('fecha');
								var fecha2=document.getElementById("fecha2");
								var form=document.getElementById("reporte");
								var submit=document.getElementById("submit");								
								<?php if(!isset($tipo)){ ?>
									var instruccion=document.getElementById("instruccion");
									instruccion.innerHTML="Ingrese un tipo de reporte de ventas.";
								<?php }
								?>
								fecha.style.visibility="hidden";
								fecha2.style.display="none";
								submit.style.visibility="hidden";
								label_fecha.innerHTML="";
								label_fecha2.innerHTML="";

								if(select!=""){
									submit.style.visibility="visible";
									fecha.style.visibility="visible";
									fecha.type=select;
									if(select=="number"){
										label_fecha.innerHTML="Año:";
										fecha.value=y;
										fecha.max=y;
										fecha.style.width="50px";
										<?php if(!isset($tipo)){ ?>
											instruccion.innerHTML="Ingrese un año para generar el reporte.";
										<?php
										}
										?>
										
									}
									if(select=="month"){
										label_fecha.innerHTML="Mes:";
										fecha.value=y+'-'+m;
										fecha.style.width="160px";
										<?php if(!isset($tipo)){?>
											instruccion.innerHTML="Ingrese un mes para generar el reporte.";
										<?php } ?>
									}
									if(select=="date"){
										label_fecha.innerHTML="Entre:";
										label_fecha2.innerHTML="y:";
										fecha.style.width="140px";
										fecha2.style.width="140px";
										fecha2.style.display="initial";
										fecha2.value=y+'-'+m+'-'+d;
										<?php if(!isset($tipo)){?>
											instruccion.innerHTML="Ingrese dos fechas para generar el reporte.";
										<?php } ?>
										
									}
								}
								
							}
						</script>
					</td>
					<th id="label_fecha"></th><td><input id="fecha" type='' style="visibility:hidden" name='fecha' required></td>
					<th id="label_fecha2"><td><input id="fecha2" type="date" name="fecha2" style="display:none"></td>
					<td><input id="submit" type='submit' style="visibility:hidden" value='Generar reporte'></td>
				</tr>
			</table>
		</form>
	</div>	
			<?php
}

function contenido(){
	if(isset($_GET['tipo'])){
		$tipo=$_GET["tipo"];
		$fecha=$_GET['fecha'];
		if($tipo=="month"){
			$meses=array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
			$anio=substr($fecha, 0, 4);
			$num_mes=intval(substr($fecha, 5))-1;
			$mes=$meses[$num_mes];
			$fechaString=' mensual para '.$mes.' de '.$anio; 
		}
		if($tipo=="number"){
			$anio=$_GET["fecha"];
			$fechaString=' anual para '.$anio;
		}
		if($tipo=="date"){
			$fecha2=$_GET["fecha2"];
			$fechaString=" entre $fecha y $fecha2";
		}
		$sql="SELECT * FROM pedido WHERE timestamp ";
		if($tipo!="date"){
			$sql.="LIKE \"$fecha%\"";			
		}else{
			$sql.="BETWEEN '$fecha 00:00:00' AND '$fecha2 23:59:59'";
		}
		$query=mysql_query($sql);
		?>
			<fieldset style='width:600;margin:auto'><legend>Reporte<?php echo $fechaString ?>:</legend>
		<?php
		if(mysql_num_rows($query)==0){
			echo '<h4><p>No se registran pedidos para este período.</p></h4>';
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
				<tr><td></td><td id="print"><input type="button"  value="Imprimir reporte" onclick="imprimir_reporte()"></td></tr>
			</table>
			<script type="text/javascript">
				function imprimir_reporte(){
					document.getElementById("print").hidden=true;
					document.getElementById("header").hidden=true;
					window.print();
					document.getElementById("print").hidden=false;
					document.getElementById("header").hidden=false;
				}
			</script>
			<?php
		}
		echo '</fieldset>';
	}else{
		?>
		<h4><p id="instruccion">Ingrese un tipo de reporte de ventas.</p></h4>
		<?php
	}
}
?>