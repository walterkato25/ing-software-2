


function validar_formulario_Etiqueta(form){
	if(form.Etiqueta.value.length == 0){
	form.Etiqueta.focus();
	alert("Introduzca Etiqueta."); 
	return false;
	}
	return true;
}
function validar_formulario_Autor(form){
	if(form.nombre.value.length == 0){
	form.nombre.focus();
	alert("Introduzca nombre."); 
	return false;
	}
	if(form.apellido.value.length == 0){
	form.apellido.focus();
	alert("Introduzca apellido."); 
	return false;
	}
	return true;
}

function validar_formulario_Libro(form){
	if(form.nombre.value.length == 0){
	form.nombre.focus();
	alert("Introduzca nombre."); 
	return false;
	}
	if(form.idioma.value.length == 0){
	form.idioma.focus();
	alert("Introduzca idioma."); 
	return false;
	}
	if(form.origen.value.length == 0){
	form.origen.focus();
	alert("Introduzca origen."); 
	return false;
	}
	if(document.getElementById( "autor" ).value == ""){
	document.getElementById( "autor" ).focus();
	alert("Debe agregar por lo menos un autor."); 
	return false;
	}
	if(document.getElementById( "etiqueta" ).value == ""){
	document.getElementById( "etiqueta" ).focus();
	alert("Debe agregar por lo menos una etiqueta."); 
	return false;
	}
	if(form.isbn.value.length != 13){
	form.isbn.focus();
	alert("El ISBN es demasiado corto."); 
	return false;
	}
	if(isNaN(form.isbn.value)){
	form.isbn.focus();
	alert("El ISBN solo debe contener numeros."); 
	return false;
	}
	if(form.precio.value.length == 0){
	form.precio.focus();
	alert("Introduzca precio."); 
	return false;
	}
	if(form.stock.value.length == 0){
	form.stock.focus();
	alert("Introduzca stock."); 
	return false;
	}if(form.stockMinimo.value.length == 0){
	form.stockMinimo.focus();
	alert("Introduzca stock minimo."); 
	return false;
	}
	if(form.cantPaginas.value.length == 0){
	form.cantPaginas.focus();
	alert("Introduzca cantidad de paginas."); 
	return false;
	}
	if(form.resumen.value.length == 0){
	form.resumen.focus();
	alert("Introduzca resumen."); 
	return false;
	}
	return true;
}