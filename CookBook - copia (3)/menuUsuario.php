<?php
require_once("php/sesion.php");
require_once("php/config.php");
require_once("php/editarPerfil.php");
require_once("php/html.php");
require_once("php/VIEWfunctions.php");
sesion();
if(!$_SESSION){
	header("location:index.php");
}
?>
<html>
<?php
head("js/validar_formularios.js");
body("menuUsuario.php");

?>
<?php 
function contenido(){ 
	if(isset($_GET["menu"])){
		if($_GET["menu"]=="Perfil"){
			getCliente($_SESSION["idUsuario"]);
	?>
					
				<?php
		}
		if($_GET["menu"]=="Pedidos"){
			viewABM("Pedido");

		}
				?>
				

		<?php
	}else{
					echo "<h4><p>Bienvenido ".$_SESSION["Usuario"].". Seleccione una opción del menú para comenzar.</p></h4>";
		}
}
?>
