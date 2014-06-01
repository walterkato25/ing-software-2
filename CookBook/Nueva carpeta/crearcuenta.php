<HTML><HEAD><link href="style.css" type="text/css" rel="stylesheet">
<?php
require_once("config.php");
function validar_usuario($query , $username){
	
	while ($row = mysql_fetch_assoc($query)) {
		$a= $row['Usuario'];
		if($a==$username){
			return false;
		}
	}
	return true;
}
/*
function validar_campos(form) {
			if(form.user.value.length == 0) {
				form.user.focus();
      	   	  	alert("Introduzca un usuario."); 
            	return false;  
        	}
        	if(form.pass.value.length == 0) {
				form.pass.focus();
      	   	  	alert("Introduzca una contraseña."); 
            	return false;  
        	}
			if(form.pass2.value.length == 0) {
				form.pass2.focus();
      	   	  	alert("Repita la contraseña."); 
            	return false;  
        	}
        	return true;            
}
*/
?>
</HEAD><BODY><div id="content" style="padding:20px; width:650px; background-color:#EBEDF4;margin:auto;">

<form id="contacto" name="newlogin" method="post" action="crearcuenta.php" onsubmit="return validar_campos(this);">
		<fieldset style="padding:15px;width:500px" >
			<legend>Crear cuenta:</legend>
			<table>
			<tr><td>Usuario:</td><td><input type="text" name="usua" class="required"></td></tr>
			<tr><td>Contraseña:</td><td><input type="password" name="cont" class="required"></td></tr>
			<tr><td>Confirmar contraseña:</td><td><input type="password" name="pass2" class="required"></td></tr>
			<tr><td></td><td><input type="submit" name="enviar" value="Crear" ><input type="button" name="cancelar" value="Cancelar" onclick="self.location='index.php'"></td></tr>
			</table>
		</fieldset>
	</form> 

<?php
if((isset($_POST["usua"]))&&(isset($_POST["cont"]))&&(isset($_POST["pass2"]))){
	$username = $_POST["usua"]; 
	$password = $_POST["cont"];
	$password2 = $_POST["pass2"];
	if ($password == $password2){
		$sql = "SELECT * FROM `Usuarios` WHERE `Usuario` = \"$username\" AND `Clave` = \"$password\""; //consulto a la bd si los datos estan guardados
		$query = mysql_query($sql);
		$agregar=validar_usuario($query , $username);	
		if($agregar){
			$consulta="INSERT INTO `grupo17`.`Usuarios` (`idUsuario`, `Usuario`, `Clave`) VALUES (NULL, '$username', '$password')";
			$resultado = mysql_query($consulta) or die("<script language = javascript> alert('Problema para agregar: ".mysql_error()."'); self.history.back();</script>");;
			echo '<script language = javascript>
			alert("se ha agregado el usuario")
			self.location = "login.php";
			</script>';
		}	
		else{
			echo '<script language = javascript>
			alert("Usuario ya existente, ingrese otro nombre de usuario")
			self.location = "login.php";
			</script>';
		}
	}
	else{
		echo '<script language = javascript>
		alert("Verifique contraseña")
		self.historyback();
		</script>';
	}
}


?>
</div></BODY>
</HTML>
