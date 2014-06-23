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

				</ul> 
				
		
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				
			</div>
			<div id="main-content">
			<form id="contacto" name="login" method="post" action="php/validarsesion.php">
							<fieldset style="padding:15px;width:300px">
							<legend>Iniciar Sesión:</legend>
							<label>Usuario:</label><input type="text" name="user" required><br><br>
							<label>Contraseña:</label><input type="password" name="pass" required><br><br>
							<input type="submit" name="enviar" value="Iniciar Sesión" style="margin-left:150px;"> <br><br>
							<span> <a href="altaUsuario.php">Crear cuenta</a></span>
							</fieldset>
                 </form>   
			</div>
		</div>

		<div id="footer">CookBooks 2014</div>
	
	</div>
</body>
</html>
