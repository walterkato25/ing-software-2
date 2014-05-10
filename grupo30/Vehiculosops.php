<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>

<BODY>
<form name="VehiculoForm" action="guardarVehiculo.php" method="POST">
Vehiculo: <input type="text" name="Vehiculo">
 <br>
 <input type="submit" value="Guardar" />
</form>

<table border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt"><tr>
<td><font face="verdana"><b>ID</b></font></td>
<td><font face="verdana"><b>idModelo</b></font></td>
<td><font face="verdana"><b>idTipo</b></font></td>
<td><font face="verdana"><b>Dominio</b></font></td>
<td><font face="verdana"><b>Anio</b></font></td>
<td><font face="verdana"><b>Precio</b></font></td>
<td colspan="2"><font face="verdana"><b>Acciones</b></font></td>
</tr>
	
<?php

  include('liblocal.php');
  
  $result = Mysql_query("SELECT *
                           FROM Vehiculos
                       ORDER BY Vehiculos.Precio");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
        $row["idVehiculo"] . "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["idModelo"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["idTipo"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["Dominio"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["Anio"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\">" . 
	    $row["Precio"]. "</font></td>";
	
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='eliminarVehiculo.php?id=".$row['idVehiculo']."'>Eliminar</a></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='editarVehiculo.php?id=".$row['idVehiculo']."'>Editar</a></font></td></tr>";
    $numero++;
  }
  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
      "</b></font></td></tr>";

