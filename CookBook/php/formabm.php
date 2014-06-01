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
