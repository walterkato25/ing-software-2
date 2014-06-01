<?php
	function filtrar_caracteristicas($caracteristicas, $tabla){
		$size = sizeof($caracteristicas);
		$lista_carac= implode(',',$caracteristicas);
		$lista_idvehiculos="SELECT idVehiculo FROM (SELECT q.idVehiculo, COUNT(q.idVehiculo) as cantidad From (SELECT idVehiculo,idCaracteristica FROM Vehiculos_Caracteristicas WHERE idCaracteristica IN ($lista_carac)) as q GROUP BY q.idVehiculo) as r WHERE cantidad =$size";
		$tabla = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo`,`idMarca`,`idModelo`,`idTipo`, tabla.`idVehiculo` FROM($tabla) as tabla INNER JOIN ($lista_idvehiculos) as listaidvehiculo ON tabla.idVehiculo = listaidvehiculo.idVehiculo";
		return $tabla;
	}






?>
