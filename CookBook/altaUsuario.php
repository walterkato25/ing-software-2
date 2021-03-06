<?php
require_once("php/sesion.php");
require_once("php/SQLfunctions.php");
require_once("php/config.php");
require_once("php/html.php");
sesion();
if(isset($_SESSION["categoria"]) && $_SESSION["categoria"]=="usuario"){
	header("location:menuUsuario.php");
}
head("js/validar_formularios.js");
body("altaUsuario.php");

function contenido(){
?>

			<form name="login" autocomplete="on" onsubmit="return validar_altaCliente(this);" method="POST" action="php/insertarUsuario.php">
							<fieldset style="margin-left:auto;margin-right:auto;width:500px">
							<legend>Registrarse:</legend>
							<table rules ="rows">
								<tr><td class="label"><label>Usuario:</label></td><td class="input"><input type="text" autofocus autocomplete="off" name="nombreDeUsuario" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Contraseña:</label></td><td class="input"><input type="password" autocomplete="off" name="password"><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Repita Contraseña:</label></td><td class="input"><input type="password" autocomplete="off" name="contraseña2" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Nombre:</label></td><td class="input"><input type="text" name="nombre" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Apellido:</label></td><td class="input"><input type="text" name="apellido" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Mail:</label></td><td class="input"><input type="mail" name="mail" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>DNI:</label></td><td class="input"><input type="text" name="dni_cuit" maxlength="11" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Teléfono:</label></td><td class="input"><input type="tel" name="tel" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Código Postal:</label></td><td class="input"><input type="text" maxlength="4" name="cp" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Localidad:</label></td><td class="input"><input type="text" name="localidad" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Calle:</label></td><td class="input"><input type="text" name="calle" ><span id="obligatorio">*</span></td></tr>
								<tr><td class="label"><label>Número:</label></td><td class="input"><input type="number" name="nro" ></td></tr>
								<tr><td class="label"><label>Piso:</label></td><td class="input"><input type="number" name="piso" ></td></tr>
								<tr><td class="label"><label>Departamento:</label></td><td class="input"><input type="text" name="depto" ></td></tr>
								<tr><td class="label"></td><td class="input"><input type="submit" name="enviar" value="Crear Usuario" style=""></td></tr>	
							</table>
							<span id= "obligatorio">Los campos con * deben llenarse obligatoriamente</span>
							</fieldset>
						
                 </form>   
<?php
}
?>