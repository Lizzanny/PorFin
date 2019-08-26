<?php 
    session_start();

    if (!isset($_SESSION["rol"])){
      header("Location:../Login/login.php");
    }
      $rol=$_SESSION['rol'];

    $user=$_SESSION['username'];
    $cv_ct=$_SESSION['ctx'];

    include '../Reportes/php/generador.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ISC LIZETH V MARTINEZ G">


<!--**************************************Icono del sistema****************************************************************-->
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png"/>

<!--**************************************Bootstrap CSS*******************************************************************-->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">

<!-- **************************************CSS  propio********************************************************************
    <link rel="stylesheet" href="../Libs/css/style4.css">
-->
    <link rel="stylesheet" href="../Libs/css/animate.css">
    <link rel="stylesheet" href="../Libs/css/sina-nav.css">
<!--***************************************DataTables*********************************************************************-->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">
    <link rel="stylesheet" href="../Libs/css/tablestyle.css">
    
<!--***************************************Alertify***********************************************************************-->
    <link rel="stylesheet" href="../Libs/alertifyjs/css/alertify.rtl.min.css">
    <link rel="stylesheet" href="../Libs/alertifyjs/css/themes/bootstrap.min.css">
   
<!--***************************************Font Awesome JS*****************************************************************-->
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="https://kit.fontawesome.com/b9fc8f6309.js"></script>
</head>
<style>
@font-face {
  font-family: Montserrat-Bold;
  src: url('../Libs/fonts/Montserrat/Montserrat-Bold.ttf'); 
}
@font-face {
  font-family: Montserrat-Regular;
  src: url('../Libs/fonts/Montserrat/Montserrat-Regular.ttf'); 
}
@font-face {
  font-family: Montserrat-Medium;
  src: url('../Libs/fonts/Montserrat/Montserrat-Medium.ttf'); 
}

* {
     font-family: Montserrat-Regular;
}

#div2{
            width:85%; 
            height: 5%; 
            vertical-align: middle;
        }
        
        #imglogo{
            width: 100%
        }
        #logox{/*div del logotipo*/
            float:left;  
            width: 60%; 
            margin-left: 2%
        }
        #div3{/*nombre del sistema*/
            float:right;  
            width: 40%; 
            vertical-align: top; 
            text-align: center;
        }
        

        body{
            background: #FFFFFF;
        }
        .nav-container{
            min-height: 120px;
        }
        .sina-nav{
            top: 40px;
            position: absolute;
        }
        .sina-nav.navbar-transparent{
            background: rgba(255, 255, 255, 0.2);
        }
        #barra{
            color:#621132;
        }
</style>
<body>
<div class="nav-container">
    <nav class="sina-nav mobile-sidebar navbar-transparent navbar-fixed" data-top="40" data-md-top="40" data-xl-top="40">
        <div class="container-fluid" style="background: #F5EFE3; border: 1px #D4C19C;">
            <div class="extension-nav">
                <ul>
                    <li class="dropdown">   
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="barra" name="barra">
                            <i class="fas fa-user-ninja"></i>
                            <?php echo $user; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="../Login/php/ClaseLogout.php" id="barra" name="barra">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </li>
                    <li class="widget-bar-btn"><a href="#" id="barra" name="barra"><i class="fa fa-bars"></i></a></li>
                </ul>
            </div><!-- .extension-nav -->

            <div class="sina-nav-header social-on">
                <div id="div2" name="div2">
                    <div id="logox" name="logox" class="hidden-xs hidden-sm col-md-8">
                        <img class="img-responsive" src="../Libs/image/logo_encabezadolvmg5.png" id="imglogo" name="imglogo">
                    </div>
                    <div id="div3" name="div3" class="col-xs-12 col-sm-12 col-md-4">
                        <h5 id="h4s" name="h4s" ><strong>PORTAL FINANCIERO</strong></h5>
                        <h5 id="h4s" name="h4s" ><strong>PORFINAN</strong></h5>
                    </div>
                </div>
                
            </div><!-- .sina-nav-header -->


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
            
            </div><!-- /.navbar-collapse -->
        </div><!-- .container -->

        <!-- Start widget-bar -->
        <div class="sina-nav-overlay off"></div>
        <div class="widget-bar">
            <a href="#" class="close-widget-bar"><i class="fa fa-times"></i></a>
            <div class="widget">
                <h6 class="title">PORTAL FINANCIERO <br>MENÚ</h6>
                <ul class="sina-menu" data-in="fadeInLeft" data-out="fadeInOut">
                    <li>
                        <a href="../Home/index.php"> 
                            <i class="fas fa-home"></i>
                            Inicio
                        </a>
                    </li>
<?php if($rol=='RFINADM'){?>
                    <li>
                        <a href="../TableUser/TableUsers.php">
                            <i class="fas fa-table"></i>
                            Usuarios
                        </a>
                    </li>
<?php } ?> 
<?php if($rol == 'RFINPRESUP' || $rol=='RFINADM'){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-coins"></i>
                            Presupuestal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="../repof/rtg.php">Reporte por tipo de gasto</a></li>
                            <li><a href="../repof/rgct.php">Reporte de gastos por Centro de trabajo</a></li>
                            <li><a href="../repof/rgpct.php">Reporte de gastos por partida y Centro de trabajo</a></li>
                            <li><a href="../repof/rtpd.php">Reporte por tipo de gasto y división</a></li>
                            <li><a href="../repof/rgppct.php">Reporte de gastos por partida y Centro de trabajo (Hacienda)</a></li>
                            <li><a href="../Flujo/flujoprincipal.php">Reporte de flujo de efectivo</a></li>
                            <li><a href="../repof/lcp.php">Layout consolidación presupuestal</a></li>
                        </ul>
                    </li>
<?php }
if($rol == 'RFINCONTABLE' || $rol=='RFINADM'){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-balance-scale"></i>
                            Contable
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="../EdoFin/estadoFin.php">Estado de situación financiera</a></li>
                            <li><a href="#">Cedula financiera a cuenta 1117</a></li>
                            <li><a data-toggle='modal' data-target='#generar'>Saldos de activo fijo por cuenta y Centro de costos</a></li>
                            <li><a href="../RAudit/TableRepor.php">Integración contable para auditores</a></li>
                            <li><a href="../Adquisiciones/index.php">Libro de inventarios y balances</a></li>
                        </ul>
                    </li>
<?php } 
        
if($rol == 'RFINCONSOLIDACION' || $rol=='RFINADM'){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-puzzle-piece"></i>
                            Cons. Financiera
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Consolidación presupuestal</a></li>
                        </ul>
                    </li>
<?php } ?>
                </ul>
            </div>
        </div>
        <!-- End widget-bar -->
    </nav>
</div>

</body>

    <!-- jQuery-->
    <script src="../Libs/js/jquery-3.3.1.js"></script>
    <script src="../Libs/js/wow.min.js"></script>
    <script src="../Libs/js/sina-nav.js"></script>

    <!--Funcionalidad del menú-->
    <script >
        $(document).ready(function() {
            // WOW animation initialize
            new WOW().init();
        });
    </script>

    <!--DataTables-->
    <script src="../Libs/DataTables/pdfmake/pdfmake.min.js"></script>
    <script src="../Libs/DataTables/pdfmake/vfs_fonts.js"></script>
    <script src="../Libs/DataTables/JSZip/jszip.min.js"></script>
    <script src="../Libs/DataTables/datatables.min.js"></script>
    <script src="../Reportes/js/operaciones.js"></script>
    <!-- Bootstrap JS -->
    <script src="../Libs/js/bootstrap.min.js"></script>

    <!--Alertify-->
    <script src="../Libs/alertifyjs/alertify.min.js"></script>
    
    <!-- Popper.JS -->
    <script src="../Libs/js/popper.min.js"></script>

    
</html>
