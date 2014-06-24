<?php
require_once("php/sesion.php");
sesion();
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>CookBook - Libros de Cocina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="img/icon.png" type="img/icon" rel="shortcut icon">
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="page-header">
				<div class=logo><a href="index.php"><img src="img/Imagen1.png" height=100% alt="logo" border="0px"></a></div>
			</div>
							
			<div id="header-menu">
				<ul id="navegacion">
					<li id="actual">
						<a href="index.php">Inicio</a>
					</li>
					<?php
					if (!(isset($_SESSION["categoria"])) || ($_SESSION["categoria"]=="usuario")){					
					echo '<li>
						<a href="catalogo.php">Catalogo</a>
					</li>';
					
					}
					?>
					<?php
						if($_SESSION){
							if($categoria=="administrador"){
								echo '<li>
								<a href="abm.php">ABM</a>
								</li>
								<li>
								<a href="usuarios.php">Usuarios</a>
								</li>
								<li>
									<a href="pedidos.php">Pedidos</a>
								</li>';
							}
							echo'</ul><ul id=navegacion style=float:right>
							<li>
							<a href="menuUsuario.php">Usuario:  '.$usuario.' </a>
							</li>
							<li>
							<a href="php/desconectarUsuario.php">Logout</a>
							</li>';
						}else{
							echo'<ul id=navegacion style=float:right>
							<li>
							<a href="login.php">Login</a>
							</li>';
						}
						
					?>
				</ul> 
				
		
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				
			</div>
			<div id="main-content">
			<p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias. Hablamos de un país paraisomático en el que a uno le caen pedazos de frases asadas en la boca. Ni siquiera los todopoderosos signos de puntuación dominan a los textos simulados; una vida, se puede decir, poco ortográfica. Pero un buen día, una pequeña línea de texto simulado, llamada Lorem Ipsum, decidió aventurarse y salir al vasto mundo de la gramática. El gran Oxmox le desanconsejó hacerlo, ya que esas tierras estaban llenas de comas malvadas, signos de interrogación salvajes y puntos y coma traicioneros, pero el texto simulado no se dejó atemorizar. Empacó sus siete versales, enfundó su inicial en el cinturón y se puso en camino. Cuando ya había escalado las primeras colinas de las montañas cursivas, se dio media vuelta para dirigir su mirada por última vez, hacia su ciudad natal Letralandia, el encabezamiento del pueblo Alfabeto y el subtítulo de su</p>
			</div>
			<div id="push"></div>
			<br/>
		</div>

		<!--<div id="footer">CookBooks 2014</div>-->
	
	</div>
</body>
</html>
