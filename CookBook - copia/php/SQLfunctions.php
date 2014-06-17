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
		return true;
	}

	function listarArreglo($array){
		foreach ($variable as $value) {
			if (isset($lista_array)){
				$lista_array=$lista_array.', '.$value;
			}else{
				$lista_array= $value;
			}
		}
		return $lista_array;	
	}

	function delete($tabla, $id){
		$sql="DELETE FROM $tabla WHERE id$tabla=$id";
		mysql_query($sql,$bd) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		return true;
	}

	function logic_delete($tabla, $id){
		$sql="UPDATE $tabla SET `baja` = 1 WHERE $id=$id";
		mysql_query($sql) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		return true;
	}
?>
