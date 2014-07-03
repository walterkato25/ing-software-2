<?php
require_once("php/sesion.php");
require_once("php/config.php");
require_once("php/VIEWfunctions.php");
require_once("php/html.php");
sesion();
if($_SESSION["categoria"]!="administrador"){
	header("location:index.php");
}

function subMenu(){
	?>
	<div id="sub-menu" >
	<ul id="navegacion">
		<li <?php 
				if(isset($_GET["abm"])){
					if($_GET["abm"]=="Autor"){
						echo ' id="sub-actual" ';
					}
				}
			?>>
			<a href="abm.php?abm=Autor">Autores</a></li>
		<li	<?php 
				if(isset($_GET["abm"])){
					if($_GET["abm"]=="Etiqueta"){
						echo ' id="sub-actual" ';
					}
				}
			?>>
			<a href="abm.php?abm=Etiqueta">Etiquetas</a></li>
					<li
					<?php 
						if(isset($_GET["abm"])){
							if($_GET["abm"]=="Libro"){
								echo ' id="sub-actual" ';
							}
						}
					?>
					><a href="abm.php?abm=Libro">Libros</a></li>
			</ul>
	</div>
	<?php
}


function contenido(){
					
	if(isset($_GET["abm"])){
		viewABM($_GET["abm"]);
	}else{
		echo "<h4><p>Seleccione un campo para realizar alta, baja o modificación</p></h4>";
	}
}
$pagina="abm.php";
head("");
body($pagina);
					
?>
