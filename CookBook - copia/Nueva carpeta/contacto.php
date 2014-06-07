
<?php
require_once("sesion.php");
sesion();
?>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="content-type"></meta>
	<title>Concesionaria PHP</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<link href="images.jpg" type="img/icon" rel="shortcut icon">
	<script type="text/javascript">
		function validar_campos(form){
			if(form.nombre.value.length == 0) {
				form.nombre.focus();
      	   	  	alert("Introduzca un nombre."); 
            	return false;  
        	}
        	var mail = form.email.value;
        	if(mail.length == 0)
        	{
        		form.email.focus();
        		alert("Introduzca un email válido");
        		return false;
        	}
        	if (!(/^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i.test(mail)))
        	{
        		form.email.focus();
        		alert("Introduzca un email válido");
        		return false;
        	}
        	
        	if(form.comentarios.value.length == 0){
        		form.comentarios.focus();
      	   	  	alert("Debe incluir un comentario."); 
            	return false; 
        	}
        	return true;            
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
				
			</div>
			
			<div id="main-content">
				<?php
				$message="'noooooo'";
				if(!isset($_POST["nombre"])){
                        echo '<form id="contacto" name="contacto" method="post" action="contacto.php" onsubmit="return validar_campos(this);">
							<fieldset style="padding:15px;width:500px;">
							<legend>Contacto:</legend>
							<label>Nombre:</label><input type="text" name="nombre" autofocus/><br><br>
							<label>Email:</label><input type="text" name="email" /><br><br>
							<label>Telefono:</label><input type="tel" name="telefono"/><br><br>
							<label>Comentarios:</label><textarea type="textarea" name="comentarios" rows=10 cols=50 style="width: 342px; height: 184px;"/></textarea><br><br>
							<input type="submit" name="submit" value="Enviar" style="margin-left:360px;"> <br><br>
							</fieldset>
                        </form>';
				}else{
					if(($_POST["nombre"]=="concesionaria")&&($_POST["email"]=="grupo17@info.php")&&($_POST["comentarios"]=="quiero loguear")){
						echo '<script language=javascript> self.location="login.php"</script>';
					}else{
						echo'<p> Hola, '.$_POST['nombre'].'<br>Hemos recibido su consulta, en breve le responderemos en su casilla de mensaje: '.$_POST["email"];
						if(($_POST['telefono'])!=""){echo "o nos comunicaremos al telefono: ".$_POST["telefono"];} 
						echo '</p>';
					}
				}

				?>
                                                                     
             </div>
             <br>
		</div>

		<div id="footer">Jonatan Nahuel Llerena Suster <a href="mailto:jnllerenas@gmail.com">jnllerenas@gmail.com</a> Walter Kato <a href="mailto:walterk_88@hotmail.com">walterk_88@hotmail.com</a></div>
	
	</div>
</body>
</html>
