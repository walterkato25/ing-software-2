<?php
		function creartabla(){
			$tablamodelos = "SELECT `Marca`,`Modelo`,`idModelo`,d.`idMarca` FROM `Modelos` as d INNER JOIN `Marcas` as b ON b.`idMarca` = d.`idMarca`";
			$tablavehiculos = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`idTipo`,`idMarca`,a.`idModelo`,a.`idVehiculo` FROM `Vehiculos` as a INNER JOIN ($tablamodelos)as c ON a.`idModelo` = c.`idModelo`";
			$tabla = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo`,`idMarca`,`idModelo`,e.`idTipo`,`idVehiculo` FROM($tablavehiculos) as e INNER JOIN `Tipos` as f ON e.`idTipo` = f.`idTipo`";
			return $tabla;
		}
?>		
