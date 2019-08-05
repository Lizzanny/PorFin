<?php 

include_once '../../Libs/conexionOracle.php';
class UserFunctions extends ConexionOracle{
	private $cve_user=11101010; 

	private $co = '';
	
	function __construct(){
		parent::__construct();
	}

	public function obtnerDatosUsuari(){
		session_start();
		$this->cve_user = $_SESSION['username']; 
	}

	public function checarConexion($cve){
		$sql = "SELECT CT_CLAVE, DB_NAME, DB_INSTANCE, USUARIO, CLAVE, IP, SID FROM C_DBLINKS WHERE CT_CLAVE = '$cve'";
		$stmt = oci_parse($this->con2, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt, OCI_BOTH);
		$host = $row["IP"];
		$daba = $row["SID"];
		$user = $row["USUARIO"];
		$pass = $row["CLAVE"];

		$this->ProbarConexionBaseRemota($host,$daba,$user,$pass);
	}

	private function ProbarConexionBaseRemota($host,$daba,$user,$pass){
        $checar=0; 
        try{    
            $base= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
            $checar=1;
            $this->guardaTemp($host,$daba,$user,$pass);
        }catch(PDOException $e){
            		//echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
            $checar=0;
        }
        echo $checar; 
    }

    private function guardaTemp($host,$daba,$user,$pass){
    	$co = oci_connect($user, $pass, "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$host." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$daba.")))");

    	echo $co;

    	$sql = "INSERT INTO ACTFIJ.INFOAUDITORIA SELECT 
        CUENTAS.CCDES CUENTA,
        CEDULAS.CONTCT CENTRO_TRABAJO,
        CEDULAS.CONTNUM CEDULA,
        NVL(GetNumActivoxCed(CEDULAS.CONTCT,CEDULAS.CONTNUM),'----') AS NUMACTIVO,
        CEDULAS.CONTCC,
        CEDULAS.CONTSC,
        CEDULAS.CONTSSC,
        CEDULAS.CONTSSSC,
        NVL(CEDULAS.CONTDES, '----') AS CONTDES,
        CEDULAS.CONTFECHADQ,
        CEDULAS.CONTFACTURA,
        CEDULAS.CONTCOSTO,
        NVL(CEDULAS.CONTORIGBIEN, '----') AS CONTORIGBIEN,
        NVL(CEDULAS.CONTASADEP, '0') AS CONTASADEP,
        CEDULAS.CONTFECHCAP,
        CEDULAS.CONTFECHDEP,
        NVL(CEDULAS.CONTPOLIZA, '----') AS CONTPOLIZA,
        NVL(CEDULAS.CONTREFALTAS, '----') AS CONTREFALTAS,
        NVL(CEDULAS.CONTREFBAJAS, '----') AS CONTREFBAJAS,
        NVL(CEDULAS.CONTABONO, '0') AS CONTABONO,
        CEDULAS.CONTFECHMOV,
        CEDULAS.CONTDEPMEN,
        CEDULAS.CONTDEPANUAL,
        CEDULAS.CONTDEPACUM,
        CEDULAS.CONTSALXDEP,
        CEDULAS.CONTBAJADEP,
        CEDULAS.CONTMESDEP,
        CEDULAS.CONTFECHDETDEP,
        CEDULAS.CONTFECHBAJA
        FROM CEDULAS,CUENTAS
        WHERE CEDULAS.CONTCC=CUENTAS.CCNUM AND CEDULAS.CONTFECHMOV <= TO_DATE('31122018','DDMMYYYY')
        ORDER BY 2,3";

        $stmt = oci_parse($co, $sql);
        oci_execute($stmt);
    }


}//end class


	$opc = $_POST['opcion'];
	$ob = new UserFunctions(); 
	//$ob->obtnerDatosUsuari();
	switch ($opc) {
		//---------------------------operaciones para grupos
		case 'checarConexion':
			$ob->checarConexion($_POST['clave']);
		break;

		case 'guardaTemp':
			$ob->guardaTemp($_POST['clave']);
		break;


		default:
			echo "error no se encuentra la opcion";
			break;
	}

 ?>
