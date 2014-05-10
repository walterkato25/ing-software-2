<?php
  include('liblocal.php');

  $sql = "INSERT INTO Vehiculos (idModelo, idTipo, Dominio, Anio, Precio)
          values (".$_POST['idModelo'].", ".$_POST['idTipo'].", '".$_POST['dominio']."', '".$_POST['anio']."', ".$_POST['precio'].")";

  $result = Mysql_query($sql);
  if ($result){
       echo "Se guardo el vehiculo patente ".$_POST["dominio"]." correctamente.";
  }
  include('nuevovehiculoForm.php');
  ?>