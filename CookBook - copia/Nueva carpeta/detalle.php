<?php
require_once("sesion.php");
sesion();
?>
<html>
<head>
	<meta content="text/html" charset="utf-8" http-equiv="content-type"></meta>
	<title>Concesionaria PHP</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<link href="images.jpg" type="img/icon" rel="shortcut icon">
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="index.php"><img src="autos.jpg" height=100% alt="logo"></a></div>
				<div class=empresa><a href="index.php"><h1>Concesionaria PHP</h1></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li>
						<a href="sucursales.php">Sucursales</a>
					</li>
					<li>
						<a href="servicios.php">Servicios</a>
					</li>
					<li>
						<a href="autos.php">Autos</a>
					</li>
					<li>
						<a href="contacto.php">Contacto</a>
					</li>
					<?php
						if($_SESSION){
						
							echo '<li>
							<a href="abm.php">ABM</a>
							</li>';
						
						echo '<span id=login><a href="desconectar_usuario.php">Logout</a></span>';
						//aca iba el usuario
						echo'<span id=login>Usuario:  '.$usuario.' </span>';
					}else{
						
						echo '<span id=login><a href="login.php">Login</a></span>';
					}
						?>
					
					
				</ul>
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				<?php
				require_once("menufiltrar.php");
				filtrar();
				?>
				
			</div>
			<div id="main-content">
				<?php
				if (isset($_GET["idVehiculo"])){
					$idVehiculo=$_GET["idVehiculo"];
					//consulta tabla vehiculo
					$sql="SELECT Marca,Modelo,Dominio,Anio,Precio,Tipo FROM 
							(SELECT idVehiculo,idMarca,Modelo,Dominio,Anio,Precio,Tipo FROM 
							(SELECT idVehiculo,idModelo,Dominio,Anio,Precio,Tipo FROM 
							(SELECT * FROM `Vehiculos` WHERE idVehiculo=$idVehiculo) as Vehi 
								INNER JOIN Tipos ON Vehi.idTipo=Tipos.idTipo) as vehitipo 
								INNER JOIN Modelos ON vehitipo.idModelo=Modelos.idModelo) as vehimod 
								INNER JOIN Marcas ON vehimod.idMarca=Marcas.idMarca";
					$consulta=mysql_query($sql);
					$row = mysql_fetch_array($consulta);
					$marca=$row['Marca'];
					if($marca==""){
						echo '<script language = javascript>
						self.history.back();
						</script>';
					}
					echo "<ul><li>Marca: $marca </li>";
					$modelo=$row['Modelo'];
					echo "<li>Modelo: $modelo</li>";
					$dominio=$row['Dominio'];
					echo "<li>Dominio: $dominio</li>";
					$anio=$row['Anio'];
					echo "<li>Año: $anio</li>";
					$precio=$row['Precio'];
					echo "<li>Precio: $$precio</li>";
					$tipo=$row['Tipo'];	
					echo "<li>Tipo: $tipo</li>";
					
					//consulta vehiculo_caracteristicas
					$sql = "SELECT Caracteristica FROM
							(SELECT Vehiculos_Caracteristicas.idVehiculo, Caracteristica FROM 
								Caracteristicas 
								INNER JOIN Vehiculos_Caracteristicas ON Caracteristicas.idCaracteristica = Vehiculos_Caracteristicas.idCaracteristica) as a WHERE a.idVehiculo = $idVehiculo";
					$consulta=mysql_query($sql);
					$cant = mysql_num_rows($consulta);
					if($cant>0){
						$carac= array();
						while ($row = mysql_fetch_assoc($consulta)){
							$carac[]= $row['Caracteristica'];
						}
						$lista_carac=implode(', ',$carac);
						echo "<li>Caracteristicas: $lista_carac</li>";
					}
					
/*estilo enlace*/	echo '<style>#genius{padding:6px 20px;}</style>';				
					echo '<br>';
					echo '<li>';
					if($_SESSION){
						
	
						echo '<a id="genius" onclick="if(!confirm(';
						echo "'¿Borrar elemento?'";
						echo '))return false" href="bajas.php?abm=Vehiculo&id='.$idVehiculo.'">Eliminar</a>';
						echo '<a id="genius" href="formabm.php?abm=Vehiculo&id='.$idVehiculo.'">Editar</a>';
						
						
					}
					echo '<a id="genius" href="javascript:history.back();">Volver</a>';
					echo '</li>';
					echo '</ul>';
					
				}
				










					?>
					
					
			
			</div>
		</div>

		<div id="footer">Jonatan Nahuel Llerena Suster <a href="mailto:jnllerenas@gmail.com">jnllerenas@gmail.com</a> Walter Kato <a href="mailto:walterk_88@hotmail.com">walterk_88@hotmail.com</a></div>
	
	</div>
</body>
</html>
