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
$pagina="usuarios.php";
function subMenu(){
	?>
	<div id="sub-menu" style='height:auto'>
		<form method="GET" id="catalogo" onsubmit="return validar_rango_fecha(this);">
		<table style='width:850; margin:auto'>	
		<tr>
			<th >
				Ver los usuarios registrados entre:
			</th>
			<td><input type='date' name='desde' required
				<?php
					if (isset($_GET['desde'])){
						echo ' value="'.$_GET['desde'].'"';
					}
				?>

				></td>
				<th>y:</th>
			<td><input type='date' name='hasta' required
				<?php
					if (isset($_GET['hasta'])){
						echo ' value="'.$_GET['hasta'].'"';
					}
				?>
				></td>
			<td><input type='submit' value='Mostrar'></td>

		</tr>
		</table>	
		</form>

	</div>
	<?php
}
function contenido(){
	viewABM("Usuario");
}
head("js/validar_formularios.js");
body($pagina);
?>