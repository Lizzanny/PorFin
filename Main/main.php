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
        <h4>PORTAL FINANCIERO</h4><!--nOMBRE DEL SISTEMA-->
        <strong id="mini" name="mini" align="left" style="font-size: 10pt;">PORTAL</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="active" style="word-wrap: break-word; font-size: 10pt;" text-align="left">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
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
        <li style="font-size: 10pt;" text-align="left">
            <a href="../Home/index.php" text-align="left">
                <i class="fas fa-home"></i>
                &nbsp;
                Inicio
            </a>
        </li>
<?php if($rol=='RFINADM'){?>
        <li style="font-size: 10pt;" text-align="left">
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
        <li style="font-size: 10pt;" text-align="left">
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-coins"></i>
                &nbsp; 
                Presupuestal
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
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
        <li style="font-size: 10pt;" text-align="left">
            <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-balance-scale"></i> 
                &nbsp;
                Contable
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu1">
                <li><a href="../EdoFin/estadoFin.php">Estado de situación financiera</a></li>
                <li><a href="#">Cedula financiera a cuenta 1117</a></li>
                <li><a data-toggle='modal' data-target='#generar'>Saldos de activo fijo por cuenta y Centro de costos</a></li>
            </ul>
        </li>
<?php } 


if($rol == 'RFINCONSOLIDACION' || $rol=='RFINADM'){ ?>
        <li style="font-size: 10pt;" text-align="left">
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-puzzle-piece"></i>
                &nbsp;
                Cons. Financiera
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li><a href="#">Consolidación presupuestal</a></li>
            </ul>
        </li>
<?php } ?>
    </ul>
</nav>

        