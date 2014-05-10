<?php
  include('liblocal.php');
  
  $sql = "UPDATE Vehiculos set idModelo = ".$_POST["idModelo"].",
                               idTipo = ".$_POST["idTipo"].",
                               Dominio = '".$_POST["dominio"]."',
                               Anio = '".$_POST["anio"]."',
                               Precio = ".$_POST["precio"]."
                     WHERE idVehiculo = ".$_POST['idVehiculo'];

  $result = Mysql_query($sql);
  if ($result){
       echo 'Se actualizo el vehiculo Patente '.$_POST["dominio"].' correctamente.';
  }
  include('nuevovehiculoForm.php');
 ?>