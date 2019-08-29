<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Monica Zamora">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PORFINAN - FLUJO DE EFECTIVO</title>
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />
    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">-->
    <!-- CSS  propio
    <link rel="stylesheet" href="../Libs/css/style4.css">-->

    <!-- Font Awesome JS 
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="../Libs/fontAwesome/js/fontawesome.js"></script>-->
    <!--<link href="../ESTILOS/estilo1.css" type="text/css" rel="stylesheet">!-->
	    

</head>
<style type="text/css">
			#contenedor {
				padding:0 0 0 0;
				width:auto;
				margin-top:10px;
			}		
			#contenido {
				padding:10px 10px 10px 10px;
				width:auto;
				display:inline-block;
			}
			.FondoModal
			{
				position:absolute; 
				width:100%; 
				height:100%; 
				display:none; 
				top:0px;
				background-color:#D1D4D3;
				opacity:0.6;
				filter: alpha(opacity=60);
				text-align:center;
			}
			.Procesando{
				width:100%;
				height: 40px;
				text-align:center;
				top:50%;
				position:absolute;
				font-size:18px;
				font-weight:bold;
				color:#000000;
			}
        </style>

<body> 
  <?php 
    include '../Main/main.php';
  ?>
  <div class="container">
        <div id="content" style="margin-top: 3%; margin-left:0; width: 100%;">
        <form enctype="multipart/form-data" id="frmCargaAutomatizada" name="frmCargaAutomatizada" class="form-horizontal bv-form" action="class/ProcesoFlujo.php" method="post">
            <div style="margin-top:5px; margin-bottom:5px;">
	  			<marquee>
					<h3 align="center" style="font-size:165%;"><font color="621132">GENERACI&Oacute;N FLUJO DE EFECTIVO</font></h3>
				</marquee>
			</div> 
            
            <fieldset style="margin-top:12px; margin-left:10px; margin-right:10px; color:#621132;">
				<legend>
					<label class="control-label"><font color="621132">PAR&Aacute;METROS PARA AJUSTES DE FLUJO DE EFECTIVO</font></label>
				</legend>
                <div id="contenedor">
				  <div id="contenido"> 
						<label class="control-label"><font color="621132">EN EJERCICIO, DIGITAR EL AÑO ACTUAL u 8888 PARA PAGOS ANTERIORES DENTRO DEL MES o 9999 PARA OBTENER EL CONSOLIDADO DEL MES </font></label>
						
					</div>
                </div>
				<div id="contenedor">
				  <div id="contenido"> 
						<label class="control-label"><font color="621132">EJERCICIO: </font></label>
						<input name="axo" type="number"  id="axo" size="4" maxlength="4" required/>
					</div>
					
					
			
                 <div id="contenido">  
                <label class="control-label"><font color="621132">FECHA INICIAL:</font></label>
                  <input type="date" name="fecha_desde" id="fecha_desde">
               </div>
                    
                  <div id="contenido">  
                <label class="control-label"><font color="621132">FECHA FINAL:</font></label>
                  <input type="date" name="fecha_hasta" id="fecha_hasta">
               </div>
			
                 
             </div>
			</fieldset>
            
            <div id="contenedor">
				<div id="contenido">
                	<input class="form-control" id="btnCargar" name="btnCargar" value="GENERAR" type="button" onclick="grid()" style="color:#621132; margin-right:20px; padding: 4px 8px;"/>
                </div>
			</div>
            <fieldset style="margin-top:12px; margin-left:10px; margin-right:10px; color:#621132;">
				<legend>
					<label class="control-label"><font color="621132">GENERACIÓN DE REPORTES</font></label>
				</legend>
                <div id="contenedor">
				  <div id="contenido"> 
						<label class="control-label"><font color="621132">DE CLIC EN EL BOTÓN DEL REPORTE QUE DESEE GENERAR </font></label>
						
					</div>
                    <div id="contenido">
                	<input class="form-control" id="btnCargar" name="btnCargar" value="FLUJO DE EFECTIVO" type="button" onclick="ReporteFlujo()" style="color:#621132; margin-right:20px; padding: 4px 8px;" />
                </div>
                <div id="contenido">
                	<input class="form-control" id="btnCargar" name="btnCargar" value="POR PARTIDA" type="button" onclick="ReportePartidas()" style="color:#621132; margin-right:20px; padding: 4px 8px;" />
                </div>
                    
     
               </fieldset>
		</form>
            
            
            
        </div>
    </div>
    <!-- jQuery-->
    <script src="../Libs/js/jquery-3.3.1.js"></script>
    <!-- Popper.JS -->
    <script src="../Libs/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../Libs/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../Libs/js/mainfunction.js"> </script>
    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script type="text/javascript" language="javascript" charset="UTF-8">
            $(document).ready(function() {
                var divProcesando = function(mostrar){
                    if(mostrar == 1)
                    	$('#divProcesando').show();
                    else
                    	$('#divProcesando').hide();
                };
               $("#frmCargaAutomatizada").on('submit', function (e) {
					if (e.isDefaultPrevented()){
						divProcesando(0);
					}
					else{
						//alert($('#flpArchivo')[0].files[0].name);
						var aux = $('#flpArchivo')[0].files[0].name.split('.');
						if(aux[aux.length-1].toUpperCase() != 'TXT'){
							alert('El archivo debe ser .txt');
							divProcesando(0);
							return false;
						}
						divProcesando(1);
					}
                });
                
                
            });
        </script>

   
        
<script>
  webshims.setOptions('forms-ext', {types: 'date'});
  webshims.polyfill('forms forms-ext');
  $.webshims.formcfg = {
  en: {
      dFormat: '-',
      dateSigns: '-',
      patterns: {
          d: "yy-mm-dd"
		  //d: "dd-mm-yy"
      }
  }
  };
</script>

<script>
function grid(){
 $.ajax({
        url:   'class/ProcesoFlujo.php',
        dataType: "json",
        type:  'post',
          data: {"ejercicio":$('#axo').val(),
			  "fecha_desde":$('#fecha_desde').val(),
              "fecha_hasta":$('#fecha_hasta').val()
              
	
			     },

        success: function(resp){
         if(resp==''){
          alert ("las fechas no coinciden");
		  
         }if(resp!=''){
	     //alert(resp);
		 alert ('Procesando: ' + resp +' '+ $('#axo').val());
		    window.open('flujo.php?mesdesde='+resp+"&axo="+$('#axo').val(), '_blank');
      //  location.href='flujo.php?mesdesde='+resp+"&axo="+$('#axo').val();
		console.log($('#axo').val());
		//location.href='flujo.php?mesdesde='+resp;
         }
         
        }

        });
};
</script>
<script language="JavaScript" type="text/JavaScript">
function ReporteFlujo()
		{
         //  if (frmPeriodo.centroacopio.value == 0)
		  // {
    	//window.location.href="http://172.30.10.94:8080/birt-viewer/frameset?__report=report/sicop-conac/FLUJO.rptdesign";
       window.open('Flujo_rep.php', '_blank');
		  }
</script>
<script language="JavaScript" type="text/JavaScript">
function ReportePartidas()
		{
         //  if (frmPeriodo.centroacopio.value == 0)
		  // {
    	//window.location.href="http://172.30.10.94:8080/birt-viewer/frameset?__report=report/sicop-conac/PARTIDAS.rptdesign";
     window.open('Partidas_rep.php', '_blank');
		  }
</script>

</body>

</html>

