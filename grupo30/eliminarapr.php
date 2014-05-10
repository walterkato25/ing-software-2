<?php
  include('liblocal.php');
  
  $result = Mysql_query("SELECT count(*) as cantidad
                          FROM Vehiculos_Caracteristicas
                          WHERE Vehiculos_Caracteristicas.idCaracteristica = ".$_GET['id']);
  $row = mysql_fetch_array($result);
  if ($row['cantidad'] > 0){
    echo "No se puede eliminar la caracteristica ya que existen vehiculos de esa caracteristica";
  } else {
	  $sql = "DELETE FROM Caracteristicas WHERE idCaracteristica = ".$_GET['id'];

	  $result = Mysql_query($sql);
	  if ($result){
		   echo "Se elimino la caracteristica seleccionado correctamente.";
	  }
  }
  include('apr.php');
?>