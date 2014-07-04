<?php
require_once("php/sesion.php");
require_once("php/SQLfunctions.php");

sesion();
if(isset($_SESSION["categoria"])){
	header("location:menuUsuario.php");
}
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="img/icon.png" type="img/icon" rel="shortcut icon">
	<script src="js/validar_formularios.js" language="javascript"></script>
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
			<form name="login" autocomplete="on" onsubmit="return validar_altaCliente(this);" method="POST" action="php/insertarUsuario.php">
							<fieldset style="margin-left:auto;margin-right:auto;width:500px">
							<legend>Registrarse:</legend>
							<table rules ="rows">
								<tr><td class="label"><label>Usuario:</label></td><td class="input"><input type="text" autofocus autocomplete="off" name="nombreDeUsuario" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Contraseña:</label></td><td class="input"><input type="password" autocomplete="off" name="password"><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Repita Contraseña:</label></td><td class="input"><input type="password" autocomplete="off" name="contraseña2" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Nombre:</label></td><td class="input"><input type="text" name="nombre" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Apellido:</label></td><td class="input"><input type="text" name="apellido" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Mail:</label></td><td class="input"><input type="mail" name="mail" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>DNI:</label></td><td class="input"><input type="text" name="dni_cuit" maxlength="11" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Teléfono:</label></td><td class="input"><input type="tel" name="tel" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Código Postal:</label></td><td class="input"><input type="text" name="cp" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Localidad:</label></td><td class="input"><input type="text" name="localidad" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Calle:</label></td><td class="input"><input type="text" name="calle" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Número:</label></td><td class="input"><input type="number" name="nro" ></td></tr>
								<tr><td class="label"><label>Piso:</label></td><td class="input"><input type="number" name="piso" ></td></tr>
								<tr><td class="label"><label>Departamento:</label></td><td class="input"><input type="text" name="depto" ></td></tr>
								<tr><td class="label"></td><td class="input"><input type="submit" name="enviar" value="Crear Usuario" style=""></td></tr>	
							</table>
							<span id= "obligatorio">Los campos con * deben llenarse obligatoriamente</span>
							</fieldset>
						
                 </form>   
			</div>
		</div>

		<div id="footer">CookBooks 2014</div>
	
	</div>
</body>
</html>