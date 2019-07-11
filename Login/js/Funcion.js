$( ".singin" ).click(function() {
	//console.log("hola");
	var user = $('.user').val();
	var pass = $('.pass').val();

	console.log(user);
	console.log(pass);
	if(user == ''){
		var alert = alertify.alert('¡Error!','El campo del usuario se encuentra vacio.').set('label', 'Aceptar');     	 
		alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
		alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
		$('.user').focus();
	}else if(pass == ''){
		var alert = alertify.alert('¡Error!','El campo de la contraseña se encuentra vacia.').set('label', 'Aceptar');     	 
		alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
		alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
		$('.pass').focus();
	}else{
		console.log('ok');
	
		$.ajax({
   		    url: 'php/ClaseLogin.php',
   		    type: 'POST',
   		    dataType: 'json',
   		    data: {
   		      'opcion': 'IniciaSesion',
   		      'resu':user,
   		      'ssap':pass
   		    }
   		}).done(function(res) {
   			alertify.set('notifier','position', 'top-center');
   		    if(res.opc == 1){
   		     	alertify.success(res.msj);
   		     	setTimeout ("redireccionar()", 1000);
   		    }else{

   		      alertify.error(res.msj);
   		    }

   		}).fail(function() {
   		        console.log("error");
   		})/**/
    }
});

function redireccionar(){
	location.href='../Home/index.php';
}