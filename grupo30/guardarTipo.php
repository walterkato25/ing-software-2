<?php
  include('liblocal.php');

  $sql = "INSERT INTO Tipos (Tipo) values ('".$_POST['tipo']."')";

  $result = Mysql_query($sql);
  if ($result){
       echo "Se guardo el tipo ".$_POST["tipo"]." correctamente.";
  }
  include('nuevoTipoForm.php');
  ?>