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
					<!--<li>
						<a href="aboutUs.php">Conocenos</a>
					</li>
					<li>
						<a href="contacto.php">Contacto</a>
					</li>-->
					<li>
						<a href="abm.php">ABM</a>
					</li>
				<!--<?php
						if($_SESSION){
						if($usuario=="admin"){
							echo '<li>
							<a href="abm.php">ABM</a>
							</li>';
						}
					}
					 
							if($_SESSION){
							echo '<span id=login><a href="desconectar_usuario.php">Logout</a></span>';
							//aca iba el usuario
							echo'<span id=login>Usuario:  '.$usuario.' </span>';
							}else{
								echo '<span id=login><a href="login.php">Login</a></span>';
							}
						?>-->
				</ul> 
				
		
			</div>
		</div>

		<div id="content">
			<div id="left-bar">
				
			</div>
			<div id="main-content">
				<?php
				$id=1;
				
	function getCliente($id){
		require_once("php/config.php");
		$sql="SELECT * FROM `usuario` WHERE `idUsuario` = $id";
		$query=mysql_query($sql);
		while($row = mysql_fetch_assoc($query)){
			foreach ($row as $atributo => $valor) {
				inputDinamico("usuario", $atributo, $valor, $id);
			}
			
		}
	}
	function inputDinamico($tabla, $nombre, $valor, $id, $type="text"){
		require_once("php/SQLfunctions.php");
		if(isset($_POST[$nombre])){
			update($tabla, $nombre, $_POST[$nombre], $id);
			echo "<p id='modificado'>El campo $nombre se ha cambiado correctamente</p>";
		}
		echo '<form name="'.$nombre.'" method="POST">';
		echo "<label for=$nombre>$nombre</label>: ";
		if(isset($_POST['update']) && $_POST['update']==$nombre){
			$a=$_POST['update'];
	   		echo '<input autofocus name="'.$nombre.'" type="'.$type.'" value="';
		}
		if(isset($_POST[$nombre])){
			echo $_POST[$nombre];
		}else{
	    	echo $valor;
		}
		if(isset($_POST['update']) && $_POST['update']==$nombre){
	    	echo '" />';
		}
		if(isset($_POST['update']) && $_POST['update']==$nombre){
	       			echo "<input value='Save' type='submit' />";
   			echo "<input value='Cancel' type='button' onclick='location.reload();' />";
		}else{
   			echo "<input name='update' type='hidden' value='$nombre' />";
    		echo "<input value='Edit' type='submit' /></br>";
    	}
    	echo "</form>";
	}

	getCliente($id);

?>
			<!--<p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias. Hablamos de un país paraisomático en el que a uno le caen pedazos de frases asadas en la boca. Ni siquiera los todopoderosos signos de puntuación dominan a los textos simulados; una vida, se puede decir, poco ortográfica. Pero un buen día, una pequeña línea de texto simulado, llamada Lorem Ipsum, decidió aventurarse y salir al vasto mundo de la gramática. El gran Oxmox le desanconsejó hacerlo, ya que esas tierras estaban llenas de comas malvadas, signos de interrogación salvajes y puntos y coma traicioneros, pero el texto simulado no se dejó atemorizar. Empacó sus siete versales, enfundó su inicial en el cinturón y se puso en camino. Cuando ya había escalado las primeras colinas de las montañas cursivas, se dio media vuelta para dirigir su mirada por última vez, hacia su ciudad natal Letralandia, el encabezamiento del pueblo Alfabeto y el subtítulo de su</p>
		-->
			</div>
			<div id="push"></div>
			<br/>
		</div>

		<!--<div id="footer">CookBooks 2014</div>-->
	
	</div>
</body>
</html>
