<?php
header("Content-type: text/html; charset=utf-8");
require_once("SQLfunctions.php");
require_once("config.php");
require_once("sesion.php");
sesion();

function modificar($abm, $id){
	echo '<a href="formabm.php?abm='.$abm.'&id='.$id;
	echo '"><img src="img/editar.png" title="Editar"/></a>';
}
function eliminar($abm, $id){
	?>
	<td><a onclick="if(!confirm('¿Desea borrar el elemento?'))return false"; href="php/bajas.php?abm=<?php echo $abm.'&id='.$id; ?>"><img src="img/eliminar.png" title="Eliminar" /></a>
	<?php
}
function verEtiqueta($id){
	echo '<th>Etiqueta</th>';
	echo'<th>Acciones</th></tr>';
	$query = select("Etiqueta","Etiqueta");
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["Etiqueta"].'</td>';
		eliminar("Etiqueta", $row["idEtiqueta"]);
		modificar("Etiqueta", $row["idEtiqueta"]);
	}
}
function verAutor($id){
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
function verLibro($id){
	echo '<th>Nombre</th><th>Autores</th><th>Etiquetas</th><th>Precio</th>';
	echo'<th>Acciones</th></tr>';
	$query = select("Libro","Nombre", true);
	while ($row  = mysql_fetch_assoc($query)) {
		$nombreLibro= $row["nombre"];
		$idLibro= $row["idLibro"];
		$precio=$row["precio"];
		$sql= "SELECT apellido, nombre FROM `autor` WHERE `idAutor` in (SELECT idAutor FROM `libroautor` WHERE `idLibro`=$idLibro)";
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
		$sql= "SELECT etiqueta FROM `etiqueta` WHERE `idEtiqueta` in (SELECT idEtiqueta FROM `libroetiqueta` WHERE `idLibro`=$idLibro)";
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
		eliminar("Libro", $idLibro);
		modificar("Libro", $idLibro);
	}
}

function verUsuario($id){
	echo '<th>Nombre de Usuario</th><th>Apellido</th><th>Nombre</th><th>DNI/CUIT</th><th>Categoría</th>';
	echo'<th>Acciones</th></tr>';
	$query=select("Usuario","nombreDeUsuario", true);
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["nombreDeUsuario"].'</td>';
		echo '<td>'.$row["apellido"].'</td>';
		echo '<td>'.$row["nombre"].'</td>';
		echo '<td>'.$row["dni_cuit"].'</td>';
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
	function verPedido($id){
		$sql="SELECT * FROM pedido";
		if($id!=""){
			$sql.=" WHERE idUsuario=$id";
		}
			$query=mysql_query($sql);
			if (mysql_num_rows($query)!=0) { ?>
				<th>Fecha y Hora</th><th>Monto</th><th>Estado</th>
				<?php 
				if($_SESSION["categoria"]=="administrador"){
					?><th>Usuario</th><?php
				}?>
				<th>Acciones</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($query)){
					$estado=$row["estado"];
					$idUsuario=$row["idUsuario"];
					$usuario=mysql_query("SELECT nombreDeUsuario FROM Usuario WHERE idUsuario=$idUsuario");
					$usuario=mysql_fetch_assoc($usuario);
					$nombreDeUsuario=$usuario["nombreDeUsuario"];
				?>
				
					<tr>
						<td><?php echo $row["timestamp"]; ?>
						</td>
						<td><?php echo "$".number_format($row["monto"],2,',','.'); ?>
						</td>
						<td><?php echo $estado; ?>
						</td>
						<?php 
						if($_SESSION["categoria"]=="administrador"){
							?>
							<td>
								<?php echo $nombreDeUsuario ?>
							</td>
							<?php
							

						}
							?>
						<td><?php echo "<a href='verPedido.php?idPedido=".$row["idPedido"]."' >Ver Detalle</a> "; ?> 
						</td>

					</tr>
					<?php } ?>
				
				<?php	
			}else{
				echo "<h4><p>No ha realizado nigún pedido.</p></h4>";
			}		
		
	}
}	
function viewABM($abm,$id=""){
						echo '<fieldset style="margin:auto; width:885px;">';
						if($abm=='Autor'){
							echo '<legend>'.$abm.'es </legend>';
						}else{
							echo '<legend>'.$abm.'s </legend>';
						}
						$funcionVer='ver'.$abm;
						echo '<table rules="rows">';
						echo '<tr>';
						

						$funcionVer($id);
						if(!($abm=="Usuario") && !($abm=="Pedido")){
							echo "<tr><td><span ><a id='agregar' href=\"formabm.php?abm=$abm";
							echo "\">Agregar... </span></td></tr>";
						}
						echo "</table>";
						echo '</fieldset>';
}

?>