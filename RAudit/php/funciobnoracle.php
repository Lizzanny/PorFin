<?php 

include_once '../../Libs/conexionOracle.php';
date_default_timezone_set('America/Mexico_City');
class UserFunctions extends ConexionOracle{
	private $cve_user=11101010; 

	private $co = '';
private $CUENTA = array();
private $CENTRO_TRABAJO = array();
private $CEDULA = array();
private $NUMACTIVO = array();
private $CONTCC = array();
private $CONTSC = array();
private $CONTSSC = array();
private $CONTSSSC = array();
private $CONTDES = array();
private $CONTFECHADQ = array();
private $CONTFACTURA = array();
private $CONTCOSTO = array();
private $CONTORIGBIEN = array();
private $CONTASADEP = array();
private $CONTFECHCAP = array();
private $CONTFECHDEP = array();
private $CONTPOLIZA = array();
private $CONTREFALTAS = array();
private $CONTREFBAJAS = array();
private $CONTABONO = array();
private $CONTFECHMOV = array();
private $CONTDEPMEN = array();
private $CONTDEPANUAL = array();
private $CONTDEPACUM = array();
private $CONTSALXDEP = array();
private $CONTBAJADEP = array();
private $CONTMESDEP = array();
private $CONTFECHDETDEP = array();
private $CONTFECHBAJA = array();

	public $cuentaReg = 0;
	
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
            $base= new PDO("oci:dbname=$host/$daba;charset=utf8", $user, $pass);
            $checar = $this->guardaTemp($host,$daba,$user,$pass);
            $base = null;
        }catch(PDOException $e){
            		//echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
            $checar=0;
        }
      //  echo $checar; 
    }

    private function guardaTemp($host,$daba,$user,$pass){
    	
    	$co = oci_connect($user, $pass, "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$host." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$daba.")))");

    	$sql = "SELECT  
        CUENTAS.CCDES CUENTA,
        CEDULAS.CONTCT CENTRO_TRABAJO,
        CEDULAS.CONTNUM CEDULA,
        NVL(GetNumActivoxCed(CEDULAS.CONTCT,CEDULAS.CONTNUM),'----') AS NUMACTIVO,
        CEDULAS.CONTCC,
        CEDULAS.CONTSC,
        CEDULAS.CONTSSC,
        CEDULAS.CONTSSSC,
        NVL(CEDULAS.CONTDES, '----') AS CONTDES,
        NVL(CEDULAS.CONTFECHADQ,TO_DATE('01121900','DD-MM-RR')) AS CONTFECHADQ,
        CEDULAS.CONTFACTURA,
        CEDULAS.CONTCOSTO,
        NVL(CEDULAS.CONTORIGBIEN, '----') AS CONTORIGBIEN,
        NVL(CEDULAS.CONTASADEP, '0') AS CONTASADEP,
        TO_DATE(CEDULAS.CONTFECHCAP,'DD-MM-RR')AS CONTFECHCAP,
        TO_DATE(CEDULAS.CONTFECHDEP,'DD-MM-RR') AS CONTFECHDEP,
        NVL(CEDULAS.CONTPOLIZA, '----') AS CONTPOLIZA,
        NVL(CEDULAS.CONTREFALTAS, '----') AS CONTREFALTAS,
        NVL(CEDULAS.CONTREFBAJAS, '----') AS CONTREFBAJAS,
        NVL(CEDULAS.CONTABONO, '0') AS CONTABONO,
        TO_DATE(CEDULAS.CONTFECHMOV,'DD-MM-RR') AS CONTFECHMOV,
        CEDULAS.CONTDEPMEN,
        CEDULAS.CONTDEPANUAL,
        CEDULAS.CONTDEPACUM,
        CEDULAS.CONTSALXDEP,
        CEDULAS.CONTBAJADEP,
        CEDULAS.CONTMESDEP,
        NVL(CEDULAS.CONTFECHDETDEP, TO_DATE('01121900','DD-MM-RR')) AS CONTFECHDETDEP,
        NVL(CEDULAS.CONTFECHBAJA, TO_DATE('01121900','DD-MM-RR')) AS CONTFECHBAJA
        FROM CEDULAS,CUENTAS
        WHERE CEDULAS.CONTCC=CUENTAS.CCNUM AND CEDULAS.CONTFECHMOV <= TO_DATE('31122018','DD-MM-RR')
        ORDER BY 2,3";

        $stmt = oci_parse($co, $sql);
        oci_execute($stmt);
        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){ 

        	$arregloxd[$i] = "( '". $row['CUENTA']."',
        					     ".(INT)$row['CENTRO_TRABAJO'].",
        					     ".(INT)$row['CEDULA'].",
        					    '".$row['NUMACTIVO']."',
        					     ".(INT)$row['CONTCC'].",
        					     ".(INT)$row['CONTSC'].",
        					     ".(INT)$row['CONTSSC'].",
        					     ".(INT)$row['CONTSSSC'].",
        					    '".$row['CONTDES']."',
        					    '".$row['CONTFECHADQ']."', 
        					    '".$row['CONTFACTURA']."', 
        					     ".(INT)$row['CONTCOSTO'].",
        					    '".$row['CONTORIGBIEN']."',
        					     ".(INT)$row['CONTASADEP'].",
        					    '".$row['CONTFECHCAP']."', 
        					    '".$row['CONTFECHDEP']."', 
        					    '".$row['CONTPOLIZA']."', 
        					    '".$row['CONTREFALTAS']."', 
        					    '".$row['CONTREFBAJAS']."', 
        					     ".(INT)$row['CONTABONO'].",
        					    '".$row['CONTFECHMOV']."', 
        					     ".(INT)$row['CONTDEPMEN'].",
        					     ".(INT)$row['CONTDEPANUAL'].",
        					     ".(INT)$row['CONTDEPACUM'].", 
        					     ".(INT)$row['CONTSALXDEP'].", 
        					     ".(INT)$row['CONTBAJADEP'].", 
        					     ".(INT)$row['CONTMESDEP'].", 
        					    '".$row['CONTFECHDETDEP']."', 
        					    '".$row['CONTFECHBAJA']."')";
        	
			
        }
        oci_free_statement($stmt);
        $this->cuentaReg = sizeof($arregloxd);

        $this->insertaRows($arregloxd);
   
       	 
       	//
       	
    }

    private function insertaRows($arregloxd){


    	for($i=0; $i<$this->cuentaReg; $i++){
   
    		$sql2 = "INSERT INTO INFOAUDITORIA (CUENTA, CENTRO_TRABAJO, CEDULA, ACTIVO, CONTCC, CONTSC, CONTSSC, CONTSSSC, CONTDES, CONTFECHADQ, CONTFACTURA, CONTCOSTO, CONTORIGBIEN, CONTASADEP, CONTFECHCAP, CONTFECHDEP, CONTPOLIZA, CONTREFALTAS, CONTREFBAJAS, CONTABONO, CONTFECHMOV, CONTDEPMEN, CONTDEPANUAL, CONTDEPACUM, CONTSALXDEP, CONTBAJADEP, CONTMESDEP, CONTFECHDETDEP, CONTFECHBAJA ) VALUES $arregloxd[$i]";                          

    		$stmt2 = oci_parse($this->con2, $sql2);
			oci_execute($stmt2);

			//echo $sql2."<br><br><br><br>";
    	}
    	
    		return 1;
    	
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


		default:
			echo "error no se encuentra la opcion";
			break;
	}

 ?>
