<html>

  <body>

	
<?php
  include('listado.php');
  include('liblocal.php');
  
  $result = Mysql_query("SELECT Vehiculos.idTipo, Vehiculos.Dominio, Vehiculos.Anio, Vehiculos.Precio, 
                                Modelos.Modelo, Marcas.Marca 
                           FROM Vehiculos INNER JOIN Modelos ON Vehiculos.idModelo = Modelos.idModelo
                                INNER JOIN Marcas ON Modelos.idMarca = Marcas.idMarca
			  WHERE Vehiculos.Dominio = '".$_POST['dominio']."'
                       ORDER BY Modelos.Modelo, Marcas.Marca");
  
   if (Mysql_num_rows($result) > 0){
      $row = mysql_fetch_array($result);
	  echo "<font face='verdana' size='3'>Modelo: ".$row["Modelo"];
	  echo "<br>";
	  echo "Marca: ".$row["Marca"];
	  echo "<br>";
	  echo "Dominio: ".$row["Dominio"];
	  echo "<br>";
	  echo "Año: ".$row["Anio"];
	  echo "<br>";
	  echo "Precio: ".$row["Precio"];
	  echo "<br>";
	  
	  $result = Mysql_query("SELECT Tipos.Tipo
							   FROM Tipos
				  WHERE Tipos.idTipo = ".$row['idTipo']);
	  $row = mysql_fetch_array($result);
	  echo "Tipo: ".$row["Tipo"];
	  echo "<br>";
	  
	  $result = Mysql_query("SELECT Caracteristicas.Caracteristica
							   FROM Vehiculos INNER JOIN Vehiculos_Caracteristicas ON Vehiculos.idVehiculo = Vehiculos_Caracteristicas.idVehiculo
									INNER JOIN Caracteristicas ON Vehiculos_Caracteristicas.idCaracteristica = Caracteristicas.idCaracteristica
				  WHERE Vehiculos.Dominio = '".$_POST['dominio']."'
						   ORDER BY Caracteristicas.Caracteristica");
	  
	  echo "<table><tr><th>Características</th></tr>";  
	  while ($row = mysql_fetch_array($result)){
		  echo "<tr><td>".$row["Caracteristica"]."</td></tr>";     
	  }
	  echo "</table>";
	  
	  echo "</font>";
  } else {
      echo "No existe ningún vehículo con ese dominio.";
  }
  mysql_free_result($result);
  
?>
</table>

</body>


</html>
