function getcts(){
        $.ajax({
            url: '../Reportes/php/operaciones.php',
            type: 'POST',
            dataType: 'html',
            data: {
                'opcion': 'obtenerCtg'
            },
        }).done(function(res) {
              $('#clavectx').html(res);
        }).fail(function() {
                console.log("error");
        })
}

function generate(){
    var ctgen = $('#clavectx').val();
    var feini = $('#fechai').val();
    var fefin = $('#fechaf').val();


    window.open('../Reportes/saldosInvDpreCtaCont.php?ct='+ctgen+'&fi='+feini+'&ff='+fefin, '_blank');

}