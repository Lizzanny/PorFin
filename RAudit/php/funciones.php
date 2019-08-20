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
            //$checar=1;
        }catch(PDOException $e){
            		//echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
            $checar=0;
        }
        echo $checar; 
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
        TO_CHAR(NVL(CEDULAS.CONTFECHADQ,TO_DATE('01121900','DD-MM-RR'))) AS CONTFECHADQ,
        CEDULAS.CONTFACTURA,
        CEDULAS.CONTCOSTO,
        NVL(CEDULAS.CONTORIGBIEN, '----') AS CONTORIGBIEN,
        NVL(CEDULAS.CONTASADEP, '0') AS CONTASADEP,
        TO_CHAR(TO_DATE(CEDULAS.CONTFECHCAP,'DD-MM-RR'))AS CONTFECHCAP,
        TO_CHAR(TO_DATE(CEDULAS.CONTFECHDEP,'DD-MM-RR')) AS CONTFECHDEP,
        NVL(CEDULAS.CONTPOLIZA, '----') AS CONTPOLIZA,
        NVL(CEDULAS.CONTREFALTAS, '----') AS CONTREFALTAS,
        NVL(CEDULAS.CONTREFBAJAS, '----') AS CONTREFBAJAS,
        NVL(CEDULAS.CONTABONO, '0') AS CONTABONO,
        TO_CHAR(TO_DATE(CEDULAS.CONTFECHMOV,'DD-MM-RR')) AS CONTFECHMOV,
        CEDULAS.CONTDEPMEN,
        CEDULAS.CONTDEPANUAL,
        CEDULAS.CONTDEPACUM,
        CEDULAS.CONTSALXDEP,
        CEDULAS.CONTBAJADEP,
        CEDULAS.CONTMESDEP,
        TO_CHAR(NVL(CEDULAS.CONTFECHDETDEP, TO_DATE('01121900','DD-MM-RR'))) AS CONTFECHDETDEP,
        TO_CHAR(NVL(CEDULAS.CONTFECHBAJA, TO_DATE('01121900','DD-MM-RR'))) AS CONTFECHBAJA
        FROM CEDULAS,CUENTAS
        WHERE CEDULAS.CONTCC=CUENTAS.CCNUM AND CEDULAS.CONTFECHMOV <= TO_DATE('31122018','DD-MM-RR')
        ORDER BY 2,3";

        $stmt = oci_parse($co, $sql);
        oci_execute($stmt);
        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){ 

        	$arregloxd[$i] = "( '".str_replace("'",'"',$row['CUENTA'])."',
        					     ".$row['CENTRO_TRABAJO'].",
        					     ".$row['CEDULA'].",
        					    '".str_replace("'",'"',$row['NUMACTIVO'])."',
        					     ".$row['CONTCC'].",
        					     ".$row['CONTSC'].",
        					     ".$row['CONTSSC'].",
        					     ".$row['CONTSSSC'].",
        					    '".str_replace("'",'"',$row['CONTDES'])."',
        					    '".str_replace("'",'"',$row['CONTFECHADQ'])."', 
        					    '".str_replace("'",'"',$row['CONTFACTURA'])."', 
        					     ".$row['CONTCOSTO'].",
        					    '".str_replace("'",'"',$row['CONTORIGBIEN'])."',
        					     ".$row['CONTASADEP'].",
        					    '".str_replace("'",'"',$row['CONTFECHCAP'])."', 
        					    '".str_replace("'",'"',$row['CONTFECHDEP'])."', 
        					    '".str_replace("'",'"',$row['CONTPOLIZA'])."', 
        					    '".str_replace("'",'"',$row['CONTREFALTAS'])."', 
        					    '".str_replace("'",'"',$row['CONTREFBAJAS'])."', 
        					     ".$row['CONTABONO'].",
        					    '".str_replace("'",'"',$row['CONTFECHMOV'])."', 
        					     ".$row['CONTDEPMEN'].",
        					     ".$row['CONTDEPANUAL'].",
        					     ".$row['CONTDEPACUM'].", 
        					     ".$row['CONTSALXDEP'].", 
        					     ".$row['CONTBAJADEP'].", 
        					     ".$row['CONTMESDEP'].", 
        					    '".str_replace("'",'"',$row['CONTFECHDETDEP'])."', 
        					    '".str_replace("'",'"',$row['CONTFECHBAJA'])."')";
        	

            $sql2 = "INSERT INTO ACTFIJ.INFOAUDITORIA(CUENTA, CENTRO_TRABAJO, CEDULA, ACTIVO, CONTCC, CONTSC, CONTSSC, CONTSSSC, CONTDES, CONTFECHADQ, CONTFACTURA, CONTCOSTO, CONTORIGBIEN, CONTASADEP, CONTFECHCAP, CONTFECHDEP, CONTPOLIZA, CONTREFALTAS, CONTREFBAJAS, CONTABONO, CONTFECHMOV, CONTDEPMEN, CONTDEPANUAL, CONTDEPACUM, CONTSALXDEP, CONTBAJADEP, CONTMESDEP, CONTFECHDETDEP, CONTFECHBAJA) VALUES $arregloxd[$i]"; 
            $stmt2 = oci_parse($this->con2, $sql2);
            $ok=oci_execute($stmt2);
			
        }
        oci_free_statement($stmt);
        $this->cuentaReg = sizeof($arregloxd);
        return 1;
        //$this->insertaRows($arregloxd);
   
       	 
       	//
       	
    }

    private function insertaRows($arregloxd){

    //$link = mysqli_connect("127.0.0.1", "root", "");
	//mysqli_select_db($link, "portalfinanciero");
	//$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
	//
    	for($i=0; $i<$this->cuentaReg; $i++){
   
    		


            if($ok){
                //echo "fila exito: $i";
            }
            else{
                echo "</br>fila mala: $i <br> $sql2";
            }
    	//	$result = mysqli_query($link, $sql2);
			//echo $sql2."<br><br><br><br>";
    	}
    	
    		//return 1;
    	
    }

    public function VaciarTab(){
        $sql3 = "DELETE FROM INFOAUDITORIA"; 
        $stmt3 = oci_parse($this->con2, $sql3);
        oci_execute($stmt3);
        $ok = oci_num_rows($stmt3);
        if($ok!=0){
            $msj = '¡Exito! La tabla de integración contable esta vacia..';
            $opc = 1;
        }else{
            $msj = 'Sucedio un error al intentar vaciar la tabla.';
            $opc = 2;
        }
        
        
        $array = array('msj' => $msj,
                        'opc' => $opc );


      echo json_encode($array);
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

        case 'VaciarT':
            $ob->VaciarTab();
        break;

		default:
			echo "error no se encuentra la opcion";
			break;
	}

 ?>
