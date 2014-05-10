<?php
  include('liblocal.php');
  
  
	  $sql = "DELETE FROM Usuarios WHERE Usuario = ".$_GET['id'];

	  $result = Mysql_query($sql);
	  if ($result){
		   echo "Se elimino el tipo seleccionado correctamente.";
	  }
  
  include('nuevoUsuarioForm.php');
  ?>