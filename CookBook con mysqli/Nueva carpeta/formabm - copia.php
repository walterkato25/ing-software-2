<HTML>
	<HEAD><link href="../css/style.css" type="text/css" rel="stylesheet">
	<meta content="text/html" charset="utf-8" http-equiv="content-type"></meta>
	</HEAD>
	<BODY>
		<div id="content" style="padding:20px; width:650px; background-color:#EBEDF4;margin:auto;">
<?php
require_once("sesion.php");
sesion();

require_once("config.php");


if(isset($_GET["abm"])){
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
				echo '/>';
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
				echo '/></td></tr><tr><td>Apellido: </td> <td>';
				echo '<input id="ape" type="text" name="apellido" ';
				if(isset($_GET["apellido"])){
					echo 'value="'.$_GET["apellido"].'"';
				}
				echo '/>';
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
			//cantPaginas
				echo '<td>Cantidad de paginas: </td>';
				echo '<td>';
				echo '<input id="cantPaginas" type="number" name="cantPaginas" ';
				if(isset($_GET["cantPaginas"])){
					echo 'value="'.$_GET["cantPaginas"].'"';
				}
				echo '/></td></tr><tr>';
			//idioma
				echo '<td>Idioma: </td>';
				echo '<td>';
				echo '<input id="idioma" type="text" name="idioma" ';
				if(isset($_GET["idioma"])){
					echo 'value="'.$_GET["idioma"].'"';
				}
				echo '/></td></tr><tr>';
			//isbn
				echo '<td>ISBN: </td>';
				echo '<td>';
				echo '<input id="isbn" type="number" name="isbn" ';
				if(isset($_GET["isbn"])){
					echo 'value="'.$_GET["isbn"].'"';
				}
				echo '/></td></tr><tr>';
			//nombre
				echo '<td>Nombre: </td>';
				echo '<td>';
				echo '<input id="nombre" type="text" name="nombre" ';
				if(isset($_GET["nombre"])){
					echo 'value="'.$_GET["nombre"].'"';
				}
				echo '/></td></tr><tr>';
			//origen
				echo '<td>Origen: </td>';
				echo '<td>';
				echo '<input id="origen" type="text" name="origen" ';
				if(isset($_GET["origen"])){
					echo 'value="'.$_GET["origen"].'"';
				}
				echo '/></td></tr><tr>';
			//precio
				echo '<td>Precio: </td>';
				echo '<td>';
				echo '<input id="precio" type="number" step="0.05" name="precio" ';
				if(isset($_GET["precio"])){
					echo 'value="'.$_GET["precio"].'"';
				}
				echo '/></td></tr><tr>';
			//resumen
				echo '<td>Resumen: </td>';
				echo '<td>';
				echo '<input id="resumen" type="textarea" name="resumen" ';
				if(isset($_GET["resumen"])){
					echo 'value="'.$_GET["resumen"].'"';
				}
				echo '/></td></tr><tr>';
			//stock
			    echo '<td>Stock: </td>';
				echo '<td>';
				echo '<input id="stock" type="textarea" name="stock" ';
				if(isset($_GET["stock"])){
					echo 'value="'.$_GET["stock"].'"';
				}
				echo '/></td></tr><tr>';
			//stockminimo
				echo '<td>Stock minimo: </td>';
				echo '<td>';
				echo '<input id="stockMinimo" type="textarea" name="stockMinimo" ';
				if(isset($_GET["stockMinimo"])){
					echo 'value="'.$_GET["stockMinimo"].'"';
				}
				echo '/></td></tr><tr>';
			//autor/es
				echo '<td>Autor/es: <p>Mantenga la tecla ctrl apretada</p> <p>para seleccionar varios autores</p></td>';
				echo '<td><select multiple name="idAutor[]">';
				$sql = "SELECT * FROM `Autor`";
				$query = mysql_query($sql);
				echo '<option value=""></option>';
				while ($row  = mysql_fetch_assoc($query)) {
					$apellidoynombre = $row['apellido'].', '.$row['nombre'];
					$id = $row['idAutor'];
					echo '<option value="'.$id.'" ';
					if (isset($_GET['idAutor'])){
						if($_GET['idAutor']==$id){
							echo 'selected';
						}
					}
					echo '>'.$apellidoynombre.'</option>';
				}
				echo '</select>';
				echo '</td><td><a href="formabm.php?abm=Autor">Nuevo</a>';
				echo '</td></tr><tr>';
				
			//etiqueta/s
				echo '<td>Etiqueta/s: <p>Mantenga la tecla ctrl apretada</p> <p>para seleccionar varias etiquetas</p></td>';
				echo '<td><select multiple name="idEtiqueta[]">';
				$sql = "SELECT * FROM `Etiqueta`";
				$query = mysql_query($sql);
				echo '<option value=""></option>';
				while ($row  = mysql_fetch_assoc($query)) {
					$etiqueta = $row['Etiqueta'];
					$id = $row['idEtiqueta'];
					echo '<option value="'.$id.'" ';
					if (isset($_GET['idEtiqueta'])){
						if($_GET['idEtiqueta']==$id){
							echo 'selected';
						}
					}
					echo '>'.$etiqueta.'</option>';
				}
				echo '</select>';
				echo '</td><td><a href="formabm.php?abm=Etiqueta">Nuevo</a>';
			break;
		}
		echo '</td>'; //fin inputs normal
		echo '</tr>'; //fin encabezado normal
	
	echo '<br><tr>';
	echo '<td></td>';
	echo '<td><input type="submit" name="Enviar" value="Enviar" />';
	echo '<input type="button" name="Cancelar" value="Cancelar" onClick="self.history.back();"/></td></tr>';
	echo '</table>';
	echo '</fieldset>';
	echo '</form>';	
}
?></div></BODY>
</HTML>

