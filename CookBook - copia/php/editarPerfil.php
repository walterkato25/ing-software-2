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
	
	<div id="eliminarcuenta">
		<?php
		$id=$_SESSION["idUsuario"];
					echo '<br><a onclick="if(!confirm(';
					echo "'Esta seguro que desea borrar su cuenta?'";
					echo '))return false" href="php/bajas.php?abm=Usuario&id='.$id.'">Darse de baja</a></br>';
?>		</div>
<script language='javascript'>
							function limpiar(){
								if(document.getElementById('limpiar')){
									var nodo = document.getElementById("limpiar");
									rep=document.createElement('br');
									nodo.parentNode.replaceChild(rep, nodo);
								}
							}
							function edit(atributo, tipo){
								window.onload=limpiar();
								var table_ini="<table style='width:270'>";
								var table_fin="</table>";
								var td_ini="<td>";
								var td_fin="</td>";
								var form_ini="<form id='limpiar' method='POST' action='php/userUpdate.php'>"
								<?php echo "var id=\"<input type='hidden' name='id' value='".$_SESSION["idUsuario"]."'/>\";"; ?>
								var input1="<input autofocus required type='"+tipo+"' name='"+atributo+"' />";
								var input2="<input type='submit' value='Save'/>";
								var cancel="<input type='button' value='Cancel' onclick='limpiar()'/>";
								var form_fin="</form>";
								document.getElementById(atributo).innerHTML=form_ini+id+table_ini+td_ini+input1+td_fin+td_ini+input2+td_fin+td_ini+cancel+td_fin+form_fin;
							}
</script>

		<?php
		}
	}
function inputDinamico($cliente, $label, $atributo, $tipo){
	?>
		<table frame="hsides">
			<tr>
				<td style="width:150">
					<label><?php echo $label; ?>: </label>
				</td>
				<td style="width:400">
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
