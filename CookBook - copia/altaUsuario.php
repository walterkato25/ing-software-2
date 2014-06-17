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
					<li id="actual">
						<a href="index.php">Inicio</a>
					</li>
					<!--<li>
						<a href="aboutUs.php">Conocenos</a>
					</li>
					<li>
						<a href="contacto.php">Contacto</a>
					</li>-->
					<li>
						<a href="abm.php">ABM</a>
					</li>
					<li>
						<a href="login.php">Login</a>    
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
			<form id="contacto" name="login" method="post" action="php/validarSesion.php">
							<fieldset style="padding:15px;width:300px">
							<legend>Registrarse:</legend>
							<label>Usuario:</label><input id="focus" type="text" name="usuario" class="required"><span id="obligatorio">*</span><br><br>
							<label>Contraseña:</label><input id="focus" type="password" name="contraseña" class="required"><span id="obligatorio">*</span><br><br>
							<script type="text/javascript">
								document.getElementById( "contacto" ).focus();
								function validar_formulario(form){
								if(form.usuario.value.length == 0){
									form.usuario.focus();
									alert("Introduzca usuario."); 
									return false;
								}
								if(form.contraseña.value.length == 0){
									form.contraseña.focus();
									alert("Introduzca contraseña."); 
								return false;
								}
								return true;
								}
							</script>
							<label>Repita Contraseña:</label><input id="focus" type="password" name="contraseña2" class="required"><span id="obligatorio">*</span><br><br>
							<label>Nombre:</label><input id="focus" type="text" name="nombre" class="required"><span id="obligatorio">*</span><br><br>
							<label>Apellido:</label><input id="focus" type="text" name="apellido" class="required"><span id="obligatorio">*</span><br><br>
							<label>Mail:</label><input id="focus" type="text" name="mail" class="required"><span id="obligatorio">*</span><br><br>
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