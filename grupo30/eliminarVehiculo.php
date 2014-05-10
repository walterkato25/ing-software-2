<?php

  include('liblocal.php');
  
  $sql = "DELETE FROM Vehiculos_Caracteristicas WHERE idVehiculo = ".$_GET['id'];
  $result = Mysql_query($sql);
    
  $sql = "DELETE FROM Vehiculos WHERE idVehiculo = ".$_GET['id'];

  $result = Mysql_query($sql);
  if ($result){
      echo "Se elimino el vehiculo seleccionado correctamente.";
  }
  include('nuevovehiculoForm.php');