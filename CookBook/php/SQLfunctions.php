<?php
	function update($tabla, $atributo, $valor, $id){
		$sql="UPDATE `$tabla` SET $atributo = \"$valor\" WHERE id$tabla=$id";
		mysql_query($sql) or die ("<script type='text/javascript'> alert(\"no se ha podido modificar el campo $atributo\")</script>");
	}
	function insert($tabla, $atributos, $valores){
		$lista_atributos=implode(', ', $atributos);
		$lista_valores=implode(', ', $valores);
		$sql="INSERT INTO $tabla ($lista_atributos) values ($lista_valores)";
		mysql_query($sql) or die ("<script type='text/javascript'> alert(\"no se ha podido insertar el elemento\")</script>");
		
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
		$sql="DELETE FROM $tabla WHERE id$tabla=$id";
		mysql_query($sql,$bd) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		
	}

	function logic_delete($tabla, $id){
		$sql="UPDATE $tabla SET `baja` = 1 WHERE id$tabla=$id";
		mysql_query($sql) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		
	}
?>
