<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>

<head>
    <script type="text/javascript">
	function cargarModelos() {
	    document.forms["marca"].submit()
	}
	
	function validarFormVehiculo(){
	    var marca = document.forms["marca"].idMarca.value;
	    var modelo = document.forms["vehiculoForm"].idModelo.value;
	    var dominio = document.forms["vehiculoForm"].dominio.value;
	    var anio = document.forms["vehiculoForm"].anio.value;
	    var precio = document.forms["vehiculoForm"].precio.value;
	    if (marca == ""){
		alert("Seleccione una marca");
	    } else {
		if (modelo == ""){
	            alert("Seleccione un modelo");
	        } else {
		    if (dominio.length != 6) {
			alert("Debe completar un dominio valido");
		    } else {
			if (anio.length != 4) {
			    alert("Debe completar un año valido");
		        } else {
			    if (precio == "") {
			        alert("Debe completar un precio valido");
		            } else {
			        document.forms["vehiculoForm"].submit();
			    }
			}
		    }
		}
	    }
	}
    </script>
</head>

<BODY>
<?php

include('privado.php');
include('liblocal.php');

echo '<font face="Verdana" size="2">';
echo '<u style="text-align:center;">Vehiculo:</u> <br>
 <form name="marca" action="nuevovehiculoForm.php" method="POST">
 Marca: <select name="idMarca" onchange="cargarModelos();">';
 echo "<option value=''>Seleccione...</option>";
 $result = Mysql_query("SELECT Marcas.idMarca, Marcas.Marca
                          FROM Marcas
		      ORDER BY Marcas.Marca");
  while($row = mysql_fetch_array($result))
  {
      if (isset($_POST["idMarca"]) && ($_POST["idMarca"] == $row['idMarca'])){
          echo "<option value='".$row['idMarca']."' selected='selected'>".$row['Marca']."</option>";
      } else {
	  echo "<option value='".$row['idMarca']."'>".$row['Marca']."</option>";
      }
  }
  echo '</select>';
  echo '</form>';
 
 echo '<form name="vehiculoForm" action="guardarVehiculo.php" method="POST">';
 echo 'Modelo: <select name="idModelo">';
  if (isset($_POST["idMarca"])){ 
      $result = Mysql_query("SELECT Modelos.idModelo, Modelos.Modelo
                               FROM Modelos
			      WHERE Modelos.idMarca = ".$_POST["idMarca"]."
                           ORDER BY Modelos.Modelo");
      while($row = mysql_fetch_array($result))
      {
          echo "<option value='".$row['idModelo']."'>".$row['Modelo']."</option>";
      }
  } else {
      echo "<option value=''>Seleccione la marca</option>";
  }
echo "</select><br>";
echo 'Tipo: <select name="idTipo">';
      $result = Mysql_query("SELECT Tipos.idTipo, Tipos.Tipo
                               FROM Tipos
                           ORDER BY Tipos.Tipo");
      while($row = mysql_fetch_array($result))
      {
          echo "<option value='".$row['idTipo']."'>".$row['Tipo']."</option>";
      }
echo "</select>"; ?>
<br>
 <br> 
 Dominio: <input type="text" maxlength="6" size="2" name="dominio">
 <br>
  Año: <input type="text"  maxlength="4" size="2" name="anio">
 <br>
  Precio: <input type="text" name="precio" size="4">
 <br>
 <input type="button" onclick="validarFormVehiculo();" value="Guardar" />
</form>

<table border="3" cellspacing=3 cellpadding=2 style="font-size: 8pt"><tr>
<th><font face="verdana"size=4><u><i>Tipo</i></u></font></th>
<th><font face="verdana"size=4><u><i>Marca</i></u></font></th>
<th><font face="verdana"size=4><u><i>Modelo</i></u></font></th>
<th><font face="verdana"size=4><u><i>Dominio</i></u></font></th>
<th><font face="verdana"size=4><u><i>Año</i></u></font></th>
<th><font face="verdana"size=4><u><i>Precio</i></u></font></th>

<th colspan="2"><font face="verdana"size=4><u>Acciones</u></font></th>
</tr>
	

  <?php
  include('liblocal.php');
  
  $result = Mysql_query("SELECT Vehiculos.idVehiculo, Tipos.Tipo, Vehiculos.Dominio, Vehiculos.Anio, Vehiculos.Precio, 
                                Modelos.Modelo, Marcas.Marca 
                           FROM Tipos INNER JOIN Vehiculos ON Tipos.idTipo = Vehiculos.idTipo
			        INNER JOIN Modelos ON Vehiculos.idModelo = Modelos.idModelo
                                INNER JOIN Marcas ON Modelos.idMarca = Marcas.idMarca
                       ORDER BY Tipos.Tipo");
  $numero = 0; 
   while($row = mysql_fetch_array($result))
  {
    echo "<tr><td width=\"25%\"><font face=\"verdana\"color=#33CC33 size=3>" . 
        $row["Tipo"] . "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\" color=#FF6633 size=2>" . 
	    $row["Marca"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"color= #333399 size=2>" . 
	    $row["Modelo"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"color= #FF0099 size=2>" . 
	    $row["Dominio"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"color= #009999 size=2>" . 
	    $row["Anio"]. "</font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"color= #6666FF
 size=2>" . 
	    $row["Precio"]. "</font></td>";
	
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='eliminarVehiculo.php?id=".$row['idVehiculo']."'>Eliminar</a></font></td>";
	echo "<td width=\"25%\"><font face=\"verdana\"><a href='editarVehiculo.php?id=".$row['idVehiculo']."'>Editar</a></font></td></tr>";
    $numero++;
  }
  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
      "</b></font></td></tr>";

?>
<font>
</BODY>
</html>