<?php
require_once("php/sesion.php");
require_once("php/config.php");
require_once("php/editarPerfil.php");
sesion();
if(!$_SESSION){
	header("location:index.php");
}
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="img/icon.png" type="img/icon" rel="shortcut icon">
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="index.php"><img src="img/Imagen1.png" height=100% alt="logo" border="0px"></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li >
						<a href="index.php">Inicio</a>
					</li>
					<?php
					if (!$_SESSION || $categoria=="usuario"){
						?>
					
					<li>
						<a href="catalogo.php">Catalogo</a>
					</li>
					<?php
				}
				?>
					<?php
						if($_SESSION){
							if($categoria=="administrador"){
								echo '<li>
								<a href="abm.php">ABM</a>
								</li>';
							}
							echo'</ul><ul id=navegacion style=float:right>
							<li id="actual">
							<a href="menuUsuario.php">Usuario:  '.$usuario.' </a>
							</li>
							<li>
							<a href="php/desconectarUsuario.php">Logout</a>
							</li>';
						}else{
							echo'</ul><ul id=navegacion style=float:right>
							<li>
							<a href="login.php">Login</a>
							</li>';
						}
						
					?>
				</ul> 
						
			</div>
			<div id="sub-menu">
				<ul id="navegacion">
					<li id="sub-actual">
						<a href="menuUsuario.php">Perfil</a></li>
						<?php if($_SESSION["categoria"]!="administrador"){
							?>
					<li>
						<a href="verPedidos.php">Pedidos</a></li>	
						<?php
						}
						?>			
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				
			</div>
			<div id="main-content">
				<?php
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
				
		</div>
			<div id="push"></div>
			<br/>
		</div>

		<!--<div id="footer">CookBooks 2014</div>-->
	
	</div>
</body>
</html>
