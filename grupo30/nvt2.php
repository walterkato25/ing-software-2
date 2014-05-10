<?php

include('privado.php');
echo '<form name="tipoForm" action="guardarTipoooooo.php" method="POST">
 <font face="verdana"> <u> <b>Tipo: </b> </u> </font>
 <input type= "text" name="tipo">
 <input type="submit" value="GUARDAR" />
 </form>
 
<table border = "2" cellspacing="4" cellpading="3">
<tr>
  <th> <font face= "verdana"> <u> ID TIPO </u></font></th>
  <th> <font face= "verdana"> <u> Tipo </u></font></th>
  <th> <font face= "verdana"> <u> Dominio </u></font></th>
  <th> <font face="verdana"> <u> Anio </u> </font> </th>
  <th> <font face="verdana"> <u> Precio </u> </font> </th>
  <th> <font face="verdana"> <u> Modelo </u> </font> </th>
  <th> <font face="verdana"> <u> Marca </u> </font> </th>
  
</tr>';

 include('liblocal.php'); 
 
 
 $result= Mysql_query("SELECT Tipos.idTipo, Tipos.Tipo, Vehiculos.Dominio, Vehiculos.Anio, Vehiculos.Precio, Modelos.Modelo, Marcas.Marca
                       FROM Tipos INNER JOIN Vehiculos ON Tipos.idTipo = Vehiculos.idTipo INNER JOIN  Modelos ON Vehiculos.idModelo = Modelos.idModelo
					   INNER JOIN  Marcas ON Marcas.idMarca
					   ORDER BY Marcas.Marca, Modelos.Modelo");
				
 while ($row = mysql_fetch_array($result))
  {
  echo"<tr> <td width=\"25%\"> <font face= \"verdana\" color=blue size=2>" .$row["idTipo"]. 	"</font> </td>";
  echo  "<td width=\"25%\"> <font face= \"verdana\" color= red size=2>" .$row["Tipo"].  "</font> </td>";
  echo  "<td width=\"25%\"> <font face= \"verdana\" color= red size=2>" .$row["Dominio"].  "</font> </td>";
  echo  "<td width=\"25%\"> <font face= \"verdana\" color= red size=2>" .$row["Anio"].  "</font> </td>";
  echo "<td width= \"25%\"><font face=\"verdana\" color=green size=2>" .$row["Precio"]. "</font> </td>";
  echo "<td width= \"25%\"> <font face= \"verdana\" color=blue size=2>" .$row["Modelo"]. "</font> </td>";
  echo "<td width= \"25%\"> <font face=\"verdana\" color= blue size=2> " .$row["Marca"]. "</font> </td></tr>";
  }
  ?>