<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<!DOCTYPE html>
<html class=web style="background-color:#FFCD9B;">
<link rel='stylesheet' type='text/CSS' title='default' href='Estilos/index.css'/>

<head>
    
    <script type="text/javascript">
	function cargarModelos() {
	    document.forms["marca"].submit()
	}
    </script>

    <div class=heading style="background-image:URL(Img/textura3.png);">
    <title>Concesionaria Alfa</title> 
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
</div>
<div class=menu style="float:right; background-image:URL(Img/textura2.png);"> <!-- barra lateral derecha -->
</div>
 <br>
 <!-- contenido -->
 <?php 
  include('liblocal.php');
?> 
 <u><h2 style="text-align:center">Listar vehiculos por:<h2></u>
 <div style="float:right">
 <font face='verdana' size='3' color='blue'>
 Caracteristica:
 </font>
 <form name="caract2" action="caract2.php" method="POST">
 <select multiple name="idCaracteristica[]">
 <?php
  $result = Mysql_query("SELECT Caracteristicas.idCaracteristica, Caracteristicas.Caracteristica 
                           FROM Caracteristicas
                       ORDER BY Caracteristicas.Caracteristica");
   while($row = mysql_fetch_array($result))
  {
      echo "<option value='".$row['idCaracteristica']."'>".$row['Caracteristica']."</option>";
  }
 ?>
 </select>
 <input type="submit" value="Buscar"/><br>
<font face="Verdana" size="1">ctrl para seleccionar mas de una opción</font>
 </form>
 
 Tipo:
 
 <form name="tipo" action="tipo.php" method="POST">
 <select name="idTipo">
 <?php 
  $result = Mysql_query("SELECT Tipos.idTipo, Tipos.Tipo 
                           FROM Tipos
                       ORDER BY Tipos.Tipo");
   while($row = mysql_fetch_array($result))
  {
      echo "<option value='".$row['idTipo']."'>".$row['Tipo']."</option>";
  }
 ?>
 </select>
 <input type="submit" value="Buscar"/>
 </form>
 <font face='verdana' size='3'>
 Marca:
 </font>
 <form name="marca" action="listado.php" method="POST">
 <select name="idMarca" onchange='cargarModelos();'>
 <?php
  echo "<option value=''>Seleccione...</option>";
  $result = Mysql_query("SELECT Marcas.idMarca, Marcas.Marca
                           FROM Marcas
                       ORDER BY Marcas.Marca");
   while($row = mysql_fetch_array($result))
  {
      if (isset($_POST["idMarca"]) && ($_POST["idMarca"] == $row['idMarca'])){
          echo "<option value='".$row['idMarca']."' selected='selected'>".$row['Marca']."</option>";
      } else {
	     echo "<option value='".$row['idMarca']."'>".$row['Marca']."</option>";
      }
  }
 ?>
 </select>
 </form>
 <font face='verdana' size='3'>
 Modelo
 </font>
 <form name="modelo" action="marca_modelo.php" method="POST">
 <select name="idModelo">
 <?php
  if (isset($_POST["idMarca"])){ 
      $result = Mysql_query("SELECT Modelos.idModelo, Modelos.Modelo
                               FROM Modelos
			      WHERE Modelos.idMarca = ".$_POST["idMarca"]."
                           ORDER BY Modelos.Modelo");
      while($row = mysql_fetch_array($result))
      {
          echo "<option value='".$row['idModelo']."'>".$row['Modelo']."</option>";
      }
     echo "</select>"; 
     echo '<input type="submit" value="Buscar"/>';
  } else {
      echo "<option value=''>Seleccione la marca</option>";
      echo "</select>";
  }
 ?>
 </form>
 </div>
 <div>
 <form name="marca" action="marca.php" method="POST">
 <input type="submit" value="Marca" />
 </form>
 <form name="precio" action="precio.php" method="POST">
 <input type="submit" value="Precio"/>
 </form>
 <form name="modelo" action="modelo.php" method="POST">
 <input type="submit" value="Modelo"/>
 </form>
 <font face="Verdana" size="2">
 Detalle Vehículo por dominio
 </font>
 <form name="vehiculoDominio" action="vehiculo_dominio.php" method="POST">
 <input type="text" name="dominio" maxlength="6" size="2">   
 <input type="submit" value="Enviar"/>
 </form>
 </div>
 <br>
 <br>
 <br>
 <br>
 <!--pie-->
 <div style="background-image:URL(Img/textura3.png); font-size:20px; text-align:center; width:804px; height:70px; color:white;"><b>Para mas info enviar un correo a concecionaria@grupo30.com  o al telefono 467-7662851</b></div> 
 </body>
 </html>