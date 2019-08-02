<?php 
	/**
	 * 
	 */
	include_once '../Libs/conexionOracle.php';//Incluimos la conexion
	class ListarDispo extends ConexionOracle{
		public $stat;
		public $clve;

		function __construct(){
        	parent::__construct();
        	$this->getMetodoAcceso();
        	
			if($this->stat == null || $this->clve == null ){
				$this->stat = 2;
				 echo '<br>';
				$this->clve = 0;
				 echo '<br>';
			}else{
				 $this->stat = $this->stat;
				 echo '<br>';
					$this->clve = $this->clve;
				 echo '<br>';
			}
			//$this->stat = $this->stat;
			//$this->clve = $clve;
          
    	}
		
		//metodos
		public function generaLista(){
			$array["data"] = [];
			$msj = 'No se encuentra información.';
			$opc = 2;
			$bot = [];
      		$che = [];
      		$conex = 2;
			$estado_color = array(
       			'0' => '../Libs/image/rojo.png',
       			'1' => '../Libs/image/verde.png',
            	'2' => '../Libs/image/blanco.png');


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
            
         
              
               	if($this->stat == '1'){
               		$aux = ($this->clve-1);
               		if($i == $aux){
               			$bot[$i] = "<img width='30px' src=' ".$estado_color[$this->stat]."'>";
              			$che[$i] = "<button type='button' class='checarCon btn btn btn-info btn-sm' disabled='disabled'><i class='far fa-check-square'></i></button>";
              			echo '1 <br>'.$estado_color[1];
               		}else{
               			$bot[$i] = "<img width='30px' src=' ".$estado_color[$conex]."'>";
              			$che[$i] = "<button type='button' class='checarCon btn btn btn-info btn-sm'><i class='far fa-check-square'></i></button>";
              			echo '2 <br>'.$estado_color[$conex];
               		}
               		
               	} else if($this->stat == '0'){
               		$aux = ($this->clve-1);
               		if($i == $aux ){
               			$bot[$i] = "<img width='30px' src=' ".$estado_color[$this->stat]."'>";
              			$che[$i] = "<button type='button' class='checarCon btn btn btn-info btn-sm' disabled='disabled'><i class='far fa-check-square'></i></button>";
              			echo '0 <br>'.$estado_color[0];
               		}else{
               			$bot[$i] = "<img width='30px' src=' ".$estado_color[$conex]."'>";
              			$che[$i] = "<button type='button' class='checarCon btn btn btn-info btn-sm'><i class='far fa-check-square'></i></button>";
              			echo '2 <br>'.$estado_color[$conex];
               		}
               	} else if($this->stat == '2'){
               		$bot[$i] = "<img width='30px' src=' ".$estado_color[$conex]."'>";
              		$che[$i] = "<button type='button' class='checarCon btn btn btn-info btn-sm'><i class='far fa-check-square'></i></button>";
              		echo '2 <br>'.$estado_color[$conex];
               	}
              

               

				$array["data"][] = array(
                          	'num' => ($i+1),
                          	'clve' => $row['CT_CLAVE'],
       						'nomb' => $row['DB_INSTANCE'],
       						'cone' => $bot[$i],
                          	'chec' => $che[$i]
     									 );           
		                           
			 }
				echo json_encode($array); 
				oci_free_statement($stmt);
        	
			}

			public function getMetodoAcceso(){
				$this->stat = $_POST['stt'];
				$this->clve = $_POST['cve'];
        		$this->generaLista(); 
       
        		//echo json_encode($this->cnx); 
    		}
				

	}//endmyclass
	
	$obj = new ListarDispo();//instancia de la clase para crear un obj
	
//llamar un metodo de la la clase 
	$obj->cerrarConexion(); 

 ?>

