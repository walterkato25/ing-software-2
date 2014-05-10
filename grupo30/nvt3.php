<?php
 include('privado.php');
 echo'<form name="CaractForm" action="guardarCaractaaaaaaaaaaaaaaaaa.php" method="POST">
 Caract:
 <input type="text" name="caracteristica" value="guardar"/>
 </form>
 
 <table border="3" cellspacing="3" cellpading="3">
 <tr>
 <th> <font face="verdana" color="blue" size="3"> ID CARACT</font> </th>
 <th> <font face="verdana" color="blue" size="3"> CARACT </font> </th>  
 </tr>';
  include('liblocal.php'); 
 $result= Mysql_query("SELECT *
                      FROM Caracteristicas
					  ORDER BY Caracteristicas.Caracteristica");
while ($row= Mysql_fetch_array($result))					  
 {
 echo"<tr> <td width=\"25%\">  <font face=\"verdana\" color=blue size=3>" .$row["idCaracteristica"]. "</font></td>";
 echo"<td widtg=\"25%\"> <font face=\"verdana\" color=blue size=3>" .$row["Caracteristica"]. "</font></td></tr>";
 }
?> 