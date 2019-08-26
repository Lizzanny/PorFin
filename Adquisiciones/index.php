<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Elias Alejandro Morales Mancera">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Adquisiciones</title>
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />

    <!-- Bootstrap CSS Online
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    
     <!-- Bootstrap CSS 
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">
    -->
    <!-- CSS  propio 
    <link rel="stylesheet" href="../Libs/css/style4.css"> 
-->


     <!-- Alertifyjs CSS 
    <link rel="stylesheet" href="../Libs/alertifyjs/css/alertify.rtl.min.css">
    <link rel="stylesheet" href="../Libs/alertifyjs/css/themes/bootstrap.min.css">
    -->

      <!-- Font Awesome JS 
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="https://kit.fontawesome.com/b9fc8f6309.js"></script>
-->

    <!-- DataTables CSS
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css"> -->
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
    <?php 
        include '../Main/main.php';
    ?>
    <!-- INCLUDE CODIGO DE VIVIANA -->
    <div class="container">
        <div id="content" style="margin-top: 3%; margin-left:0; width: 100%;">
    <!-- FIN DEL CODIGO DE VIVIANA -->

    <div class="container-fluid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="text-center text-uppercase">REPORTE DE ADQUISICIONES ALTAS BAJAS</h3>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- ACORDION -->
                    <div class="accordion" id="accordionAdquisi">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                             Instrucciones
                            </button>
                          </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionAdquisi">
                          <div class="card-body">
                            <p><strong>Instrucciones</strong>: Para generar el reporte de adquisiciones es necesario seleccionar el año para el que desea obtener la información, después marcar cada una de las casillas de verificación de los centros de trabajo. Al hacer clic sobre cada casilla se desplegará una barra de progreso indicando la carga de la información y enseguida se mostrará un semáforo que marca los siguientes status:</p>
                                <ul>
                                    <li>Verde: La información se ha completado exitosamente.</li>
                                    <li>Naranja: Está intentando duplicar la información que ya se encuentra registrada esto no es posible realizar.</li>
                                    <li>Rojo: : Indica que el servidor de la base de datos a la que se desea conectar no se encuentra disponible o se ha cambiado el usuario o contraseña.</li>
                                </ul>

                            <p>El botón de color verde genera un reporte en formato Excel. Al dar clic sobre dicho botón, se desplegara las siguientes opciones:</p>
                            <ul>
                                <li>Maquinaria y equipo</li>
                                <li>Mobiliario y equipo de oficina</li>
                                <li>Equipo de transporte</li>
                                <li>Equipo de computo</li>
                                <li>Software</li>
                            </ul>
                                 
                            <p>Seleccione cualquiera de estas opciones y en la parte inferior se descargara un archivo Excel con la información que selecciono previamente.</p>

                            <p>Al hacer clic sobre el botón de color rojo se mostrara un mensaje de confirmación para limpiar (Eliminar) toda la información de la tabla de paso. Esto con el fin de que pueda volver a realizar todo el proceso después de cada año.</p>

                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Dudas o sugerencias 
                            </button>
                          </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionAdquisi">
                          <div class="card-body">
                            Favor de comunicarse a la siguiente extensión 62271.
                          </div>
                        </div>
                      </div>
                    </div>
                <!-- ACORDION -->
            </div><!-- DIV 12 -->
            
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
                    Excel &nbsp;&nbsp;<i class="far fa-file-excel"></i>
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
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="tablacentrotrabajo"></div>
        </div>

    </div><!-- fin del  container flud-->
</div> <!-- content de un div creado con style -->

</div><!-- wrapper -->
    
</body>
    <!-- Jquery JS -->
    <script src="../Libs/js/jquery-3.3.1.js"></script>

    <!--JavaScrip del menu lateral izquierda-->
    <script src="../Libs/js/mainfunction.js"> </script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

     <!-- no funciona el javascrip de bootstrap -->
    <!-- Bootstrap JS 
     <script src="../Libs/js/bootstrap.min.js"></script>-->

    <!-- Alertifyjs JS -->
    <script src="../Libs/alertifyjs/alertify.min.js"></script>

    <!-- DataTables JS 
    <script src="../Libs/DataTables/pdfmake/pdfmake.min.js"></script>
    <script src="../Libs/DataTables/pdfmake/vfs_fonts.js"></script>
    <script src="../Libs/DataTables/JSZip/jszip.min.js"></script>
    <script src="../Libs/DataTables/datatables.min.js"></script>-->        
    
    
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
        alertify.confirm('Eliminar el contenido de la tabla adquisiciones', '¿Esta seguro que desea vaciar la tabla de adquisiciones?, si vacía el contenido tendrá que seleccionar cada uno de los centro de trabajo y el año nuevamente .Confirmar mensaje', 
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
                    console.log("Error al intentar vaciar el contenido de la tabla adquisiciones.");
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