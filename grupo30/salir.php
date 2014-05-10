<?php
// Inicializar la sesión.
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();
?>

<!DOCTYPE html>
<html class=web style="background-color:#FFCD9B;">
<link rel='stylesheet' type='text/CSS' title='default' href='Estilos/index.css'/>

<head>
    <div class=heading style="background-image:URL(Img/textura3.png);">
    <title>Concesionaria Alfa</title> 
	<img src="Img/logo.png" height="50px" width="75px" alt="logo" style="float:left"/>
	<h2>Concesionaria Alfa</h2>	
	</div>
</head>
<body>
<div class=menu style="float:left; background-image:URL(Img/textura2.png);"> <!-- barra lateral izquierda --></div>
<a href='./index.php'>Inicio</a>
<div style="background-image:URL(Img/textura3.png); width:804px; height:70px; color:white;">
  <p><b>Ha salido del acceso privado.</b></p>
  <b>Para mas info enviar un correo a concecionaria@grupo30.com  o al telefono 467-7662851</b>
</div><!--pie--> 
</body>
</html>