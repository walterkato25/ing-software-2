<?php

require_once("SQLfunctions.php");
require_once("config.php");

function modificar($abm, $id){
	echo '<a href="php/formabm.php?abm='.$abm.'&id='.$id;
	echo '"><img src="img/editar.png" title="Editar"/></a>';
}
function eliminar($abm, $id){
	?>
	<td><a onclick="if(!confirm('Desea borrar el elemento?'))return false"; href="php/bajas.php?abm='<?php echo $abm.'&id='.$id; ?>'"><img src="img/eliminar.png" title="Eliminar" /></a>
	<?php
}
function verEtiqueta(){
	echo '<th>Etiqueta</th>';
	echo'<th>Acciones</th></tr>';
	$query = select("Etiqueta","Etiqueta");
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["Etiqueta"].'</td>';
		eliminar("Etiqueta", $row["idEtiqueta"]);
		modificar("Etiqueta", $row["idEtiqueta"]);
	}
}
function verAutor(){
	echo '<th>Apellido</th><th>Nombre</th>';
	echo'<th>Acciones</th></tr>';
	$query=select("Autor","Apellido");
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["apellido"].'</td>';
		echo '<td>'.$row["nombre"].'</td>';
		eliminar("Autor", $row["idAutor"]);
		modificar("Autor", $row["idAutor"]);
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
			echo "<a href='javascript:void(0)' title='$otros' style='text-decoration:none; color:black'> <u>y otros...</u></a>";
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
		eliminar("Libro", $id);
		modificar("Libro", $id);
	}
}

function verUsuario(){
	echo '<th>Nombre de Usuario</th><th>Apellido</th><th>Nombre</th><th>DNI/CUIT</th><th>Categoría</th>';
	echo'<th>Acciones</th></tr>';
	$query=select("Usuario","nombreDeUsuario", true);
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["nombreDeUsuario"].'</td>';
		echo '<td>'.$row["apellido"].'</td>';
		echo '<td>'.$row["nombre"].'</td>';
		echo '<td>'.$row["dni/cuit"].'</td>';
		echo '<td>'.$row["categoria"].'</td>';
		if(($row["categoria"]=="administrador")&&($row["idUsuario"]!=$_SESSION["idUsuario"])){
			eliminar("Usuario", $row["idUsuario"]);
		}
		if($row["categoria"]=="usuario"){
			echo '<td><a href="pedidos.php?idUsuario='.$row["idUsuario"].'" > Ver Pedidos </a></td>';
		}
	}
}
if (isset($_SESSION["categoria"])){
	function verPedido(){
		$sql="SELECT * FROM pedido";
		if($_SESSION["categoria"]=="usuario"){
			$idUsuario=$_SESSION["idUsuario"];
			$sql.=" WHERE idUsuario=$idUsuario";
			$query=mysql_query($sql);
			if (mysql_num_rows($query)!=0) { ?>
				<th>Fecha y Hora</th><th>Monto</th><th>Estado</th><th>Acciones</th></tr>
				<?php while($row=mysql_fetch_array($query)){
				?>
				
					<tr>
						<td><?php echo $row["timestamp"]; ?></td>
						<td><?php echo "$".number_format($row["monto"],2,',','.'); ?></td>
						<td><?php echo $row["estado"]; ?></td>
						<td><?php if ($row["estado"]=="Pendiente") {
							echo "<a href='php/cancelarPedido.php?idPedido=".$row["idPedido"]."' onclick='if(!confirm(\"Desea borrar el elemento?\"))return false'>Cancelar Pedido</a> ";
						} ?></td>

					</tr>
					<?php } ?>
				
				<?php	
				
			}else{
				echo "<h4><p>No tiene nigún pedido.</p></h4>";
			}		
		}
	}
}	
function viewABM($abm){
						echo '<fieldset style="margin:auto; width:885px; float:left">';
						if($abm=='Autor'){
							echo '<legend>'.$abm.'es </legend>';
						}else{
							echo '<legend>'.$abm.'s </legend>';
						}
						$funcionVer='ver'.$abm;
						echo '<table rules="rows">';
						echo '<tr>';
						
						$funcionVer();
<<<<<<< HEAD
						echo "<tr><td><span ><a id='agregar' href=\"php/formabm.php?abm=$abm";
						echo "\">Agregar... </span></td></tr></table>";
=======
						if(!($abm=="Usuario") && !($abm=="Pedido")){
							echo "<tr><td><span ><a id='agregar' href=\"php/formabm.php?abm=$abm";
							echo "\">Agregar... </span></td></tr>";
						}
						echo "</table>";
>>>>>>> origin/master
						echo '</fieldset>';
}

?>