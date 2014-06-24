
<?php
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
					<li <?php if($actual=="index.php"){echo 'id="actual"'; }?>>
						<a href="index.php">Inicio</a>
					</li>
				<?php
					if (!(isset($_SESSION["categoria"])) || ($_SESSION["categoria"]=="usuario")){					
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
	<?php	}	?>
				</ul>
				<ul id="navegacion" style="float:right">
					<li <?php if($actual=="menuUsuario.php"){echo 'id="actual"'; }?>>							
						<a href="menuUsuario.php">Usuario:  '<?php echo $_SESSION["Usuario"]; ?>' </a>
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
function subMenuABM(){
	?>
	<div id="sub-menu" >
	<ul id="navegacion">
		<li <?php 
				if(isset($_GET["abm"])){
					if($_GET["abm"]=="Autor"){
						echo ' id="sub-actual" ';
					}
				}
			?>>
			<a href="abm.php?abm=Autor">Autores</a></li>
		<li	<?php 
				if(isset($_GET["abm"])){
					if($_GET["abm"]=="Etiqueta"){
						echo ' id="sub-actual" ';
					}
				}
			?>>
			<a href="abm.php?abm=Etiqueta">Etiquetas</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Libro"){
								echo ' id="sub-actual" ';
							}
						}
					?>
					><a href="abm.php?abm=Libro">Libros</a></li>
			</ul>
		</div>
	<?php
}
function subMenuUsuario(){
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
		<li	<?php 
			if(isset($_GET["menu"])){
				if($_GET["menu"]=="Pedidos"){
					echo ' id="sub-actual" ';
				}
			}
			?>>
			<a href="menuUsuario.php?menu=Pedidos">Pedidos</a>
		</li>
	</ul>
	</div>
<?php
}
function subMenu($pagina){
?>
	
		<?php
		if($pagina=="abm.php"){ subMenuABM(); }
		if($pagina=="menuUsuario.php"){ subMenuUsuario(); }
		if($pagina=="catalogo.php"){ subMenuCatalogo(); }
		?>

	

<?php
}
function encabezado($pagina){
?>
	<div id="header" <?php if($pagina=="catalogo.php"){ echo "style='height:240px'" ;} ?>>
			<?php 
			pageHeader(); 
			if(isset($_SESSION["categoria"])){
				$admin=($_SESSION["categoria"]=="administrador");
			}else{
				$admin=false;
			}
			headerMenu($pagina, $admin);
			subMenu($pagina);
			?>			
	</div> 
<?php
}
function body($pagina){
?>
	<body>
		<div id="page">
			<?php 
			encabezado($pagina);
			?>
			<div id="content">
				<div id="main-content">
					<?php contenido(); ?>
				</div>
			</div>
		</div>
	</body>
	<?php
}

?>

		
				