<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Lizeth Viviana Martínez Gómez">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PORTAL FINANCIERO - REPORTES</title>
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
          include '../Libs/conexionOracle.php';
        ?>

        <!-- Page Content  -->
        <div>
        <!--PARA INCORPORAR LA CABECERA DE IDENTIFICACIÓN DEL SISTEMA-->
            <?php 
            include '../Main/head.php'; 
            ?>
        </div>
        <div id="content" style="margin-top: 6%; margin-left:0; width: 100%;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="text-center text-uppercase">Reporte de gastos por partida y centro de trabajo</h3>
                </div>
            </div>
            <iframe src="http://172.30.10.94:8080/birt-viewer/frameset?__report=report/sicop-conac/repcontablepres04.rptdesign" height="100%" width="100%"></iframe>
           
        </div>
    </div>

 
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="js/ops.js"></script>
    <script src="../Libs/js/mainfunction.js"> </script>
    
    <script src="../Libs/js/jquery-1.12.3.js" ></script>
    <script src="js/funcion_di1.js"></script>
    <script src="../Libs/DataTables/pdfmake/pdfmake.min.js"></script>
    <script src="../Libs/DataTables/pdfmake/vfs_fonts.js"></script>
    <script src="../Libs/DataTables/JSZip/jszip.min.js"></script>
    <script src="../Libs/DataTables/datatables.min.js"></script>
    <script src="../Libs/js/bootstrap.min.js"></script>
    <script src="../Libs/alertifyjs/alertify.min.js"></script>
    <script src="../Reportes/js/operaciones.js"></script>
    
</body>

</html>