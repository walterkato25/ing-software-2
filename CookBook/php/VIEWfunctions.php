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
function verEtiqueta($id,$url){
	
	?>
	<th id="orden">
		<a href="
		<?php 
			if(isset($_GET["orden"]) && $_GET["orden"]=="etiqueta DESC"){
				echo $url.'&orden=etiqueta ASC';
			}else{
				echo $url.'&orden=etiqueta DESC';} ?>
				" title="Ordenar por nombre de etiqueta" >Etiqueta
		</a>
	</th>
	<th id="orden"><span>Acciones</span></th></tr>
	<?php
	if(isset($_GET["orden"])){
		$orden=$_GET["orden"];
	}else{
		$orden="etiqueta";
	}
	$query = select("Etiqueta",$orden);
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["Etiqueta"].'</td>';
		eliminar("Etiqueta", $row["idEtiqueta"]);
		modificar("Etiqueta", $row["idEtiqueta"]);
	}
}
function verAutor($id,$url){
	
	?>
	<th id="orden">
		<a href="
		<?php 
			if(isset($_GET["orden"]) && $_GET["orden"]=="apellido DESC"){
				echo $url.'&orden=apellido ASC';
			}else{
				echo $url.'&orden=apellido DESC';} ?>
				" title="Ordenar por apellido" >Apellido
		</a>
	</th>
	<th id="orden">
		<a href="
		<?php 
			if(isset($_GET["orden"]) && $_GET["orden"]=="nombre ASC"){
				echo $url.'&orden=nombre DESC';
			}else{
				echo $url.'&orden=nombre ASC';} ?>
				" title="Ordenar por nombre" >Nombre
		</a>
	</th>
	<th id="orden"><span>Acciones</span></th></tr>
	<?php
	if(isset($_GET["orden"])){
		$orden=$_GET["orden"];
	}else{
		$orden="apellido";
	}
	$query=select("Autor",$orden);
	while ($row  = mysql_fetch_assoc($query)) {
		echo '<tr><td>'.$row["apellido"].'</td>';
		echo '<td>'.$row["nombre"].'</td>';
		eliminar("Autor", $row["idAutor"]);
		modificar("Autor", $row["idAutor"]);
	}
}
function verLibro($id,$url){
	?>
	<th id="orden">
		<a href="
		<?php 
			if(isset($_GET["orden"]) && $_GET["orden"]=="nombre DESC"){
				echo $url.'&orden=nombre ASC';
			}else{
				echo $url.'&orden=nombre DESC';} ?>
				" title="Ordenar por nombre" >Nombre
		</a>
	</th>
	<th id="orden"><span>Autores</span></th>
	<th id="orden"><span>Etiquetas</span></th>
	<th id="orden">
		<a href="
		<?php 
			if(isset($_GET["orden"]) && $_GET["orden"]=="estadoStock ASC"){
				echo $url.'&orden=estadoStock DESC';
			}else{
				echo $url.'&orden=estadoStock ASC';} ?>
				" title="Ordenar por estado de stock" >Estado de stock
		</a>
	</th>

	<th id="orden"><span>Acciones</span></th></tr>
	<?php
	if(isset($_GET["orden"])){
		$orden=$_GET["orden"];
	}else{
		$orden="nombre";
	}
	//$query = select("Libro",$orden, true);
	$sql="SELECT idLibro,nombre,ISBN,cantPaginas,stock,stockMinimo,img,origen,resumen,idioma,precio,baja,(stock-stockMinimo)as estadoStock FROM libro WHERE baja=0 ORDER BY $orden";
	$query=mysql_query($sql);
	while ($row  = mysql_fetch_assoc($query)) {
		$nombreLibro= $row["nombre"];
		$idLibro= $row["idLibro"];
		$precio=$row["precio"];
		$estadoStock=$row["estadoStock"];
		$sql= "SELECT apellido, nombre FROM `autor` WHERE `idAutor` in (SELECT idAutor FROM `libroautor` WHERE `idLibro`=$idLibro)";
		$queryautor= mysql_query($sql);
		$cantAutores = mysql_num_rows($queryautor);
		$nombreAutor='';
		$otros='';
		while ($autor = mysql_fetch_array($queryautor)){
			if($nombreAutor==''){
				$nombreAutor= $autor["apellido"].', '.$autor["nombre"];
			}else{
				$otros=$otros.$autor["apellido"].', '.$autor["nombre"].'&#13;';
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
		echo "<td style='width:150'>";
		if($row['estadoStock']>0){echo 'Normal';} else {echo '<h4 style="background-color: red; margin:auto">Critico</h4>';}
		echo "</td>";
		eliminar("Libro", $idLibro);
		modificar("Libro", $idLibro);
	}

}

function verUsuario($id,$url){
	if(isset($_GET['desde'])){
		$url.='&';
	}else{
		$url.='?';
	}
	?>
	<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="nombreDeUsuario ASC"){echo $url.'orden=nombreDeUsuario DESC';}else{echo $url.'orden=nombreDeUsuario ASC';} ?>" title="Ordenar por nombre de usuario" >Usuario</a></th>
	<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="fechaAlta ASC"){echo $url.'orden=fechaAlta DESC';}else{echo $url.'orden=fechaAlta ASC';} ?>" title="Ordenar por fehca de registro">Fecha de Alta</a></th>
	<!--<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="nombre ASC"){echo $url.'orden=nombre DESC';}else{echo $url.'orden=nombre ASC';} ?>" title="Ordenar por nombre">Nombre</a></th>
	<th id="orden"><span>DNI/CUIT</span></th>-->
	<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="categoria ASC"){echo $url.'orden=categoria DESC';}else{echo $url.'orden=categoria ASC';} ?>" title="Ordenar por categoría de usuario">Categoría</a></th>
	<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="baja ASC"){echo $url.'orden=baja DESC';}else{echo $url.'orden=baja ASC';} ?>" title="Ordenar por estado de la cuenta">Estado de Cuenta</a></th>
	<th id="orden"><span>Acciones</span></th>
	</tr>
	<?php
	if(isset($_GET["orden"])){
		$orden=$_GET["orden"];
	}else{
		$orden="nombreDeUsuario";
	}
	$sql="SELECT * FROM usuario";
	if (isset($_GET['desde'])){
		$desde=$_GET['desde'].' 00:00:00';
		$hasta=$_GET['hasta'].' 23:59:59';
		$between=" fechaAlta BETWEEN '$desde' AND '$hasta'";
		$sql.= ' WHERE '.$between;
	}
	$sql.=' ORDER BY '.$orden;
	//echo $sql;
	$query=mysql_query($sql);
	while ($row  = mysql_fetch_array($query)) {
		echo '<tr><td>'.$row["nombreDeUsuario"].'</td>';
		echo '<td>'.$row["fechaAlta"].'</td>';
		//echo '<td>'.$row["nombre"].'</td>';
		//echo '<td>'.$row["dni_cuit"].'</td>';
		echo '<td>'.$row["categoria"].'</td>';
		echo '<td>';
		if($row["baja"]){echo "Eliminada";}else{echo "Activa";}
		echo'</td>';
		if(($row["categoria"]=="administrador")&&($row["idUsuario"]!=$_SESSION["idUsuario"])&&(!$row["baja"])){
			eliminar("Usuario", $row["idUsuario"]);
		}
		if($row["categoria"]=="usuario"){
			echo '<td><a id="agregar" href="pedidos.php?idUsuario='.$row["idUsuario"].'" > Ver pedidos </a></td>';
		}
	}
}
if (isset($_SESSION["categoria"])){
	function verPedido($id,$url){
		$url=$_SERVER["REQUEST_URI"];
		if (isset($_GET["orden"])){
			$lenght=strlen($url)-(9+strlen($_GET["orden"]));
			$url=substr($url, 0, $lenght);
		}
		if(isset($_GET['idUsuario'])){
			$url.='&';
		}else{
			$url.='?';
		}
		$sql="SELECT idPedido, estado, pedido.idUsuario, monto, timestamp, nombreDeUsuario FROM pedido INNER JOIN usuario WHERE pedido.idUsuario=usuario.idUsuario";
		if($id!=""){
			$sql.=" AND pedido.idUsuario=$id";
		}
		if(isset($_GET["orden"])){
			$sql.=" ORDER BY ".$_GET["orden"];
		}else{
			$sql.=" ORDER BY timestamp DESC";
		}
			$query=mysql_query($sql);
			if (mysql_num_rows($query)!=0) { ?>
				<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="timestamp ASC"){echo $url.'orden=timestamp DESC';}else{echo $url.'orden=timestamp ASC';} ?>" title="Ordenar por fecha y hora de realización del pedido" >Fecha y Hora</a></th>
				<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="monto ASC"){echo $url.'orden=monto DESC';}else{echo $url.'orden=monto ASC';} ?>" title="Ordenar por monto del pedido">Monto</a></th>
				<th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="estado ASC"){echo $url.'orden=estado DESC';}else{echo $url.'orden=estado ASC';} ?>" title="Ordenar por estado del pedido">Estado</a></th>
				<?php 
				if($_SESSION["categoria"]=="administrador"){
					?><th id="orden"><a href="<?php if(isset($_GET["orden"]) && $_GET["orden"]=="nombreDeUsuario ASC"){echo $url.'orden=nombreDeUsuario DESC';}else{echo $url.'orden=nombreDeUsuario ASC';} ?>" title="Ordenar por nombre de usuario">Usuario</a></th><?php
				}?>
				<th id="orden"><span>Acciones</span></th>
				</tr>
				<?php
				while($row=mysql_fetch_array($query)){
					$estado=$row["estado"];
					$idUsuario=$row["idUsuario"];
					$nombreDeUsuario=$row["nombreDeUsuario"];
					
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
						<td><a id='agregar' href='verPedido.php?idPedido=<?php echo $row["idPedido"]; ?>' >Ver detalle</a>  
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
	$url=$_SERVER["REQUEST_URI"];
	if (isset($_GET["orden"])){
		$lenght=strlen($url)-(9+strlen($_GET["orden"]));
		$url=substr($url, 0, $lenght);
	}
						echo '<fieldset style="margin:auto; width:885px;">';
						if($abm=='Autor'){
							echo '<legend>'.$abm.'es </legend>';
						}else{
							echo '<legend>'.$abm.'s ';
								if($abm=='Pedido' && isset($_GET["idUsuario"])){
									$id=$_GET["idUsuario"];
									$usuario=mysql_fetch_assoc(mysql_query("SELECT nombreDeUsuario FROM usuario WHERE idUsuario=$id"));
									$nombreDeUsuario=$usuario['nombreDeUsuario'];
									echo " realizados por: $nombreDeUsuario";
								}
							echo '</legend>';
						}
						$funcionVer='ver'.$abm;
						echo '<table rules="rows">';
						echo '<tr>';
						

						$funcionVer($id,$url);
						if(!($abm=="Usuario") && !($abm=="Pedido")){
							echo "<tr><td><span ><a id='agregar' href=\"formabm.php?abm=$abm";
							echo "\">Agregar... </span></td></tr>";
						}
						if(($abm=="Usuario") && ($_SESSION["categoria"]=="administrador")){
							echo '<tr><td colspan="2"><span><a id="agregar" href="altaUsuario.php"> Agregar usuario administrador..</span></td></tr></a>';
						}
						echo "</table>";
						echo '</fieldset>';
}

?>