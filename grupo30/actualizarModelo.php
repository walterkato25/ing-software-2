<?php
  include('liblocal.php');

  $sql = "UPDATE Modelos set Modelo = '".$_POST['modelo']."' WHERE idModelo = ".$_POST['idModelo'];

  $result = Mysql_query($sql);
  if ($result){
       echo "Se actualizo el modelo ".$_POST["modelo"]." correctamente.";
  }
  include('nuevoModeloForm.php');
?>  