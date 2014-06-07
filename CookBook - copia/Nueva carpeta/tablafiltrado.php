<?php
		function tablafiltrado($idmodelo,$idmarca){
			require_once("creartabla.php");
			$tablafull = creartabla();
			$consulta = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo`,`idMarca` FROM($tablafull) as g WHERE g.`idModelo` = $idmodelo";
			$consulta2 = "SELECT `Marca`,`Dominio`,`Anio`,`Precio`,`Modelo`,`Tipo` FROM($consulta) as h WHERE h.`idMarca` = $idmarca";
			$tabla = mysql_query($consulta2);
			return $tabla;
		}
?>
