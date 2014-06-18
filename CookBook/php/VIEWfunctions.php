<?php

require_once("SQLfunctions.php");
require_once("config.php");

function modificarEliminar($abm, $id){
	echo '<td><a onclick="if(!confirm(';
	echo " 'Desea borrar el elemento?' ";
	echo '))return false"; href="php/bajas.php?abm='.$abm.'&id='.$id.'"><img src="img/eliminar.png" title="Eliminar" /></a>';
	echo '<a href="php/formabm.php?abm='.$abm.'&id='.$id;
	echo '"><img src="img/editar.png" title="Editar"/></a>';
}
function verEtiqueta(){
	echo '<th>Etiqueta</th>';
	echo'<th>Acciones</th></tr>';
	$query = select("Etiqueta","Etiqueta");
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["Etiqueta"].'</td>';
		modificarEliminar("Etiqueta", $row["idEtiqueta"]);
	}
}
function verAutor(){
	echo '<th>Apellido</th><th>Nombre</th>';
	echo'<th>Acciones</th></tr>';
	$query=select("Autor","Apellido");
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["apellido"].'</td>';
		echo '<td>'.$row["nombre"].'</td>';
		modificarEliminar("Autor", $row["idAutor"]);
	}
}
function verLibro(){
	echo '<th>Nombre</th><th>Autores</th><th>Etiquetas</th><th>Precio</th>';
	echo'<th>Acciones</th></tr>';
	$query = select("Libro","Nombre", true);
	while ($row  = mysql_fetch_assoc($query)) {
		$nombreLibro= $row["nombre"];
		$id= $row["idLibro"];
		$precio=$row["precio"];
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
		
		echo "<tr><td>$nombreLibro</td>";
		echo "<td>$nombreAutor";
		if ($cantAutores > 1){
			echo "<a href='javascript:void(0)' title='$otros'> y otros...</a>";
		}
		echo "</td>";
		$sql= "SELECT etiqueta FROM `etiqueta` WHERE `idEtiqueta` in (SELECT idEtiqueta FROM `libroetiqueta` WHERE `idLibro`=$id)";
		$queryetiqueta= mysql_query($sql);
		$listaEtiquetas='';
		while($etiqueta = mysql_fetch_array($queryetiqueta)){
			if($listaEtiquetas!=''){
				$listaEtiquetas=$listaEtiquetas.', ';
			}
			$listaEtiquetas = $listaEtiquetas.$etiqueta["etiqueta"]; 
		}
		echo "<td>$listaEtiquetas</td>";
		echo "<td style='text-align:right'>\$".number_format($precio,2,',','.')."</td>";
		modificarEliminar("Libro", $id);
	}
}

function verUsuario(){
	echo '<th>Nombre de Usuario</th><th>Apellido</th><th>Nombre</th><th>DNI/CUIT</th>';
	echo'<th>Acciones</th></tr>';
	$query=select("Usuario","nombreDeUsuario", true);
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["nombreDeUsuario"].'</td>';
		echo '<td>'.$row["apellido"].'</td>';
		echo '<td>'.$row["nombre"].'</td>';
		echo '<td>'.$row["dni/cuit"].'</td>';
		modificarEliminar("Usuario", $row["idUsuario"]);
	}
}
function viewABM($abm){
						echo '<fieldset style="margin:auto; width; float:left">';
						if($abm=='Autor'){
							echo '<legend>'.$abm.'es </legend>';
						}else{
							echo '<legend>'.$abm.'s </legend>';
						}
						$funcionVer='ver'.$abm;
						echo '<table>';
						echo '<tr>';
						

						$funcionVer();

						echo "<tr><td><span ><a id='agregar' href=\"php/formabm.php?abm=$abm";
						echo "\">Agregar... </span></td></tr></table>";
						echo '</fieldset>';
}

?>