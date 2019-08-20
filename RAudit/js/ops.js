function getCT(){
  $.ajax({
    url: 'php/funciones.php',
    type: 'POST',
    dataType: 'json',
    data: {'opcion': 'VaciarT'
          },
  }).done(function(res) {
      if(res.opc==1){
        alertify.success("Se ha vaciado la tabla de Integracion contable nacional");
        $('#usuarios').DataTable().ajax.reload();
      }else{
        alertify.error("No ha sido posible vaciar la tabla de Integracion contable nacional");
      }
  }).fail(function() {
        console.log("error");
  }) 
}