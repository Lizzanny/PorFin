<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">

    <!-- Data CSS -->
    <link rel="stylesheet" href="../Libs/DataTables/dtable/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Libs/DataTables/datatables.min.css">

    <!--dataTables-->
    <link rel="stylesheet" href="../Libs/css/tablestyle.css">

    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />


	<!-- Font Awesome JS -->
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="https://kit.fontawesome.com/b9fc8f6309.js"></script>

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
								<th>CUENTA</th>
								<th>CENTRO_TRABAJO</th>
								<th>CEDULA</th>
								<th>NUMACTIVO</th>
								<th>CONTCC</th>
								<th>CONTSC</th>
								<th>CONTSSC</th>
								<th>CONTSSSC</th>
								<th>CONTDES</th>
								<th>CONTFECHADQ</th>
								<th>CONTFACTURA</th>
								<th>CONTCOSTO</th>
								<th>CONTORIGBIEN</th>
								<th>CONTASADEP</th>
								<th>CONTFECHCAP</th>
								<th>CONTFECHDEP</th>
								<th>CONTPOLIZA</th>
								<th>CONTREFALTAS</th>
								<th>CONTREFBAJAS</th>
								<th>CONTABONO</th>
								<th>CONTFECHMOV</th>
								<th>CONTDEPMEN</th>
								<th>CONTDEPANUAL</th>
								<th>CONTDEPACUM</th>
								<th>CONTSALXDEP</th>
								<th>CONTBAJADEP</th>
								<th>CONTMESDEP</th>
								<th>CONTFECHDETDEP</th>
								<th>CONTFECHBAJA</th>
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
						"text":'<i class="fas fa-file-csv"></i>',
						"titleAttr": "CSV",
						"className": "btn btn-primary",

					},{
						extend: 'excel', 
						"text": '<i class="far fa-file-excel"></i>',
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

	