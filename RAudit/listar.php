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

        $tamanioarreglo=sizeof($this->cnx);
        for($i=0; $i<$tamanioarreglo; $i++){
       //$i=13;
            echo $this->cnx[$i]['cone']."<br>";
            //if($this->cnx[$i]['cone']!=0){
                $co = oci_connect($this->cnx[$i]['user'], $this->cnx[$i]['pass'], "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->cnx[$i]['host']." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$this->cnx[$i]['base'].")))");

                /*if(!$co){
                    $error = oci_error();
                    trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
                }else{
                    $co;
                    //$this->getInformacionCedulas($co);
                }*/
            //}

            //$this->getInformacionCedulas($co); 
        }
           
       
    }


    private function getInformacionCedulas($co){
        $inf=array();  
         
        $sql = "INSERT INTO INFOAUDITORIA SELECT 
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
        oci_free_statement($stmt);
        oci_close($co);
        
       
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

