function getCT(){
	$.ajax({
		url: 'php/funciones.php',
		type: 'POST',
		dataType: 'html',
		data: {'opcion': 'getCT'
		      },
	}).done(function(res) {
		  $('#ccoctcve').html(res);
	}).fail(function() {
		    console.log("error");
	}) 
}


$('#ccoctcve').change(function (){
  var clave = $("#ccoctcve").val();

  $.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: "html",
    data: {
      "opcion": 'getCC',
      "cvecct": clave
    }

  }).done(function(res) {
  	 $('#cvecencos').html(res);
  }).fail(function() {
    console.log("error");
  })
});

$('#numeronna').change(function (){
	var cvect = $("#ccoctcve").val();
  	var clave = $("#numeronna").val();
  	console.log(cvect);
  	console.log(clave);

  	$.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: "html",
    data: {
      "opcion": 'getName',
      "rhctno": cvect,
      "nomina": clave
    }

  }).done(function(res) {
  	 $('#nombreusr').val(res);
  	 console.log(res);
  }).fail(function() {
    console.log("error");
  })
});

$( "#guardaUsuario" ).click(function() {
	var ccoct = $('#ccoctcve').val();
	var cvecc = $('#cvecencos').val();
	var nunna = $('#numeronna').val();
	var nomus = $('#nombreusr').val();
	var usuar = $('#usuarious').val();
	var passw = $('#contrasen').val();
	var cvero = $('#claverolx').val();

	if(ccoct == ''){
		$('#ccoctcve').focus();
	}else if(cvecc == ''){
		$('#cvecencos').focus();
	}else if(nunna == ''){
		$('#numeronna').focus();
	}else if(usuar == ''){
		$('#usuarious').focus();
	}else if(passw == ''){
		$('#contrasen').focus();
	}else if(cvero == ''){
		$('#claverolx').focus();
	}else{
    //console.log('todo bien');
		$.ajax({
    		url: 'php/funciones.php',
    		type: 'POST',
    		dataType: "json",
    		data: {
     		 	"opcion": 'saveUser',
     		 	"ccoctx" : ccoct,
				  "cveccx" : cvecc,
				  "nunnax" : nunna,
				  "nomusx" : nomus,
				  "usuarx" : usuar,
				  "passwx" : passw,
				  "cverox" : cvero
    		}
  		}).done(function(res) {
  	 		if (res.opc == 1) {
  	 			alertify.success(res.msj);
          limpia();
        $('#usuario').DataTable().ajax.reload();
  	 		}else if(res.opc == 2){
  	 			alertify.error(res.msj);
          limpia();
        $('#usuario').DataTable().ajax.reload();
  	 		}else{
  	 			alertify.warning(res.msj);
          limpia();
        $('#usuario').DataTable().ajax.reload();
  	 		}
        
  		}).fail(function() {
    		console.log("error");
  		})
	}
});

function limpia(){
  $('#ccoctcve').val('');
  $('#cvecencos').val('');
  $('#numeronna').val('');
  $('#nombreusr').val('');
  $('#usuarious').val('');
  $('#contrasen').val('');
  $('#claverolx').val('');
}

 $('#Econtrasen').attr('type', 'password');

function returnCT(cvect){
  $.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: 'html',
    data: {
          'opcion': 'returnCT',
          'clavec': cvect
          },
  }).done(function(res) {
      $('#Eccoctcve').html(res);
  }).fail(function() {
        console.log("error");
  }) 
}

function returnCCos(cvect, cvecc){
  $.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: 'html',
    data: {
          'opcion': 'returnCCos',
          'clavec': cvect,
          'claves': cvecc
          },
  }).done(function(res) {
      $('#Ecvecencos').html(res);
  }).fail(function() {
        console.log("error");
  }) 
}

$('#Eccoctcve').change(function (){
  var clave = $("#Eccoctcve").val();

  $.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: "html",
    data: {
      "opcion": 'getCC',
      "cvecct": clave
    }

  }).done(function(res) {
     $('#Ecvecencos').html(res);
  }).fail(function() {
    console.log("error");
  })
});

$('#Enumeronna').change(function (){
  var cvect = $("#Eccoctcve").val();
    var clave = $("#Enumeronna").val();
    console.log(cvect);
    console.log(clave);

    $.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: "html",
    data: {
      "opcion": 'getName',
      "rhctno": cvect,
      "nomina": clave
    }

  }).done(function(res) {
     $('#Enombreusr').val(res);
     console.log(res);
  }).fail(function() {
    console.log("error");
  })
});

$("#boton1").click(function(){
  $('#Econtrasen').attr('type', 'text');
});

$( "#actualizaUsuario" ).click(function() {
  var ccoct = $('#Eccoctcve').val();
  var cvecc = $('#Ecvecencos').val();
  var nunna = $('#Enumeronna').val();
  var nomus = $('#Enombreusr').val();
  var usuar = $('#Eusuarious').val();
  var passw = $('#Econtrasen').val();
  var cvero = $('#Eclaverolx').val();

  if(ccoct == ''){
    $('#Eccoctcve').focus();
  }else if(cvecc == ''){
    $('#Ecvecencos').focus();
  }else if(nunna == ''){
    $('#Enumeronna').focus();
  }else if(usuar == ''){
    $('#Eusuarious').focus();
  }else if(passw == ''){
    $('#Econtrasen').focus();
  }else if(cvero == ''){
    $('#Eclaverolx').focus();
  }else{
    $.ajax({
        url: 'php/funciones.php',
        type: 'POST',
        dataType: "json",
        data: {
          "opcion": 'updateUser',
          "ccoctx" : ccoct,
          "cveccx" : cvecc,
          "nunnax" : nunna,
          "nomusx" : nomus,
          "usuarx" : usuar,
          "passwx" : passw,
          "cverox" : cvero
        }
      }).done(function(res) {
        if (res.opc == 1) {
          alertify.success(res.msj);
        }else if(res.opc == 2){
          alertify.error(res.msj);
        }else{
          alertify.warning(res.msj);
        }
        $('#usuario').DataTable().ajax.reload();
      }).fail(function() {
        console.log("error");
      })
  }
});