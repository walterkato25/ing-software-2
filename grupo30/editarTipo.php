<html>
<?php
  include('privado.php');
  include('liblocal.php');
  
  $result = Mysql_query("SELECT *
                           FROM Tipos
                          WHERE Tipos.idTipo = ".$_GET['id']);
						  
  $row = mysql_fetch_array($result);
?>
<form name="editTipoForm" action="actualizarTipo.php" method="POST">
 <input type="hidden" name="idTipo" value="<?php echo $row['idTipo'] ?>">
Cambiar valor por: <input type="text" name="tipo" value="<?php echo $row['Tipo'] ?>">
 <br>
 <input type="submit" value="Guardar" />
</form>

</html>