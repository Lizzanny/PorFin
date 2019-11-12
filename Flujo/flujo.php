<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8">
    <meta name="author" content="Monica Zamora">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Flujo de Efectivo</title>

    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css"> 
    <!-- CSS  propio-->
    <link rel="stylesheet" href="../Libs/css/style4.css">
    <link href="https://demos.telerik.com/kendo-ui/grid/excel-export">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
	<!---->
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="../Libs/fontAwesome/js/fontawesome.js"></script>
    
   <!--
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.2.514/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.2.514/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.2.514/styles/kendo.material.mobile.min.css" />-->
    <link rel="stylesheet" href="../Libs/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="../Libs/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="../Libs/styles/kendo.material.mobile.min.css" />

     <!--
    <script src="https://kendo.cdn.telerik.com/2019.2.514/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2019.2.514/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2019.2.514/js/kendo.all.min.js"></script>-->
    <script src="../Libs/jskendo/jquery.min.js"></script>
    <script src="../Libs/jskendo/jszip.min.js"></script>
    <script src="../Libs/jskendo/kendo.all.min.js"></script>
    

    <!-- Font Awesome JS -->
    

</head>



<style type="text/css">
 /*  .k-grid-save
{
     background-image : none ;
     background-color : white ;
}*/

.k-grid-toolbar  {
	background-color: #621132;
	}
	
.k-grouping-header {
	background-color: #621132;
		}

.k-grid .k-header .k-button {
    background-color: #B38E5D;
}
</style>
 <?php 
   
 $mes = $_REQUEST["mesdesde"];
 $axo = $_REQUEST["axo"];
// $mes = "MAYO";
 //echo "MES: ".$mes;
?>
<body>
    <?php 
          //include '../Main/main.php';
    ?>
    <div class="container-fluid">
      
        <div id="content" style="margin-top: 3%; margin-left:0; width: 100%;">


<div style="margin-top:15px; margin-bottom:15px;">
	  			<marquee>
					<h3 align="center" style="font-size:165%;"><font color="621132">FLUJO DE EFECTIVO </font></h3>
				</marquee>
			</div>

<div id="example">
    <div id="grid"></div>
    <script>
	   var mes = '<?php echo $mes ?>';
	   var axo = '<?php echo $axo ?>';
	   //alert ("mes flujo grid: " + mes);
       var dataSource = new kendo.data.DataSource({
						 transport: {
                        read: "http://portalfinanciero.liconsa.gob.mx/Flujo/data/conceptos2.php?mesdesde="+mes+"&axo="+axo,
						//read: "http://localhost:8080/Portfin/public_html/Flujo/Data/conceptos2.php?mesdesde="+mes+"&axo="+axo,
						 create: {
							url: "",
							type: "POST"
						},
						update: {
                                // url: "http://localhost:8080/Portfin/public_html/Flujo/data/actualiza.php",
								 url: "http://portalfinanciero.liconsa.gob.mx/Flujo/data/actualiza.php",
                                 type: "POST"
                                },
						destroy: {
                                 url: "",
                                 type: "POST"
                                }},	
   
   schema:{
					 data: "data",
                    model: {
						// id: "EmployeeID",
						 id: "ID",
                        fields: {
                            ID: { type: "number", validation: { required: true} },
                            CG: { type: "number", validation: { required: true} },
                            CGDES: { type: "string",  validation: { required: true} },
							SUBCTA: { type: "number", validation: { required: true} },
                            SUBCTADES: { type: "string",  validation: { required: true} },
							PARTIDA: { type: "number", validation: { required: true} },
							PARTIDADES: { type: "string",  validation: { required: true} },
							CAPITULO: { type: "number", validation: { required: true} },
							CAPITDESC: { type: "string",  validation: { required: true} },
							C101: { type: "number",  validation: { required: true} },
							C204: { type: "number",  validation: { required: true} },
							C209: { type: "number",  validation: { required: true} },
							C210: { type: "number",  validation: { required: true} },
							C301: { type: "number",  validation: { required: true} },
							C303: { type: "number",  validation: { required: true} },
							C304: { type: "number",  validation: { required: true} },
							C305: { type: "number",  validation: { required: true} },
							C309: { type: "number",  validation: { required: true} },
							C310: { type: "number",  validation: { required: true} },
							C311: { type: "number",  validation: { required: true} },
							C312: { type: "number",  validation: { required: true} },
							C313: { type: "number",  validation: { required: true} },
							C315: { type: "number",  validation: { required: true} },
							C316: { type: "number",  validation: { required: true} },
							C317: { type: "number",  validation: { required: true} },
							C318: { type: "number",  validation: { required: true} },
							C319: { type: "number",  validation: { required: true} },
							C320: { type: "number",  validation: { required: true} },
							C321: { type: "number",  validation: { required: true} },
							C322: { type: "number",  validation: { required: true} },
							C323: { type: "number",  validation: { required: true} },
							C324: { type: "number",  validation: { required: true} },
							C325: { type: "number",  validation: { required: true} },
							C328: { type: "number",  validation: { required: true} },
							C330: { type: "number",  validation: { required: true} },
							C332: { type: "number",  validation: { required: true} },
							C333: { type: "number",  validation: { required: true} },
							C334: { type: "number",  validation: { required: true} },
							C335: { type: "number",  validation: { required: true} },
							C336: { type: "number",  validation: { required: true} },
							C401: { type: "number",  validation: { required: true} },
							C402: { type: "number",  validation: { required: true} },
							C408: { type: "number",  validation: { required: true} },
							C600: { type: "number",  validation: { required: true} },
							C930: { type: "number",  validation: { required: true} },
							C940: { type: "number",  validation: { required: true} },
							C950: { type: "number",  validation: { required: true} },
							C960: { type: "number",  validation: { required: true} },
							C999: { type: "number",  validation: { required: true} },
							TOTAL: { type: "number",  validation: { required: true} },
							
							
							
							
							//neto: { type: "number",  validation: { required: true} },
                            //UnitsOnOrder: { type: "number" },
                            //UnitsInStock: { type: "number" }
                        }
						
                    },
    },
	
	aggregate: [ { field: "CG", aggregate: "count" },
                                          { field: "C101", aggregate: "sum" },
                                          { field: "C204", aggregate: "sum" },
                                          { field: "C209", aggregate: "sum" },
										  { field: "C210", aggregate: "sum" },
										  { field: "C301", aggregate: "sum" },
										  { field: "C303", aggregate: "sum" },
                                          { field: "C304", aggregate: "sum" },
                                          { field: "C305", aggregate: "sum" },
										  { field: "C309", aggregate: "sum" },
										  { field: "C310", aggregate: "sum" },
                                          { field: "C311", aggregate: "sum" },
                                          { field: "C312", aggregate: "sum" },
										  { field: "C313", aggregate: "sum" },
										  { field: "C315", aggregate: "sum" },
                                          { field: "C316", aggregate: "sum" },
                                          { field: "C317", aggregate: "sum" },
										  { field: "C318", aggregate: "sum" },
										  { field: "C319", aggregate: "sum" },
										  { field: "C320", aggregate: "sum" },
                                          { field: "C321", aggregate: "sum" },
                                          { field: "C322", aggregate: "sum" },
										  { field: "C323", aggregate: "sum" },
										  { field: "C324", aggregate: "sum" },
                                          { field: "C325", aggregate: "sum" },
                                          { field: "C328", aggregate: "sum" },
										  { field: "C330", aggregate: "sum" },
										  { field: "C332", aggregate: "sum" },
                                          { field: "C333", aggregate: "sum" },
                                          { field: "C334", aggregate: "sum" },
										  { field: "C335", aggregate: "sum" },
										 
										  { field: "C336", aggregate: "sum" },
										  { field: "C401", aggregate: "sum" },
                                          { field: "C402", aggregate: "sum" },
                                          { field: "C408", aggregate: "sum" },
										  { field: "C600", aggregate: "sum" },
										  { field: "C930", aggregate: "sum" },
										  { field: "C940", aggregate: "sum" },
										  { field: "C950", aggregate: "sum" },
                                          { field: "C960", aggregate: "sum" },
                                          { field: "C999", aggregate: "sum" },
										  { field: "TOTAL", aggregate: "sum" }
										 
										  
                                          ],
	
    pageSize: 500
	//pageSize: 4
});

$("#grid").kendoGrid({
    dataSource: dataSource,
	
    columns: [
	{
                        field: "CG",
                        title: "CG",
                        locked: true,
                        lockable: false,
                        width: 100,
						footerTemplate: "Total Count: #=count#"
                    }, {
                        field: "CGDES",
                        title: "CGDES",
						locked: true,
                        lockable: false,
                        width: 100,
						
                    },
					  {
                        field: "SUBCTA",
                        title: "SUBCTA",
						locked: true,
                        lockable: false,
                        width: 100,
                    }, 
					  {
                        field: "SUBCTADES",
                        title: "SUBCTADES",
						width: 100,
                    }, 
					{
                        field: "PARTIDA",
                        title: "PARTIDA",
						width: 100,
                    }, 
					{
                        field: "PARTIDADES",
                        title: "PARTIDADES",
						width: 100,
                    },
					{
                        field: "CAPITULO",
                        title: "CAPITULO",
						width: 100,
                    },
					{
                        field: "CAPITDESC",
                        title: "CAPITDESC",
						width: 100,
                    },   
					  {
                        field: "C101",
                        title: "O.C.",
						format:"{0:c2}",
                        width: 100,
						//footerTemplate: "Total C101: #=sum#"
						footerTemplate: "Total O.C.: #= kendo.toString(sum, 'C') #"
						
						
						
                    },{
                        field: "C204",
                        title: "QRO.",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total QRO.: #= kendo.toString(sum, 'C') #"
						
                    },
					{
                        field: "C209",
                        title: "COLIMA",
						format:"{0:c2}",
                        width: 100,
						footerTemplate: "Total COL.: #= kendo.toString(sum, 'C') #"
						//footerTemplate: "<div>Min: #= min #	<div>Max: #= max #</div>"
                    },{
                        field: "C210",
                        title: "OAXACA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						//footerTemplate: "Total C210: #=sum#"
						footerTemplate: "Total OAX.: #= kendo.toString(sum, 'C') #"
						
                    },
					{
                        field: "C301",
                        title: "NUEVO LEON",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total N.L.: #= kendo.toString(sum, 'C') #"
						
                    },
					
					{
                        field: "C303",
                        title: "JALISCO",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total JAL.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C304",
                        title: "METRO NORTE",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total NORTE: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C305",
                        title: "YUCATAN",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total YUC.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C309",
                        title: "GUERRERO",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total GRO.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C310",
                        title: "TAMAULIPAS",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total TAM.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C311",
                        title: "S.L.P.",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total S.L.P.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C312",
                        title: "ZACATECAS",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total ZAC.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C313",
                        title: "NAYARIT",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total NAY.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C315",
                        title: "MORELOS",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total MOR.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C316",
                        title: "CHIAPAS",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total CHIA.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C317",
                        title: "COAHUILA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total COAH.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C318",
                        title: "GTO.",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total GTO.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C319",
                        title: "CHIHUAHUA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total CHIH.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C320",
                        title: "SINALOA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total SIN.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C321",
                        title: "SONORA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total SON.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C322",
                        title: "AGUASCALIENTES",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total AGS.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C323",
                        title: "DURANGO",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total DGO.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C324",
                        title: "TABASCO",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total TAB.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C325",
                        title: "VERACRUZ",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total VER.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C328",
                        title: "PUEBLA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total PUE.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C330",
                        title: "METRO SUR",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total SUR: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C332",
                        title: "QUINTANA ROO",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total Q.ROO: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C333",
                        title: "HIDALGO",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total HID.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C334",
                        title: "CAMPECHE",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total CAMP.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C335",
                        title: "B.C.S",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total B.C.S.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C336",
                        title: "TOLUCA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total TOL.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C401",
                        title: "MICHOACAN",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total MICH.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C402",
                        title: "TLAXCALA",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total TLAX.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C408",
                        title: "B.C.N.",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total B.C.N.: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C600",
                        title: "C600",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total C600: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C930",
                        title: "C930",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total C930: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C940",
                        title: "C940",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total C940: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C950",
                        title: "C950",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total C950: #= kendo.toString(sum, 'C') #"
                    },
					{
                        field: "C960",
                        title: "C960",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total C960: #= kendo.toString(sum, 'C') #"
                    },
					
					{
                        field: "C999",
                        title: "C999",
						format:"{0:c2}",
                        //locked: true,
                        width: 100,
						footerTemplate: "Total C999: #= kendo.toString(sum, 'C') #"
                    }, 
					 			
	
    {
        
		 field: "TOTAL",
					    title: "TOTAL",
                       // lockable: false,
					   format:"{0:c2}",
                        width: 100,
						footerTemplate: "TOTAL: #= kendo.toString(sum, 'C') #",
        editor: function(cont, options) {
            $("<span>" + options.model.total + "</span>").appendTo(cont);
        }
		
		},
		
		
		
		],
   		
		
			//toolbar: [ "save", "cancel", "excel"],
			 toolbar: [
   
    { name: "save" , text: "Actualiza" },
    { name: "cancel", text: "Cancelar" },
	{ name: "excel", text: "Exportar a Excell" }
	//toolbar: [ "save", "cancel", "excel"],
  ],
	excel: {
                fileName: "Flujo.xlsx",
                proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
                filterable: true
            },
			
			
				height: 540,
				editable: true,
                sortable: true,
                reorderable: true,
                groupable: true,
                resizable: true,
                filterable: true,
                columnMenu: true,
                pageable: true,
				
   save: function(data) {
         if (data.values.C101) {
           var test = data.model.set("TOTAL", data.values.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C204) {
           var test = data.model.set("TOTAL", data.model.C101 + data.values.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C209) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.values.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		
		if (data.values.C210) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.values.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C301) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.values.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C303) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.values.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C304) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.values.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		if (data.values.C305) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.values.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C309) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.values.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C310) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.values.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		
		if (data.values.C311) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.values.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C312) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.values.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C313) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.values.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
										   								   
										   
        }
		
		
		 if (data.values.C315) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.values.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C316) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.values.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C317) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.values.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		
		if (data.values.C318) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.values.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C319) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.values.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C320) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.values.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		if (data.values.C321) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.values.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C322) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.values.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C323) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.values.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		
		if (data.values.C324) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.values.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C325) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.values.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C328) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.values.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
										   								   
										   
        }
		
		
		
		
		if (data.values.C330) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.values.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		
		if (data.values.C332) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.values.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C333) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.values.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C334) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.values.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C335) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.values.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		if (data.values.C336) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.values.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C401) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.values.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C402) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.values.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		
		
		if (data.values.C408) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.values.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C600) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.values.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C930) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.values.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
										   								   
										   
        }
		
		
		 if (data.values.C940) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.values.C940
										   + data.model.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C950) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.values.C950 + data.model.C960 + data.model.C999);
        }
		if (data.values.C960) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.values.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.values.C960 + data.model.C999);
        }
		
		
		if (data.values.C999) {
           var test = data.model.set("TOTAL", data.model.C101 + data.model.C204 + data.model.C209 + data.model.C210
			                               + data.model.C301 + data.model.C303 + data.model.C304 + data.model.C305 + data.model.C309
										   + data.model.C310 + data.model.C311 + data.model.C312 + data.model.C313
										   + data.model.C315 + data.model.C316 + data.model.C317 + data.model.C318
										   + data.model.C319 + data.model.C320 + data.model.C321 + data.model.C322
										   + data.model.C323 + data.model.C324 + data.model.C325 + data.model.C328
										   + data.model.C330 + data.model.C332 + data.model.C333 + data.model.C334
										   + data.model.C335 + data.model.C336 + data.model.C401 + data.model.C402
										   + data.model.C408 + data.model.C600 + data.model.C930 + data.model.C940
										   + data.model.C950 + data.model.C960 + data.values.C999);
        }
		
		
       /* else {
            var test = data.model.set("TOTAL", data.model.C101 + data.values.C204 + data.model.C209 + data.model.C210);
        }*/
    }
	
    
});

    </script>
</div>
        </div>
    </div>
    <!-- jQuery-->
    <script src="../Libs/js/jquery-3.3.1.js"></script>
    <!-- Popper.JS -->
    <script src="../Libs/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../Libs/js/bootstrap.min.js"></script>


</body>
</html>
