<?php
  
      include('liblocal.php');
  
      $sql = "DELETE FROM Usuarios WHERE Usuarios.idUsuario = ".$_GET['id'];

	  $result = Mysql_query($sql);
	  if ($result){
		   echo "Se elimino el Usuario seleccionado correctamente.";
	  }
  
     include('nuevoUsuarioForm.php');
  ?>