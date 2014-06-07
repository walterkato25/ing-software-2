<?php
$mysql_hostname = "localhost";
$mysql_user = "grupo17";
$mysql_password = "nahuELROman";
$mysql_database = "grupo17";
$error = "No se pudo conectar a la base de datos: ";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die($error.mysql_error());
mysql_select_db($mysql_database, $bd) or die($error.mysql_error());
function connect(){
	$mysql_hostname = "localhost";
	$mysql_user = "grupo17";
	$mysql_password = "nahuELROman";
	$mysql_database = "grupo17";
	$error = "No se pudo conectar a la base de datos: ";
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
	or die($error.mysql_error());
	mysql_select_db($mysql_database, $bd) or die($error.mysql_error());
	return $bd;
}
?>
