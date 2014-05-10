<?php
  include('privado.php');
  echo '
  
  <table border="4" cellspacing="3" cellpading="3">
  <tr>
   <th> <font face="verdana" colot=#000099 size=3> ID </font></th>
   <th> <font face="verdana" color=#000099 size=3> Tipo </font> </th>
   
  </tr>';
  
   include('liblocal.php');
   
   $result= Mysql_query("SELECT *
                         FROM Tipos
						 ORDER BY Tipos.Tipo");
	$numero=0;
    while ($row = mysql_fetch_array($result))
	  {
	  echo "<tr><td width=\"25%\"> <font face=\"verdana\" color=#CC66CC size=3>". $row["idTipo"]. "</font></td>";
	  echo "<td width=\"25%\"> <font face=\"verdana\" color=#CC66CC size=3>" . $row["Tipo"]. "</font> </td></tr>";
	  $numero++;  }
	  
	  ?>
  
  