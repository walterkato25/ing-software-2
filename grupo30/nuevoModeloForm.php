<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>
<head>
    <script type="text/javascript">	    
		function validar()
		{
		    //valido que el campo modelo no sea vacio
		    if (document.modeloForm.modelo.value == ""){
		       alert("El campo modelo es obligatorio!");
		       document.modeloForm.modelo.focus();
		    } else {
		       document.modeloForm.submit();
		    }
		}
</script>
</head>

<BODY>
<?php 
include('privado.php');
include('liblocal.php'); 
echo '<form name="modeloForm" action="guardarModelo.php" method="POST">
<font face="verdana" color=#000099 size=3><u> Marca:</u> </font>
 <select name="idMarca">';
 
  $result = Mysql_query("SELECT Marcas.idMarca, Marcas.Marca 
                           FROM Marcas
                       ORDER BY Marcas.Marca");
   while($row = mysql_fetch_array($result))
  {
      echo "<option value='".$row['idMarca']."'>".$row['Marca']."</option>";
  }

 echo'</select>';
 echo '<br>
<font face="verdana" color=#000099 size= 3><u> Modelo: </u></font><input type="text" name="modelo">
 <br>
 <input type="button" onclick="validar();" value="Guardar" />
</form>

<table border="3" cellspacing=7 cellpadding=1 style="font-size: 8pt"><tr>
<th><font face="verdana"><u>ID modelo</u></font></th>
<th><font face="verdana"><u>Marca</u></font></th>
<th><font face="verdana"><u>Modelo</u></font></th>
<th colspan="2"><font face="verdana"><u>Acciones</u></font></th>
</tr>';
	


  $result = Mysql_query("SELECT Modelos.idModelo, Modelos.Modelo, Marcas.idMarca, Marcas.Marca
                           FROM Modelos INNER JOIN Marcas ON (Modelos.idMarca = Marcas.idMarca)
                       ORDER BY Modelos.Modelo");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\" color= #33CC33 size=5><b>" . 
        $row["idModelo"] . "</b></font></td>";
	
	
	echo "<td width=\"25%\"> <font face=\"verdanda\"color= #FF6633 size=3 ><u>" .$row["Marca"] . "</u></font> </td>";
	
	
	echo "<td width=\"25%\"><font face=\"verdana\"><strong><i>" . 
	    $row["Modelo"]. "</i></strong></font></td>";  
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='eliminarModelo.php?id=".$row['idModelo']."'>Eliminar</a></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='editarModelo.php?id=".$row['idModelo']."'>Editar</a></font></td></tr>";
    $numero++;
  }
  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
      "</b></font></td></tr>";

?>
</BODY>
</html>