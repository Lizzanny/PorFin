<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Lizeth Viviana Martínez Gómez">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Base para desarrollo de sistemas</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <!-- CSS  propio-->
    <link rel="stylesheet" href="../Libs/css/style4.css">

    <!-- Font Awesome JS -->
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="../Libs/fontAwesome/js/fontawesome.js"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>TABLERO DE CONTROL</h3><!--nOMBRE DEL SISTEMA-->
                <strong id="mini" name="mini" style="font-size: 10pt">SISTC</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" text-align="center">
                        <i class="fas fa-user-ninja"></i>
                        &nbsp; &nbsp;
                        LizzWortgamz
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Cerrar Sesión</a>
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
                <li>
                    <a href="../Tables/Tables.php">
                        <i class="fas fa-table"></i>
                        &nbsp;
                        Tablas
                    </a>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        &nbsp;
                        Pagina 1
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Subpagina 1</a>
                        </li>
                        <li>
                            <a href="#">Subpagina 2</a>
                        </li>
                        <li>
                            <a href="#">Subpagina 3</a>
                        </li>
                    </ul>
                </li>
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
                    <a href="#">
                        <i class="fas fa-paper-plane"></i>
                        &nbsp;
                        Pagina 4
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div>
        <!--PARA INCORPORAR LA CABECERA DE IDENTIFICACIÓN DEL SISTEMA-->
            <nav class="navbar navbar-expand-xl navbar-light bg-light">
                <div class="container-fluid" id="div1" name="div1">
                    <div id="divbot" name="divbot">
                         <button type="button" id="sidebarCollapse" id="sidebarCollapse" class="btn btn-sm btn-circle">
                            <i class="fas fa-align-left fa-xs"></i>
                        </button>
                    </div>
                  <div id="div2" name="div2">
                    <div id="logox" name="logox">
                        <img class="img-responsive" src="../Libs/image/logotipo.png" id="imglogo" name="imglogo">
                    </div>
                    <div id="div3" name="div3">
                        <h4 id="h4s" name="h4s" ><strong>TABLERO DE CONTROL</strong></h4>
                        <h4 id="h4s" name="h4s" ><strong>SISTC</strong></h4>
                    </div>
                  </div>
                </div>
            </nav>
        </div>
        <div id="content" style="margin-top: 10%; margin-left:0; width: 100%;">
            <h2>CONTENIDO uno</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <div class="line"></div>

            <h2>CONTENIDO</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <div class="line"></div>

            <h2>CONTENIDO</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <div class="line"></div>

            <h3>CONTENIDO</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>
    <!-- jQuery-->
    <script src="../Libs/js/jquery-3.3.1.js"></script>
    <!-- Popper.JS -->
    <script src="../Libs/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../Libs/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../Libs/js/mainfunction.js"> </script>
</body>

</html>