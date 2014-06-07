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
			
				<?php
				
				$usuario = $_SESSION['Usuario'];
				echo '<form id="listar" method="get" action="abm.php"><fieldset><legend>Alta:</legend>';
				
				echo '<label>Seleccione marca:</label>';
				echo '<select name="idmarca">';
				$sql = "SELECT * FROM `Marcas`";
				$query = mysql_query($sql);
				echo '<option value=""></option>';
				while ($row  = mysql_fetch_assoc($query)) {
					$a = $row['Marca'];
					$b = $row['idMarca'];
					echo '<option value="'.$b.'">'.$a.'</option>';
			
				}
			    
			    
				echo '</select><br><br><label>Seleccione Modelo:</label><br>';
				echo'<select name="idmodelo">';
				$sql = "SELECT * FROM `Modelos`";
				$query = mysql_query($sql);
				echo '<option value=""></option>';
				while ($row  = mysql_fetch_assoc($query)) {
					$a = $row['Modelo'];
					$b = $row['idModelo'];
					echo '<option value="'.$b.'">'.$a.'</option>';
				}
				echo '</select><br><br>';
			
				if ($usuario == 'admin') //lo muestra solo si es admin
				{
				echo '<br><label>Seleccione Tipo:</label>';
				echo'<br><select name="idtipo">';
				$sql = "SELECT * FROM `Tipos`";
				$query = mysql_query($sql);
				echo '<option value=""></option>';
				while ($row  = mysql_fetch_assoc($query)) {
					$a = $row['Tipo'];
					$b = $row['idTipo'];
					echo '<option value="'.$b.'">'.$a.'</option>';
				}
				echo '</select><br><br>';

				
				echo '<br><label>Seleccione Caracteristica:</label>';
				echo'<br><select name="idtipo">';
				$sql = "SELECT * FROM `caracteristicas`";
				$query = mysql_query($sql);
				echo '<option value=""></option>';
				while ($row  = mysql_fetch_assoc($query)) {
					$a = $row['Caracteristica'];
					$b = $row['idCaracteristica'];
					echo '<option value="'.$b.'">'.$a.'</option>';
				}
				}
				
				echo '</select><br><br>';
				echo '<br><input type="submit" name="filtrar" value="Ver"></form>';
				
				?>
				
			</div>
			<div id="main-content">
					
			
			</div>
		</div>

		<div id="footer">Jonatan Nahuel Llerena Suster <a href="mailto:jnllerenas@gmail.com">jnllerenas@gmail.com</a> Walter Kato <a href="mailto:walterk_88@hotmail.com">walterk_88@hotmail.com</a></div>
	
	</div>
</body>
</html>
