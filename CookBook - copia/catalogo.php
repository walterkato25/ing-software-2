<?php
require_once("php/config.php");
require_once("php/html.php");
require_once("php/sesion.php");
sesion();


require_once("php/config.php");

function buscarPorAutor($idAutor){
	$ids= implode(', ', $idAutor);
	$sql="SELECT Distinct(idLibro) from libroautor";
	if($ids!=""){
		$sql.=" where idAutor in ($ids)";
	}
	return $sql;
}
function buscarPorEtiqueta($idEtiqueta){
	$ids= implode(', ', $idEtiqueta);
	$sql="SELECT Distinct(idLibro) from libroEtiqueta";
	if($ids!=""){
		$sql.=" where idEtiqueta in ($ids)";
	}
	return $sql;
}
function buscarporNombre($nombre, $idEtiqueta, $idAutor){
	$tablaEtiqueta=buscarPorEtiqueta($idEtiqueta);
	$tablaAutor=buscarPorAutor($idAutor);
	$sql="SELECT * FROM Libro WHERE baja = 0 AND nombre LIKE \"%$nombre%\" AND idLibro in ($tablaEtiqueta) AND idLibro in ($tablaAutor)";
	return $sql;
}

function subMenuCatalogo(){
?>
<div id="sub-menu" style='height:110px'>
<form method="GET" id="catalogo">
	<table id="navegacion">
	<tr>
		<th></th>
		<th>Etiquetas: </th>
		<th></th>
		<th>Autores: </th>
		<th></th>
		<th>Nombre: </th>
	</tr>
	<tr>
		<td></td>
		<td>
			<select multiple id="etiqueta" name="idEtiqueta[]" >
			<?php
				$sql = "SELECT * FROM `Etiqueta` Order by `Etiqueta`";
				$query = mysql_query($sql);
				while ($row  = mysql_fetch_assoc($query)) {
					echo '<option ';
					if(isset($_GET["idEtiqueta"]) && in_array($row['idEtiqueta'], $_GET["idEtiqueta"])){
						echo 'selected';
					}
					echo ' value="'.$row['idEtiqueta'].'">'.$row['Etiqueta'].'</option>';
		}
			?>
			</select>
		</td>
		<td></td>
		<td>
			<select multiple id="autor" name="idAutor[]" >
				<?php
				$sql = "SELECT * FROM `Autor` Order by `Apellido`";
				$query = mysql_query($sql);
				while ($row  = mysql_fetch_assoc($query)) {
					echo '<option ';
					if(isset($_GET["idAutor"]) && in_array($row['idAutor'], $_GET["idAutor"])){
						echo 'selected';
					}
					echo ' value="'.$row['idAutor'].'">'.$row['apellido'].', '.$row['nombre'].'</option>';
				}
				?>
			</select>
		</td>
		<td></td>
		<td>
			<input style="float:right" type="text" name="nombre" 
			<?php
			if(isset($_GET["nombre"])){
				echo ' value="'.$_GET["nombre"].'"';
			}
			?>
			/>
		</br>
			<input style="float:left" type="button" onclick="location.href='catalogo.php'" value="Limpiar"/>
			<input style="float:right" type="submit" value="Buscar"/>
		</td>
	</tr>
	</table>
</form>
</div>
<?php 
}
function contenido(){
if (isset($_GET["nombre"])){
		$url=$_SERVER["REQUEST_URI"];
		if (isset($_GET["orden"])){
			$lenght=strlen($url)-(9+strlen($_GET["orden"]));
			$url=substr($url, 0, $lenght);
		}
	
?>
	<fieldset><legend>Búsqueda</legend>
	
<?php
	if(!isset($_GET["idEtiqueta"])){
		$idEtiqueta[]='';
	}else{
		$idEtiqueta=$_GET["idEtiqueta"];
	}
	if(!isset($_GET["idAutor"])){
		$idAutor[]='';
	}else{
		$idAutor=$_GET["idAutor"];
	}
	$sql=buscarPorNombre($_GET["nombre"],$idEtiqueta,$idAutor);
	if(isset($_GET["orden"])){
		$orden=$_GET['orden'];
		$sql.=" ORDER BY $orden";
	}
	$query=mysql_query($sql);
	if(mysql_num_rows($query)==0){
		echo "<h4><p>No se han encontrado libros en la búsqueda.</p></h4>";
	}else{ ?>
	
		<div id="lista">
		<table >
			<tr>
				<th>Imagen</th>
				<th><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="nombre ASC"){echo $url.'&orden=nombre DESC';}else{echo $url.'&orden=nombre ASC';} ?>" >Nombre</a></th>
				<th>Autores</th>
				<th>Etiquetas</th>
				<th><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="precio ASC"){echo $url.'&orden=precio DESC';}else{echo $url.'&orden=precio ASC';}  ?>" >Precio</a></th>
				<th></th>
			</tr>
			<tr>
		<?php
		while($row = mysql_fetch_array($query)){
			$id= $row["idLibro"];
			$precio = $row["precio"];
			$imagen=$row["img"];
		?>
			<td><img id="imgelegida" style="max-width:50; max-height:50"
						<?php
							echo "src='.$imagen'";
						?>
						></td>
 			<td> <?php echo $row["nombre"]; ?> </td>
			<td> <?php
			$sql= "SELECT apellido, nombre FROM `autor` WHERE `idAutor` in (SELECT idAutor FROM `libroautor` WHERE `idLibro`=$id)";
			$queryautor= mysql_query($sql);
			$cantAutores = mysql_num_rows($queryautor);
			$nombreAutor='';
			$otros='';
			while ($row = mysql_fetch_array($queryautor)){
				if($nombreAutor==''){
					$nombreAutor= $row["apellido"].', '.$row["nombre"];
				}else{
					$otros=$otros.$row["apellido"].', '.$row["nombre"].'&#13;';
				}
			}
			echo "$nombreAutor";
			if ($cantAutores > 1){
				echo "<a href='javascript:void(0)' title='$otros' style='text-decoration:none; color:black'> <u>y otros...</u></a>";
			}
		?>
			</td>
 			<td> <?php 
			$sql= "SELECT etiqueta FROM `etiqueta` WHERE `idEtiqueta` in (SELECT idEtiqueta FROM `libroetiqueta` WHERE `idLibro`=$id)";
			$queryetiqueta= mysql_query($sql);
			$listaEtiquetas='';
			while($etiqueta = mysql_fetch_array($queryetiqueta)){
				if($listaEtiquetas!=''){
					$listaEtiquetas=$listaEtiquetas.', ';
				}
				$listaEtiquetas = $listaEtiquetas.$etiqueta["etiqueta"]; 
			}
 			echo "$listaEtiquetas";
		?>
			</td>
 			<td style='text-align:right'> $<?php echo number_format($precio,2,',','.') ?></td>
 			<td> <?php echo "<a href=detalle.php?id=$id >Ver detalle</a>";  ?> </td>
			</tr>

		<?php
		}
		?>
		</div>
	<?php
	}

}
?>
</fieldset>
<?php
}
$pagina="catalogo.php";
head("");
body($pagina);
?>