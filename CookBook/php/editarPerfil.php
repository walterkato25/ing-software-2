<?php
	function getCliente($id){
		require_once("config.php");
		$sql="SELECT nombreDeUsuario , apellido , nombre, tel, `dni/cuit`, mail FROM `usuario` WHERE `idUsuario` = $id";
		$query=mysql_query($sql);
		while($row = mysql_fetch_assoc($query)){
			foreach ($row as $atributo => $valor) {
				inputDinamico("usuario", $atributo, $valor, $id);
			}
			
		}
	}
	function inputDinamico($tabla, $nombre, $valor, $id, $type="text"){
		require_once("SQLfunctions.php");
		if(isset($_POST[$nombre])){
			update($tabla, $nombre, $_POST[$nombre], $id);
			echo "<p id='modificado'>El campo $nombre se ha cambiado correctamente</p>";
		}
		echo '<form name="'.$nombre.'" method="POST" >';
		echo "<label for=$nombre>$nombre</label>: ";
		if(isset($_POST['update']) && $_POST['update']==$nombre){
			$a=$_POST['update'];
	   		echo '<input autofocus name="'.$nombre.'" type="'.$type.'" value="';
		}
		if(isset($_POST[$nombre])){
			echo $_POST[$nombre];
		}else{
	    	echo $valor;
		}
		if(isset($_POST['update']) && $_POST['update']==$nombre){
	    	echo '" />';
		}
		if(isset($_POST['update']) && $_POST['update']==$nombre){
	       			echo "<input value='Save' type='submit' />";
   			echo "<input value='Cancel' type='button' onclick='location.reload();' />";
		}else{
   			echo "<input name='update' type='hidden' value='$nombre' />";
    		echo "<input value='Edit' type='submit' /></br>";
    	}
    	echo "</form>";
	}
	?>