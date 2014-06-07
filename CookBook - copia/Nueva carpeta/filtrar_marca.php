<?php
	function filtrar_marca($idmarca, $tabla){
		$consulta = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo`,`idMarca`,`idModelo`,`idTipo`,`idVehiculo` FROM($tabla) as g WHERE g.`idMarca` = $idmarca";
		return $consulta;
	}
?>
