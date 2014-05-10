<!DOCTYPE html>
<html class=web style="background-color:#FFCD9B;">
<link rel='stylesheet' type='text/CSS' title='default' href='Estilos/index.css'/>

<head>
    <div class=heading style="background-image:URL(Img/textura3.png);">
    <title>Concesionaria Alfa</title> 
	<img src="Img/logo.png" height="50px" width="75px" alt="logo" style="float:left"/>
	<h2>Concesionaria Alfa</h2>	
	</div>
	
<script type="text/javascript">	    
function validar()
{
//valido el usuario
if (document.logdata.usuario.value.length < 7){
  alert("El usuario debe tener al menos 7 caracteres");
  document.logdata.usuario.focus();
}else{
 var pass=document.logdata.clave.value;
 if (pass==""){
   alert("La contraseña no debe dejarse en blanco");
   document.logdata.clave.focus();
 } else {
   document.logdata.submit();
 }
}
}
</script>

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
 <!--contenido-->
   <form name="logdata" action="privado.php" method="POST" style="text-align:center">
   <br>
   <br>
      <b style="margin-left:-10">Usuario:</b><input ID="user" size="18" type="text" name="usuario"style="margin-left:20px"><br><br>
      <b style="margin-left:6px">Clave:</b><input ID="pass" style="margin-left:25px" size="18" type="password" name="clave"><br>
	  <br>
      <input type="button" value="Entrar" onclick="validar();">
	  <br>
	  <br>
	  <br>
   </form>
</div> 
<div style="background-image:URL(Img/textura3.png); width:804px; height:70px; color:white;"><b>Para mas info enviar un correo a concecionaria@grupo30.com  o al telefono 467-7662851</b></div><!--pie--> 
</body>
</html>
