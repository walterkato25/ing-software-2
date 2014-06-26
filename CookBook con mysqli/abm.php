<?php
require_once("php/sesion.php");
require_once("php/VIEWfunctions.php");
sesion();
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="img/icon.jpg" type="img/icon" rel="shortcut icon">
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="index.php"><img src="img/Imagen1.png" height=100% alt="logo" border="0px"></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li id="navegacion">
						<a href="index.php">Inicio</a>
					</li>
					<!--<li id="navegacion">
						<a href="aboutUs.php">Conocenos</a>
					</li>
					<li id="navegacion">
						<a href="contacto.php">Contacto</a>
					</li>-->
					<li id="actual">
						<a href="abm.php">ABM</a>
					</li>
				<!--<?php
						if($_SESSION){
						if($usuario=="admin"){
							echo '<li>
							<a href="abm.php">ABM</a>
							</li>';
						}
					}
					 
							if($_SESSION){
							echo '<span id=login><a href="desconectar_usuario.php">Logout</a></span>';
							//aca iba el usuario
							echo'<span id=login>Usuario:  '.$usuario.' </span>';
							}else{
								echo '<span id=login><a href="login.php">Login</a></span>';
							}
						?>-->
				</ul> 		
			</div>

			<div id="sub-menu">
				<ul id="navegacion">
					<li <?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Autor"){
								echo ' id="sub-actual" ';
							}
						}
					?>
					><a href="abm.php?abm=Autor">Autores</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Etiqueta"){
								echo ' id="sub-actual" ';
							}
						}
					?>
					><a href="abm.php?abm=Etiqueta">Etiquetas</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Libro"){
								echo ' id="sub-actual" ';
							}
						}
					?>
					><a href="abm.php?abm=Libro">Libros</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Usuario"){
								echo ' id="sub-actual" ';
							}
						}
					?>
					><a href="abm.php?abm=Usuario">Usuarios</a></li>				
			</div>
		</div>

				<div id="content">
			<div id="main-content">
				<?php
					
					if(isset($_GET["abm"])){
						viewABM($_GET["abm"]);
					}else{
						echo "<h4><p>Seleccione un campo para realizar alta, baja o modificación</p></h4>";
					}
					
			?>
			</div>
			<br/>
		</div>
		<!--<div id="footer">CookBooks 2014</div>-->	
	</div>
	
</body>
</html>
