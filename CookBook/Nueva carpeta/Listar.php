<?php
	function generarLista($idmarca,$idmodelo,$idtipo,$caracteristicas,$listarx,$orden){
		require_once("listarvehiculos.php");
		require_once("creartabla.php");
		require_once("filtrar_marca.php");
		require_once("filtrar_modelo.php");
		require_once("filtrar_tipo.php");
		require_once("filtrar_caracteristicas.php");
		require_once("listar_por.php");
		$tabla = creartabla();
		if($idmarca != ""){
			$tabla = filtrar_marca($idmarca,$tabla);
		}
		if($idmodelo != ""){
			$tabla = filtrar_modelo($idmodelo, $tabla);
		}
		if($idtipo != ""){
			$tabla = filtrar_tipo($idtipo,$tabla);
		}
		if($caracteristicas != null){
			$tabla = filtrar_caracteristicas($caracteristicas, $tabla);
		}
		$tabla = listar_por($listarx, $orden, $tabla);
		$tabla = mysql_query($tabla);
		listarvehiculos($tabla);
	}
?>
