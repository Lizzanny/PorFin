$(document).on("ready", function(){
	listar();
});


var listar = function(){
	var table = $('#usuarios').DataTable( {
		"ajax":{
			"method":"POST",
			"url": "listarDisp.php",
		},
		"columns":[
			{"data":"clve"},
			{"data":"nomb"},
      		{"data":"cone"},
			{"defaultContent": "<button type='button' class='expandir btn btn btn-info btn-sm'><i class='fas fa-expand-arrows-alt fa-sm'></i></button>&nbsp;"
								
			}
		],
		"language": idioma_espanol,
		"dom": 
		"<'row'<'offset-sm-12 offset-md-12'B>>" +
		"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-12'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-12 col-md-12'i><'col-sm-12 col-md-12'p>>",
		"buttons":[
			
		]
	});
	obtener_data_expandir("#usuarios tbody", table);
	obtener_data_editar("#usuarios tbody", table);
	obtener_id_eliminar("#usuarios tbody", table);
	
}

var obtener_data_expandir = function(tbody, table){
	$(tbody).on("click", "button.expandir", function(){
		var data = table.row( $(this).parents("tr") ).data();
		
		//location.href='../deta_conexion/index.php?idx='+data.Id_usr+'';
	});
}

var obtener_data_editar = function(tbody, table){//a nivel registro obtengo algunos valores para poder realizar en este caso la edicion. y lo mando a updateuser.php la clave
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		returnCT(data.ctxcco);
		returnCCos(data.ctxcco, data.cvecco);
		$('#Enumeronna').val(data.rhnnna);
		$('#Enombreusr').val(data.usrnom);
		$('#Eusuarious').val(data.usuari);
		$('#Econtrasen').val(data.usrpas);
		$('#Eclaverolx').val(data.rolnam);
	});
}

var obtener_id_eliminar = function(tbody, table){
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		alertify.confirm("Se trata de un diálogo de confirmación",
            function (e) {
			    if (e) {
				   $.ajax({
						url: 'php/funciones.php',
						type: 'POST',
						dataType: 'html',
						data: {'opcion': 'inhabilite',
							   'usuari': data.usuari},
					}).done(function(res) {
						  if(res.opc == 1){
						  	alertify.success(res.msj);
						  }else{
						  	alertify.error(res.msj);
						  }
						  $('#usuario').DataTable().ajax.reload();
					}).fail(function() {
						    console.log("error");
					}) 
			    } else {
				    alertify.error("Acción cancelada");
			    }
		});
	});
	
}

var idioma_espanol = {
	"decimal":        "",
	"emptyTable":     "No hay información para mostrar",
	"info":           "Mostrando de _START_ a _END_ registros",
	"infoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"infoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"infoPostFix":    "",
	"thousands":      ",",
	"lengthMenu":     "Mostrar _MENU_ registros",
	"loadingRecords": "Cargando...",
	"processing":     "Procesando...",
	"search":         "Buscar:",
	"zeroRecords":    "No se encontró información para mostrar",
	"paginate": {
	    "first":      "Primero",
	    "last":       "Ultimo",
	    "next":       "Siguiente",
	    "previous":   "Anterior"
	},
	"aria": {
	    "sortAscending":  ": activate to sort column ascending",
	    "sortDescending": ": activate to sort column descending"
	}
}


		