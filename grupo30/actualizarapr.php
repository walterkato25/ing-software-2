<?php
  include('privado.php');
  include('liblocal.php');

  $sql = "UPDATE Caracteristicas set Caracteristica = '".$_POST['Caracteristica']."' WHERE idCaracteristica = ".$_POST['idCaracteristica'];

  $result = Mysql_query($sql);
  if ($result){
       echo "Se actualizo el tipo ".$_POST["Caracteristica"]." correctamente.";
  }
  echo '<form name="volver_atras" action="apr.php" method="POST">
 <input type="submit" value="Volver"/>
 </form>';
 ?>