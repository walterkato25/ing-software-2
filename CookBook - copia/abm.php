<?php
require_once("php/sesion.php");
sesion();
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="img/icon.jpg" type="img/icon" rel="shortcut icon">
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="index.php"><img src="img/Imagen1.png" height=100% alt="logo" border="0px"></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li id="navegacion">
						<a href="index.php">Inicio</a>
					</li>
					<!--<li id="navegacion">
						<a href="aboutUs.php">Conocenos</a>
					</li>
					<li id="navegacion">
						<a href="contacto.php">Contacto</a>
					</li>-->
					<li id="actual">
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

			<div id="sub-menu">
				<ul id="navegacion">
					<li <?php 
if(isset($_GET["abm"])){
	if($_GET["abm"]=="Autor"){
		echo ' id="sub-actual" ';
	}
}
?>><a href="abm.php?abm=Autor">Autores</a></li>
					<li
					<?php 
if(isset($_GET["abm"])){
	if($_GET["abm"]=="Etiqueta"){
		echo ' id="sub-actual" ';
	}
}
?>><a href="abm.php?abm=Etiqueta">Etiquetas</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Libro"){
								echo ' id="sub-actual" ';
							}
						}
?>>
					<a href="abm.php?abm=Libro">Libros</a></li>				
			</div>
		</div>

				<div id="content">
			<div id="main-content">
				<?php
					
					if(isset($_GET["abm"])){
						echo '<fieldset style="margin:auto; width; float:left">';
						$abm=$_GET["abm"];
						if($abm=='Autor'){
							echo '<legend>'.$abm.'es </legend>';
						}else{
							echo '<legend>'.$abm.'s </legend>';
						}
						$tabla=$abm;
						$id='id'.$abm;
						switch($abm){
							case 'Etiqueta':
							$sql = "SELECT * FROM `$tabla` order by `$abm`";
							break;
							case 'Autor':
							$sql = "SELECT * FROM `$tabla` order by `apellido`";
							break;
							case 'Libro':
							$sql = "SELECT * FROM `$tabla` order by `nombre`";
							break;
						}
						
						$query = mysql_query($sql);//se hace la consulta						
						echo '<table>';
						echo '<tr><th>';
						if($abm=='Autor'){
							echo 'Nombre</th><th>Apellido';
						}
						if($abm=='Libro'){
							echo 'Nombre</th><th>Autor</th><th>Etiquetas';
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
								case 'Libro':
								$a= $row["nombre"];
								$b= $row[$id];
								$sql= "SELECT apellido, nombre FROM `autor` WHERE `idAutor` in (SELECT idAutor FROM `libroautor` WHERE `idLibro`=$b)";
								$queryautor= mysql_query($sql);
								$cantAutores = mysql_num_rows($queryautor);
								$autor = mysql_fetch_assoc($queryautor);
								$c= $autor["apellido"].', '.$autor["nombre"];
								echo "<tr><td>$a</td>";
								echo "<td>$c";
								if ($cantAutores > 1){
									echo " y otros...";
								}
								echo "</td>";
								$sql= "SELECT etiqueta FROM `etiqueta` WHERE `idEtiqueta` in (SELECT idEtiqueta FROM `libroetiqueta` WHERE `idLibro`=$b)";
								$queryetiqueta= mysql_query($sql);
								$d='';
								while($etiqueta = mysql_fetch_array($queryetiqueta)){
									if($d!=''){
										$d=$d.', ';
									}
									$d = $d.$etiqueta["etiqueta"]; 
								}
								echo "<td>$d</td>";
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
						echo '</fieldset>';
					}else{
						echo "<h4><p>Seleccione un campo para realizar alta, baja o modificación</p></h4>";
					}
					
			?>
			</div>
			<br/>
		</div>
		<!--<div id="footer">CookBooks 2014</div>-->	
	</div>
	
</body>
</html>
