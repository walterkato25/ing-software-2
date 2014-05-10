<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>

<body>

	
<?php
  include('listado.php');
  echo '<table border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt"><tr>
<td><font face="verdana"><b>Modelo</b></font></td>
<td><font face="verdana"><b>Marca</b></font></td>
<td><font face="verdana"><b>Dominio</b></font></td>
<td><font face="verdana"><b>Año</b></font></td>
<td><font face="verdana"><b>Precio</b></font></td>
</tr>';

  include('liblocal.php');
  
  $result = Mysql_query("SELECT Vehiculos.Dominio, Vehiculos.Anio, Vehiculos.Precio, 
                                Modelos.Modelo, Marcas.Marca
                           FROM Vehiculos INNER JOIN Modelos ON Vehiculos.idModelo = Modelos.idModelo
                                INNER JOIN Marcas ON Modelos.idMarca = Marcas.idMarca
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
  mysql_close($server_link);
?>
</table>

</body>


</html>
