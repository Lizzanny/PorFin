function riloud(estatus, clave){
 // console.log('hola que hace');
  var table2 = $('#usuarios').DataTable( {
    "ajax":{
      "method":"POST",
      "url": "listarDispRel.php",
      "data":{
            'stt':estatus,
            'cve':clave
      }
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
    "<'row'<'offset-sm-12 offset-md-12'B>>" +
    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-12'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-12'i><'col-sm-12 col-md-12'p>>",
    "buttons":[
      
    ]
  });
  obtener_data_checarCon("#usuarios tbody", table2);

  $("#usuarios").dataTable().fnReloadAjax();
}
var obtener_data_checarCon = function(tbody, table2){
  $(tbody).on("click", "button.checarCon", function(){
    var data = table2.row( $(this).parents("tr") ).data();
    console.log(data.clve);
    $.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: 'html',
    data: {
        'opcion': 'checarConexion',
        'clave': data.clve
          },
    }).done(function(res) {
        if(res==1){
          alertify.success('La base de datos esta disponible');
          riloud(res, data.num);
          //$('#usuario').DataTable().ajax.reload();
        }else{
          alertify.error('La base de datos NO esta disponible');
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


