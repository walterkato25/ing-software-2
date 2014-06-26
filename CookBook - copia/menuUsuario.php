<?php
require_once("php/sesion.php");
require_once("php/config.php");
require_once("php/editarPerfil.php");
require_once("php/html.php");
sesion();
if(!$_SESSION){
	header("location:index.php");
}
?>
<html>
<?php
head("");
body("menuUsuario.php");

?>
<?php 
function contenido(){ 
	if(isset($_GET["menu"])){
		if($_GET["menu"]=="Perfil"){
			getCliente($_SESSION["idUsuario"]);
	?>
					<script language='javascript'>
							function limpiar(){
								if(document.getElementById('limpiar')){
									var nodo = document.getElementById("limpiar");
									rep=document.createElement('br');
									nodo.parentNode.replaceChild(rep, nodo);
								}
							}
							function edit(atributo, tipo){
								window.onload=limpiar();
								var form_ini="<form id='limpiar' method='POST' action='php/userUpdate.php'>"
								<?php echo "var id=\"<input type='hidden' name='id' value='".$_SESSION["idUsuario"]."'/>\";"; ?>
								var input1="<input autofocus required type='"+tipo+"' name='"+atributo+"' />";
								var input2="<input type='submit' value='Save'/>";
								var cancel="<input type='button' value='Cancel' onclick='limpiar()'/>";
								var form_fin="</form>";
								document.getElementById(atributo).innerHTML=form_ini+id+input1+input2+cancel+form_fin;
							}
						</script>
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
