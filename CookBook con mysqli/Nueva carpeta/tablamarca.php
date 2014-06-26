<?php
		function tablamarca($idmarca){
			require_once("creartabla.php");
			$tablafull = creartabla();
			$consulta = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo` FROM($tablafull) as g ORDER BY g.`idMarca` ASC"; //as g WHERE g.`idMarca` = $idmarca"; 
			$tabla = mysql_query($consulta);
			return $tabla;
		}
?>
