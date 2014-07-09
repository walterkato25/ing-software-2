<?php
header("Content-type: text/html; charset=utf-8");
session_start();

if (isset($_SESSION['idUsuario'])){
	session_destroy();
	echo '<script language = javascript>
	alert("Ha cerrado sesión correctamente")
	self.history.back()
	</script>';
}
else
{
	echo '<script language = javascript>
	alert("No ha iniciado ninguna sesión")
	self.location = "../login.php"
	</script>';
}
	
?>
