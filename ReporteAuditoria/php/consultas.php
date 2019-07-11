<?php 

include_once '../../Libs/conexionOracle.php';
class consultas extends ConexionOracle{
 
	private $rolxd = '';
	private $cetxd = 0;

	private $dblinkz = array();



	function __construct(){
		parent::__construct();
	}

	public function obtnerDatosUsuari(){
		session_start();

		$this->rolxd = $_SESSION['rol'];
  		$this->cetxd = $_SESSION['ctx'];
	}




	public function dblink(){
		
		$sql = "SELECT CT_CLAVE, DB_NAME FROM C_DBLINKS";
		
		$stmt = oci_parse($this->con2, $sql);

		oci_execute($stmt);
		
		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
			$this->dblinkz[$i]= array('cve' => $row['CT_CLAVE'],'nom' => $row['DB_NAME'] );/**/
		}
		
		//echo json_encode($this->dblinkz);
		//$this->auxiliar();
	}


	public function auxiliar(){

		$tamdb = sizeof($this->dblinkz);

		for($i=0; $i<$tamdb; $i++){
			$this->VerificaConexion($this->dblinkz[$i]['nom']);
		}
	}


	function obtendatoveri(){
		$dato = array();
		$dato[0]= $this->verificaConexion('ACT_GMX.WORLD');
		$dato[1]= $this->verificaConexion('ACT_GMS.WORLD');
		
		echo json_encode($dato);
	}

	public function verificaConexion($dblinki){
		$vaco = 0;
		$sql = "SELECT 1 AS coneA FROM DUAL@".$dblinki;
		//echo"$sql";
    	$stmt = oci_parse($this->con2, $sql);

    	if(!oci_execute($stmt)){
    		throw new Exception('División por cero.');
    	}	

    	try{
    		
    		if(oci_fetch_array($stmt, OCI_BOTH)){
    	 	return "Verdadero";
    	 	} 
		}
		catch(Exception $e){
			return "falso";
		}
	}

	public function conexionACt($user,$pass,$host,$daba){
			$this->conO = oci_connect($user, $pass, "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = 1521)) (CONNECT_DATA =  (SID = $daba)))");
            if(!$this->conO){
                $error = oci_error();
                trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
               echo 'u.u';
            }else{
               echo "conexion exitosa de php a oracle <br>";
            }
	}

}//end class


	//$opc ='dblink';// $_POST['opcion'];
	$ob = new consultas(); 
//	$ob->obtnerDatosUsuari();
//$ob->obtendatoveri();
$ob->conexionACt('L09003306', 'ACUARIO', '172.30.10.98', 'actdf');
//$ob->inverso(0);
//	switch ($opc) {
//
//		case 'dblink':
//			$ob->dblink();
//		break;
//
//		default:
//			echo "error no se encuentra la opcion";
//		break;
//	}

 ?>
