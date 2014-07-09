<?php
require_once("php/config.php");
require_once("php/sesion.php");
sesion();
require_once("php/html.php");


function contenido(){
?>
<fieldset><legend>Cargar Portada</legend>
<form action="php/guardarPortada.php" method="post" enctype="multipart/form-data">
  <label for="archivo">Archivo:</label>
  <input type="file" name="archivo" id="archivo" />
  <br/>
  <input type="submit" value="Enviar" />
</form>
</fieldset>
<?php
}

$pagina="cargarPagina.php";
head("");
body($pagina);
?>