<?php
	function filtrar_modelo($idmodelo, $tabla){
		$tabla = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo`,`idMarca`,`idModelo`,`idTipo`,`idVehiculo` FROM($tabla) as g WHERE g.`idModelo` = $idmodelo";
		return $tabla;
	}
?>
