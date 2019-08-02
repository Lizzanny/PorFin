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
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">

</head>

<body>
        <div>
        <!--PARA INCORPORAR LA CABECERA DE IDENTIFICACIÓN DEL SISTEMA-->
            <?php 
                //include '../Main/main.php';
                //include '../Main/head.php'; 
            ?>
        </div>

        
       
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 class="text-center text-uppercase">Reporte de Adquisiciones Altas Bajas</h4>
                </div>
            </div>
            
            <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="tablacentrotrabajo"></div>
            </div>
        </div>

        <style type="text/css" media="screen">
            .checkbox-1x {
                transform: scale(1.3);
                -webkit-transform: scale(1.3);
            }
        </style>

</body>

    <script src="../Libs/js/jquery-3.3.1.js"></script>
    <script src="../Libs/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            console.log( "ready!" );
            getListaCentroTrabajo();
        }); 

        function getListaCentroTrabajo(){
            $.ajax({
            url: 'php/classAdquisicion.php',
            type: 'POST',
            dataType: 'html',
            data: {'opcion': 'cargaListaCentroTrabajo'},
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
            const rojo='#ea1d31';
            const verde='#51c26f';
            var idsemaforo= '#semaforo'+cve;

            if(cve!=''){
                $.ajax({
                    url: 'php/classAdquisicion.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {'opcion': 'informacionCentroTrabajo',
                           'cvect': cve},
                })
                    .done(function(res) {
                        console.log("success");
                        if(res.cone==1){
                            $(idsemaforo).css('background-color', verde);
                        }
                        if(res.cone==0){
                            $(idsemaforo).css('background-color', rojo);
                        }
                        console.log(res);
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
            }  
        }



        
        

    </script>
    
</html>