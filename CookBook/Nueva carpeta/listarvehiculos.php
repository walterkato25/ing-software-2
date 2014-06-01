<?php
		function listarvehiculos($tabla){
				//if($tabla!=null){
						echo '<table>';
						$a=0;
						while ($row  = mysql_fetch_assoc($tabla)) {
							$modelo = $row['Modelo'];  
							$marca = $row['Marca'];
							$anio = $row['Anio'];
							$precio = $row['Precio'];
							$tipo = $row['Tipo'];
							$idVehiculo = $row['idVehiculo'];
							if($a==0){
								           //comienzo de la lista//
								echo '<tr>
									<th>Marca</th>
									<th>Modelo</th>
									<th>Tipo</th>
									<th>Precio</th>
									</tr>';
							}
							$a++;
							echo "<tr>
							<td>$marca </td>
							<td> $modelo </td>
							<td> $tipo </td>
							<td> \$$precio </td>
							<td><a href=\"detalle.php?idVehiculo=$idVehiculo\">Ver</a>";
							if($_SESSION){
								echo '<td><a href="bajas.php?abm=Vehiculo&id='.$idVehiculo.'"><img src="eliminar.png" title="Eliminar"/></a>';
								echo '<a href="formabm.php?abm=Vehiculo&id='.$idVehiculo.'"><img src="editar.png" title="Editar"/></a>';
							}
							echo "</td></tr>";
						}
						
						echo '</table>';
				//}
		}
?>
