<HTML><HEAD><link href="style.css" type="text/css" rel="stylesheet">
	<link href="images.jpg" type="img/icon" rel="shortcut icon">
	<meta content="text/html" charset="utf-8" http-equiv="content-type"></meta>


</HEAD><BODY><div id="content" style="padding:20px; width:650px; background-color:#EBEDF4;margin:auto;">
<?php
require_once("sesion.php");
sesion();

require_once("config.php");

if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "login.php"
</script>';
}
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

	echo '<table>';
	//altas/modificacion todo menos vehiculo
	if($abm!="Libro"){
		echo '<tr>';//comienzo encabezado normal
		
		//input de AM
		echo '<th>'.$abm.'</th>';
		echo '</tr>'; //fin encabezado normal
		echo '<tr>'; //comienzo inputs normal
		echo '<td>';
		if(isset($_GET["id"])){
			echo '<input type="hidden" name="id" value="'.$_GET["id"].'" />';//oculto para modificacion
		}
		echo '<input type="hidden" name="abm" value="'.$abm.'" />'; //oculto para alta
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

		echo '</td>'; //fin inputs normal
	}/* else{
		//altas-modificacion libros
		//script validar
		echo '<script type="text/javascript">
		function validar_formulario(form){
			if((form.dominio.value.length == 0) || (!(/^[a-z]{3}[0-9]{3}$/i.test(form.dominio.value)))){
				form.dominio.focus();
      	   		alert("Introduzca un dominio válido."); 
           		return false;
           	}
			var anio = form.anio.value;
			if((anio.length == 0) || (!(/^[0-9]{4}$/i.test(anio))) || (anio < 1970) || (anio > (new Date).getFullYear()))
			{
				form.anio.focus();
      	 	  	alert("Introduzca un año válido."); 
        	   	return false;
        	}
			var precio = form.precio.value;
			if ( (precio.length == 0) || (!(/^[0-9]{4,7}$/i.test(precio))))
			{
				form.precio.focus();
      	   		alert("Introduzca un precio válido."); 
           		return false;
           	}
           	return true
		}
		</script>';
		//generacion de variables de vehiculo
		if(isset($_GET["id"])){
			$idVehiculo=$_GET["id"];
			$sql="SELECT Marca,Modelo,Dominio,Anio,Precio,Tipo FROM 
							(SELECT idVehiculo,idMarca,Modelo,Dominio,Anio,Precio,Tipo FROM 
							(SELECT idVehiculo,idModelo,Dominio,Anio,Precio,Tipo FROM 
							(SELECT * FROM `Vehiculos` WHERE idVehiculo=$idVehiculo) as Vehi 
								INNER JOIN Tipos ON Vehi.idTipo=Tipos.idTipo) as vehitipo 
								INNER JOIN Modelos ON vehitipo.idModelo=Modelos.idModelo) as vehimod 
								INNER JOIN Marcas ON vehimod.idMarca=Marcas.idMarca";
			$consulta=mysql_query($sql);
			$row  = mysql_fetch_array($consulta);
			$marca=$row['Marca'];
			$modelo=$row['Modelo'];
			$dominio=$row['Dominio'];
			$anio=$row['Anio'];
			$precio=(integer)$row['Precio'];
			$tipo=$row['Tipo'];
			
			$sql = "SELECT Caracteristica FROM
							(SELECT Vehiculos_Caracteristicas.idVehiculo, Caracteristica FROM 
								Caracteristicas 
								INNER JOIN Vehiculos_Caracteristicas ON Caracteristicas.idCaracteristica = Vehiculos_Caracteristicas.idCaracteristica) as a WHERE a.idVehiculo = $idVehiculo";
			$consulta=mysql_query($sql);
			$cant = mysql_num_rows($consulta);

			if($cant>0){
				$carac= array();
				while ($row = mysql_fetch_assoc($consulta)){
					$a = $row['Caracteristica'];
					$carac[]= $a;
				}						
			}			
			echo '<input type="hidden" name="id" value="'.$idVehiculo.'" />';//oculto para modificacion
		}		 

		//select modelo
		echo '<tr>';
		echo '<td>Modelo</td>';
		echo '<td>';
		echo'<select name="idmodelo">';
		$sql = "SELECT * FROM `Modelos`";
		$query = mysql_query($sql);
		while ($row  = mysql_fetch_assoc($query)) {
			$a = $row['Modelo'];
			$b = $row['idModelo'];
			echo '<option value="'.$b.'" ';
			if (isset($modelo)){
				if($modelo==$a){
					echo 'selected';
				}
			}
			echo '>'.$a.'</option>';
		}
		echo '</select></td>';
		echo '</tr>';
		
		//select tipo
		echo '<tr><td>Tipo</td>';
		echo '<td>';
		echo'<select name="idtipo">';
		$sql = "SELECT * FROM `Tipos`";
		$query = mysql_query($sql);
		while ($row  = mysql_fetch_assoc($query)) {
			$a = $row['Tipo'];
			$b = $row['idTipo'];
			echo '<option value="'.$b.'" ';
			if (isset($tipo)){
				if($tipo==$a){
					echo 'selected';
				}
			}
			echo '>'.$a.'</option>';
		}
		echo '</select></td>';
		echo '</tr>';
		//input precio
		echo '<tr><td>Precio</td>';
		echo '<td>';
		echo '<input type="text" name="precio" ';
		if (isset($precio)){
			echo'value="'.$precio.'"';
		}
		echo' /></td>';
		echo '</tr>';
		//input dominio
		echo '<tr><td>Dominio</td>';
		echo '<td>';
		echo '<input type="text" name="dominio" ';
		if (isset($dominio)){
			echo'value="'.$dominio.'"';
		}
		echo ' /></td>';
		echo '</tr>';
		//input año
		echo '<tr><td>Año</td>';
		echo '<td>';
		echo '<input type="text" name="anio" ';
		if (isset($anio)){
			echo'value="'.$anio.'"';
		}
		echo ' /></td>';
		echo '</tr>';
		//checkboxs caracteristicas
		echo '<tr><td>Características</td>';
		echo '<td>';
		$sql = "SELECT * FROM `Caracteristicas`";
		$query = mysql_query($sql);
		while ($row  = mysql_fetch_assoc($query)) {
			$a = $row['Caracteristica'];
			$b = $row['idCaracteristica'];
			echo '<input type="checkbox" name="carac[]" value="'.$b.'" ';
			if (isset($carac)){
				foreach ($carac as $valor)
    				if($valor==$a){
    					echo 'checked';
    				}
			}
			echo '><span style="font-size:0.8em;color: #65767D; font-weight:bold; text-align:left;">'.$a.'</span><br>';
		}
		echo '</td>';
		echo '</tr>';
	}*/
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
