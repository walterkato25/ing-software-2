<html>
<?php
  include('privado.php');
  include('liblocal.php');
  
  $result = Mysql_query("SELECT *
                           FROM Modelos
                          WHERE Modelos.idModelo = ".$_GET['id']);
						  
  $row = mysql_fetch_array($result);
?>
<form name="editModeloForm" action="actualizarModelo.php" method="POST">
 <input type="hidden" name="idModelo" value="<?php echo $row['idModelo'] ?>">
Cambiar valor por: <input type="text" name="modelo" value="<?php echo $row['Modelo'] ?>">
 <br>
 <input type="submit" value="Guardar" />
</form>

</html>