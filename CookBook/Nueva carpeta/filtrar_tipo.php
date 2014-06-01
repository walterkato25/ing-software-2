<?php
	function filtrar_tipo($idtipo, $tabla){
		$tabla = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo`,`idMarca`,`idModelo`,`idTipo`,`idVehiculo` FROM($tabla) as g WHERE g.`idTipo` = $idtipo";
		return $tabla;
	}
?>
