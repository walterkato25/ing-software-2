<?php
	function filtrar(){
		echo '<form id="listar" method="get" action="autos.php"><fieldset><legend>Busqueda:</legend>';
		
		echo '<label>Seleccione marca:</label>';
		echo '<select name="idmarca">';
		require_once("config.php");
		$sql = "SELECT * FROM `Marcas`";
		$query = mysql_query($sql);
		echo '<option value=""></option>';
		while ($row  = mysql_fetch_assoc($query)) {
			$a = $row['Marca'];
			$b = $row['idMarca'];
			echo '<option value="'.$b.'" ';
			if (isset($_GET['idmarca'])){
				if($_GET['idmarca']==$b){
					echo 'selected';
				}
			}
			echo '>'.$a.'</option>';
		}
		
		echo '</select><br><br><label>Seleccione Modelo:</label><br>';
		echo'<select name="idmodelo">';
		$sql = "SELECT * FROM `Modelos`";
		$query = mysql_query($sql);
		echo '<option value=""></option>';
		while ($row  = mysql_fetch_assoc($query)) {
			$a = $row['Modelo'];
			$b = $row['idModelo'];
			echo '<option value="'.$b.'" ';
			if (isset($_GET['idmodelo'])){
				if($_GET['idmodelo']==$b){
					echo 'selected';
				}
			}
			echo '>'.$a.'</option>';
		}
		echo '</select><br><br>';
		
		
		echo '<label>Seleccione Caracteristicas:</label><br><br>';
		$sql = "SELECT * FROM `Caracteristicas`";
		$query = mysql_query($sql);
		while ($row  = mysql_fetch_assoc($query)) {
			$a = $row['Caracteristica'];
			$b = $row['idCaracteristica'];
			echo '<input type="checkbox" name="carac[]" value="'.$b.'" ';
			if (isset($_GET['carac'])){
				$array=array();
				$array=$_GET['carac'];
				foreach ($array as $valor)
    				if($valor==$b){
    					echo 'checked';
    				}
			}
			echo '><span style="font-size:0.8em;color: #65767D; font-weight:bold; text-align:left;">'.$a.'</span><br>';
		}
		
		echo '<br><label>Seleccione Editorial:</label>';
		echo'<br><select name="idtipo">';
		$sql = "SELECT * FROM `Tipos`";
		$query = mysql_query($sql);
		echo '<option value=""></option>';
		while ($row  = mysql_fetch_assoc($query)) {
			$a = $row['Tipo'];
			$b = $row['idTipo'];
			echo '<option value="'.$b.'" ';
			if (isset($_GET['idtipo'])){
				if($_GET['idtipo']==$b){
					echo 'selected';
				}
			}
			echo '>'.$a.'</option>';
		}
		echo '</select><br><br>';
		$pre='Precio';
		$mar='Marca';
		echo '<label>Ordenar por:</label><br>';
		echo '<select name="listarpor">';
		echo '<option value="'.$mar.'" ';
			if (isset($_GET['listarpor'])){
				if($_GET['listarpor']==$mar){
					echo 'selected';
				}
			}
			echo '>Marca</option>';
		echo '<option value="'.$pre.'" ';
			if (isset($_GET['listarpor'])){
				if($_GET['listarpor']==$pre){
					echo 'selected';
				}
			}
			echo '>Precio</option>';
		echo '</select><br><br>';
		
		echo '<label>En sentido:</label>';
		echo'<br><select name="orden">';
		echo '<option value="ASC" ';
			if (isset($_GET['orden'])){
				if($_GET['orden']=='ASC'){
					echo 'selected';
				}
			}
			echo '>Ascendente</option>';
		echo '<option value="DESC" ';
			if (isset($_GET['orden'])){
				if($_GET['orden']=='DESC'){
					echo 'selected';
				}
			}
			echo '>Descendente</option>';
		echo'</select><br>';
		echo '<br><input type="submit" name="filtrar" value="Ver">';
		echo '<input type="button" name="nuevabusqueda" value="Nueva Búsqueda" onClick="newSearch()"></form>';
	}
?>
