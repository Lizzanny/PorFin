<?php 
	/**
	 * 
	 */
	include_once '../Libs/conexionOracle.php';//Incluimos la conexion
	class ListarDispo extends ConexionOracle{

		function __construct(){
        	parent::__construct();
        	$this->getMetodoAcceso();
    	}
		
		//metodos
		public function generaLista(){
			$array["data"] = [];
			$msj = 'No se encuentra información.';
			$opc = 2;
			$bot = [];
			$estado_color = array(
       			'0' => '../Libs/image/rojo.png',
       			'1' => '../Libs/image/verde.png');

			$sql = "SELECT CT_CLAVE, DB_NAME, DB_INSTANCE, USUARIO, CLAVE, IP, SID FROM C_DBLINKS";
	
			$stmt = oci_parse($this->con2, $sql);

			oci_execute($stmt);
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
                   $conex=$this->ProbarConexionBaseRemota($host,$base,$user,$pass);
                }

                $bot[$i] = "<img width='30px' src=' ".$estado_color[$conex]."'>";
				$array["data"][] = array('clve' => $row['CT_CLAVE'],
       									 'nomb' => $row['DB_INSTANCE'],
       									 //'host' => $row['IP'],
       									 //'base' => $row['SID'],
       									 //'user' => $row['USUARIO'],
       									 //'pass' => $row['CLAVE'],
       									 'cone' => $bot[$i]
     									 );           
		                           
			 }
				echo json_encode($array); 
				oci_free_statement($stmt);
        	
			}


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


			public function getMetodoAcceso(){
        		$this->generaLista(); 
       
        		//echo json_encode($this->cnx); 
    		}
				

	}//endmyclass

	$obj = new ListarDispo();//instancia de la clase para crear un obj

//llamar un metodo de la la clase 
	$obj->cerrarConexion(); 

 ?>

