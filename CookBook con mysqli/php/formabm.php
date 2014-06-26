<?php
require_once("sesion.php");
sesion();
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="../css/style.css" type="text/css" rel="stylesheet">
	<link href="../img/icon.jpg" type="img/icon" rel="shortcut icon">
	<script src="../js/validar_formularios.js" language="javascript"></script>
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="../index.php"><img src="../img/Imagen1.png" height=100% alt="logo" border="0px"></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li>
						<a href="../index.php">Inicio</a>
					</li>
					<!--<li>
						<a href="../aboutUs.php">Conocenos</a>
					</li>
					<li>
						<a href="../contacto.php">Contacto</a>
					</li>-->
					<li id="actual">
						<a  href="../abm.php">ABM</a>
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
?>><a href="../abm.php?abm=Autor">Autores</a></li>
					<li
					<?php 
if(isset($_GET["abm"])){
	if($_GET["abm"]=="Etiqueta"){
		echo ' id="sub-actual" ';
	}
}
?>><a href="../abm.php?abm=Etiqueta">Etiquetas</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Libro"){
								echo ' id="sub-actual" ';
							}
						}
?>>
					<a href="../abm.php?abm=Libro">Libros</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Usuario"){
								echo ' id="sub-actual" ';
							}
						}
?>>
					<a href="../abm.php?abm=Usuario">Usuarios</a></li>				
			</div>
		</div>

				<div id="content">
			
			<div id="main-content">
				<?php if(isset($_GET["abm"])){
						$abm=$_GET["abm"];
						if($abm=="Usuario"){
							require_once("editarPerfil.php");
							getCliente($_GET["id"]);
						}
						//comienzo formulario de abm
						echo '<form onsubmit="return validar_formulario_'.$abm.'(this);" action=';
						if(isset($_GET['id'])){
							echo '"update.php"';	
						}else{
							echo '"insert.php"';
						}
						echo ' method="POST" name=';
						if(isset($_GET['id'])){
							echo '"modificacion"';
						}else{
							echo '"alta"';
						}
						echo '>';
						echo '<fieldset style="margin:auto; width">';
						echo '<legend>';
						if (isset($_GET["id"])){echo 'Modificación';}
						else{echo 'Alta';}
						echo ' de '.$abm.' </legend><br>';
						//comienzo de tabla

	
		
		if(isset($_GET["id"])){
			echo '<input type="hidden" name="id" value="'.$_GET["id"].'" />';//oculto para modificacion
		}
		echo '<input type="hidden" name="abm" value="'.$abm.'" />'; //oculto para alta
		
		if($abm != "Libro"){echo '<table>';
	echo '<tr>';}//comienzo encabezado normal}
	
		
		$link = mysqli_connect("localhost", "root", "","cookbook");
		//input de AM
		switch($abm){
			case 'Etiqueta':
				if (isset($_GET["id"])){
					$idEtiqueta=$_GET["id"];
					$result = mysqli_query($link,"SELECT * FROM $abm WHERE idEtiqueta= $idEtiqueta");
		            if (!$result) {
				    printf("Error: %s\n", mysqli_error($link));
					exit(); }
					
					while ($row = mysqli_fetch_array($result)){
						$etiqueta = $row["Etiqueta"];
					}
				}
				echo '<td>'.$abm.': </td>';
				echo '<td>';
				echo '<input autofocus id="focus" type="text" name="'.$abm.'" ';
				if(isset($etiqueta)){
					echo 'value="'.$etiqueta.'"';

				}
				echo '/><span id="obligatorio">*</span>';
			break;
			
			case 'Autor':
				if (isset($_GET["id"])){
					$idAutor=$_GET["id"];
					$result = mysqli_query($link,"SELECT * FROM $abm WHERE idAutor= $idAutor");
					if (!$result) {
				    printf("Error: %s\n", mysqli_error($link));
					exit();}
					
					while ($row = mysqli_fetch_array($result)){
						$nombre = $row["nombre"];
						$apellido = $row["apellido"];
					}
				}
				echo '<td>Nombre: </td>';
				echo '<td>';
				echo '<input autofocus id="focus" type="text" name="nombre" ';
				if(isset($nombre)){
					echo 'value="'.$nombre.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr><td>Apellido: </td> <td>';
				echo '<input id="ape" type="text" name="apellido" ';
				if(isset($apellido)){
					echo 'value="'.$apellido.'"';
				}
				echo '/><span id="obligatorio">*</span>';
				break;
			case 'Libro':
				if (isset($_GET["id"])){
					$idlibro=$_GET["id"];
					$result = mysqli_query($link,"SELECT * FROM $abm WHERE idLibro= $idlibro");
                    if (!$result) {
				    printf("Error: %s\n", mysqli_error($link));
					exit();}
					
					while ($row = mysqli_fetch_array($result)){
						$cantPaginas =  $row["cantPaginas"];
						$idioma = $row["idioma"];
						$isbn = $row["isbn"];
						$nombre = $row["nombre"];
						$origen = $row["origen"];
						$precio = $row["precio"];
						$resumen = $row["resumen"];
						$stock = $row["stock"];
						$stockMinimo = $row["stockMinimo"];
					}
					$result = mysqli_query($link, "SELECT * FROM libroAutor WHERE idLibro= $idlibro");

					$arrayautor=array();
					while ($row = mysqli_fetch_array($result)){
						$arrayautor[]= $row["idAutor"];
					}
					$result = mysqli_query($link,"SELECT * FROM libroEtiqueta WHERE idLibro= $idlibro");

					$arrayetiqueta=array();
					while ($row = mysqli_fetch_array($result)){
						$arrayetiqueta[]= $row["idEtiqueta"];
					}

				}
			
				echo '<div id="libro-text" style="float:left">';
				//nombre
				echo '<table><tr><td>Nombre: </td>';
				echo '<td>';
				echo '<input autofocus id="nombre" type="text" name="nombre" ';
				if(isset($nombre)){
					echo 'value="'.$nombre.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				//idioma
				echo '<td>Idioma: </td>';
				echo '<td>';
				echo '<input id="idioma" type="text" name="idioma" ';
				if(isset($idioma)){
					echo 'value="'.$idioma.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				//origen
				echo '<td>Origen: </td>';
				echo '<td>';
				echo '<input id="origen" type="text" name="origen" ';
				if(isset($origen)){
					echo 'value="'.$origen.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				//autor/es
				echo '<td>Autor/es: <p>Mantenga la tecla ctrl apretada<br/>para seleccionar varios autores</p></td>';
				echo '<td><select multiple id="autor" name="idAutor[]" >';
				$result = mysqli_query($link, "SELECT * FROM `Autor` order by `apellido`");
				while ($row = mysqli_fetch_array($result)) {
					$apellidoynombre = $row['apellido'].', '.$row['nombre'];
					$id = $row['idAutor'];
					echo '<option value="'.$id.'" ';
					if (isset($arrayautor)){
						if(in_array($id, $arrayautor)){
							echo 'selected';
						}
					}
					echo '>'.$apellidoynombre.'</option>';
				}
				echo '</select><span id="obligatorio">*</span>';
				echo '</td><td><a id="agregar" href="formabm.php?abm=Autor">Nuevo</a>';
				echo '</td></tr><tr>';
				//etiqueta/s
				echo '<td>Etiqueta/s: <p>Mantenga la tecla ctrl apretada<br/>para seleccionar varias etiquetas</p></td>';
				echo '<td><select multiple id="etiqueta" name="idEtiqueta[]" >';
				$result = mysqli_query($link,"SELECT * FROM `Etiqueta` Order by `Etiqueta`");
				
				while ($row = mysqli_fetch_array($result)) {
					$etiqueta = $row['Etiqueta'];
					$id = $row['idEtiqueta'];
					echo '<option value="'.$id.'" ';
					if (isset($arrayetiqueta)){
						if(in_array($id, $arrayetiqueta)){
							echo 'selected';
						}
					}
					echo '>'.$etiqueta.'</option>';
				}
				echo '</select><span id="obligatorio">*</span>';
				echo '</td><td><a id="agregar" href="formabm.php?abm=Etiqueta">Nueva</a>';
				echo '</tr></table></div>';
				echo '<div id="libro-number" style="float:right"><table><tr>';
				//isbn
				echo '<td>ISBN: </td>';
				echo '<td>';
				echo '<input id="isbn" type="text" maxlength="13" name="isbn" ';
				if(isset($isbn)){
					echo 'value="'.$isbn.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				//precio
				echo '<td>Precio: </td>';
				echo '<td>';
				echo '<input id="precio" min = 0 type="number" step="0.05" name="precio" ';
				if(isset($precio)){
					echo 'value="'.$precio.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				//stock
			    echo '<td>Stock: </td>';
				echo '<td>';
				echo '<input id="stock" min = 0 type="number" name="stock" ';
				if(isset($stock)){
					echo 'value="'.$stock.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				//stockminimo
				echo '<td>Stock minimo: </td>';
				echo '<td>';
				echo '<input id="stockMinimo" min= 0 type="number" name="stockMinimo" ';
				if(isset($stockMinimo)){
					echo 'value="'.$stockMinimo.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				//cantPaginas
				echo '<td>Cantidad de paginas: </td>';
				echo '<td>';
				echo '<input id="cantPaginas" min = 0 type="number" name="cantPaginas" ';
				if(isset($cantPaginas)){
					echo 'value="'.$cantPaginas.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
				echo '</tr></table></div>';
				echo "<br/>";
				echo '<div id="resumen" style="float:left"><table><tr>';
				
				//resumen
				echo '<td>Resumen: </td>';
				echo '<td>';
				echo '<textarea id="resumen" rows=10 cols=50 style="width: 700px; height: 219px;" name="resumen" ';
				
				echo '/>';
				if(isset($resumen)){
					echo $resumen;
				}
				echo '</textarea><span id="obligatorio">*</span></td></tr><tr>';
				echo '</tr></table>';
			break;
		}
		
	if($abm != "Libro"){
		echo '</td>'; //fin inputs normal
		echo '</tr>'; //fin encabezado normal
	echo '<br><tr>';
	echo '<td></td><td>';
	}else{
		echo '<br>';
		echo '<div style="float:right">';
	}
	echo '<input id="submit" type="submit" name="Enviar" value="Enviar" />';
	echo '<input type="button" name="Cancelar" value="Cancelar" onClick="self.history.back();"/>';
	if($abm != "Libro"){
		echo '</td></tr></table>';	
	}else{
		echo '</div></div>';
	}
	echo '<br>';
	echo '<span id= "obligatorio">Los campos con * deben llenarse obligatoriamente</span>';
	echo '</fieldset>';
	echo '</form>';	
}
?>
			</div>	<br/>
		</div>
	

		
		<!--<div id="footer">CookBooks 2014</div>-->
	</div>
	
</body>
</html>

