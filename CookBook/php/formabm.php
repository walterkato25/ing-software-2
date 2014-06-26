<?php
require_once("sesion.php");
sesion();
if($_SESSION["categoria"]!="administrador"){
	header("location:../index.php");
}
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
					
					<li><a href="../index.php">
						Inicio</a>
					</li>
					<!--<li>
						<a href="../aboutUs.php">Conocenos</a>
					</li>
					<li>
						<a href="../contacto.php">Contacto</a>
					</li>-->
					<?php
						if($_SESSION){
							if($categoria=="administrador"){
								echo '<li id="actual" >
								<a href="../abm.php">ABM</a>
								</li>';
							}
							echo'</ul><ul id=navegacion style=float:right>
							<li>
							<a href="../menuUsuario.php">Usuario:  '.$usuario.' </a>
							</li>
							<li>
							<a href="desconectarUsuario.php">Logout</a>
							</li>';
						}else{
							echo'<ul id=navegacion style=float:right>
							<li>
							<a href="../login.php">Login</a>
							</li>';
						}
						
					?>
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
	
		
		
		//input de AM
		switch($abm){
			case 'Etiqueta':
				if (isset($_GET["id"])){
					$idEtiqueta=$_GET["id"];
					$sql="SELECT * FROM $abm WHERE idEtiqueta= $idEtiqueta";
					$query=mysql_query($sql);
					while ($row = mysql_fetch_array($query)){
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
					$sql="SELECT * FROM $abm WHERE idAutor= $idAutor";
					$query=mysql_query($sql);
					while ($row = mysql_fetch_array($query)){
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
					$sql="SELECT * FROM $abm WHERE idLibro= $idlibro";
					$query=mysql_query($sql);
					while ($row = mysql_fetch_array($query)){
						$cantPaginas =  $row["cantPaginas"];
						$idioma = $row["idioma"];
						$isbn = $row["isbn"];
						$nombre = $row["nombre"];
						$origen = $row["origen"];
						$precio = $row["precio"];
						$resumen = $row["resumen"];
						$stock = $row["stock"];
						$stockMinimo = $row["stockMinimo"];
						$imagen= $row["img"];
					}
					$sql= "SELECT * FROM libroAutor WHERE idLibro= $idlibro";
					$query=mysql_query($sql);
					$arrayautor=array();
					while ($row = mysql_fetch_array($query)){
						$arrayautor[]= $row["idAutor"];
					}
					$sql= "SELECT * FROM libroEtiqueta WHERE idLibro= $idlibro";
					$query=mysql_query($sql);
					$arrayetiqueta=array();
					while ($row = mysql_fetch_array($query)){
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
				$sql = "SELECT * FROM `Autor` order by `apellido`";
				$query = mysql_query($sql);
				while ($row  = mysql_fetch_assoc($query)) {
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
				$sql = "SELECT * FROM `Etiqueta` Order by `Etiqueta`";
				$query = mysql_query($sql);
				while ($row  = mysql_fetch_assoc($query)) {
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
				echo '/><span id="obligatorio">*</span></td><td style="width:55"></td></tr><tr>';
				//precio
				echo '<td>Precio: </td>';
				echo '<td>';
				echo '<input id="precio" min = 0 type="number" step="0.05" name="precio" ';
				if(isset($precio)){
					echo 'value="'.$precio.'"';
				}
				echo '/><span id="obligatorio">*</span></td><td style="width:55"></td></tr><tr>';
				//stock
			    echo '<td>Stock: </td>';
				echo '<td>';
				echo '<input id="stock" min = 0 type="number" name="stock" ';
				if(isset($stock)){
					echo 'value="'.$stock.'"';
				}
				echo '/><span id="obligatorio">*</span></td><td style="width:55"></td></tr><tr>';
				//stockminimo
				echo '<td>Stock minimo: </td>';
				echo '<td>';
				echo '<input id="stockMinimo" min= 0 type="number" name="stockMinimo" ';
				if(isset($stockMinimo)){
					echo 'value="'.$stockMinimo.'"';
				}
				echo '/><span id="obligatorio">*</span></td><td style="width:55"></td></tr>';
				//cantPaginas
				echo '<tr><td>Cantidad de paginas: </td>';
				echo '<td>';
				echo '<input id="cantPaginas" min = 0 type="number" name="cantPaginas" ';
				if(isset($cantPaginas)){
					echo 'value="'.$cantPaginas.'"';
				}
				echo '/><span id="obligatorio">*</span></td><td style="width:55"></td></tr>';
				?>
				<tr>
					<td>
						Imagen: </br></br>
						<a href="../cargarPortada.php" id="agregar">Nueva</a> 
					</td>
					<td>
						<select id="imagen" name="img" onchange="mostrarImagen();">
							<option></option>
					<?php
				    $directory="/portadas";
				    $dirint = dir('../'.$directory);
				    while (($archivo = $dirint->read()) !== false)
				    {
				        if (preg_match("(gif)i", $archivo) || preg_match("(jpg)i", $archivo) || preg_match("(png)i", $archivo)){
				            echo '<option value="'.$directory."/".$archivo.'"';
				            	if(isset($imagen)){
				            		if($imagen==$directory.'/'.$archivo){
				            			echo ' selected ';
				            		}
				            	}
				            echo '>'.$archivo.'</option>';
				        }
				    }
				    $dirint->close();
					?>
				
						</select><span id="obligatorio">*</span>
					</td>
					<td style="width:55;height:55;">
						<img id="imgelegida" style="max-width:50; max-height:50"
						<?php
							if(isset($imagen)){
								echo "src='..$imagen'";
							}
						?>
						>
					</td>
				</tr>
<script>
function mostrarImagen(){
	var img=document.getElementById("imgelegida");
	var src=document.getElementById("imagen").value;
	img.src='..'+src;
}
</script>
				<?php
				echo '</table></div>';
				echo "<br/>";
				//resumen
				echo '<div id="resumen" style="float:left">';
				echo '<table><tr><td>Resumen: </td>';
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

