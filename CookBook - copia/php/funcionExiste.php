<?php
function existeDatoUsuario($atributo,$valor){
	$sql="SELECT idUsuario FROM `usuario` WHERE `$atributo`=\"$valor\"";
	$query= mysql_query($sql);
	$existe=mysql_num_rows($query);
	return $existe;
}