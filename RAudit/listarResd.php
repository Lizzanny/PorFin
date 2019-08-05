<?php 
	/**
	 * 
	 */
	include_once '../Libs/conexionOracle.php';//Incluimos la conexion
	class Listar extends ConexionOracle{

		//atributos 
		protected $cnx= array(); //informacion de conexion
    	function __construct(){
       		parent::__construct();
       		$this->getMetodoAcceso();
  		}

		//constructor
		//
		private function getDatosConexionesRemotas(){
        	$sql= "SELECT * FROM C_DBLINKS";
        	$stmt = oci_parse($this->con2, $sql);
        	oci_execute($stmt);
       /*  */
    
    		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
            
            	//llamar al metodo comprobar conexion de las base de datos remotos
            	$host= trim($row["IP"]);
            	$base= trim($row["SID"]);
            	$user= trim($row["USUARIO"]);
            	$pass= trim($row["CLAVE"]);
            	$nomb= trim($row["DB_INSTANCE"]);
            	$dblink= trim($row["DB_NAME"]);
            	
            	   
            	$conex=1;
            	if($nomb=="Chihuahua"){
            		$conex=0;//$this->ProbarConexionBaseRemota($host,$base,$user,$pass);
            	}

                $this->cnx[$i]= $valor =  array('clve' => $row['CT_CLAVE'],
                                                 'nomb' => $row['DB_INSTANCE'],
                                                 'host' => $row['IP'],
                                                 'base' => $row['SID'],
                                                 'user' => $row['USUARIO'],
                                                 'pass' => $row['CLAVE'],
                                                 'cone' => $conex
                                                );  
        	}
        //$this->loteprimer(); 
        //echo json_encode($this->cnx);
    }

    //metodo privado para testing de las bases de datos remotas 
    private function ProbarConexionBaseRemota($host,$daba,$user,$pass){
        $checar=0; 
        try{    
            $base= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
            $checar=1;
        }catch(PDOException $e){
             //echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
             $checar=0;
        }
        return $checar; 
    }
		
		
	private function getconexionremota(){
		$array["data"] = [];
        $inf=array();  $ct0 = array(); $ct1 = array(); $ct2 = array(); $ct3 = array(); $ct4 = array(); $ct5 = array(); $ct6 = array(); $ct7 = array(); $ct8 = array(); $ct9 = array(); $ct10 = array(); $ct11 = array(); $ct12 = array(); $ct13 = array(); $ct14 = array(); $ct15 = array(); $ct16 = array(); $ct17 = array(); $ct18 = array(); $ct19 = array(); $ct20 = array(); $ct21 = array(); $ct22 = array(); $ct23 = array(); $ct24 = array(); $ct25 = array(); $ct26 = array(); $ct27 = array(); $ct28 = array(); $ct29 = array(); $ct30 = array(); $ct31 = array(); $ct32 = array(); $ct33 = array(); $ct34 = array(); 
        $tamanioarreglo= sizeof($this->cnx);
        for($i=0; $i<$tamanioarreglo; $i++){
       //$i=13;
            if($this->cnx[$i]['cone']!=0){
                $co = oci_connect($this->cnx[$i]['user'], $this->cnx[$i]['pass'], "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->cnx[$i]['host']." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$this->cnx[$i]['base'].")))");
                if(!$co){
                    $error = oci_error();
                    trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
                }else{
                    if($i==0){
                        $ct0=$this->getInformacionCedulas($co); 
                    }
                    if($i==1){
                        $ct1=$this->getInformacionCedulas($co); 
                    }
                    if($i==2){
                        $ct2=$this->getInformacionCedulas($co); 
                    }
                    if($i==3){
                        $ct3=$this->getInformacionCedulas($co); 
                    }
                    if($i==4){
                        $ct4=$this->getInformacionCedulas($co); 
                    }
                    if($i==5){
                        $ct5=$this->getInformacionCedulas($co); 
                    }
                    if($i==6){
                        $ct6=$this->getInformacionCedulas($co); 
                    }
                    if($i==7){
                        $ct7=$this->getInformacionCedulas($co); 
                    }
                    if($i==8){
                        $ct8=$this->getInformacionCedulas($co); 
                    }
                    if($i==9){
                        $ct9=$this->getInformacionCedulas($co); 
                    }
                    if($i==10){
                        $ct10=$this->getInformacionCedulas($co); 
                    }
                    if($i==11){
                        $ct11=$this->getInformacionCedulas($co); 
                    }
                    if($i==12){
                        $ct12=$this->getInformacionCedulas($co); 
                    }
                    if($i==13){
                        $ct12=$this->getInformacionCedulas($co); 
                    }
                    if($i==14){
                        $ct14=$this->getInformacionCedulas($co); 
                    }
                    if($i==15){
                        $ct15=$this->getInformacionCedulas($co); 
                    }
                    if($i==16){
                        $ct16=$this->getInformacionCedulas($co); 
                    }
                    if($i==17){
                        $ct17=$this->getInformacionCedulas($co); 
                    }
                    if($i==18){
                        $ct18=$this->getInformacionCedulas($co); 
                    }
                    if($i==19){
                        $ct19=$this->getInformacionCedulas($co); 
                    }
                    if($i==20){
                        $ct20=$this->getInformacionCedulas($co); 
                    }
                    if($i==21){
                        $ct21=$this->getInformacionCedulas($co); 
                    }
                    if($i==22){
                        $ct22=$this->getInformacionCedulas($co); 
                    }
                    if($i==23){
                        $ct23=$this->getInformacionCedulas($co); 
                    }
                    if($i==24){
                        $ct24=$this->getInformacionCedulas($co); 
                    }
                    if($i==25){
                        $ct25=$this->getInformacionCedulas($co); 
                    }
                    if($i==26){
                        $ct26=$this->getInformacionCedulas($co); 
                    }
                    if($i==27){
                        $ct27=$this->getInformacionCedulas($co); 
                    }
                    if($i==28){
                        $ct28=$this->getInformacionCedulas($co); 
                    }
                    if($i==29){
                        $ct29=$this->getInformacionCedulas($co); 
                    }
                    if($i==30){
                        $ct30=$this->getInformacionCedulas($co); 
                    }
                    if($i==31){
                        $ct31=$this->getInformacionCedulas($co); 
                    }
                    if($i==32){
                        $ct33=$this->getInformacionCedulas($co); 
                    }
                    if($i==33){
                        $ct33=$this->getInformacionCedulas($co); 
                    }
                    if($i==34){
                        $ct34=$this->getInformacionCedulas($co); 
                    }
                }
            }
           
        }
         //$inf[$i]
         $array["data"][]=array(
                    'ct0' => $ct0,
                    'ct1' => $ct1,
                    'ct2' => $ct2,
                    'ct3' => $ct3,
                    'ct4' => $ct4,
                    'ct5' => $ct5,
                    'ct6' => $ct6,
                    'ct7' => $ct7,
                    'ct8' => $ct8,
                    'ct9' => $ct9,
                    'ct10' => $ct10,
                    'ct11' => $ct11,
                    'ct12' => $ct12,
                    'ct13' => $ct13,
                    'ct14' => $ct14,
                    'ct15' => $ct15,
                    'ct16' => $ct16,
                    'ct17' => $ct17,
                    'ct18' => $ct18,
                    'ct19' => $ct19,
                    'ct20' => $ct20,
                    'ct21' => $ct21,
                    'ct22' => $ct22,
                    'ct23' => $ct23,
                    'ct24' => $ct24,
                    'ct25' => $ct25,
                    'ct26' => $ct26,
                    'ct27' => $ct27,
                    'ct28' => $ct28,
                    'ct29' => $ct29,
                    'ct30' => $ct30,
                    'ct31' => $ct31,
                    'ct32' => $ct32,
                    'ct33' => $ct33,
                    'ct34' => $ct34   
                ); 
     //  echo json_encode($inf);
      //var_dump($inf);
      //$this->hojaExecel($inf);
      echo json_encode($array); 
       
    }


    private function getInformacionCedulas($co){
        $inf=array();  
         
        $sql="SELECT 
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
        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
            if(!isset($row["CONTFECHADQ"])){
                $FECHADQ=null;
            }else{
                $FECHADQ=$row["CONTFECHADQ"];
            }
            if(!isset($row["CONTFECHDETDEP"])){
                $HDETDEP=null;
            }else{
                $HDETDEP=$row["CONTFECHDETDEP"];
            }
            if(!isset($row['CONTFECHBAJA'])){
                $FECHBAJ=null;
            }else{
                $FECHBAJ=$row['CONTFECHBAJA'];
            }
            $inf[$i]= $fila = array('ccuenta' =>$row['CUENTA'],
                                    'ccentro' =>$row['CENTRO_TRABAJO'],
                                    'ccedula' =>$row['CEDULA'],
                                    'numacti'=>$row['NUMACTIVO'],
                                    'cccosto' =>$row['CONTCC'],
                                    'ccontsc' =>$row['CONTSC'],
                                    'contssc'=>$row['CONTSSC'],
                                    'cntsssc'=>$row['CONTSSSC'],
                                    'contdes'=>$row['CONTDES'],
                                    'FECHADQ'=>$FECHADQ,
                                    'factuer'=>$row['CONTFACTURA'],
                                    'cncosto'=>$row['CONTCOSTO'],
                                    'rigbien'=>$row['CONTORIGBIEN'],
                                    'TASADEP'=>$row['CONTASADEP'],
                                    'FECHCAP'=>$row['CONTFECHCAP'],
                                    'FECHDEP'=>$row['CONTFECHDEP'],
                                    'TPOLIZA'=>$row['CONTPOLIZA'],
                                    'REFALTA'=>$row['CONTREFALTAS'],
                                    'REFBAJA'=>$row['CONTREFBAJAS'],
                                    'NTABONO'=>$row['CONTABONO'],
                                    'FECHMOV'=>$row['CONTFECHMOV'],
                                    'TDEPMEN'=>$row['CONTDEPMEN'],
                                    'DEPANUA'=>$row['CONTDEPANUAL'],
                                    'DEPACUM'=>$row['CONTDEPACUM'],
                                    'SALXDEP'=>$row['CONTSALXDEP'],
                                    'BAJADEP'=>$row['CONTBAJADEP'],
                                    'TMESDEP'=>$row['CONTMESDEP'],
                                    'HDETDEP'=>$HDETDEP,
                                    'FECHBAJ'=>$FECHBAJ
                                );
                               /**/
        }
        oci_free_statement($stmt);
        oci_close($co);
        
        //echo json_encode($inf);
        return $inf; 
        //$this->hojaExecel($inf); 
    }
    public function getMetodoAcceso(){
    	$this->getDatosConexionesRemotas(); 
        $this->getconexionremota(); 
        //$this->imprimirjsoninformacion(); 
    }
				

	}//endmyclass

	$obj = new Listar();//instancia de la clase para crear un obj

//llamar un metodo de la la clase 
	//$ob->getMetodoAcceso(); 
	//$obj->generaLista();
	$obj->cerrarConexion(); 

 ?>

