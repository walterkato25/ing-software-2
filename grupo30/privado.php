<?php
session_start();

include('liblocal.php');

if (isset($_POST["usuario"]) && isset($_POST["clave"])){
	$result = Mysql_query("SELECT *                                
							 FROM Usuarios
							WHERE Usuarios.Usuario = '".$_POST['usuario']."'
							  AND Usuarios.Clave = '".$_POST['clave']."'");
	if (Mysql_num_rows($result) > 0){
		$_SESSION['session_valida']  = true;
	} else {
		$_SESSION['session_valida']  = false;
	}
}

if ((isset($_SESSION["session_valida"]) && $_SESSION["session_valida"] == false) || (isset($_SESSION["session_valida"]) == false)){
    echo "No tiene permiso para acceder o es un usuario invalido!! Primero debe loguearse.  ";
	echo "<a href='./index.php'>Volver</a> o ";
	echo "<a href='./acceder.php'>Loguearse</a>";
	die;
}

?>
<!DOCTYPE html>
<html class=web style="background-color:#FFCD9B;">
<link rel='stylesheet' type='text/CSS' title='default' href='Estilos/index.css'/>

<head>
    <div class=heading style="background-image:URL(Img/textura3.png);">
    <title>Concesionaria Alfa - Administrador</title> 
	<img src="Img/logo.png" height="50px" width="75px" alt="logo" style="float:left"/>
	<h2>Concesionaria Alfa</h2>	
	</div>
</head>
<body>

<div class=menu style="float:left; background-image:URL(Img/textura2.png);"> <!-- barra lateral izquierda -->
   <br>
   <code style="color:white">______</code>
   <a href='index.php'style="magin-left:30px; text-decoration:none; color:white">Inicio</a>
   <code style="color:white">______</code>
       <a href='acceder.php'style="magin-left:30px; text-decoration:none; color:white">Acceder</a>  
  <code style="color:white">______</code>   
       <a href='llegar.php'style="magin-left:30px; text-decoration:none; color:white">Como llegar</a>
  <code style="color:white">______</code>
       <a href='listado.php'style="magin-left:30px; text-decoration:none; color:white">Lista de vehiculos</a>
  <code style="color:white">______</code>   
  <a href='privado.php'style="magin-left:30px; text-decoration:none; color:white">Privado</a>
  <code style="color:white">______</code>
  <a href='salir.php'style="magin-left:30px; text-decoration:none; color:white">Salir</a>
   <code style="color:white">______</code>
</div>
<div class=menu style="float:right; background-image:URL(Img/textura2.png);"> <!-- barra lateral derecha -->
</div>
<br>
<!-- contenido -->
<u><h2 style="text-align:center"><u>Panel de Control</u><h2></u>

<form name="TipoVehículos" action="nuevoTipoForm.php" method="POST">
<input type="submit" value="ABM de tipos de vehiculos" />
</form>

<form name="Usuario" action="nuevoUsuarioForm.php" method="POST">
<input type="submit" value="Listado de Usuarios" />
</form>


<form name="MarcasModelosVehículos" action="nuevoModeloForm.php" method="POST">
<input type="submit" value="ABM de marcas y modelos de los vehiculos"/>
</form>
<form name="ABCaracteristica" action="apr.php" method="POST">    
<input type="submit" value="Alta baja de las caracteristicas de los autos"/>
</form>
<form name="ABMVehículos" action="nuevovehiculoForm.php" method="POST">
<input type="submit" value="ABM de Vehiculos"/>
</form>

<div style="background-image:URL(Img/textura3.png); text-align:center; font-size:20px; width:804px; height:70px; color:white;"><b>Concesionaria alfa - Panel de administracion</b></div><!--pie--> 

</body>
</html>