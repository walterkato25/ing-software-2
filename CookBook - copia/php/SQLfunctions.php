<?php
require_once("config.php");
	function update($tabla, $atributosvalores, $id){
		$toUpdate="";
		foreach ($atributosvalores as $atributo => $valor) {
			if($toUpdate!=""){
				$toUpdate.=", ";
			}
			$toUpdate.="`$atributo` = \"$valor\"";
		}
		$sql="UPDATE `$tabla` SET $toUpdate WHERE id$tabla=$id";
		mysql_query($sql) or die ("<script type='text/javascript'> alert(\"no se ha podido insertar el elemento\")</script>");
	}
	function insert($tabla, $atributosvalores){
		$lista_atributos='';
		$lista_valores='';
		foreach($atributosvalores as $atributo => $valor){
			if($lista_atributos!=''){
				$lista_atributos=$lista_atributos.', '.'`'.$atributo.'`';
			}else{
				$lista_atributos=$atributo;
			}
			if($lista_valores!=''){
				$lista_valores=$lista_valores.', '.'"'.$valor.'"';
			}else{
				$lista_valores='"'.$valor.'"';
			}
		}

		$sql="INSERT INTO $tabla ($lista_atributos) values ($lista_valores)";
		mysql_query($sql) or die ("<script type='text/javascript'> alert(\"no se ha podido insertar el elemento\"); self.history.back()</script>");
		
	}

	function select($tabla, $order='', $logic=false, $atributos='*'){
		if($atributos != "*"){
			$lista_atributos=implode(', ', $atributos);
		}else{
			$lista_atributos="*";
		}
		$sql="SELECT $lista_atributos FROM $tabla";
		if($logic){
			$sql=$sql.' WHERE `baja`= 0 ';
		}
		if($order != ""){
			$sql=$sql.' ORDER BY '.$order;
		}
		$query= mysql_query($sql);
		return $query;
	}

	function delete($tabla, $id){
		require_once("config.php");
		$sql="DELETE FROM $tabla WHERE id$tabla=$id";
		mysql_query($sql,connect()) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		
	}

	function logic_delete($tabla, $id){
		$sql="UPDATE $tabla SET `baja` = 1 WHERE id$tabla=$id";
		mysql_query($sql) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		
	}
?>
