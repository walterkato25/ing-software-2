function validarEmptyForm(element,atributo){
	if(element.value.length == 0){
		element.focus();
		alert("Introduzca "+atributo+"."); 
		return false;
	}
	return true;
}
function validarSelect(id){
	if(document.getElementById(id).value == ""){
	document.getElementById(id).focus();
	alert("Debe seleccionar "+id+"."); 
	return false;
	}
	return true;
}
function validarLenghtString(element, length, atributo){
	if(element.value.length != length){
	element.focus();
	alert("El "+atributo+" es demasiado corto."); 
	return false;
	}
	return true;
}
function validarLengthDniCuit(element){
	if((element.value.length == 8) || (element.value.length == 11)){
	return true;	
	}
	element.focus();
	alert("Inserte un DNI o Cuit válido."); 
	return false;
}
function validarCampoNumerico(element,atributo){
	if(isNaN(element.value)){
		element.focus();
		alert("El "+atributo+" sólo debe contener números."); 
		return false;
	}
	return true;
}
function validarCampoMail(element){
	if (!(/^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i.test(element.value))){
        		element.focus();
        		alert("Introduzca un E-Mail válido");
        		return false;
    }
    return true;
}
function validarFechaVencimiento(element){
	var fecha_venc=element.value;
	var anio= Number(fecha_venc.substring(0,4));
	var mes=Number(fecha_venc.substring(5));
	var fecha_actual= new Date();
	var mes_actual=fecha_actual.getMonth()+1;
	var anio_actual=fecha_actual.getFullYear();
	if((anio<anio_actual) || (anio>(anio_actual+3)) || ((anio_actual=anio) && (mes_actual>mes))){
		element.focus();
		alert("Introduzca una fecha de vencimiento válida");
		return false;
	}
	return true;
}
function matchPasswords(pass1,pass2){
	if(pass1.value!=pass2.value){
		pass1.focus();
		alert("Las contraseñas no coinciden");
		return false
	}
	return true;
}
function validar_formulario_Etiqueta(form){
	return validarEmptyForm(form.Etiqueta,'etiqueta');
}
function validar_formulario_Autor(form){
	return validarEmptyForm(form.nombre,'nombre') && validarStringForm(form.apellido,'apellido')
}

function validar_formulario_Libro(form){
	return validarEmptyForm(form.nombre,'nombre')
		&& validarEmptyForm(form.idioma,'idioma')
		&& validarEmptyForm(form.origen,'origen')
		&& validarSelect("autor")
		&& validarSelect("etiqueta")
		&& validarCampoNumerico(form.isbn,'ISBN')
		&& validarLenghtString(form.isbn,13,'ISBN')
		&& validarEmptyForm(form.precio,'precio')
		&& validarEmptyForm(form.stock,'stock')
		&& validarEmptyForm(form.stockMinimo,'stock mínimo')
		&& validarEmptyForm(form.cantPaginas,'cantidad de páginas')
		&& validarSelect("imagen")
		&& validarEmptyForm(form.resumen,'resumen')
}
function validar_nombreDeUsuario(form){
	return validarEmptyForm(form.nombreDeUsuario,"nombre de usuario");
}
function validar_apellido(form){
	return validarEmptyForm(form.apellido,"apellido");
}
function validar_nombre(form){
	return validarEmptyForm(form.nombre,"nombre");
}
function validar_dnicuit(form){
	return validarEmptyForm(form.dnicuit,"DNI/CUIT")
		&& validarLengthDniCuit(form.dnicuit)
		&& validarCampoNumerico(form.dnicuit,'DNI/CUIT');
}
function validar_mail(form){
	return validarEmptyForm(form.mail,"E-Mail")
		&& validarCampoMail(form.mail);
	
}
function validar_tel(form){
	return validarEmptyForm(form.tel,"teléfono")
		&& validarCampoNumerico(form.tel,'teléfono');
}
function validar_cp(form){
	return validarEmptyForm(form.cp,"código postal")
		&& validarCampoNumerico(form.cp,"código postal")
		&& validarLenghtString(form.cp,4,"código postal");
}
function validar_localidad(form){

}
function validar_calle(form){
	return validarEmptyForm(form.calle,"calle");
}
function validar_nro(form){
	return validarCampoNumerico(form.nro,"número de casa");
}
function validar_piso(form){
	return validarCampoNumerico(form.piso,"piso");
}
function validar_depto(form){

}
function validar_tarjeta(){
	return validarSelect("banco")
		&& validarSelect("tarjeta")
		&& validarEmptyForm(document.getElementById("nombreTitular"), "nombre del titular de la tarjeta")
		&& validarEmptyForm(document.getElementById("numTarjeta"), "número de la tarjeta")
		&& validarCampoNumerico(document.getElementById("numTarjeta"),"número de la tarjeta")
		&& validarLenghtString(document.getElementById("numTarjeta"),16,"número de la tarjeta")
		&& validarEmptyForm(document.getElementById("fechaVencimiento"),"fecha de vencimiento")
		&& validarFechaVencimiento(document.getElementById("fechaVencimiento"))
		&& validarCampoNumerico(document.getElementById("codigoTarjeta"),"código de validación de la tarjeta")
		&& validarLenghtString(document.getElementById("codigoTarjeta"),3,"código de validación de la tarjeta");
}
function validar_altaCliente(form){
	return validar_nombreDeUsuario(form)
	&& validarEmptyForm(form.password,"contraseña")
	&& validarEmptyForm(form.contraseña2,"la contraseña nuevamente")
	&& matchPasswords(form.password,form.contraseña2)
	&& validar_nombre(form)
	&& validarEmptyForm(form.apellido,"apellido")
	&& validar_mail(form)
	&& validar_dnicuit(form)
	&& validar_tel(form);

}