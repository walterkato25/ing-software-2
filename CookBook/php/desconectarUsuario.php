<?php
session_start();

if (isset($_SESSION['idUsuario'])){
	session_destroy();
	echo '<script language = javascript>
	alert("Ha cerrado sesion correctamente")
	self.history.back()
	</script>';
}
else
{
	echo '<script language = javascript>
	alert("No ha iniciado ninguna sesion")
	self.location = "../login.php"
	</script>';
}
	
?>
