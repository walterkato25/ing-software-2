<?php
require_once("sesion.php");
sesion();
?>
<html>
<head>
	<meta content="text/html" charset="utf-8" http-equiv="content-type"></meta>
	<title>Concesionaria PHP</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<link href="images.jpg" type="img/icon" rel="shortcut icon">
	<script>
		function newSearch() {
 		window.location.assign("autos.php")
	  	}
	</script>
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="index.php"><img src="autos.jpg" height=100% alt="logo"></a></div>
				<div class=empresa><a href="index.php"><h1>Concesionaria PHP</h1></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li>
						<a href="sucursales.php">Sucursales</a>
					</li>
					<li>
						<a href="servicios.php">Servicios</a>
					</li>
					<li>
						<a href="autos.php">Autos</a>
					</li>
					<li>
						<a href="contacto.php">Contacto</a>
					</li>
					<?php
						if($_SESSION){
						
							echo '<li>
							<a href="abm.php">ABM</a>
							</li>';
						
						}
					?>
						
						<?php 
							if($_SESSION){
							echo '<span id=login><a href="desconectar_usuario.php">Logout</a></span>';
							//aca iba el usuario
							echo'<span id=login>Usuario:  '.$usuario.' </span>';
							}else{
								echo '<span id=login><a href="login.php">Login</a></span>';
							}
						?>
				</ul>
				
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				<?php
				require_once("menufiltrar.php");
				filtrar();
				?>
				
			</div>
			<div id="main-content">
				<?php
				if (isset($_GET["filtrar"])){
					require_once("Listar.php");
					$marca = $_GET["idmarca"];
					$modelo = $_GET["idmodelo"];
					$tipo = $_GET["idtipo"];
					$caracteristicas=array();
					if(isset($_GET['carac'])){
						$caracteristicas=$_GET['carac'];
					}
					$listarx = $_GET["listarpor"];
					$orden = $_GET["orden"];
					generarLista($marca,$modelo,$tipo,$caracteristicas,$listarx,$orden);
					
					
				}
				if($_SESSION){
							echo "<table><tr><td><a href=\"formabm.php?abm=Vehiculo\">Agregar...</a></td></tr></table>";
				}
				
				
				?>
					
					
			
			</div>
		</div>

		<div id="footer">Jonatan Nahuel Llerena Suster <a href="mailto:jnllerenas@gmail.com">jnllerenas@gmail.com</a> Walter Kato <a href="mailto:walterk_88@hotmail.com">walterk_88@hotmail.com</a></div>
	
	</div>
</body>
</html>
