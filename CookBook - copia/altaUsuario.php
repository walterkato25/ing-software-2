<?php
require_once("php/sesion.php");
require_once("php/SQLfunctions.php");

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
					<li id="actual">
						<a href="index.php">Inicio</a>
					</li>
					<li>
						<a href="catalogo.php">Catalogo</a>
					</li>
					<?php
						if($_SESSION){
							if($categoria=="administrador"){
								echo '<li>
								<a href="abm.php">ABM</a>
								</li>';
							}
							echo'</ul><ul id=navegacion style=float:right>
							<li>
							<a href="menuUsuario.php">Usuario:  '.$usuario.' </a>
							</li>
							<li>
							<a href="php/desconectarUsuario.php">Logout</a>
							</li>';
						}else{
							echo'<ul id=navegacion style=float:right>
							<li>
							<a href="login.php">Login</a>
							</li>';
						}
					?>																																						
				</ul> 
				
		
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				
			</div>
			<div id="main-content">
			<form id="contacto" name="login" method="POST" action="php/insertarUsuario.php">
							<fieldset style="padding:15px;width:300px">
							<legend>Registrarse:</legend>
							<label>Usuario:</label><input id="focus" type="text" name="nombreDeUsuario" required><span id="obligatorio">*</span><br><br>
							<label>Contraseña:</label><input id="focus" type="password" name="password"required><span id="obligatorio">*</span><br><br>
							<label>Repita Contraseña:</label><input id="focus" type="password" name="contraseña2" required><span id="obligatorio">*</span><br><br>
							<label>Nombre:</label><input id="focus" type="text" name="nombre" required><span id="obligatorio">*</span><br><br>
							<label>Apellido:</label><input id="focus" type="text" name="apellido" required><span id="obligatorio">*</span><br><br>
							<label>Mail:</label><input id="focus" type="email" name="mail" required><span id="obligatorio">*</span><br><br>
							<label>DNI:</label><input id="focus" type="number" name="dni/cuit" required><span id="obligatorio">*</span><br><br>
							<label>Telefono:</label><input id="focus" type="tel" name="tel" required><span id="obligatorio">*</span><br><br>
							<label>Cp:</label><input id="focus" type="text" name="cp" required><span id="obligatorio">*</span><br><br>
							<label>Localidad:</label><input id="focus" type="text" name="localidad" required><span id="obligatorio">*</span><br><br>
							<label>Calle:</label><input id="focus" type="text" name="calle" required><span id="obligatorio">*</span><br><br>
							<label>Numero:</label><input id="focus" type="number" name="nro" ><br><br>
							<label>Piso:</label><input id="focus" type="number" name="piso" ><br><br>
							<label>Depto:</label><input id="focus" type="text" name="depto" ><br><br>
							<input type="submit" name="enviar" value="Crear Usuario" style="margin-left:150px;"> <br><br>	
							<span id= "obligatorio">Los campos con * deben llenarse obligatoriamente</span>
							</fieldset>
						
                 </form>   
			</div>
		</div>

		<div id="footer">CookBooks 2014</div>
	
	</div>
</body>
</html>