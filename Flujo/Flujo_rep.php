<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Lizeth Viviana Martínez Gómez">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PORTAL FINANCIERO - REPORTES</title>
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />
   <!-- Bootstrap CSS 
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">
-->
    <!-- CSS  propio
    <link rel="stylesheet" href="../Libs/css/style4.css">
-->
    <!--dataTables
   
    <link rel="stylesheet" href="../Libs/css/tablestyle.css">-->
    <!--Alertify
    <link rel="stylesheet" href="../Libs/alertifyjs/css/alertify.min.css">-->
    <!-- Font Awesome JS 
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="https://kit.fontawesome.com/b9fc8f6309.js"></script>
-->

</head>
<body>
    <?php 
        include '../Main/main.php';
    ?>
    <div class="container">
        <div id="content" style="margin-top: 6%; margin-left:0; width: 100%; ">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="text-center text-uppercase">Flujo de efectivo</h3>
                </div>
            </div>
            <iframe src="http://172.30.10.94:8080/birt-viewer/frameset?__report=report/sicop-conac/FLUJO.rptdesign" height="800px" width="100%"></iframe>
           
        </div>
    </div>


 <script src="../Libs/js/jquery-3.3.1.js"></script>
    <!-- Popper.JS -->
    <script src="../Libs/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../Libs/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../Libs/js/mainfunction.js"> </script>
    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    
</body>

</html>