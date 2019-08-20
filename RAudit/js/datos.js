$(document).on("ready", function(){
	listarDatos();
});


var listarDatos = function(){
	var table = $('#datos').DataTable( {
		"ajax":{
			"method":"POST",
			"url": "listarData.php",
		},
		"columns":[
			{"data":"num"},
			{"data":"cta"},
			{"data":"ctx"},
			{"data":"ced"},
			{"data":"act"},
			{"data":"tcc"},
			{"data":"tsc"},
			{"data":"ssc"},
			{"data":"sss"},
			{"data":"des"},
			{"data":"adq"},
			{"data":"ura"},
			{"data":"sto"},
      		{"data":"ien"},
      		{"data":"dep"},
      		{"data":"cap"},
      		{"data":"chd"},
      		{"data":"iza"},
      		{"data":"tas"},
			{"data":"jas"},
			{"data":"ono"},
			{"data":"mov"},
			{"data":"men"},
			{"data":"ual"},
			{"data":"cum"},
			{"data":"xde"},
			{"data":"ade"},
			{"data":"sde"},
			{"data":"tde"},
			{"data":"hba"}
		],
		"language": idioma_espanol,
		"dom": 
		"<'row'<'offset-sm-12 offset-md-4'B>>" +
		"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		"buttons":[
			{
       			extend: 'copy', 
       			"text": "<i class='fa fa-clone aria-hidden=true' ></i>",
       			"titleAttr": "Copiar",
       			"className": "btn btn-success",

			},{
			 	extend: 'csv', 
			 	"text":'<i class="fas fa-file-csv"></i>',
			 	"titleAttr": "CSV",
			 	"className": "btn btn-danger",

			},{
			  	extend: 'excel', 
			  	"text": '<i class="fas fa-file-excel"></i>',
			  	"titleAttr": "Excel",
			  	"className": "btn btn-warning",

			},{
			  	extend: 'pdf', 
			  	"text":'<i class="fas fa-file-pdf"></i>',
			  	"titleAttr": "PDF",
			  	"className": "btn btn-info",

			},{
			  	extend: 'print', 
			  	"text":'<i class="fa fa-print aria-hidden= true"></i>',
			  	"titleAttr": "Imprimir",
			  	"className": "btn btn-light",
			}
		]
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


		