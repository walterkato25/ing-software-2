<?php
		function tablaprecio($min = 0, $max = 1000000){
			require_once("creartabla.php");
			$tablafull = creartabla();
			$consulta = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo` FROM($tablafull) as g ORDER BY g.`Precio` ASC"; //as g WHERE g.`Precio` BETWEEN $min and $max";
			$tabla = mysql_query($consulta);
			return $tabla;
		}
		
?>
