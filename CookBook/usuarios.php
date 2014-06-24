<?php
require_once("php/config.php");
require_once("php/html.php");
require_once("php/sesion.php");
sesion();
require_once("php/config.php");
require_once("php/VIEWfunctions.php");
$pagina="usuarios.php";
function contenido(){
	viewABM("Usuario");
}
head("");
body($pagina);
?>