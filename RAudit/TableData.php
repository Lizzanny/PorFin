<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Lizeth Viviana Martínez Gómez">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PORTAL DE INFORMACIÓN FINANCIERA - USUARIOS</title>
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />

   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">

    <!-- CSS  propio-->
    <link rel="stylesheet" href="../Libs/css/style4.css">

    <!--dataTables-->
   
    <link rel="stylesheet" href="../Libs/css/tablestyle.css">
    <!--Alertify-->
    <link rel="stylesheet" href="../Libs/alertifyjs/css/alertify.min.css">
    <!-- Font Awesome JS -->
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="https://kit.fontawesome.com/b9fc8f6309.js"></script>


</head>
<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
          include '../Main/main.php';
          //include '../Libs/conexionOracle.php';
        ?>

        <!-- Page Content  -->
        <div>
        <!--PARA INCORPORAR LA CABECERA DE IDENTIFICACIÓN DEL SISTEMA-->
            <?php 
            include '../Main/head.php'; 
            ?>
        </div>
        <div id="content" style="margin-top: 10%; margin-left:0; width: 100%;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 class="text-center text-uppercase"> Integración contable para auditores</h2>
                </div>
            </div>
            <div class="row">
                <div id="cuadro1" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tablita table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12" >      
                        <table id="datos" class="table table-bordered table-condensed" width="90%">
                            <thead>
                                <tr>   
                                    <th>#</th>             
                                    <th>CUENTA</th>
                                    <th>CENTRO_TRABAJO</th>
                                    <th>CEDULA</th>
                                    <th>ACTIVO</th>
                                    <th>CONTCC</th>             
                                    <th>CONTSC</th>
                                    <th>CONTSSC</th>
                                    <th>CONTSSSC</th>
                                    <th>CONTDES</th>
                                    <th>CONTFECHADQ</th>             
                                    <th>CONTFACTURA</th>
                                    <th>CONTCOSTO</th>
                                    <th>CONTORIGBIEN</th>
                                    <th>CONTASADEP</th>
                                    <th>CONTFECHCAP</th>             
                                    <th>CONTFECHDEP</th>
                                    <th>CONTPOLIZA</th>
                                    <th>CONTREFALTAS</th>
                                    <th>CONTREFBAJAS</th>
                                    <th>CONTABONO</th>             
                                    <th>CONTFECHMOV</th>
                                    <th>CONTDEPMEN</th>
                                    <th>CONTDEPANUAL</th>
                                    <th>CONTDEPACUM</th>
                                    <th>CONTSALXDEP</th>             
                                    <th>CONTBAJADEP</th>
                                    <th>CONTMESDEP</th>
                                    <th>CONTFECHDETDEP</th>
                                    <th>CONTFECHBAJA</th>
                                </tr>
                            </thead>                    
                        </table>
                    </div>          
                </div>  
            </div>
        
        </div>
    </div>

 
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="../Libs/js/mainfunction.js"> </script>
    
    <script src="../Libs/js/jquery-1.12.3.js" ></script>
    <script src="js/datos.js"></script>

    <script src="../Libs/DataTables/pdfmake/pdfmake.min.js"></script>
    <script src="../Libs/DataTables/pdfmake/vfs_fonts.js"></script>
    <script src="../Libs/DataTables/JSZip/jszip.min.js"></script>
    <script src="../Libs/DataTables/datatables.min.js"></script>
    <script src="../Libs/js/bootstrap.min.js"></script>
    <script src="../Libs/alertifyjs/alertify.min.js"></script>

    
</body>

</html>