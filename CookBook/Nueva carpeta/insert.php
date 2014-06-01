<?php
require_once('config.php');
if(isset($_POST['abm'])){
	$abm = $_POST['abm'];
	$valor = $_POST["$abm"];
	$tabla = $abm.'s';
	$idabm = 'id'.$abm;
	$inj_col = "`$idabm`,`$abm`";
	$inj_val = "NULL,'$valor'";
	//inject modelo
	if(isset($_POST['idmarca'])){
		$idmarca = $_POST['idmarca'];
		$inj_col = $inj_col.",`idMarca`";
		$inj_val = $inj_val.",'$idmarca'";
	}

$sql = "INSERT INTO `$tabla` ($inj_col) values ($inj_val)";
mysql_query($sql) or die("<script language = javascript> alert('Problema para agregar: ".mysql_error()."'); self.history.back();</script>");
echo '<script language = javascript>
	alert("se ha agregado el elemento")
	self.history.go(-2);
	</script>';
}
//alta vehiculo
function validar_dominio($dominio){
			$sql="SELECT Dominio FROM Vehiculos WHERE Dominio = '$dominio'";
			$consulta=mysql_query($sql);
			$cant = mysql_num_rows($consulta);
			if($cant == 0){
				return true;
			}
			return false;
		}
if(isset($_POST["idtipo"])){
		
		$idmodelo = $_POST["idmodelo"];
		$idtipo = $_POST["idtipo"];
		$anio = $_POST["anio"];
		$dominio = $_POST["dominio"];
		if(!(validar_dominio($dominio))){
			echo '<script language = javascript>
			alert("El dominio se encuentra en uso");
			self.history.back();
			</script>';
		}else{
			$precio = $_POST["precio"];
			$abm = 'Vehiculo';
			$tabla = $abm.'s';
			$idabm = 'id'.$abm;
			$inj_col = "`idVehiculo`,`idModelo`,`idTipo`,`Precio`,`Dominio`,`Anio`";
			$inj_val = "NULL,'$idmodelo','$idtipo','$precio','$dominio','$anio'";

			$sql = "INSERT INTO `$tabla` ($inj_col) values ($inj_val)";
			mysql_query($sql) or die("<script language = javascript> alert('Problema para agregar: ".mysql_error()."'); self.history.back();</script>");


			if (isset($_POST["carac"])){
				$sql = "SELECT `idVehiculo` FROM `$tabla` WHERE `Dominio` = '$dominio'";
				$query = mysql_query($sql) or die("<script language = javascript> alert('Problema para agregar: ".mysql_error()."'); self.history.back();</script>");
				$idvehiculoarray = mysql_fetch_array($query);
				$idvehiculo = $idvehiculoarray['idVehiculo'];
				$carac = array();
				$carac = $_POST["carac"];
				$tabla = "Vehiculos_Caracteristicas";
				$idabm = "idVehiculo";
				//realizar conexion a tabla caracteristicas
				foreach ($carac as $valor){
					$sql = "INSERT INTO `$tabla` (`idVehiculoCaractesristica`,`idVehiculo`,`idCaracteristica`) values (NULL,'$idvehiculo','$valor')";
					mysql_query($sql) or die("<script language = javascript> alert('Problema para actualizar tabla vehiculos_caracteristicas: ".mysql_error()."'); self.history.back();</script>");
				}			
			}
			echo '<script language = javascript>
				alert("se ha agregado el elemento")
				self.history.go(-2);
				</script>';
		}
}

?>