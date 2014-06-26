<?php
	require_once('config.php');
	function validar_dominio($dominio,$id){
			$sql="SELECT Dominio,idVehiculo FROM Vehiculos WHERE Dominio = '$dominio'";
			$consulta=mysql_query($sql);
			$cant = mysql_num_rows($consulta);
			if($cant == 0){
				return true;
			}else{
				$arrayid = mysql_fetch_array($consulta);
				$idv = $arrayid["idVehiculo"];
				if($id == $idv){
					return true;
				}
			}
			return false;
		}
	$bd=connect();
	if(isset($_POST['abm'])){
		$abm = $_POST['abm'];
		$tabla = $abm.'s';
		$valornuevo = $_POST["$abm"];
		$id = $_POST['id'];
		$idabm = 'id'.$abm;
		$inject = "`$abm` = '$valornuevo' ";
		if(isset($_POST['idmarca'])){
			$idmarca = $_POST['idmarca'];
			$inject = $inject.",`idMarca` = '$idmarca' ";
		}
	}

	if(isset($_POST["idtipo"])){
		$dominio = $_POST["dominio"];
		$id = $_POST['id'];
	if(!(validar_dominio($dominio,$id))){
		echo '<script language = javascript>
			alert("El dominio se encuentra en uso");
			self.history.back();
			</script>';
		exit;
	}
		if (isset($_POST["carac"])){
			$carac = array();
			$carac = $_POST["carac"];
			$tabla = "Vehiculos_Caracteristicas";
			$idabm = "idVehiculo";
			//realizar conexion a tabla caracteristicas
			$sql="DELETE FROM `$tabla` WHERE `$idabm` = $id";
			mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para actualizar tabla vehiculos_caracteristicas: ".mysql_error()."'); self.history.back();</script>");
			foreach ($carac as $valor){
				$sql = "INSERT INTO `$tabla` (`idVehiculoCaractesristica`,`idVehiculo`,`idCaracteristica`) values (NULL,'$id','$valor')";
				mysql_query($sql) or die("<script language = javascript> alert('Problema para actualizar tabla vehiculos_caracteristicas: ".mysql_error()."'); self.history.back();</script>");
			}			
		}
		$idmodelo = $_POST["idmodelo"];
		$idtipo = $_POST["idtipo"];
		$anio = $_POST["anio"];
		
		$precio = $_POST["precio"];
		$abm = 'Vehiculo';
		$tabla = $abm.'s';
		$idabm = 'id'.$abm;
		$inject = "`idModelo`= '$idmodelo', `idTipo` = '$idtipo', `Precio` = '$precio', `Dominio` = '$dominio', `Anio` = '$anio'";
	}




	$sql = "UPDATE `$tabla` SET $inject WHERE `$idabm` = '$id'";
	mysql_query($sql,$bd) or die("<script language = javascript> alert('Problema para actualizar: ".mysql_error()."'); self.history.back();</script>");
	echo '<script language = javascript>
		alert("se ha actualizado el elemento")
		self.history.go(-2);
		</script>';

?>