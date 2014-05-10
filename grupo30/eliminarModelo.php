<?php
  include('liblocal.php');
  
  $result = Mysql_query("SELECT count(*) as cantidad
                           FROM Vehiculos
                          WHERE Vehiculos.idModelo = ".$_GET['id']);
  $row = mysql_fetch_array($result);
  if ($row['cantidad'] > 0){
    echo "No se puede eliminar el modelo ya que existen vehiculos de ese modelo";
  } else {
	  $sql = "DELETE FROM Modelos WHERE idModelo = ".$_GET['id'];

	  $result = Mysql_query($sql);
	  if ($result){
		   echo "Se elimino el modelo seleccionado correctamente.";
	  }
  }
  include('nuevoModeloForm.php');
  ?>