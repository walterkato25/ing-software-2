function validarcampos(f) { 
if (f.nombre.value   == '') { alert ('El nombre esta vacío');  
f.nombre.focus(); return false; } 
if (f.email.value  == '') { alert ('El email esta vacío'); 
if (f.Comentarios.value ==''){alert('No ha escrito un comentario')}
f.email.focus(); return false; } return true; }
if ((f.Tipo.value== "" )||(f.Caracteristica.value == '')||(f.Modelo.value)||(f.Marca.value == '')||(f.Precio.value ==  '') || (f.name.Anio == '') || (f.name.Dominio == '')){
	alert('debe llenar todos los campos');
}