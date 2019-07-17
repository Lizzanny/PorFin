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
<nav id="sidebar">
            <div class="sidebar-header">
                <h3>PORTAL FINANCIERO</h3><!--nOMBRE DEL SISTEMA-->
                <strong id="mini" name="mini" style="font-size: 10pt">PORTAL</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active" style="word-wrap: break-word; font-size: 10pt;">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" text-align="center">
                        <i class="fas fa-user-ninja"></i>
                        &nbsp; &nbsp;
                        <?php echo $user; ?>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="../Login/php/ClaseLogout.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-home"></i>
                        &nbsp;
                        Inicio
                    </a>
                </li>
<?php if($rol=='RFINADM'){?>
                <li>
                    <a href="../TableUser/TableUsers.php">
                        <i class="fas fa-table"></i>
                        &nbsp;
                        Usuarios
                    </a>
                </li>
<?php } ?> <!--
                <li>
                    <a href="../Forms/Formulario.php">
                        <i class="fas fa-file-invoice"></i>
                        &nbsp;
                        Formularios
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-question"></i>
                        &nbsp;
                        Pagina 3
                    </a>
                </li>
                <li>
                    <a data-toggle='modal' data-target='#generar' onclick="getcts()">
                        <i class="fas fa-paper-plane"></i>
                        &nbsp;
                        saldos de inversion
                    </a>
                </li>-->
<?php if($rol == 'RFINPRESUP' || $rol=='RFINADM'){ ?>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-coins"></i>
                        &nbsp; 
                        Inf. Presupuestal
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="../repof/rtg.php">Reporte por tipo de gasto</a></li>
                        <li><a href="../repof/rgct.php">Reporte de gastos por centro de trabajo</a></li>
                        <li><a href="../repof/rgpct.php">Reporte de gastos por partida y centro de trabajo</a></li>
                        <li><a href="../repof/rtpd.php">Reporte por tipo de gasto y división</a></li>
                        <li><a href="../repof/rgppct.php">Reporte de gastos por partida y centro de trabajo(Hacienda)</a></li>
                        <li><a href="../Flujo/flujoprincipal.php">Reporte de flujo de efectivo</a></li>
                    </ul>
                </li>
<?php }

if($rol == 'RFINCONTABLE' || $rol=='RFINADM'){ ?>
                <li>
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-balance-scale"></i> 
                        &nbsp;
                        Inf. Contable
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        <li><a href="#">Estado de situación financiera</a></li>
                        <li><a href="#">Cédula financiera de cuenta</a></li>
                        <li><a data-toggle='modal' data-target='#generar'>Saldos de activo fijo por cuenta y centros de costo.</a></li>
                    </ul>
                </li>
<?php } ?>
            </ul>
        </nav>

        