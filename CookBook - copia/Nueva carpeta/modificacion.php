<?php
require_once("config.php");

//Iniciar Sesión
session_start();

//Validar si se está ingresando con sesión correctamente
if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "login.php"
</script>';
}


?>
<html>
<head>
	<meta content="text/html" charset="utf-8" http-equiv="content-type"></meta>
	<title>Concesionaria PHP</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<link href="images.jpg" type="img/icon" rel="shortcut icon">
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="index.html"><img src="autos.jpg" height=100% alt="logo"></a></div>
				<div class=empresa><a href="index.html"><h1>Concesionaria PHP</h1></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li>
						<span><a href="desconectar_usuario.php">Logout</a></span>
						<?php echo'<span align="right">Usuario:  '.$_SESSION['Usuario'].' </span>'?>
					</li>
					
				</ul>
				
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
			
				
				
			</div>
			<div id="main-content">
				<?php
				require_once("creartabla.php");
				require_once("listarvehiculos.php");
				$_tabla=creartabla();
				listarvehiculos($_tabla);
				
				?>	
			
			</div>
		</div>

		<div id="footer">Jonatan Nahuel Llerena Suster <a href="mailto:jnllerenas@gmail.com">jnllerenas@gmail.com</a> Walter Kato <a href="mailto:walterk_88@hotmail.com">walterk_88@hotmail.com</a></div>
	
	</div>
</body>
</html>
