<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>

<body>

	
<?php
  include('listado.php');
   echo '<table border="5" cellspacing=5 cellpadding=2 style="font-size: 8pt"><tr>
<th><font face="verdana" color=#0000CC size=4><u>Marca</u></font></th>
<th><font face="verdana" color=#0000CC size=4><b>Modelo</b></font></th>
<th><font face="verdana"color=#0000CC size=4><u>Dominio</u></font></th>
<th><font face="verdana" color=#0000CC size=4><u>Año</u></font></th>
<th><font face="verdana" color=#0000CC size=4><u>Precio</u></font></th>
</tr>';

  include('liblocal.php');
  
  $result = Mysql_query("SELECT Vehiculos.Dominio, Vehiculos.Anio, Vehiculos.Precio, 
                                Modelos.Modelo, Marcas.Marca 
                           FROM Vehiculos INNER JOIN Modelos ON Vehiculos.idModelo = Modelos.idModelo
                                INNER JOIN Marcas ON Modelos.idMarca = Marcas.idMarca
                       ORDER BY Marcas.Marca, Modelos.Modelo");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\" color=#000099 size=2>" . 
      $row["Marca"] . "</font></td>";
    echo "<td width=\"25%\"><font face=\"verdana\" color=#000099 size=2>" . 
	  $row["Modelo"] . "</font></td>";  
    echo "<td width=\"25%\"><font face=\"verdana\" color=#000099 size=2>" . 
	    $row["Dominio"]. "</font></td></td>";
    echo "<td width=\"25%\"><font face=\"verdana\" color=#000099 size=2>" . 
	    $row["Anio"]. "</font></td></td>";	
    echo "<td width=\"25%\"><font face=\"verdana\" color= #000099 size=2>" . 
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
