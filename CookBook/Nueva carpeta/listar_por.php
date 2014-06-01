<?php
		function listar_por($listarx,$orden,$tabla){
			$tabla = "SELECT `Marca`,`Anio`,`Precio`,`Modelo`,`Tipo`,`idVehiculo` FROM($tabla) as g ORDER BY g.`$listarx` $orden"; 
			return $tabla;
		}
?>
