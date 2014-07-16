<?php
require_once("php/config.php");
require_once("php/html.php");
require_once("php/sesion.php");
sesion();
require_once("php/config.php");
require_once("php/VIEWfunctions.php");
if(!(isset($_SESSION["categoria"])) || ($_SESSION["categoria"]!="administrador")){
	header("location:index.php");
}
$pagina="pedidos.php";
function subMenu(){
	?>
	<div id="sub-menu" style='height:auto'>
		<form target="_blank" method="GET" id="catalogo"  action="reporte.php">
			<table style='width:850; margin:auto'>
				<tr>
					<th rowspan='2'>
						Ingrese un mes para generar un reporte de ventas:
					</th>	
				</tr>
				<tr>
					<td><input type='month' name='mes' required
						<?php
							echo ' value="';
							if (isset($_GET['mes'])){
								echo $_GET['mes'];
							}else{
								echo date("Y-m");
							}
							echo '"';
						?>

					></td>
					<td><input type='submit' value='Generar reporte'></td>
				</tr>
			</table>
		</form>
	</div>	
			<?php
}
function contenido(){
	if(isset($_GET["idUsuario"])){
		viewABM("Pedido",$_GET["idUsuario"]);
	}else{
		viewABM("Pedido");
	}
}
head("");
body($pagina);
?>