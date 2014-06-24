<?php
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
	$sql="SELECT * FROM Libro WHERE nombre LIKE \"%$nombre%\" AND idLibro in ($tablaEtiqueta) AND idLibro in ($tablaAutor)";
	return $sql;
}


?>
<form method="GET" id="catalogo">
<select multiple id="etiqueta" name="idEtiqueta[]" >
	<?php
		$sql = "SELECT * FROM `Etiqueta` Order by `Etiqueta`";
		$query = mysql_query($sql);
		while ($row  = mysql_fetch_assoc($query)) {
			echo '<option value="'.$row['idEtiqueta'].'">'.$row['Etiqueta'].'</option>';
		}
	?>
</select>
<select multiple id="autor" name="idAutor[]" >
	<?php
		$sql = "SELECT * FROM `Autor` Order by `Apellido`";
		$query = mysql_query($sql);
		while ($row  = mysql_fetch_assoc($query)) {
			echo '<option value="'.$row['idAutor'].'">'.$row['apellido'].', '.$row['nombre'].'</option>';
		}
	?>
</select>
<input type="text" name="nombre" />
<input type="submit" value="Buscar"/>

<?php 
if (isset($_GET["nombre"])){
?>
<div id="lista">
	<table>
		<tr>
			<th>Nombre</th><th>Autores</th><th>Etiquetas</th><th>Precio</th>
		</tr>
		<tr>
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
	$query=mysql_query($sql);
	while($row = mysql_fetch_array($query)){
		$id= $row["idLibro"];
?>
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
?> </td>
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
?> </td>
 <td style='text-align:right'> $ <?php echo number_format($row["precio"],2,',','.') ?></td>
</tr>

<?php
	}

?>
</div>
<?php
}
?>