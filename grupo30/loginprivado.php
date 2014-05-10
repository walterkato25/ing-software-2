<?php
session_start();

  if ((isset($_SESSION["session_valida"]) && $_SESSION["session_valida"] == false) || (isset($_SESSION["session_valida"]) == false)){
      echo "No tiene permiso para acceder o es un usuario invalido!! Primero debe loguearse.  ";
      echo "<a href='./index.php'>Volver</a> o ";
      echo "<a href='./acceder.php'>Loguearse</a>";
      die;
  }
?>