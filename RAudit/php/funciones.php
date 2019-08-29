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

	public function checarConexion($cve, $fec){
		$sql = "SELECT CT_CLAVE, DB_NAME, DB_INSTANCE, USUARIO, CLAVE, IP, SID FROM C_DBLINKS WHERE CT_CLAVE = '$cve'";
		$stmt = oci_parse($this->con2, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt, OCI_BOTH);
		$host = $row["IP"];
		$daba = $row["SID"];
		$user = $row["USUARIO"];
		$pass = $row["CLAVE"];

		$this->ProbarConexionBaseRemota($host,$daba,$user,$pass, $fec);
	}

	private function ProbarConexionBaseRemota($host,$daba,$user,$pass, $fec){
        $checar=0; 
        try{    
            $base= new PDO("oci:dbname=$host/$daba;charset=utf8", $user, $pass);
            $checar = $this->guardaTemp($host,$daba,$user,$pass,$fec);
            $base = null;
            //$checar=1;
        }catch(PDOException $e){
            		//echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
            $checar=0;
        }
        echo $checar; 
    }

    private function guardaTemp($host,$daba,$user,$pass,$fec){
    	$conn= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
    	//$co = oci_connect($user, $pass, "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$host." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$daba.")))");

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
        TO_CHAR(CEDULAS.CONTFECHADQ, 'DD/MM/YYYY') AS CONTFECHADQ,
        CEDULAS.CONTFACTURA,
        CEDULAS.CONTCOSTO,
        NVL(CEDULAS.CONTORIGBIEN, '----') AS CONTORIGBIEN,
        NVL(CEDULAS.CONTASADEP, '0') AS CONTASADEP,
        TO_CHAR(CEDULAS.CONTFECHCAP, 'DD/MM/YYYY') AS CONTFECHCAP,
        TO_CHAR(CEDULAS.CONTFECHDEP, 'DD/MM/YYYY') AS CONTFECHDEP,
        NVL(CEDULAS.CONTPOLIZA, '----') AS CONTPOLIZA,
        NVL(CEDULAS.CONTREFALTAS, '----') AS CONTREFALTAS,
        NVL(CEDULAS.CONTREFBAJAS, '----') AS CONTREFBAJAS,
        NVL(CEDULAS.CONTABONO, '0') AS CONTABONO,
        TO_CHAR(CEDULAS.CONTFECHMOV,'DD/MM/YYYY') AS CONTFECHMOV,
        CEDULAS.CONTDEPMEN,
        CEDULAS.CONTDEPANUAL,
        CEDULAS.CONTDEPACUM,
        CEDULAS.CONTSALXDEP,
        CEDULAS.CONTBAJADEP,
        CEDULAS.CONTMESDEP,
        TO_CHAR(CEDULAS.CONTFECHDETDEP, 'DD/MM/YYYY') AS CONTFECHDETDEP,
        TO_CHAR(CEDULAS.CONTFECHBAJA, 'DD/MM/YYYY') AS CONTFECHBAJA
        FROM CEDULAS,CUENTAS
        WHERE CEDULAS.CONTCC=CUENTAS.CCNUM AND CEDULAS.CONTFECHMOV <= TO_DATE('$fec','DD/MM/YYYY')
        ORDER BY 2,3";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        for ($i=0; $row = $stmt->fetch(PDO::FETCH_OBJ); $i++) {

        //$stmt = oci_parse($co, $sql);
        //oci_execute($stmt);
        //for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){ 

        	$arregloxd[$i] = "( '".substr(str_replace(array('\'', '"'), '' , $row->CUENTA), 0, 99)."',
        					     ".$row->CENTRO_TRABAJO.", 
        					     ".$row->CEDULA.", 
        					    '".substr(str_replace(array('\'', '"'), '', $row->NUMACTIVO), 0, 3999)."',
        					     ".$row->CONTCC.",
        					     ".$row->CONTSC.",
        					     ".$row->CONTSSC.",
        					     ".$row->CONTSSSC.",
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTDES), 0, 99)."',
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTFECHADQ), 0, 19)."',
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTFACTURA), 0, 11)."',
        					     ".str_replace(',','.',$row->CONTCOSTO).",
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTORIGBIEN), 0, 29)."',
        					     ".str_replace(',','.',$row->CONTASADEP).",
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTFECHCAP), 0, 19)."',
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTFECHDEP), 0, 19)."',
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTPOLIZA), 0, 9)."',
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTREFALTAS), 0, 99)."',
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTREFBAJAS),0,99)."',
        					     ".str_replace(',','.',$row->CONTABONO).",
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTFECHMOV), 0, 19)."',
        					     ".str_replace(',','.',$row->CONTDEPMEN).",
        					     ".str_replace(',','.',$row->CONTDEPANUAL).",
        					     ".str_replace(',','.',$row->CONTDEPACUM).",
        					     ".str_replace(',','.',$row->CONTSALXDEP).",
        					     ".str_replace(',','.',$row->CONTBAJADEP).",
        					     ".$row->CONTMESDEP.",
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTFECHDETDEP), 0, 19)."',
        					    '".substr(str_replace(array('\'', '"'), '', $row->CONTFECHBAJA), 0, 19)."')";
        	

            $sql2 = "INSERT INTO ACTFIJ.INFOAUDITORIA(CUENTA, CENTRO_TRABAJO, CEDULA, ACTIVO, CONTCC, CONTSC, CONTSSC, CONTSSSC, CONTDES, CONTFECHADQ, CONTFACTURA, CONTCOSTO, CONTORIGBIEN, CONTASADEP, CONTFECHCAP, CONTFECHDEP, CONTPOLIZA, CONTREFALTAS, CONTREFBAJAS, CONTABONO, CONTFECHMOV, CONTDEPMEN, CONTDEPANUAL, CONTDEPACUM, CONTSALXDEP, CONTBAJADEP, CONTMESDEP, CONTFECHDETDEP, CONTFECHBAJA) VALUES $arregloxd[$i]"; 
            $stmt2 = oci_parse($this->con2, $sql2);
            $ok=oci_execute($stmt2);
            if($ok!=true){
                echo $sql .'<br>';//adwendn
                 echo $sql2 .'<br>';//adwendn
            }else{
               // echo 'ok';
            }
			
        }
       // oci_free_statement($stmt);
        $stmt = null;//cerrar consulta
        $conn = null;//cerrar  conexion
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

    public function Validate($clave){

        $resp = 0;
        $sqlx = "SELECT count(*) AS CONT FROM ACTFIJ.INFOAUDITORIA WHERE CENTRO_TRABAJO = $clave";
        //echo $sqlx;
        $stmtx = oci_parse($this->con2, $sqlx);
        $ok=oci_execute($stmtx);
        $row = oci_fetch_array($stmtx, OCI_BOTH);
        $nreg = (int)$row['CONT'];

        //echo 'nreg '.$nreg.'<br>';

        if($nreg > 0 ){
            $resp = 2;
        }else{
            $resp = 1;
        }
        echo $resp;
    }


}//end class


	$opc = $_POST['opcion'];
	$ob = new UserFunctions(); 
	//$ob->obtnerDatosUsuari();
	switch ($opc) {
		//---------------------------operaciones para grupos
		case 'checarConexion':
			$ob->checarConexion($_POST['clave'], $_POST['fecha']);
		break;

        case 'VaciarT':
            $ob->VaciarTab();
        break;

        case 'Validate':
            $ob->Validate($_POST['clave']);
        break;

		default:
			echo "error no se encuentra la opcion";
			break;
	}

 ?>
