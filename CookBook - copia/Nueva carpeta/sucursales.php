<?php
require_once("sesion.php");
sesion();
?>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="content-type"></meta>
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
						
						}
					 
							if($_SESSION){
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
				
				<p>	
					<h5><a href="sucursales.php?id=1">La Plata</a></h5> <br>
					<h5><a href="sucursales.php?id=2">Avellaneda</a></h5><br>
					<h5><a href="sucursales.php?id=3">Quilmes</a></h5><br>
				</p>
				
			</div>
			<div id="main-content">
			<?php
				if(isset($_GET['id'])){
					switch ($_GET['id']) {
						case 1:
							echo '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ar/maps?f=d&amp;source=s_d&amp;saddr=&amp;daddr=-34.960457,-58.009836&amp;hl=es&amp;geocode=&amp;sll=-34.952332,-57.997942&amp;sspn=0.028105,0.038581&amp;t=m&amp;mra=mift&amp;mrsp=1&amp;sz=15&amp;ie=UTF8&amp;ll=-34.952332,-57.997942&amp;spn=0.028105,0.038581&amp;output=embed"></iframe><br />';
							break;
						case 2:
							echo'<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ar/maps?f=d&amp;source=s_d&amp;saddr=&amp;daddr=Mujeres+Argentinas&amp;hl=es&amp;geocode=FRTn7v0dJ4uF_A&amp;sll=-34.660958,-58.366928&amp;sspn=0.056408,0.077162&amp;t=m&amp;mra=mr&amp;ie=UTF8&amp;ll=-34.660958,-58.366928&amp;spn=0.056408,0.077162&amp;output=embed"></iframe><br />';
							break;
						case 3:
							echo '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ar/maps?f=d&amp;source=s_d&amp;saddr=&amp;daddr=Brandsen&amp;hl=es&amp;geocode=FWgq7v0dDjmH_A&amp;sll=-34.72486,-58.249083&amp;sspn=0.028182,0.038581&amp;t=m&amp;mra=mr&amp;ie=UTF8&amp;ll=-34.72486,-58.249083&amp;spn=0.028182,0.038581&amp;output=embed"></iframe><br />';
							break;
					}
				}
				
				?>
			</div>
			<br>
		</div>

		<div id="footer">Jonatan Nahuel Llerena Suster <a href="mailto:jnllerenas@gmail.com">jnllerenas@gmail.com</a> Walter Kato <a href="mailto:walterk_88@hotmail.com">walterk_88@hotmail.com</a></div>
	
	</div>
</body>
</html>
