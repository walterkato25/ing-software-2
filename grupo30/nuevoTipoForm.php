<?php
  include('privado.php');
  
  echo '<form name="tipoForm" action="guardarTipo.php" method="POST">
 <font face= "verdana" color= #000099 size=3>Tipo:</font> <input type="text" name="tipo">
 <br>
 <input type="submit" value="Guardar" />
</form>

<table border="1" cellspacing=7 cellpadding=2 style="font-size: 8pt"><tr>
<th><font face="verdana" color= #99CCCC size=4><u>ID</u></font></th>
<th><font face="verdana" color= #99CCCC size=4><u>Tipo</u></font></th>
<th colspan="2"><font face="verdana" color= #99CCCC size= 4><u>Acciones</u></font></th>
</tr>';

  include('liblocal.php');
  
  $result = Mysql_query("SELECT *
                           FROM Tipos
                       ORDER BY Tipos.Tipo");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\" color= #CC66CC size=2><strong>" . 
        $row["idTipo"] . "</strong></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\" color= #000099 size=2><samp>" . 
	    $row["Tipo"]. "</samp></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='eliminarTipo.php?id=".$row['idTipo']."'>Eliminar</a></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='editarTipo.php?id=".$row['idTipo']."'>Editar</a></font></td></tr>";
    $numero++;
  }
  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
      "</b></font></td></tr>";

?>