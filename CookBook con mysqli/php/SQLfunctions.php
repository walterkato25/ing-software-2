<?php
 $link = mysqli_connect("localhost", "root", "","cookbook");
	function update($tabla, $atributosvalores, $id){
		$toUpdate="";
		foreach ($atributosvalores as $atributo => $valor) {
			if($toUpdate!=""){
				$toUpdate.=", ";
			}
			$toUpdate.="$atributo = \"$valor\"";
		}
		$sql="UPDATE `$tabla` SET $toUpdate WHERE id$tabla=$id";
		mysqli_query($link,$sql) or die ("<script type='text/javascript'> alert(\"no se ha podido insertar el elemento".mysql_error()."\")</script>");
	}
	function insert($tabla, $atributosvalores){
		$lista_atributos='';
		$lista_valores='';
		foreach($atributosvalores as $atributo => $valor){
			if($lista_atributos!=''){
				$lista_atributos=$lista_atributos.', '.$atributo;
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
		mysqli_query($link,$sql) or die ("<script type='text/javascript'> alert(\"no se ha podido insertar el elemento".mysql_error()."\"); self.history.back()</script>");
		
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
		$link = mysqli_connect("localhost", "root", "","cookbook");
		$query= mysqli_query($link,$sql);
		return $query;
	}

	function delete($tabla, $id){
		require_once("config.php");
		$sql="DELETE FROM $tabla WHERE id$tabla=$id";
		 mysqli_query($link,$sql) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		
	}

	function logic_delete($tabla, $id){
		$sql="UPDATE $tabla SET `baja` = 1 WHERE id$tabla=$id";
		mysqli_query($link,$sql) or die("<script type='text/javascript'> alert(\"no se ha podido eliminar el elemento\")</script>");
		
	}
?>
