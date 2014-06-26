<?php
require_once("php/config.php");
require_once("php/html.php");
require_once("php/sesion.php");
sesion();
require_once("php/config.php");
require_once("php/VIEWfunctions.php");
if(!(isset($_SESSION["categoria"])) || ($_SESSION["categoria"]!="administrador")){
	header("location:index.php");
}
$pagina="usuarios.php";
function contenido(){
	viewABM("Usuario");
}
head("");
body($pagina);
?>