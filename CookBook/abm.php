<?php
require_once("php/sesion.php");
sesion();
?>
<html>
<head>
	<meta charset=utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<!--<link href="images.jpg" type="img/icon" rel="shortcut icon">-->
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
				<?php
					
				 		echo '<h5><a href="abm.php?abm=Autor">Autores</a></h5>
						<h5><a href="abm.php?abm=Etiqueta">Etiquetas</a></h5>
					 	<h5><a href="abm.php?abm=Libro">Libros</a></h5>';
			
					?>
					
								
			</div>
			<div id="main-content">
				<?php
					
					if(isset($_GET["abm"])){
						echo '<fieldset style="margin:auto; width">';
						$abm=$_GET["abm"];
						if($abm=='Autor'){
							echo '<legend>'.$abm.'es </legend>';
						}else{
							echo '<legend>'.$abm.'s </legend>';
						}
						$tabla=$abm;
						$id='id'.$abm;
						$sql = "SELECT * FROM `$tabla`";
						$query = mysql_query($sql);//se hace la consulta						
						echo '<table>';
						echo '<tr><th>';
						if($abm=='Autor'){
							echo 'Nombre</th><th>Apellido';
						}
						
						echo'</th><th>Acciones</th></tr>';
						while ($row  = mysql_fetch_assoc($query)) {
							switch($abm){
								case 'Etiqueta':
								$a = $row["$abm"];
								$b = $row["$id"];
								echo "<tr><td>$a</td>";
								break;
								case 'Autor':
								$a= $row["nombre"];
								$c= $row["apellido"];
								$b = $row["$id"];
								echo "<tr><td>$a</td>";
								echo "<td>$c</td>";
								break;
							}
							
							$b = $row["$id"];
							echo '<td><a onclick="if(!confirm(';
							echo " 'Desea borrar el elemento?' ";
							echo '))return false"; href="php/bajas.php?abm='.$abm.'&id='.$b.'"><img src="img/eliminar.png" title="Eliminar" /></a>';
							echo '<a href="php/formabm.php?abm='.$abm.'&id='.$b.'&nombre='.$a;
							if($abm=='Autor'){
								echo '&apellido='.$c;
							}
							echo '"><img src="img/editar.png" title="Editar"/></a>';
						}
						echo "<tr><td><span ><a id='agregar' href=\"php/formabm.php?abm=$abm";
						echo "\">Agregar... </span></td></tr></table>";

					}
					echo '</fieldset>';
			?>
			</div>
		</div>
		<div id="footer">CookBooks 2014</div>	
	</div>
	
</body>
</html>
