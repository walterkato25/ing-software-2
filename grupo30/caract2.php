<html>

  <body>

	
<?php
    include('listado.php');
    echo '<table border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt"><tr>
<td><font face="verdana"><b>Modelo</b></font></td>
<td><font face="verdana"><b>Marca</b></font></td>
<td><font face="verdana"><b>Dominio</b></font></td>
<td><font face="verdana"><b>Anio</b></font></td>
<td><font face="verdana"><b>Precio</b></font></td>
</tr>';
 
  include('liblocal.php');
  
  if (isset($_POST['idCaracteristica']) == false){
      echo "Seleccione al menos una característica";
  } else {  
	  $primero = true;
	  $inSelect = "(";
	  foreach ($_POST['idCaracteristica'] as $valor){
		  if ($primero){
			  $inSelect =  $inSelect.$valor;
			  $primero = false;
		  } else {
			  $inSelect =  $inSelect.",".$valor;
		  }
	  }
	  $inSelect = $inSelect .")";
	  
	  $sql = "SELECT Caracteristicas.Caracteristica
				FROM Caracteristicas
			   WHERE Caracteristicas.idCaracteristica IN ".$inSelect;
	  
	  $result = Mysql_query($sql);
	  echo "<font face='Verdana' size='2'>";
	  while ($row = mysql_fetch_array($result)){
		echo $row["Caracteristica"].' - ';
	  }
	  echo "</font>";

	  $result = Mysql_query("SELECT Vehiculos.Dominio, Vehiculos.Anio, Vehiculos.Precio, 
									Modelos.Modelo, Marcas.Marca 
							   FROM Vehiculos_Caracteristicas INNER JOIN Vehiculos ON Vehiculos_Caracteristicas.idVehiculo = Vehiculos.idVehiculo
									INNER JOIN Modelos ON Vehiculos.idModelo = Modelos.idModelo
									INNER JOIN Marcas ON Modelos.idMarca = Marcas.idMarca
							  WHERE Vehiculos_Caracteristicas.idCaracteristica IN ".$inSelect."
						   ORDER BY Modelos.Modelo, Marcas.Marca");
	  
	  
	   $numero = 0; 
	   while($row = mysql_fetch_array($result))
	  { 
		echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
			$row["Modelo"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["Marca"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["Dominio"]. "</font></td></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["Anio"]. "</font></td></td>";	
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["Precio"]. "</font></td></tr>";
		$numero++;
	  }
	  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
		  "</b></font></td></tr>";
	  
	  mysql_free_result($result);
  }	  
	?>
</table>

</body>


</html>
