<?php
require_once("sesion.php");
sesion();
?>
<html>
<head>
	<meta charset=utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="../css/style.css" type="text/css" rel="stylesheet">
	<!--<link href="images.jpg" type="img/icon" rel="shortcut icon">-->
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
					<li>
						<a href="../aboutUs.php">Conocenos</a>
					</li>
					<li>
						<a href="../contacto.php">Contacto</a>
					</li>
					<li>
						<a href="../abm.php">ABM</a>
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
					
				 		echo '<h5><a href="../abm.php?abm=Autor">Autor</a></h5>
						<h5><a href="../abm.php?abm=Etiqueta">Etiqueta</a></h5>
					 	<h5><a href="../abm.php?abm=Libro">Libros</a></h5>';
			
					?>
					
								
			</div>
			<div id="main-content">
				<?php if(isset($_GET["abm"])){
						$abm=$_GET["abm"];
						//comienzo formulario de abm
						echo '<form onsubmit="return validar_formulario(this);" action=';
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
		
		echo '<table>';
	//altas/modificacion todo menos vehiculo
	
		echo '<tr>';//comienzo encabezado normal
		
		//input de AM
		switch($abm){

			
			case 'Etiqueta':
				echo '<td>'.$abm.': </td>';
				echo '<td>';
				echo '<input id="focus" type="text" name="'.$abm.'" ';
				if(isset($_GET["nombre"])){
					echo 'value="'.$_GET["nombre"].'"';
				}
				echo '/><span id="obligatorio">*</span>';
				//autofoco js
				echo '<script type="text/javascript">
					document.getElementById( "focus" ).focus();
					function validar_formulario(form){
						if(form.'.$abm.'.value.length == 0){
						form.'.$abm.'.focus();
						alert("Introduzca '.$abm.'."); 
						return false;
						}
						return true;
					}
				</script>';
			break;
			case 'Autor':
				echo '<td>Nombre: </td>';
				echo '<td>';
				echo '<input id="focus" type="text" name="nombre" ';
				if(isset($_GET["nombre"])){
					echo 'value="'.$_GET["nombre"].'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr><td>Apellido: </td> <td>';
				echo '<input id="ape" type="text" name="apellido" ';
				if(isset($_GET["apellido"])){
					echo 'value="'.$_GET["apellido"].'"';
				}
				echo '/><span id="obligatorio">*</span>';
				echo '<script type="text/javascript">
					document.getElementById( "focus" ).focus();
					function validar_formulario(form){
						if(form.nombre.value.length == 0){
						form.nombre.focus();
						alert("Introduzca nombre."); 
						return false;
						}
						if(form.apellido.value.length == 0){
						form.apellido.focus();
						alert("Introduzca apellido."); 
						return false;
						}
						return true;
					}
				</script>';
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
			//cantPaginas
				echo '<td>Cantidad de paginas: </td>';
				echo '<td>';
				echo '<input id="cantPaginas" type="number" name="cantPaginas" ';
				if(isset($cantPaginas)){
					echo 'value="'.$cantPaginas.'"';
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
			//isbn
				echo '<td>ISBN: </td>';
				echo '<td>';
				echo '<input id="isbn" type="text" maxlength="13" name="isbn" ';
				if(isset($isbn)){
					echo 'value="'.$isbn.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
			//nombre
				echo '<td>Nombre: </td>';
				echo '<td>';
				echo '<input id="nombre" type="text" name="nombre" ';
				if(isset($nombre)){
					echo 'value="'.$nombre.'"';
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
			//precio
				echo '<td>Precio: </td>';
				echo '<td>';
				echo '<input id="precio" type="number" step="0.05" name="precio" ';
				if(isset($precio)){
					echo 'value="'.$precio.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
			//resumen
				echo '<td>Resumen: </td>';
				echo '<td>';
				echo '<input id="resumen" type="textarea" name="resumen" ';
				if(isset($resumen)){
					echo 'value="'.$resumen.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
			//stock
			    echo '<td>Stock: </td>';
				echo '<td>';
				echo '<input id="stock" type="textarea" name="stock" ';
				if(isset($stock)){
					echo 'value="'.$stock.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
			//stockminimo
				echo '<td>Stock minimo: </td>';
				echo '<td>';
				echo '<input id="stockMinimo" type="textarea" name="stockMinimo" ';
				if(isset($stockMinimo)){
					echo 'value="'.$stockMinimo.'"';
				}
				echo '/><span id="obligatorio">*</span></td></tr><tr>';
			//autor/es
				echo '<td>Autor/es: <p>Mantenga la tecla ctrl apretada<br/>para seleccionar varios autores</p></td>';
				echo '<td><select multiple id="autor" name="idAutor[]">';
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
				echo '<td><select multiple id="etiqueta" name="idEtiqueta[]">';
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
				echo '<script type="text/javascript">
					document.getElementById( "cantPaginas" ).focus();
					function validar_formulario(form){
						if(form.cantPaginas.value.length == 0){
						form.cantPaginas.focus();
						alert("Introduzca cantidad de paginas."); 
						return false;
						}
						if(form.idioma.value.length == 0){
						form.idioma.focus();
						alert("Introduzca idioma."); 
						return false;
						}
						if(form.idioma.value.length == 0){
						form.idioma.focus();
						alert("Introduzca idioma."); 
						return false;
						}
						if(form.isbn.value.length != 13){
						form.isbn.focus();
						alert("El ISBN es demasiado corto."); 
						return false;
						}
						if(isNaN(form.isbn.value)){
						form.isbn.focus();
						alert("El ISBN solo debe contener numeros."); 
						return false;
						}
						if(form.nombre.value.length == 0){
						form.nombre.focus();
						alert("Introduzca nombre."); 
						return false;
						}
						if(form.origen.value.length == 0){
						form.origen.focus();
						alert("Introduzca origen."); 
						return false;
						}
						if(form.precio.value.length == 0){
						form.precio.focus();
						alert("Introduzca precio."); 
						return false;
						}
						if(form.resumen.value.length == 0){
						form.resumen.focus();
						alert("Introduzca resumen."); 
						return false;
						}
						if(form.stock.value.length == 0){
						form.stock.focus();
						alert("Introduzca stock."); 
						return false;
						}
						if(form.stockMinimo.value.length == 0){
						form.stockMinimo.focus();
						alert("Introduzca stock minimo."); 
						return false;
						}
						if(document.getElementById( "autor" ).value == ""){
						document.getElementById( "autor" ).focus();
						alert("Debe agregar por lo menos un autor."); 
						return false;
						}
						if(document.getElementById( "etiqueta" ).value == ""){
						document.getElementById( "etiqueta" ).focus();
						alert("Debe agregar por lo menos una etiqueta."); 
						return false;
						}
						return true;
					}
				</script>';
			break;
		}
		echo '</td>'; //fin inputs normal
		echo '</tr>'; //fin encabezado normal
	
	echo '<br><tr>';
	echo '<td></td>';
	echo '<td><input type="submit" name="Enviar" value="Enviar" />';
	echo '<input type="button" name="Cancelar" value="Cancelar" onClick="self.history.back();"/></td></tr>';
	echo '</table>';	
	echo '<span id= "obligatorio">Los campos con * deben llenarse obligatoriamente</span>';
	echo '</fieldset>';
	echo '</form>';	
}
?>
			</div>
		</div>
		</br>

		<div id="footer">CookBooks 2014</div>
	
	</div>
	
</body>
</html>

