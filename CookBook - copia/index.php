<?php
require_once("php/sesion.php");
sesion();
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
					<li>
						<a href="index.php">Inicio</a>
					</li>
					<li>
						<a href="aboutUs.php">Conocenos</a>
					</li>
					<li>
						<a href="contacto.php">Contacto</a>
					</li>
					<li>
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
		</div>

		<div id="content">
			<div id="left-bar">
				
			</div>
			<div id="main-content">
			
			</div>
		</div>

		<div id="footer">CookBooks 2014</div>
	
	</div>
</body>
</html>
