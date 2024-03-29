<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Lizeth Viviana Martínez Gómez">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PORTAL DE INFORMACIÓN FINANCIERA - USUARIOS</title>
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
   
    <link rel="stylesheet" href="../Libs/css/tablestyle.css">
    -->
    <!--Alertify
    <link rel="stylesheet" href="../Libs/alertifyjs/css/alertify.min.css">
    -->
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
        <div id="content" style="margin-top: 10%; margin-left:0; width: 100%;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 class="text-center text-uppercase">Catálogo de Usuarios</h2>
                </div>
            </div>
            <div class="row">
                <div id="cuadro1" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tablita table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12" >      
                        <table id="usuarios" class="table table-bordered table-condensed" width="100%">
                            <thead>
                                <tr>                
                                    <th>CENCOS CT CLAVE</th>
                                    <th>CENCOS CLAVE</th>
                                    <th>NOMBRE</th>
                                    <th>RH CENTRAB</th>
                                    <th>NOMINA</th>
                                    <th>USUARIO</th>
                                    <th>CONTRASEÑA</th>
                                    <th>ROL</th>
                                    <th>MODULOS</th>
                                    <th>OPERACIONES </th>
                                </tr>
                            </thead>                    
                        </table>
                    </div>          
                </div>  
            </div>
            <div class="row">
                <?php 
                include 'php/agregaUsuario.php';
                ?>
            </div>
            <div class="row">
                <?php 
                include 'php/editarUsuario.php'; 
                ?>
            </div>

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