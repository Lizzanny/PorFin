<?php 

include_once '../../Libs/conexionOracle.php';
class operaciones extends ConexionOracle{
 
	private $rolxd = '';
	private $cetxd = 0;
	function __construct(){
		parent::__construct();
	}

	public function obtnerDatosUsuari(){
		session_start();

		$this->rolxd = $_SESSION['rol'];
  		$this->cetxd = $_SESSION['ctx'];
	}

	public function verifica(){
	$strusu='';
		if($this->rolxd != 'RFINADM'){
			if($this->rolxd=="RFINPRESUP" ||$this->rolxd=="RFINCONTABLE" ){
				$strusu="rol 1, ".$this->cetxd;
				$this->obtenerCtgxv($this->cetxd, 'no');
			}
		}else{
			$strusu="rol admin";
			$this->obtenerCtgxv($this->cetxd, 'si');
		}
		//echo "$strusu";
	}



	public function obtenerCtgxv($centro, $listar){
		$sql = '';
		if($listar == 'no'){
			$sql = "SELECT CTCENTRAB, CTDESCRIP FROM ACTFIJ.CENTROS_DE_TRABAJO WHERE CTCENTRAB = '$centro'";
		}else{
		
			$sql = "SELECT CTCENTRAB, CTDESCRIP FROM ACTFIJ.CENTROS_DE_TRABAJO";
		}
		//echo $sql;
		$stmt = oci_parse($this->con2, $sql);

		oci_execute($stmt);
		$lista='';
	
			$lista.='<option value="" selected="selected">SELECCIONE EL CENTRO DE TRABAJO</option>';
		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
			if($listar == 'no'){
				if($row[0]==$centro){
				$lista.="<option selected='selected' value='$row[0]'> $row[1] </option>";
				}
			}else{
				$lista.="<option value='$row[0]'> $row[1] </option>";
			}
			
		}

		
		echo $lista;

		
	}




}//end class


	$opc = $_POST['opcion'];
	$ob = new operaciones(); 
	$ob->obtnerDatosUsuari();
	switch ($opc) {

		case 'obtenerCtg':
			$ob->verifica();
		break;

		default:
			echo "error no se encuentra la opcion";
		break;
	}

 ?>
