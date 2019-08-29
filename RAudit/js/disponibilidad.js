$(document).on("ready", function(){
	$("#Aviso").modal();
});

$( "#fecha" ).change(function() {
  	listar();
});
var arregloxd = new Array();
var contador = 0;

var listar = function(){
	var table = $('#usuarios').DataTable( {
		"ajax":{
			"method":"POST",
			"url": "listarDisp.php"
		},
		"columns":[
			{"data":"num"},
			{"data":"clve"},
			{"data":"nomb"},
      		{"data":"cone"},
			{"data":"chec"}
		],
		"language": idioma_espanol,
		"dom": 
		"<'row'<'offset-sm-4 offset-md-4'B>>" +
		"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-12'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-12 col-md-12'i><'col-sm-12 col-md-12'p>>",
		"buttons":[
			{
				text: "<i class='fas fa-file-export'></i>",
				titleAttr: "Exportar",
				className: "btn btn-dark",
				action: function() {
					window.location='php/raux.php';  
            		//window.location.href = '../repof/Auditorias.php';
        		}
			},
			{
				text: "<i class='fas fa-trash-restore'></i>",
				titleAttr: "Vaciar",
				className: "btn btn-danger",
				action: function() {
					getCT();
            		
				}
			}
		]
	});
	obtener_data_checarCon("#usuarios tbody", table);
	
}

var obtener_data_checarCon = function(tbody, table){
	$(tbody).on("click", "button.checarCon", function(){
		var fech = $('#fecha').val();
		var data = table.row( $(this).parents("tr") ).data();
		var idsemaforo = '#images'+data.clve;
		var botonesxdp = '#checkin'+data.clve;
		var d = new Date(fech),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    	if (month.length < 2) month = '0' + month;
    	if (day.length < 2) day = '0' + day;
	
    	var fechx = [day, month, year].join('/');
    	console.log(data.clve);
    	$.ajax({
		url: 'php/funciones.php',
		type: 'POST',
		dataType: 'html',
		data: {
				'opcion': 'Validate',
				'clave': data.clve
		      },
		}).done(function(resu) {
			if(resu == 1){
				$.ajax({
				url: 'php/funciones.php',
				type: 'POST',
				dataType: 'html',
				data: {
					'opcion': 'checarConexion',
					'clave': data.clve,
					'fecha': fechx
			    	},
				}).done(function(res) {
				  if(res==1){
				  	$(botonesxdp).attr('disabled','disabled');
				  	$(idsemaforo).attr("src","../Libs/image/verde.png");
				  	alertify.success('La base de datos esta disponible');
				  	almacena(data.clve);
				  }else{
				  	alertify.error('La base de datos NO esta disponible');
				  	$(botonesxdp).attr('disabled', 'disabled');
				  	$(idsemaforo).attr("src","../Libs/image/rojo.png");
				  }
				}).fail(function() {
				    console.log("error");
				}) 
			}else{
				alertify.error('Este centro de trabajo ya ha sido procesado');
			}
			
		}).fail(function() {
				    console.log("error");
		}) 
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


function almacena(clave){
	//console.log(clave);
	arregloxd[contador]=clave;
	
	//console.log(arregloxd[contador]);
	contador++;
//console.log(arregloxd);
}