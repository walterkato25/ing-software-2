
<?php
header("Content-type: text/html; charset=utf-8");
require_once("sesion.php");
sesion();
function head($script){
	?>
	<head>
	<meta charset="utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="img/icon.jpg" type="img/icon" rel="shortcut icon">
	<script src="<?php echo $script ?>" language="javascript"></script>
</head>
<?php
}

function pageHeader(){
?>
	<div id="page-header">
				<div class="logo">
					<a href="index.php">
						<img src="img/Imagen1.png" height=100% alt="logo" border="0px">
					</a>
				</div>
	</div>
<?php
}
function headerMenu($actual="", $admin=false){
	?>
	<div id="header-menu">
		

				<ul id="navegacion">
					<li style="padding:0; margin:0" >
						<a class="logo" href="index.php">
							<img src="img/Imagen1.png" height="60px" alt="logo" border="0px">
						</a>
					</li>
				<?php
					if (!$admin){					
					?>
					<li <?php if($actual=="catalogo.php"){echo 'id="actual"'; }?>>
						<a href="catalogo.php">Catalogo</a>
					</li>
					<?php					
					}
					?>
					<!--<li id="navegacion">
						<a href="aboutUs.php">Conocenos</a>
					</li>
					<li id="navegacion">
						<a href="contacto.php">Contacto</a>
					</li>-->
					
	<?php
		if(isset($_SESSION["categoria"])){
			if($admin){
	?>
					<li <?php if($actual=="abm.php"){echo 'id="actual"'; }?> >
								<a href="abm.php">ABM</a>
					</li>
					<li <?php if($actual=="usuarios.php"){echo 'id="actual"'; }?>>
						<a href="usuarios.php">Usuarios</a>
					</li>
					<li <?php if($actual=="pedidos.php"){echo 'id="actual"'; }?>>
						<a href="pedidos.php">Pedidos</a>
					</li>
						<li <?php if($actual=="reporte.php"){echo 'id="actual"'; }?>>
						<a href="reporte.php">Reporte</a>
					</li>
	<?php	}else{
					?>
					<li <?php if($actual=="verCarrito.php"){echo 'id="actual"'; }?>>
						<a href="verCarrito.php">Carrito</a>
					</li>
					<?php
				}	?>
				</ul>
				<ul id="navegacion" style="float:right">
					<li <?php if($actual=="menuUsuario.php"){echo 'id="actual"'; }?>>							
						<a href="menuUsuario.php">Usuario: <?php echo $_SESSION["Usuario"]; ?></a>
					</li>
					<li <?php if($actual=="desconectarUsuario.php"){echo 'id="actual"'; }?>> 
						<a href="php/desconectarUsuario.php">Logout</a>
					</li>

	<?php
		}else{
	?>
				</ul>
				<ul id="navegacion" style="float:right">
					<li <?php if($actual=="login.php"){	echo 'id="actual"'; }?>>
						<a href="login.php">Login</a>
					</li>
	<?php	
		}	
	?>
				</ul> 		
			</div>
<?php
}


function encabezado($pagina){
?>

	<div id="header" >
			
			<?php 
			//pageHeader(); 

			if(isset($_SESSION["categoria"])){
				$admin=($_SESSION["categoria"]=="administrador");
			}else{
				$admin=false;
			}
			headerMenu($pagina, $admin);
			if (function_exists('subMenu')){
			subMenu(); //subMenu debe implementarse en aquellas paginas que tengan que implementar un submenu
			}
			?>			
	</div> 
<?php
}
function footer(){
	?>
	<div id="footer">CookBook 2014</div>
	<?php
}
function body($pagina){
?>
	<body>
		<?php 
			encabezado($pagina);
			?>
		<div id="page">
			
			<div id="content">
				<div id="main-content">
					<?php contenido(); //contenido es una funcion que debe implementarse en el script de cada pagina. tendra el contenido de la pagina debajo del menu y el submenu. ?> 
				</div>
			</div>
		</div>
		<?php 
			footer($pagina);
			?>
	</body>
	<?php
}

?>

		
				