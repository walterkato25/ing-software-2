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
$pagina="menuUsuario.php";
body($pagina);

 
function subMenu(){
?>
	<div id="sub-menu" >
	<ul id="navegacion">
		<li <?php 
			if(isset($_GET["menu"])){
				if($_GET["menu"]=="Perfil"){
					echo ' id="sub-actual" ';
				}
			}
			?>>
			<a href="menuUsuario.php?menu=Perfil">Perfil</a>
		</li>
		<?php
		if((isset($_SESSION["categoria"]))&&($_SESSION["categoria"]!="administrador")){
			?>
		<li	<?php 
			if(isset($_GET["menu"])){
				if($_GET["menu"]=="Pedidos"){
					echo ' id="sub-actual" ';
				}
			}

			?>>
			<a href="menuUsuario.php?menu=Pedidos">Pedidos</a>
			<?php
		}
		?>
		</li>
	</ul>
	</div>
<?php
}
function contenido(){ 
	if(isset($_GET["menu"])){
		if($_GET["menu"]=="Perfil"){
			getCliente($_SESSION["idUsuario"]);
	?>
					
				<?php
		}
		if($_GET["menu"]=="Pedidos"){
			viewABM("Pedido",$_SESSION["idUsuario"]);

		}
				?>
				

		<?php
	}else{
					echo "<h4><p>Bienvenido, ".$_SESSION["Usuario"].". Seleccione una opción del menú para comenzar.</p></h4>";
		}
}
?>
