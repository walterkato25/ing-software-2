<?php
  include('privado.php');
  
  
  
  echo '

<table border="1" cellspacing=7 cellpadding=2 style="font-size: 8pt"><tr>
<th><font face="verdana" color= #99CCCC size=4><u>Usuario</u></font></th>
<th><font face="verdana" color= #99CCCC size=4><u>Clave</u></font></th>
<th><font face="verdana" color= #99CCCC size=4><u>Acciones</u></font></th>
</tr>';

  
  
include('liblocal.php');

	$result = Mysql_query("SELECT *                                
							 FROM Usuarios
							ORDER BY Usuarios.Usuario");
	 $numero = 0; {
		  while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\" color= #CC66CC size=2><strong>" . 
        $row["Usuario"] . "</strong></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\" color= #000099 size=2><samp>" . 
	    $row["Clave"]. "</samp></font></td>";
    echo "<td width=\"25%\"><font face=\"verdana\"><a href='eliminarUsuario.php?id=".$row['idUsuario']."'>Eliminar</a></font></td>";
	
    $numero++;

  }
 
	
	} 
  
  
  
 
?>