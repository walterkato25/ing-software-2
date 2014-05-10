<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>

<BODY>
<form name="CaracteristicaForm" action="aprguardar.php" method="POST">
 Caracteristica: <input type="text" name="caracteristica">
 <br>
 <input type="submit" value="Guardar" />
</form>

<table border="1" cellspacing=1 cellpadding=4 style="font-size: 8pt"><tr>
<td><font face="verdana"><b>ID</b></font></td>
<td><font face="verdana"><b>Caracteristica</b></font></td>
<td><font face="verdana"><b>Dominio</b></font></td>
<td><font face="verdana"><b>Precio</b></font></td>
<td colspan="2"><font face="verdana"><b>Acciones</b></font></td>
</tr>
	
<?php

  include('liblocal.php');
  
  $result = Mysql_query("SELECT Caracteristicas.idCaracteristica, Caracteristicas.Caracteristica,Vehiculos.Dominio, Vehiculos.Precio
                           FROM Caracteristicas INNER JOIN Vehiculos_Cacteristicas ON  = Caracteristicas.idCaracteristica = Vehiculos_Cacteristicas.idCaracteristica
						   INNER JOIN Vehiculos ON Vehiculos.idVehiculo
						   ORDER BY Caracteristicas.Caracteristica");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
        $row["idCaracteristica"] . "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["Caracteristica"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["Dominio"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["Precio"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='eliminarapr.php?id=".$row['idCaracteristica']."'>Eliminar</a></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='editarapr.php?id=".$row['idCaracteristica']."'>Editar</a></font></td></tr>";
    $numero++;
  }
  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
      "</b></font></td></tr>";

