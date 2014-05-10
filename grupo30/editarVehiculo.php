<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<html>
  <head>
    <script type="text/javascript">
	function cargarModelos() {
	    document.forms["marca"].submit()
	}
	
	function validarFormVehiculo(){
	    var marca = document.forms["marca"].idMarca.value;
	    var modelo = document.forms["editVehiculoForm"].idModelo.value;
	    var dominio = document.forms["editVehiculoForm"].dominio.value;
	    var anio = document.forms["editVehiculoForm"].anio.value;
	    var precio = document.forms["editVehiculoForm"].precio.value;
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
			        document.forms["editVehiculoForm"].submit();
			    }
			}
		    }
		}
	    }
	}
    </script>
</head>

<body>
<?php
  include('privado.php');
  include('liblocal.php'); 
  $result = Mysql_query("SELECT Tipos.idTipo, Modelos.idMarca, Vehiculos.idModelo, Vehiculos.Dominio, Vehiculos.Precio, Vehiculos.Anio, Vehiculos.idVehiculo
                           FROM Tipos INNER JOIN Vehiculos ON Tipos.idTipo = Vehiculos.idTipo
			        INNER JOIN Modelos ON Vehiculos.idModelo = Modelos.idModelo
                          WHERE Vehiculos.idVehiculo = ".$_GET['id']);
						  
  $rowveh = mysql_fetch_array($result);
?>

<font face="Verdana" size="2">

<form name="marca" action="editarVehiculo.php" method="GET">
 <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
 Marca: <select name="idMarca" onchange="cargarModelos();">
 
 <?php
 $result = Mysql_query("SELECT Marcas.idMarca, Marcas.Marca
                          FROM Marcas
		      ORDER BY Marcas.Marca");
  while($row = mysql_fetch_array($result))
  {
      if (isset($_GET["idMarca"])){ 
	  $marca = $_GET["idMarca"];    
       } else {
	  $marca = $rowveh["idMarca"]; 
       }
      if ($marca == $row['idMarca']){
          echo "<option value='".$row['idMarca']."' selected='selected'>".$row['Marca']."</option>";
      } else {
	  echo "<option value='".$row['idMarca']."'>".$row['Marca']."</option>";
      }
  }
  echo '</select>';
  echo '</form>';
  echo '<form name="editVehiculoForm" action="actualizarVehiculo.php" method="POST">'; 
 echo 'Modelo: <select name="idModelo">';
  if (isset($_GET["idMarca"])){ 
     $marca = $_GET["idMarca"];    
  } else {
     $marca = $rowveh["idMarca"]; 
  }
  $result = Mysql_query("SELECT Modelos.idModelo, Modelos.Modelo
			    FROM Modelos
			   WHERE Modelos.idMarca = ".$marca."
			ORDER BY Modelos.Modelo");
   while($row = mysql_fetch_array($result))
   {
       if ($rowveh["idModelo"] == $row['idModelo']){
           echo "<option value='".$row['idModelo']."' selected='selected'>".$row['Modelo']."</option>";
       } else {
	   echo "<option value='".$row['idModelo']."'>".$row['Modelo']."</option>";
       }
   }
echo "</select><br>";
echo 'Tipo: <select name="idTipo">';
      $result = Mysql_query("SELECT Tipos.idTipo, Tipos.Tipo
                               FROM Tipos
                           ORDER BY Tipos.Tipo");
      while($row = mysql_fetch_array($result))
      {
	  if ($rowveh["idTipo"] == $row['idTipo']){
              echo "<option value='".$row['idTipo']."' selected='selected'>".$row['Tipo']."</option>";
	  } else {
	    echo "<option value='".$row['idTipo']."'>".$row['Tipo']."</option>";
	  }
      }
echo "</select>"; ?>
 <br>
 <input type="hidden" name="idVehiculo" value="<?php echo $rowveh['idVehiculo'] ?>">
 Dominio: <input type="text" maxlength="6" size="4" name="dominio"  value="<?php echo $rowveh['Dominio'] ?>">
 <br>
 Anio: <input type="text" maxlength="4" size="2" name="anio" value="<?php echo $rowveh['Anio'] ?>">
 <br>
 Precio: <input type="text" name="precio" size="6" value="<?php echo $rowveh['Precio'] ?>">
 <br>
 <input type="button" onclick="validarFormVehiculo();" value="Guardar" />
</font>
</form>

</body>  
</html>