	
<?php 

/**
 * 	Autor: Ing.Elias Alejandro Morales Macera
 *	Fecha inicio: 30/07/2019 12:44 
 *	Fecha  Final: 
 * 	Descripcion: 
 *  Modificacion: 
 *	
 */
include_once '../../Libs/ConexionOracle.php'; 

class Adquisiciones extends ConexionOracle{

	private $anio=2018; 
	
	//construtor 
	function __construct($anio){
		$this->anio=$anio; 
		parent::__construct();
	}
	//imagenes escritorio remoto de recuroos humanos
	//carpeta-> que se llame  remotamente 193.0.0.45 
	//c: rh/2000/fotos/210/foto9308
	// $ncols = oci_num_fields($stid);
	public function getListaCT(){
		//$listact=array(); 
		$tablact=''; 
		$sql="SELECT DB_INSTANCE,CT_CLAVE FROM C_DBLINKS";
		$stmt = oci_parse($this->con2, $sql);
        oci_execute($stmt);
        $tablact.='<table class="table-hover table-bordered">
                        <thead>
                            <tr>
                            	<th width="10%">N°</th>
                             	<th width="20%">Clave</th>
                                <th width="35%">Centro de Trabajo</th>
                                <th width="20%">Verificar</th>
                                <th width="15%">Semaforo</th>
                            </tr>
                        </thead>
                        <tbody>';

        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++) { 
        	//$listact[$i] =$f = array('NOMBRECT' =>$row['DB_INSTANCE'],'CLAVECT' =>$row['CT_CLAVE']);
        	$cvect =$row['CT_CLAVE'];
        	$idsema='semaforo'.$cvect; 
        		$tablact.=" <tr>
        						<td>".($i+1)."</td>
        						<td align='center'>".$cvect."</td>
                                <td>".$row['DB_INSTANCE']."</td>
                                <td align='center'><input class='form-check-input position-static checkbox-1x' type='checkbox' onclick='checarevento($cvect)'></td>
                                <td id='$idsema'></td>
                            </tr>";
        }
        	$tablact.='	</tbody>
                    </table>';

        oci_free_statement($stmt);//libera todos los recursos asociados con la instrucción o el cursor
        unset($row); //eliminamos la fila para evitar sobrecargar la memoria
        //echo json_encode($listact);
        echo $tablact;
	}


	//obtener clave de la cuenta y descripcion de cuentas
	public function getCuentas(){
		$cuentas= array();
		$sql="SELECT CCNUM,CCDES FROM CUENTAS"; 
		$stmt = oci_parse($this->con2, $sql);
        oci_execute($stmt);

        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++) { 
        	$cuentas[$i] =$f = array('CCNUM' =>$row['CCNUM'],'CCDES' =>$row['CCDES']);
        }
        oci_free_statement($stmt);//libera todos los recursos asociados con la instrucción o el cursor
        unset($row); //eliminamos la fila para evitar sobrecargar la memoria
        echo json_encode($cuentas);
	}


	//obtener informacion del centro de trabajo que se le pasa por parametro
	public function getInfoConexCT($cveCentro){
		$concvect= array();

		$sql= "SELECT IP,SID,USUARIO,CLAVE,DB_INSTANCE,DB_NAME FROM C_DBLINKS WHERE CT_CLAVE=$cveCentro";
		//echo "$sql"; 
		$stmt = oci_parse($this->con2, $sql);
        oci_execute($stmt);
        
 			$row = oci_fetch_array($stmt, OCI_BOTH);
        	$host= trim($row["IP"]);
            $base= trim($row["SID"]);
            $user= trim($row["USUARIO"]);
            $pass= trim($row["CLAVE"]);

            //informacion en array  
            $conex= $this->comprobarConexionCT($host,$base,$user,$pass); 
            $concvect = array('cone' => $conex);
            oci_free_statement($stmt);//libera todos los recursos asociados con la instrucción o el cursor
            unset($row); //eliminamos la fila para evitar sobrecargar la memoria
            echo json_encode($concvect);
	}	


	//metodo privado para testing de las bases de datos remotas  retorna 1 si es exitosa la conexion
    private function comprobarConexionCT($host,$daba,$user,$pass)
    {
        $checar=0; 
        try{    
            $conexion= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
            $checar=1;
            $this->altasAquisicion($conexion); 

            $conexion = null;
        }catch(PDOException $e){
             //echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
             $checar=0;
        }
        return $checar; 
	}


	public function altasAquisicion($conn){
		//print_r ($conn);
		$sql= "SELECT CE.CONTCT
		,CE.CONTNUM
		,CE.CONTCC
		,CE.CONTSSC
		,CE.CONTSSSC
		,A.ACTNUMERO
		,CE.CONTDES
		,CE.CONTMARCA
		,CE.CONTMODELO
		,CE.CONTSERIE
		,CE.CONTFECHCAP
		,CE.CONTFACTURA
		,CE.CONTCOSTO
		,CE.CONTDEPACUM
		,T.CTDESCRIP
		,CC.CCDES
		FROM CEDULAS CE,CENTROS_DE_TRABAJO T ,CUENTAS CC ,ACTIVOS A
		WHERE TO_NUMBER(TO_CHAR(CE.CONTFECHMOV,'yyyy'))='$this->anio' AND Nvl(CE.CONTABONO,0)=0 AND
		CE.CONTTIPMOV= 'A1' AND
		CE.CONTCT=T.CTCENTRAB AND
		CE.CONTCC=CC.CCNUM AND
		CE.CONTCT   =A.CONTCT(+) AND
		CE.CONTNUM=A.CONTNUM(+)
		ORDER BY CE.CONTCT,CE.CONTNUM,CE.CONTSSC,CE.CONTSSSC";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		//$numrow = $stmt->rowCount();
		//$query= $conn->query($sql);
		//$numrow =$->rowCount();
		for ($i=0; $row = $stmt->fetch(PDO::FETCH_OBJ); $i++) { 
			$ID=($i+1);							//NUMBER(10)   
			$CONTCT = $row->CONTCT;				//NUMBER(3)    
		    $CONTNUM = $row->CONTNUM;			//NUMBER(8)    
		    $CONTCC = $row->CONTCC;				//NUMBER(4)    
		    $CONTSSC = $row->CONTSSC;			//NUMBER(4)    
		    $CONTSSSC = $row->CONTSSSC ;		//NUMBER(4)    
		    $ACTNUMERO = $row->ACTNUMERO;		//VARCHAR2(13) 
		    $CONTDES = $row->CONTDES;			//VARCHAR2(100)
		    $CONTMARCA = $row->CONTMARCA;		//VARCHAR2(10) 
		    $CONTMODELO = $row->CONTMODELO;		//VARCHAR2(10) 
		    $CONTSERIE = $row->CONTSERIE;		//VARCHAR2(18) 
		    $CONTFECHCAP = $row->CONTFECHCAP;	//DATE         
		    $CONTFACTURA = $row->CONTFACTURA;	//VARCHAR2(12) 
		    $CONTCOSTO = $row->CONTCOSTO;		//NUMBER       
		    $CONTDEPACUM = $row->CONTDEPACUM;	//NUMBER       
		    $TIPOMOV = 1;//tipó					//NUMBER(1)    
		    $CTDESCRIP = $row->CTDESCRIP;		//VARCHAR2(40) 
		    $CCDES = $row->CCDES; 				//VARCHAR2(100)

		  
 //$imprinfo= "$ID, $CONTCT, $CONTNUM, $CONTCC, $CONTSSC, $CONTSSSC, $ACTNUMERO, $CONTDES, $CONTMARCA, $CONTMODELO, $CONTSERIE, $CONTFECHCAP, $CONTFACTURA, $CONTCOSTO, $CONTDEPACUM, $TIPOMOV, $CTDESCRIP, $CCDES <br>"; https://coderadio.freecodecamp.org/

		$insertar =$this->insertarTablaTemporal($ID, $CONTCT, $CONTNUM, $CONTCC, $CONTSSC, $CONTSSSC, $ACTNUMERO, $CONTDES, $CONTMARCA, $CONTMODELO, $CONTSERIE, $CONTFECHCAP, $CONTFACTURA, $CONTCOSTO, $CONTDEPACUM, $TIPOMOV, $CTDESCRIP, $CCDES, $conn); 
	
		   echo "$insertar"; 
		}
	
		$stmt = null;
		//return $query;
	}


	public function bajasAquisicion(){
		$sql= "
		SELECT CE.CONTCT
		,CE.CONTNUM
		,CE.CONTCC
		,CE.CONTSSC
		,CE.CONTSSSC
		,A.HBNUMERO
		,CE.CONTDES
		,CE.CONTMARCA
		,CE.CONTMODELO
		,CE.CONTSERIE
		,CE.CONTFECHCAP
		,CE.CONTFACTURA
		,CE.CONTABONO*-1 CONTABONO
		,CE.CONTBAJADEP*-1 CONTBAJADEP
		,T.CTDESCRIP
		,CC.CCDES
		FROM    CEDULAS CE
		       ,CENTROS_DE_TRABAJO T
		       ,CUENTAS CC, HISTORICO_BAJAS A
		WHERE TO_NUMBER(TO_CHAR(CE.CONTFECHBAJA,'yyyy'))=$this->anio AND
		TO_NUMBER(TO_CHAR(CE.CONTFECHMOV,'yyyy'))<=$this->anio and
		CE.CONTABONO<>0 AND
		CE.CONTTIPMOVB not IN ('T1','T2') AND
		CE.CONTCT=T.CTCENTRAB AND
		CE.CONTCC=CC.CCNUM AND
		CE.CONTCT =A.CONTCT(+) AND
		CE.CONTNUM=A.CONTNUM(+)
		ORDER BY CE.CONTCT,CE.CONTNUM,CE.CONTSSC,CE.CONTSSSC;";
	}

//ACTNUMERO,
//CONTDEPACUM, 
//CONTCOSTO,
	public function insertarTablaTemporal($ID, $CONTCT, $CONTNUM, $CONTCC, $CONTSSC, $CONTSSSC, $ACTNUMERO, $CONTDES, $CONTMARCA, $CONTMODELO, $CONTSERIE, $CONTFECHCAP, $CONTFACTURA, $CONTCOSTO, $CONTDEPACUM, $TIPOMOV, $CTDESCRIP, $CCDES, $conn){

	try {
		$sql= "INSERT INTO TAB_ALTASYBAJAS (ID,CONTCT,CONTNUM,CONTCC,CONTSSC,CONTSSSC,HBNUMERO,CONTDES,CONTMARCA,CONTMODELO,CONTSERIE,CONTFECHCAP,CONTFACTURA,CONTABONO,CONTBAJADEP,TIPOMOV,CTDESCRIP,CCDES) VALUES(:ID,:CONTCT,:CONTNUM,:CONTCC,:CONTSSC,:CONTSSSC,:HBNUMERO,:CONTDES,:CONTMARCA,:CONTMODELO,:CONTSERIE,:CONTFECHCAP,:CONTFACTURA,:CONTABONO,:CONTBAJADEP,:TIPOMOV,:CTDESCRIP,:CCDES)";

		$sentencia = $conn-> prepare($sql);
	
		$sentencia-> bindParam(':ID', $ID, PDO::PARAM_INT);		//NUMBER(10)   	
  		$sentencia-> bindParam(':CONTCT', $CONTCT, PDO::PARAM_INT);	//NUMBER(3)    	
  		$sentencia-> bindParam(':CONTNUM', $CONTNUM, PDO::PARAM_INT);	//NUMBER(8)    	
  		$sentencia-> bindParam(':CONTCC', $CONTCC, PDO::PARAM_INT);		//NUMBER(4)    
  		$sentencia-> bindParam(':CONTSSC', $CONTSSC, PDO::PARAM_INT);	//NUMBER(4)    	
  		$sentencia-> bindParam(':CONTSSSC', $CONTSSSC, PDO::PARAM_INT);	//NUMBER(4)    
  		$sentencia-> bindParam(':HBNUMERO', $ACTNUMERO, PDO::PARAM_STR);	//VARCHAR2(13) 
  		$sentencia-> bindParam(':CONTDES', $CONTDES, PDO::PARAM_STR);	//VARCHAR2(100)	
  		$sentencia-> bindParam(':CONTMARCA', $CONTMARCA, PDO::PARAM_STR);	//VARCHAR2(10) 
  		$sentencia-> bindParam(':CONTMODELO', $CONTMODELO, PDO::PARAM_STR);		//VARCHAR2(10) 
  		$sentencia-> bindParam(':CONTSERIE', $CONTSERIE, PDO::PARAM_STR);	//VARCHAR2(18) 	
  		$sentencia-> bindParam(':CONTFECHCAP', $CONTFECHCAP, PDO::PARAM_STR);	//DATE         	
  		$sentencia-> bindParam(':CONTFACTURA', $CONTFACTURA, PDO::PARAM_STR);		//VARCHAR2(12) 
  		$sentencia-> bindParam(':CONTABONO', $CONTCOSTO, PDO::PARAM_INT);	//NUMBER       	
  		$sentencia-> bindParam(':CONTBAJADEP', $CONTDEPACUM, PDO::PARAM_INT);	//NUMBER       	
  		$sentencia-> bindParam(':TIPOMOV', $TIPOMOV, PDO::PARAM_INT);	//NUMBER(1)    
  		$sentencia-> bindParam(':CTDESCRIP', $CTDESCRIP, PDO::PARAM_STR);	//VARCHAR2(40) 	
  		$sentencia-> bindParam(':CCDES', $CCDES, PDO::PARAM_STR);	//VARCHAR2(100)


  		$pdoExec = $sentencia -> execute(); 
  	}catch (PDOException $e) {
     	print 'ERROR: '. $e->getMessage();
     	print '<br/>Data Not Inserted';
	}
		if($pdoExec){
		    //echo 'Data Inserted';
		}

	}

//$sql.= "INSERT ALL INTO TAB_ALTASYBAJAS (ID,CONTCT,CONTNUM,CONTCC,CONTSSC,CONTSSSC,HBNUMERO,CONTDES,CONTMARCA,CONTMODELO,CONTSERIE,CONTFECHCAP,CONTFACTURA,CONTABONO,CONTBAJADEP,TIPOMOV,CTDESCRIP,CCDES) VALUES()";  

}//myClassEnd
	$ob = new Adquisiciones(2017);
	
	
	//$ob->getCuentas(); 
	
	switch ($_POST['opcion']) {
		case 'cargaListaCentroTrabajo':
			$ob->getListaCT(); 
			break;
		
		case 'informacionCentroTrabajo':
			$ob->getInfoConexCT($_POST['cvect']);  
			break;

		default:
			echo "La opcion no se encuentra definida en la clase!: "._POST['opcion'];
			break;
	}/**/
	$ob->cerrarConexion2(); 
 ?>

