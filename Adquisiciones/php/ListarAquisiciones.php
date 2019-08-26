<?php 
/**
 * 
 */
class ListarAquisiciones{
	
	function __construct(){
	}


	public function metodoDataTable(){
		include 'ssp.class.php';
		$columnas= array(
			array( 'db' => 'ID', 'dt'=>0),
			array( 'db' => 'CONTCT', 'dt'=>1),
			array( 'db' => 'CONTNUM', 'dt'=>2),
			array( 'db' => 'CONTCC', 'dt'=>3),
			array( 'db' => 'CONTSSC','dt' => 4),
			array( 'db' => 'CONTSSSC','dt' => 5),
			array( 'db' => 'HBNUMERO','dt' => 6),
			array( 'db' => 'CONTDES','dt' => 7),
			array( 'db' => 'CONTMARCA','dt' => 8),
			array( 'db' => 'CONTMODELO','dt' => 9),
			array( 'db' => 'CONTSERIE','dt' => 10),
			array( 'db' => 'CONTFECHCAP','dt' => 11),
			array( 'db' => 'CONTFACTURA','dt' => 12),
			array( 'db' => 'CONTABONO','dt' => 13),
			array( 'db' => 'CONTBAJADEP','dt' => 14),
			array( 'db' => 'TIPOMOV','dt' => 15),
			array( 'db' => 'CTDESCRIP','dt' => 16),
			array( 'db' => 'CCDES','dt' => 17)
		);


		$dbDetalle= array(
			'host' => '',
			'user' => '',
			'pass' => '',
			'db'   => ''
		);

		$table='TAB_ALTASYBAJAS';

		$primaryKey= 'ID';

		echo json_encode(
			SSP::simple($_GET,$dbDetalle,$table,$primaryKey,$columnas)
		);


	}//fin del metodo metodoDataTable


	public function imprimedatos(){
		echo "solslmslsmlsm";
	}
}//myClassEnd

$ob = new ListarAquisiciones();
//$ob->imprimedatos();
$ob->metodoDataTable();

 ?>