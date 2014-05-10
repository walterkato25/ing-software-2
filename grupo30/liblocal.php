<?php
  // me conecto al servidor
  //$server_link = mysql_connect("localhost", "grupo30", "alaNSeba");
  $server_link = mysql_connect("localhost", "root", ""); // <== CAMBIAR ANTES DE ENTREGAR
  if(!$server_link){
    die("Fall&oacute; la Conexi&oacute;n ". mysql_error());
  }
  // elijo la base de datos
  $db_selected = mysql_select_db("grupo30", $server_link);
  if(!$db_selected){
      die("No se pudo seleccionar la Base de Datos ". mysql_error());
  }
  ?>