<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>

<body>

	
<?php
  include('listado.php');
  echo'<table border="5" cellspacing=4 cellpadding=2 style="font-size: 8pt"><tr>

<th><font face="verdana" color= #990000 size=4><b>Marca</b></font></th>
<th><font face="verdana" color= #990000 size=4><u>Modelo</u></font></th>
<th><font face="verdana" color= #990000 size=3><u>Dominio</b></font></th>
<th><font face="verdana"color= #990000 size=3><u>Año</u></font></th>
<th><font face="verdana" color= #990000 size=3><u>Precio</u></font></th>
</tr>';
  include('liblocal.php');
  
  $result = Mysql_query("SELECT Tipos.Tipo
                           FROM Tipos
                          WHERE Tipos.idTipo = ".$_POST['idTipo']);
  $row = mysql_fetch_array($result);
  echo "<h3>".$row["Tipo"]."</h3>";						  
  
  $result = Mysql_query("SELECT Vehiculos.Dominio, Vehiculos.Anio, Vehiculos.Precio, 
                                Modelos.Modelo, Marcas.Marca 
                           FROM Vehiculos INNER JOIN Modelos ON Vehiculos.idModelo = Modelos.idModelo
                                INNER JOIN Marcas ON Modelos.idMarca = Marcas.idMarca
						  WHERE Vehiculos.idTipo = ".$_POST['idTipo']."
                       ORDER BY Modelos.Modelo, Marcas.Marca");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {

    echo "<tr> <td width=\"25%\"><font face=\"verdana\" color= #993300 size=2>" . 
	    $row["Marca"] . "</font></td>";
    echo "<td width=\"25%\"><font face=\"verdana\"color=#993300 size=2>" . 
        $row["Modelo"] . "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\" color=#993300 size=2>" . 
	    $row["Dominio"]. "</font></td></td>";
    echo "<td width=\"25%\"><font face=\"verdana\"color=#993300 size=2>" . 
	    $row["Anio"]. "</font></td></td>";	
    echo "<td width=\"25%\"><font face=\"verdana\"color=#993300 size=2>" . 
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
