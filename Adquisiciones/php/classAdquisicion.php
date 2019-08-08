
<?php

/**
 * 	Autor: Ing.Elias Alejandro Morales Macera
 *	Fecha inicio: 30/07/2019 12:44
 *	Fecha  Final:
 * 	Descripcion:
 *  Modificacion:
 *
 */
//https://docs.oracle.com/cd/B19306_01/server.102/b14237/initparams122.htm#REFRN10119
include_once '../../Libs/ConexionOracle.php';

class Adquisiciones extends ConexionOracle{

	private $anio=2018;
	private $altasAqui=0; 
	private $bajasAqui=0;
	private $conexbase=0; 
	private $nomcentrotrabajo='';
	private $errorproc=''; 

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
            $this->nomcentrotrabajo= trim($row["DB_INSTANCE"]);
            //informacion en array
            $this->conexbase= $this->comprobarConexionCT($host,$base,$user,$pass);

            $this->imprimirJsonData(); 																//IMPRIME INFORMACION
            //$concvect = array('cone' => $conex);
            oci_free_statement($stmt);//libera todos los recursos asociados con la instrucción o el cursor
            unset($row); //eliminamos la fila para evitar sobrecargar la memoria
            //echo json_encode($concvect);
	}


	//metodo privado para testing de las bases de datos remotas  retorna 1 si es exitosa la conexion
    private function comprobarConexionCT($host,$daba,$user,$pass)
    {
        $checar=0;
        try{
            $conexion= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
            $checar=1;
            //$this->cambiarFormatoFecha($conexion);
            //$this->getConfiguracionNLS($conexion);
            	$this->obtenerAltasAquisicion($conexion);										//OBTENER ALTAS AQUISICION
            	$this->obtenerBajasAquisicion($conexion);										//OBTENER BAJAS AQUISICION

            $conexion = null;
        }catch(PDOException $e){
             //echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
             $checar=0;
        }
        return $checar;
	}

	public function randondigitos(){
		$numrando=92383;
		$num1=rand(1,10);
		$num2=rand(0,10);
		$num3=rand(0,10);
		$num4=rand(0,10);
		$numrando="$num1"."$num2"."$num3".$num4;
		return (int)$numrando;
	}

	//31/12/17 ---- 31/DIC/17  -----  31-DIC-2017 
	public function formatearFechaDiaMesAnio($fechadb){
		//$fecha = new DateTime($fechadb); 
		//$fomfecha = $fecha->format("d-m-Y"); 	

		//return $fomfecha; 
	}

	public function formatoFechaBaseDatos($fecha){
		$sql= "SELECT TO_CHAR (TO_DATE('31/12/17','DD/MM/YYYY'), 'DD/MM/YYYY') AS FORMATOFECHA FROM DUAL";
		$stid = oci_parse($this->con2,$sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt, OCI_BOTH);
	}

	public function getConfiguracionNLS($conn){
		$dataNls = array();
		$sql="SELECT * FROM NLS_SESSION_PARAMETERS"; 

		$stmt = $conn->prepare($sql);	// Preparar la sentencia
		$stmt->execute();				// Ejecutar la sentencia
		//print_r($row);
		for($i=0; $row = $stmt->fetch(PDO::FETCH_OBJ); $i++) {
        	$dataNls[$i] = array('PARAMETER' =>$row->PARAMETER,
        						 'VALUE' =>$row->VALUE
        						);	
        }

        $stmt=null;	// Liberar los recursos asociados a una sentencia o cursor
        echo json_encode($dataNls);
	}


	//Para la fecha presentada en formato '29-DEC-2015' nls_date_formatdebe ser 'DD-MON-YYYY'. Si tiene algún otro valor, puede cambiarlo usando la siguiente consulta.
	public function cambiarFormatoFecha($conn){
		//$sql="ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-RR'; ALTER SESSION SET NLS_DATE_LANGUAGE = 'AMERICAN'"; 
		$sql="ALTER SESSION SET NLS_DATE_FORMAT='DD-MM-RR'"; 
		
		$stmt = $conn->prepare($sql);	// Preparar la sentencia
		$stmt->execute();				// Ejecutar la sentencia
		$stmt=null;	// Liberar los recursos asociados a una sentencia o cursor
	
	}

	//TO_DATE(CE.CONTFECHCAP, 'DD-MOD-RR')
	//TO_CHAR (TO_DATE(CE.CONTFECHCAP,'DD/MM/RR'), 'DD/MM/RR') CONTFECHCAP
	public function obtenerAltasAquisicion($conn){
		//print_r ($conn); //obtener informacion de la conexion que se pasa como paramtro 
		$datoAlta = array();
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

		for ($i=0; $row = $stmt->fetch(PDO::FETCH_OBJ); $i++) {
			//$formFecha= $this->formatearFechaDiaMesAnio($row->CONTFECHCAP); 
			$numRando= $this->randondigitos(); 
			$datoAlta[$i]= array(
							 'ID' =>$numRando,
							 'CONTCT' => (int)$row->CONTCT,
							 'CONTNUM' => (int)$row->CONTNUM,
							 'CONTCC' => (int)$row->CONTCC,
							 'CONTSSC' => (int)$row->CONTSSC,
							 'CONTSSSC' => (int)$row->CONTSSSC,
							 'ACTNUMERO' => "'".$row->ACTNUMERO."'",
							 'CONTDES' => "'".$row->CONTDES."'",
							 'CONTMARCA' => "'".$row->CONTMARCA."'",
							 'CONTMODELO' => "'".$row->CONTMODELO."'",
							 'CONTSERIE' => "'".$row->CONTSERIE."'",
							 //'CONTFECHCAP' => "'".$formFecha."'",
							 'CONTFECHCAP' => "'".$row->CONTFECHCAP."'",
							 'CONTFACTURA' => "'".$row->CONTFACTURA."'",
							 'CONTCOSTO' => floatval($row->CONTCOSTO),
							 'CONTDEPACUM' => floatval($row->CONTDEPACUM),
							 'TIPOMOV' => 1,
							 'CTDESCRIP' => "'".$row->CTDESCRIP."'",
							 'CCDES' => "'".$row->CCDES."'"
							 );
		}

		$stmt = null;//cerrar consulta
		$conn = null;//cerrar  conexion
		//ver informacion del json
		//echo json_encode($datoAlta); 
		$this->altasAqui= sizeof($datoAlta);
		//$this->insertarTablaTemporal($datoAlta,1); 
	}



	//TO_DATE(CE.CONTFECHCAP, 'DD-MOD-RR') CONTFECHCAP
	//TO_CHAR (TO_DATE(CE.CONTFECHCAP,'DD/MM/RR'), 'DD/MM/RR') CONTFECHCAP
	public function obtenerBajasAquisicion($conn){
		$datoBaja = array();
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
		,TO_CHAR (TO_DATE(CE.CONTFECHCAP,'DD/MM/RR'), 'DD/MM/RR') CONTFECHCAP
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
		ORDER BY CE.CONTCT,CE.CONTNUM,CE.CONTSSC,CE.CONTSSSC";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		for ($i=0; $row = $stmt->fetch(PDO::FETCH_ASSOC); $i++) {
			//$formFecha= $this->formatearFechaDiaMesAnio($row->CONTFECHCAP); 
			$numRando= $this->randondigitos(); 
			$datoBaja[$i]= array(
							 $numRando,
							 (int)$row['CONTCT'],
							 (int)$row['CONTNUM'],
							 (int)$row['CONTCC'],
							 (int)$row['CONTSSC'],
							 (int)$row['CONTSSSC'],
							 "'".$row['HBNUMERO']."'",
							 "'".$row['CONTDES']."'",
							 "'".$row['CONTMARCA']."'",
							 "'".$row['CONTMODELO']."'",
							 "'".$row['CONTSERIE']."'",
							 "'".$row['CONTFECHCAP']."'",
							 "'".$row['CONTFACTURA']."'",
							 floatval($row['CONTABONO']),
							 floatval($row['CONTBAJADEP']),
							 2,
							 "'".$row['CTDESCRIP']."'",
							 "'".$row['CCDES']."'"
							 );
		}

		$stmt = null;//cerrar consulta
		$conn = null;//cerrar  conexion
		//echo json_encode($datoBaja); 
		$this->bajasAqui= sizeof($datoBaja);
		$this->insertarTablaTemporal($datoBaja,0); 
	}

//ACTNUMERO, //CONTDEPACUM, //CONTCOSTO,
/* OCUPANDO PDO  
*  no marca errores con la fecha por tal motivo antes de pasarlo tengo que parsearlo a los valores correspondientes y despues pasarlo en un arreglo mmmm proceso que se hace en 
*/
	public function insertarTablaTemporal($item,$tipmovi){
		$tamanioItem=sizeof($item);  	//variable global 
		if($tipmovi==1){//tipo de movimiento ALTAS
			for ($i=0; $i <$tamanioItem; $i++){ 
				$sql= "INSERT INTO TAB_ALTASYBAJAS (ID,CONTCT,CONTNUM,CONTCC,CONTSSC,CONTSSSC,HBNUMERO,CONTDES,CONTMARCA,CONTMODELO,CONTSERIE,CONTFECHCAP,CONTFACTURA,CONTABONO,CONTBAJADEP,TIPOMOV,CTDESCRIP,CCDES) 
				VALUES(".$item[$i][0].",
				".$item[$i][1].",
				".$item[$i][2].",
				".$item[$i][3].",
				".$item[$i][4].",
				".$item[$i][5].",
				".$item[$i][6].", 
				".$item[$i][7].",
				".$item[$i][8].",
				".$item[$i][9].",
				".$item[$i][10].",
				".$item[$i][11].",
				".$item[$i][12].",
				".$item[$i][13].",
				".$item[$i][14].",
				".$item[$i][15].",
				".$item[$i][16].",".$item[$i][17].")";
				//echo "$sql <br><br><br>";
				$stid = oci_parse($this->con2,$sql);
				oci_execute($stid);
				oci_free_statement($stid); 
			}
			oci_commit($this->con2);  // Consigna la transacción pendiente de la base de datos 1,2,3,4
		}//endtipo de movimiento altas

		if($tipmovi==0){//tipo de movimientos BAJAS 
			for ($i=0; $i <$tamanioItem; $i++){ 
				$sql= "INSERT INTO TAB_ALTASYBAJAS (ID,CONTCT,CONTNUM,CONTCC,CONTSSC,CONTSSSC,HBNUMERO,CONTDES,CONTMARCA,CONTMODELO,CONTSERIE,CONTFECHCAP,CONTFACTURA,CONTABONO,CONTBAJADEP,TIPOMOV,CTDESCRIP,CCDES) 
				VALUES(
				".$item[$i][0].",
				".$item[$i][1].",
				".$item[$i][2].",
				".$item[$i][3].",
				".$item[$i][4].",
				".$item[$i][5].",
				".$item[$i][6].", 
				".$item[$i][7].",
				".$item[$i][8].",
				".$item[$i][9].",
				".$item[$i][10].",
				".$item[$i][11].",
				".$item[$i][12].",
				".$item[$i][13].",
				".$item[$i][14].",
				".$item[$i][15].",
				".$item[$i][16].",".$item[$i][17].")";
				
				//echo "$sql <br><br><br>";
				$stid = oci_parse($this->con2,$sql);
				oci_execute($stid);
				oci_free_statement($stid); 
			}
			oci_commit($this->con2);  // consolida todos los nuevos valores: 1, 2, 3, 4, 5
		}
		
	}


	public function imprimirJsonData(){
		$info= array();

		$info = array('cone' => $this->conexbase,
					  'alta' => $this->altasAqui,
					  'baja' => $this->bajasAqui,
					  'nomb' => $this->nomcentrotrabajo 
					);
	
		echo json_encode($info);
		unset($info); //eliminamos la fila para evitar sobrecargar la memoria

	}


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

