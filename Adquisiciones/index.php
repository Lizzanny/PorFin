<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Elias Alejandro Morales Mancera">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Adquisiciones</title>
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
     <!-- Bootstrap CSS 
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">-->
    
    <!-- CSS  propio-->
    <link rel="stylesheet" href="../Libs/css/style4.css">


     <!-- Alertifyjs CSS -->
    <link rel="stylesheet" href="../Libs/alertifyjs/css/alertify.rtl.min.css">
    <link rel="stylesheet" href="../Libs/alertifyjs/css/themes/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">
    <!--dataTables
    <link rel="stylesheet" href="../Libs/css/tablestyle.css">-->
    
    <style type="text/css">
        table {
            width: 100%;
            height: 200px;
        }
        th {
          text-align: left;
          background-color: #68132e;
          color: white;
        }

        .checkbox-1x {
                transform: scale(1.3);
                -webkit-transform: scale(1.3);
        }
        
        #tablatemporal{
            font-size: 8;
        }
    </style>
</head>

<body>
        
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class="display-6">REPORTE DE ADQUISICIONES ALTAS BAJAS</h4>
                 <p class="lead">Instrucciones para generar el reporte es necesario marcar la casilla de verificación de cada uno de los centros de trabajo este realizara un proceso interno que importara la información de ese dicho  centro de trabajo, después de haber completado este paso deberá darle clic en el botón de color verde, seleccionar que tipo de reporte desea generar (maquinaria y equipo, mobiliario y quipo de oficina, equipo de transporte, equipo de computo, software).</p>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div align="center"><span id="cargargif"></span></div><!-- Cargar imagen gif XD -->
            </div>

            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <button type="button" class="btn btn-danger btn-block" onclick="eliminadoContenidoTabla()">Eliminar <i class="fas fa-eraser"></i></button>&nbsp;&nbsp; 
            </div>

            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <select class="form-control btn-block" id="anio">
                    <option selected>2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                </select>
            </div>

            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <!-- Example single danger button -->
                <div class="btn-group btn-block">
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Excel
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="importaInformacion(1208,'MAQUINARIA Y EQUIPO')">MAQUINARIA Y EQUIPO</a>
                    <a class="dropdown-item" href="#" onclick="importaInformacion(1212,'MOBILIARIO Y EQUIPO DE OFICINA')">MOBILIARIO Y EQUIPO DE OFICINA</a>
                    <a class="dropdown-item" href="#" onclick="importaInformacion(1216,'EQUIPO DE TRANSPORTE')">EQUIPO DE TRANSPORTE</a>
                    <a class="dropdown-item" href="#" onclick="importaInformacion(1220,'EQUIPO DE COMPUTO')">EQUIPO DE COMPUTO</a>
                    <a class="dropdown-item" href="#" onclick="importaInformacion(1228,'SOFTWARE')">SOFTWARE</a>
                  </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" id="tablacentrotrabajo"></div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="table-responsive">
                    <table id="tablatemporal" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>CONTCT</th>
                                <th>CONTNUM</th>
                                <th>CONTCC</th>
                                <th>CONTSSC</th>
                                <th>CONTSSSC</th>
                                <th>HBNUMERO</th>
                                <th>CONTDES</th>
                                <th>CONTMARCA</th>
                                <th>CONTMODELO</th>
                                <th>CONTSERIE</th>
                                <th>CONTFECHCAP</th>
                                <th>CONTFACTURA</th>
                                <th>CONTABONO</th>
                                <th>CONTBAJADEP</th>
                                <th>TIPOMOV</th>
                                <th>CTDESCRIP</th>
                                <th>CCDES</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>CONTCT</th>
                                <th>CONTNUM</th>
                                <th>CONTCC</th>
                                <th>CONTSSC</th>
                                <th>CONTSSSC</th>
                                <th>HBNUMERO</th>
                                <th>CONTDES</th>
                                <th>CONTMARCA</th>
                                <th>CONTMODELO</th>
                                <th>CONTSERIE</th>
                                <th>CONTFECHCAP</th>
                                <th>CONTFACTURA</th>
                                <th>CONTABONO</th>
                                <th>CONTBAJADEP</th>
                                <th>TIPOMOV</th>
                                <th>CTDESCRIP</th>
                                <th>CCDES</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

    <script src="../Libs/js/jquery-3.3.1.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- Alertifyjs JS -->
    <script src="../Libs/alertifyjs/alertify.min.js"></script>

    <!-- DataTables JS -->        
    <script src="../Libs/DataTables/pdfmake/pdfmake.min.js"></script>
    <script src="../Libs/DataTables/pdfmake/vfs_fonts.js"></script>
    <script src="../Libs/DataTables/JSZip/jszip.min.js"></script>
    <script src="../Libs/DataTables/datatables.min.js"></script>
    
    
    <script>
        $(document).ready(function() {
            //console.log( "ready!" );
           
            getListaCentroTrabajo();
            alertify.set('notifier','position', 'top-right');
        }); 

        function importaInformacion(cve,nom){
            alertify.success('procesando....');
            setTimeout(function(){
            window.open('php/reportecsv.php?clave='+cve+'&nombre='+nom,'_blank');
            }, 1500);
        }

        function eliminadoContenidoTabla(){
        alertify.confirm('¿Esta seguro que desea vaciar la tabla de adquisiciones?, si vacía el contenido tendrá que realizar el procesos de seleccionar cada uno de los centro de trabajo para que la información se concentre en la tabla de adquisiciones.', 'Confirmar mensaje', 
            function(){
                $.ajax({
                    url: 'php/classAdquisicion.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {'opcion':'eliminarDatosTabla'},
                }).done(function(res) {
                    if(res.elim==1){
                        alertify.success(res.mesj,5);
                            setTimeout(function(){
                               location.reload();//recargar pagina
                            }, 1500);   
                        //$('#detalleAvales').DataTable().ajax.reload();
                    }if(res.elim==0){
                        alertify.error(res.mesj,5); 
                    }
                     
                }).fail(function() {
                    console.log("error al intentar vaciar el contenido de la tabla.");
                });
            }, 
            function(){ 
                alertify.error('Proceso cancelado.'); 
            }); 
        }



        function getListaCentroTrabajo(){
            $.ajax({
            url: 'php/classAdquisicion.php',
            type: 'POST',
            dataType: 'html',
            data: {'opcion': 'cargaListaCentroTrabajo'
                  },
            })
            .done(function(res) {
                $("#tablacentrotrabajo").html(res);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        }  
        

        function checarevento(cve){
            $("#cargargif").html("<img src='../Libs/image/cargando.gif'>"); 

            const rojo='#ea1d31';
            const verde='#51c26f';
            const naranja='#ff7f5d';
            var idsemaforo= '#semaforo'+cve;
            var anio = $("#anio").val();             console.log(anio);
           
           /**/
            if(cve!='' || anio!=''){
                $.ajax({
                    url: 'php/classAdquisicion.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {'opcion': 'informacionCentroTrabajo',
                           'cvect': cve,
                           'anio': anio},
                })
                    .done(function(res) {
                        console.log("success");
                        if(res.cone==1){
                            $(idsemaforo).css('background-color', verde);
                            alertify.success('<strong>!Exito</strong> Se proceso correctamente: '+res.nomb,5);
                            $("#cargargif").html("<small>N° Altas: "+res.alta+"   N° Bajas: "+res.baja+"   Centro de Trabajo: "+res.nomb+" <small>");
                        }
                        if(res.cone==0){
                            $(idsemaforo).css('background-color', rojo);
                            alertify.error('!Error al intentar realizar la conexion: '+res.nomb,5);
                            $("#cargargif").html("<small>Error de conexión para el centro de trabajo: "+res.nomb+". Mas información consulte al administrador del sistema.<small>");
                        }
                        if(res.cone==2){
                            $(idsemaforo).css('background-color', naranja);
                            alertify.warning(res.msje);
                            $("#cargargif").html("<small>Numero de registros existentes : "+res.exit+"</small><br><small>"+res.msje+"</small>");
                        }
                        console.log(res);
                    })
                    .fail(function() {
                        console.log("error check");
                          alertify.error('!Error .................................................' ,5);
                        $("#cargargif").html("<small>Error al obtener la información del centro de trabajo: "+cve+", favor de consultar al administrador del sistema</small>");
                    })
                    .always(function() {
                        console.log("complete check");
                    });
            } /**/  
        }



        
        

    </script>
    
</html>