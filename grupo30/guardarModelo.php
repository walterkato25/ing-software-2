<?php
  include('liblocal.php');

  $sql = "INSERT INTO Modelos (idMarca, Modelo) values (".$_POST['idMarca'].", '".$_POST['modelo']."')";

  $result = Mysql_query($sql);
  if ($result){
       echo "Se guardo el modelo ".$_POST["modelo"]." correctamente.";
  }
  include('nuevoModeloForm.php');
  ?>