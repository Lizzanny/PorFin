<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Lizeth Viviana Martínez Gómez">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PORTAL DE INFORMACIÓN FINANCIERA - AUDITORIA</title>
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />

   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">

    <!-- CSS  propio-->
    <link rel="stylesheet" href="../Libs/css/style4.css">
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
        <div id="content" style="margin-top: 10%; margin-left:0; width: 100%;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 class="text-center text-uppercase">Reporte de auditoria</h2>
                </div>
            </div>
            <div class="row">
              <div class="offset-md-4 col-md-10">
                    <table width="40%" cellpadding="1px" cellspacing="1px" border="1" style="font-size: 9pt">
                        <tr>
                            <td><label>TODOS LOS CENTROS DE TRABAJO</label></td>
                            <td><input type="checkbox" value="555" name="centrosT[]" /></td>
                            <td id="555"></td>
                        </tr>
                        <tr>
                            <td><label>OFICINA CENTRAL</label></td>
                            <td><input type="checkbox" value="101" name="centrosT[]" /></td>
                            <td id="101"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA ESTATAL QUERETARO</label></td>
                            <td><input type="checkbox" value="204" name="centrosT[]" /></td>
                            <td id="204"></td>
                        </tr>
                        <tr>
                            <td><label>PLANTA VALLE DE TOLUCA</label></td>
                            <td><input type="checkbox" value="207" name="centrosT[]" /></td>
                            <td id="207"></td>
                        </tr>
                        <tr>
                            <td><label>PLANTA MONTERREY</label></td>
                            <td><input type="checkbox" value="208" name="centrosT[]" /></td>
                            <td id="208"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA ESTATAL COLIMA</label></td>
                            <td><input type="checkbox" value="209" name="centrosT[]" /></td>
                            <td id="209"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA ESTATAL OAXACA</label></td>
                            <td><input type="checkbox" value="210" name="centrosT[]" /></td>
                            <td id="210"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. NUEVO LEON</label></td>
                            <td><input type="checkbox" value="301" name="centrosT[]" /></td>
                            <td id="301"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. OAXACA</label></td>
                            <td><input type="checkbox" value="302" name="centrosT[]" /></td>
                            <td id="302"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA ESTATAL JALISCO</label></td>
                            <td><input type="checkbox" value="303" name="centrosT[]" /></td>
                            <td id="303"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA METROPOLITANA NORTE</label><br/>     </td>
                            <td><input type="checkbox" value="304" name="centrosT[]" /></td>
                            <td id="304"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. YUCATAN</label></td>
                            <td><input type="checkbox" value="305" name="centrosT[]" /></td>
                            <td id="305"></td>
                        </tr>
                        <tr>
                            <td><label>PLANTA TLAHUAC</label></td>
                            <td><input type="checkbox" value="306" name="centrosT[]" /></td>
                            <td id="306"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. METROPOLITANO NORTE</label></td>
                            <td><input type="checkbox" value="308" name="centrosT[]" /></td>
                            <td id="308"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. GUERRERO</label></td>
                            <td><input type="checkbox" value="309" name="centrosT[]" /></td>
                            <td id="309"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. TAMAULIPAS</label></td>
                            <td><input type="checkbox" value="310" name="centrosT[]" /></td>
                            <td id="310"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. SAN LUIS POTOSI</label></td>
                            <td><input type="checkbox" value="311" name="centrosT[]" /></td>
                            <td id="311"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. ZACATECAS</label></td>
                            <td><input type="checkbox" value="312" name="centrosT[]" /></td>
                            <td id="312"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. NAYARIT</label></td>
                            <td><input type="checkbox" value="313" name="centrosT[]" /></td>
                            <td id="313"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA ESTATAL MICHOACAN</label></td>
                            <td><input type="checkbox" value="314" name="centrosT[]" /></td>
                            <td id="314"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. MORELOS</label></td>
                            <td><input type="checkbox" value="315" name="centrosT[]" /></td>
                            <td id="315"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. CHIAPAS</label></td>
                            <td><input type="checkbox" value="316" name="centrosT[]" /></td>
                            <td id="316"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. COAHUILA</label></td>
                            <td><input type="checkbox" value="317" name="centrosT[]" /></td>
                            <td id="317"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. GUANAJUATO</label></td>
                            <td><input type="checkbox" value="318" name="centrosT[]" /></td>
                            <td id="318"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. CHIHUAHUA</label></td>
                            <td><input type="checkbox" value="319" name="centrosT[]" /></td>
                            <td id="319"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. SINALOA</label></td>
                            <td><input type="checkbox" value="320" name="centrosT[]" /></td>
                            <td id="320"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. SONORA</label></td>
                            <td><input type="checkbox" value="321" name="centrosT[]" /></td>
                            <td id="321"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S AGUASCALIENTES</label></td>
                            <td><input type="checkbox" value="322" name="centrosT[]" /></td>
                            <td id="322"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. DURANGO</label></td>
                            <td><input type="checkbox" value="323" name="centrosT[]" /></td>
                            <td id="323"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. TABASCO</label></td>
                            <td><input type="checkbox" value="324" name="centrosT[]" /></td>
                            <td id="324"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. VERACRUZ</label></td>
                            <td><input type="checkbox" value="325" name="centrosT[]" /></td>
                            <td id="325"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. JALISCO</label></td>
                            <td><input type="checkbox" value="326" name="centrosT[]" /></td>
                            <td id="326"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. QUERETARO</label></td>
                            <td><input type="checkbox" value="327" name="centrosT[]" /></td>
                            <td id="327"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. PUEBLA</label></td>
                            <td><input type="checkbox" value="328" name="centrosT[]" /></td>
                            <td id="328"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. TLAXCALA</label></td>
                            <td><input type="checkbox" value="329" name="centrosT[]" /></td>
                            <td id="329"></td>
                        </tr>
                        <tr>
                            <td><label> METROPOLITANO SUR</label></td>
                            <td><input type="checkbox" value="330" name="centrosT[]" /></td>
                            <td id="330"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. COLIMA</label></td>
                            <td><input type="checkbox" value="331" name="centrosT[]" /></td>
                            <td id="331"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. QUINTANA ROO</label></td>
                            <td><input type="checkbox" value="332" name="centrosT[]" /></td>
                            <td id="332"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. HIDALGO</label></td>
                            <td><input type="checkbox" value="333" name="centrosT[]" /></td>
                            <td id="333"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. CAMPECHE</label></td>
                            <td><input type="checkbox" value="334" name="centrosT[]" /></td>
                            <td id="334"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. BAJA CALIFORNIA SUR</label></td>
                            <td><input type="checkbox" value="335" name="centrosT[]" /></td>
                            <td id="335"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA ESTATAL MICHOACAN</label></td>
                            <td><input type="checkbox" value="401" name="centrosT[]" /></td>
                            <td id="401"></td>
                        </tr>
                        <tr>
                            <td><label>GERENCIA ESTATAL TLAXCALA</label></td>
                            <td><input type="checkbox" value="402" name="centrosT[]" /></td>
                            <td id="402"></td>
                        </tr>
                        <tr>
                            <td><label>P.A.S. BAJA CALIFORNIA NORTE</label></td>
                            <td><input type="checkbox" value="408" name="centrosT[]" /></td>
                            <td id="408"></td>
                        </tr>
                        <tr>
                            <td><label>PLANTA XALAPA</label></td>
                            <td><input type="checkbox" value="404" name="centrosT[]" /></td>
                            <td id="404"></td>
                        </tr>
                        <tr>
                            <td><label>PROGRAMA DE ABASTO SOCIAL QUINTANA ROO</label></td>
                            <td><input type="checkbox" value="300" name="centrosT[]" /></td>
                            <td id="300"></td>
                        </tr>
                        <tr>
                            <td><label>G. ESTATAL VALLE DE TOLUCA</label></td>
                            <td><input type="checkbox" value="336" name="centrosT[]" /></td>
                            <td id="336"></td>
                        </tr>
                    
                    </table>
              </div>
            </div>
        </div>
    </div>

 
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="js/funciones.js"></script>
    
</body>

</html>