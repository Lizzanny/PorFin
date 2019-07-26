<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">

    <!--dataTables-->
    <link rel="stylesheet" href="../Libs/css/tablestyle.css">

</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2 class="text-center text-uppercase">CEDULAS</h2><!--SOCIOS DE CAPITAL-->
			</div>
		</div>

		<div class="row">
			<div class="col col-sm-12 col-md-12 col-lg-12">
				<!--<h3 class="text-center text-uppercase">Socios</h3>-->
				<div class="table-responsive" >
					<table id="tablainformacion" class="table table-bordered table-hover table-danger" cellspacing="0" width="100%">
						<thead class="thead-light">
							<tr>
								<th>ccuenta</th>
								<th>ccentro</th>
								<th>ccedula</th>
								<th>numacti</th>
								<th>cccosto</th>
								<th>ccontsc</th>
								<th>contssc</th>
								<th>cntsssc</th>
								<th>contdes</th>
								<th>FECHADQ</th>
								<th>factuer</th>
								<th>cncosto</th>
								<th>rigbien</th>
								<th>TASADEP</th>
								<th>FECHCAP</th>
								<th>FECHDEP</th>
								<th>TPOLIZA</th>
								<th>REFALTA</th>
								<th>REFBAJA</th>
								<th>NTABONO</th>
								<th>FECHMOV</th>
								<th>TDEPMEN</th>
								<th>DEPANUA</th>
								<th>DEPACUM</th>
								<th>SALXDEP</th>
								<th>BAJADEP</th>
								<th>TMESDEP</th>
								<th>HDETDEP</th>
								<th>FECHBAJ</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div><!--div row-->

	</div><!--div container-->
</body>

<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

<script>
$(document).ready(function() {
	var dataTable=$('#tablainformacion').DataTable({
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:"copiaarchivo.php",
                    type:"post"
                },
                "language": idioma_espanol,
                "dom":
			"<'row'<'offset-sm-12 offset-md-4'B>>" +
			"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			"buttons":[
					{
						extend: 'csv', 
						"text":'<i class="fa fa-file-text-o fa-2x"></i>',
						"titleAttr": "CSV",
						"className": "btn btn-primary",

					},{
						extend: 'excel', 
						"text": '<i class="fa fa-file-excel-o aria-hidden=true fa-2x"></i>',
						"titleAttr": "Excel",
						"className": "btn btn-success",

					}
			]
    });
});
		var idioma_espanol = {
			"decimal":        "",
			"emptyTable":     "No hay información para mostrar",
			"info":           "Mostrando de _START_ a _END_ registros",
			"infoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ registros",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontró información para mostrar",
			"paginate": {
			    "first":      "Primero",
			    "last":       "Ultimo",
			    "next":       "Siguiente",
			    "previous":   "Anterior"
			},
			"aria": {
			    "sortAscending":  ": activate to sort column ascending",
			    "sortDescending": ": activate to sort column descending"
			}
		}
	</script>

	

	<script src="../Libs/DataTables/pdfmake/pdfmake.min.js"></script>
    <script src="../Libs/DataTables/pdfmake/vfs_fonts.js"></script>
    <script src="../Libs/DataTables/JSZip/jszip.min.js"></script>
    <script src="../Libs/DataTables/datatables.min.js"></script>

    <script src="../Libs/js/bootstrap.min.js"></script>
</html>

	