<?php $id=2; $precio=35.50; $stock=5; ?>
<?php 
require_once("php/config.php");
require_once("php/sesion.php");
sesion();
?>
<?php
if(isset($_SESSION["carrito"])&&(isset($_SESSION["carrito"][$_GET["id"]]))){
?>
<div id="agregado"> Producto agregado. Cantidad: <?php echo $_SESSION["carrito"][$_GET["id"]]["cantidad"] ?> </div>
<?php
}else{
?>
<form method="POST" action="php/carrito.php" onsbmit="if(!confirm('Desea agregar el producto al carrito?'))return false">
<input type="hidden" name="precio" value="<?php echo $precio ?>" />
<input type="hidden"  name="idLibro" value="<?php echo $id ?>" />
<input name="cantidad" type="number" min="1" max="<?php echo $stock ?>" value="1" />
<input type="submit" name="agregar" value="Agregar a Carrito" />
</form>
<?php
}
?>