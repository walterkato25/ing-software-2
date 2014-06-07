<?php
require_once("sesion.php");
sesion();
if($_SESSION){
	echo '<script language=javascript>self.location = "index.php"</script>';
}
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Concesionaria PHP</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<link href="images.jpg" type="img/icon" rel="shortcut icon">
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
				</ul>
				<span id="login"> <a href="login.php">Login</a></span>
		
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				
			</div>
			<div id="main-content">
				<form id="contacto" name="login" method="post" action="validarsesion.php">
							<fieldset style="padding:15px;width:300px">
							<legend>Iniciar Sesión:</legend>
							<label>Usuario:</label><input type="text" name="user" class="required"><br><br>
							<label>Contraseña:</label><input type="password" name="pass" class="required"><br><br>
							<input type="submit" name="enviar" value="Iniciar Sesión" style="margin-left:150px;"> <br><br>
							<span> <a href="crearcuenta.php">Crear cuenta</a></span>
							</fieldset>
                 </form>   
			</div>
		</div>

		<div id="footer">Jonatan Nahuel Llerena Suster <a href="mailto:jnllerenas@gmail.com">jnllerenas@gmail.com</a> Walter Kato <a href="mailto:walterk_88@hotmail.com">walterk_88@hotmail.com</a></div>
	
	</div>
</body>
</html>
