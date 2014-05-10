<?php  
  include('liblocal.php');

  $sql = "UPDATE Tipos set Tipo = '".$_POST['tipo']."' WHERE idTipo = ".$_POST['idTipo'];

  $result = Mysql_query($sql);
  if ($result){
       echo "Se actualizo el tipo ".$_POST["tipo"]." correctamente.";
  }
  include('nuevoTipoForm.php');
?>  