<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>

<BODY>
<?php
include('privado.php');
echo '<form name="CaracteristicaForm" action="aprguardar.php" method="POST">
<font face="verdana" color= #000099 size=3> Caracteristica: </font> <input type="text" name="caracteristica">
 <br>
 <input type="submit" value="Guardar" />
</form>

<table border="4" cellspacing=7 cellpadding=2 style="font-size: 8pt"><tr>
<th><font face="verdana" ><u>ID</u></font></th>
<th><font face="verdana"><u>Caracteristica</u></font></th>
<th colspan="2"><font face="verdana"><u>Acciones</u></font></th>
</tr>';
	

  include('liblocal.php');
  
  $result = Mysql_query("SELECT *
                           FROM Caracteristicas
                       ORDER BY Caracteristicas.Caracteristica");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\" color=#006600 size=2>" . 
        $row["idCaracteristica"] . "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"color= #006600 size=2><strong><i>" . 
	    $row["Caracteristica"]. "</i></strong></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='eliminarapr.php?id=".$row['idCaracteristica']."'>Eliminar</a></font></td>";
    $numero++;
  }
  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
      "</b></font></td></tr>";

?>
</BODY>
</html>