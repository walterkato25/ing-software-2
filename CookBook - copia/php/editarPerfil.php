<?php

function getCliente($id){
		require_once("config.php");
		$sql="SELECT nombreDeUsuario , apellido , nombre, tel, `dni/cuit`, mail, calle, nro, piso, depto, localidad, cp  FROM `usuario` WHERE `idUsuario` = $id";
		$query=mysql_query($sql);
		$cliente = mysql_fetch_assoc($query);
		?>
		<div id="alluserinfo" style='float:left;width:47%'>
		<fieldset><legend>Información Personal</legend>
		</br>
			<div id="personal" >
				<?php
				inputDinamico($cliente, "Nombre de Usuario", "nombreDeUsuario", "text");
				inputDinamico($cliente, "Apellido", "apellido", "text");
				inputDinamico($cliente, "Nombre", "nombre", "text");
				inputDinamico($cliente, "DNI/CUIT", "dni/cuit", "number");
				?>
			</div>
		</fieldset>
		

		<fieldset><legend>Información de Contacto</legend>
			</br>
		<div id="infocontacto" >
			<?php
			inputDinamico($cliente, "E-Mail", "mail", "mail");
			inputDinamico($cliente, "Teléfono", "tel", "number");
			?>
		</div>
		</fieldset>
	</div>
	<?php
	if ($_SESSION['categoria']=="usuario"){
	?>
	<fieldset style='float:right; width:47%'><legend>Domicilio</legend>
	<div id="domicilio" >
		</br>
		<?php
			inputDinamico($cliente, "Calle", "calle", "number");
			inputDinamico($cliente, "N°", "nro", "number");
			inputDinamico($cliente, "Piso", "piso", "number");
			inputDinamico($cliente, "Departamento", "depto", "text");
			inputDinamico($cliente, "Localidad", "localidad", "text");
			inputDinamico($cliente, "Código Postal", "cp", "number");
		?>		
		</div>

	</fieldset>

		<?php
		}
	}
function inputDinamico($cliente, $label, $atributo, $tipo){
	?>
		<table>
			<tr>
				<td>
					<label><?php echo $label; ?>: </label>
				</td>
				<td>
					<span> <?php echo $cliente[$atributo]; ?> </span>
				</td>
				<td>
					<a id="agregar" onclick='edit("<?php echo $atributo; ?>", "<?php echo $tipo; ?>")' href='javascript:void(0)'>Edit</a>
				</td>
			</tr>
		</table>
		<div id="<?php echo $atributo; ?>"></br></div>
	<?php
	}
	?>