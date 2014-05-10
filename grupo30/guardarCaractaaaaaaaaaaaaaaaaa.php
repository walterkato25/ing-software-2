<?php
 include('liblocal.php');
 $sql= "INSERT INTO Caracteristicas (Caracteristica) values ('".$_POST["caracteristica"]."')";
 $result= Mysql_query($sql);
 if($result){
  echo "Se guardo la caracteristica: ".$_POST["caracteristica"]." correctamente.";}
 include('nvt3.php');
?> 