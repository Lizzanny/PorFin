$(document).on("ready", function(){
	listarDatos();
});


var listarDatos = function(){
	var table = $('#datos').DataTable( {
		"ajax":{
			"method":"POST",
			"url": "listar.php",
		},
		"columns":[
			{"data":"ct0"},
			{"data":"ct1"},
			{"data":"ct2"},
			{"data":"ct3"},
			{"data":"ct4"},
			{"data":"ct5"},
			{"data":"ct6"},
			{"data":"ct7"},
			{"data":"ct8"},
			{"data":"ct9"},
			{"data":"ct10"},
			{"data":"ct11"},
			{"data":"ct12"},
      		{"data":"ct13"},
      		{"data":"ct14"},
      		{"data":"ct15"},
      		{"data":"ct16"},
      		{"data":"ct17"},
      		{"data":"ct18"},
			{"data":"ct19"},
			{"data":"ct20"},
			{"data":"ct21"},
			{"data":"ct22"},
			{"data":"ct23"},
			{"data":"ct24"},
			{"data":"ct25"},
			{"data":"ct26"},
			{"data":"ct27"},
			{"data":"ct28"},
			{"data":"ct29"},
			{"data":"ct30"},
			{"data":"ct31"},
			{"data":"ct32"},
			{"data":"ct33"},
			{"data":"ct34"}
		],
		"language": idioma_espanol,
		"dom": 
		"<'row'<'offset-sm-12 offset-md-4'B>>" +
		"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		"buttons":[
			{
				text: "<i class='fa fa-plus' aria-hidden='true' data-toggle='modal' data-target='#agregarUsu'></i>",
				titleAttr: "Agregar",
				className: "btn btn-dark",
				action: function() {
            		getCT();
        		}
			},{
				
				"text": "<i class='fas fa-recycle'></i>",
				"titleAttr": "Reactivar",
				className: "btn btn-secondary",

			},{
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


		