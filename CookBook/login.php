<?php
require_once("php/sesion.php");
require_once("php/html.php");
sesion();
if(isset($_SESSION["categoria"])){
	header("location:index.php");
}
head("");
$pagina="login.php";
body($pagina);
function contenido(){
	?>
			<form id="contacto" name="login" method="post" action="php/validarsesion.php">
							<fieldset style="padding:15px;width:300px">
							<legend>Iniciar Sesión:</legend>
							<label>Usuario:</label><input type="text" name="user" required><br><br>
							<label>Contraseña:</label><input type="password" name="pass" required><br><br>
							<input type="submit" name="enviar" value="Iniciar Sesión" style="margin-left:150px;"> <br><br>
							<span> <a href="altaUsuario.php">Crear cuenta</a></span>
							</fieldset>
            </form>   
            <?php
        }
        ?>