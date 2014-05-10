 <?php
  include('liblocal.php');

  $sql = "INSERT INTO Caracteristicas (Caracteristica) values ('".$_POST['caracteristica']."')";

  $result = Mysql_query($sql);
  if ($result){
       echo "Se guardo el tipo ".$_POST["caracteristica"]." correctamente.";
  }
  include('apr.php');
  ?>