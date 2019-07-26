$(document).ready(function() {
    var table = jQuery('#example').dataTable({
             "bProcessing": true,
             "sAjaxSource": "datos.php",
              "bPaginate":true,
              "sPaginationType":"full_numbers",
              "iDisplayLength": 5,
             "aoColumns": [
    { mData: 'CUENTA' } ,
    { mData: 'CENTRO_TRABAJO' },
    { mData: 'CEDULA' },
    { mData: 'NUMACTIVO' } ,
    { mData: 'CONTCC' },
    { mData: 'CONTSC' },
    { mData: 'CONTSSC' } ,
    { mData: 'CONTSSSC' },
    { mData: 'CONTDES' },
    { mData: 'CONTFECHADQ' } ,
    { mData: 'CONTFACTURA' },
    { mData: 'CONTCOSTO' },
    { mData: 'CONTORIGBIEN' } ,
    { mData: 'CONTASADEP' },
    { mData: 'CONTFECHCAP' },
    { mData: 'CONTFECHDEP' } ,
    { mData: 'CONTPOLIZA' },
    { mData: 'CONTREFALTAS' },
    { mData: 'CONTREFBAJAS' } ,
    { mData: 'CONTABONO' },
    { mData: 'CONTFECHMOV' },
    { mData: 'CONTDEPMEN' } ,
    { mData: 'CONTDEPANUAL' },
    { mData: 'CONTDEPACUM' },
    { mData: 'CONTSALXDEP' } ,
    { mData: 'CONTBAJADEP' },
    { mData: 'CONTMESDEP' },
    { mData: 'CONTFECHDETDEP' },
    { mData: 'CONTFECHBAJA' }
]
    });   
});

 */