
<?php

/**
 * 	Autor: Ing.Elias Alejandro Morales Macera
 *	Fecha inicio: 30/07/2019 12:44
 *	Fecha  Final:
 * 	Descripcion:
 *  Modificacion:
 *
 */
include '../../Libs/conexionOracle.php';


class Adquisiciones extends ConexionOracle{

	private $anio=2017;
	private $altasAqui=0; 
	private $bajasAqui=0;
	private $conexbase=0; 
	private $nomcentrotrabajo='';
	private $mensaje='';
	private $errorproc=''; 
	private $existen=0; //registros existentes 

	//construtor
	function __construct($anio){
		$this->anio=$anio;
		parent::__construct();
	}
	
	public function getListaCT(){
		//$listact=array();
		$tablact='';
		$sql="SELECT DB_INSTANCE,CT_CLAVE FROM C_DBLINKS";
		$stmt = oci_parse($this->con2, $sql);
        oci_execute($stmt);
        $tablact.='<table class="table-hover table-bordered">
                        <thead>
                            <tr>
                            	<th width="5%">N°</th>
                                <th width="70%">Centro de Trabajo</th>
                                <th width="10%">Obten</th>
                                <th width="15%">Luz</th>
                            </tr>
                        </thead>
                        <tbody>';

        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++) {
        	//$listact[$i] =$f = array('NOMBRECT' =>$row['DB_INSTANCE'],'CLAVECT' =>$row['CT_CLAVE']);
        	$cvect =$row['CT_CLAVE'];
        	$idsema='semaforo'.$cvect;
        		$tablact.=" <tr>
        						<td>".($i+1)."</td>
                                <td>($cvect) ".$row['DB_INSTANCE']."</td>
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


	/* Verifica si existe datos del centro de trabajo en la tabla de adquisiciones */
	private function getExisteCentroTrabajoAdqui($cvect){
		$numregistro=0;  $mensaje="No existe registros para el centro de trabajo $cvect";  $datos=array(); 
		$conexion=3; $valida=false; 

		$sql="SELECT COUNT(*) AS REGISTOS FROM TAB_ALTASYBAJAS WHERE CONTCT =$cvect"; 
		$stmt = oci_parse($this->con2, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_BOTH);
        $numregistro=$row['REGISTOS'];
        if($numregistro!=0){
        	$mensaje="<strong>Advertencia</strong> este centro de trabajo $cvect ya se encuentra registrado en la tabla adquisición la información se duplicaría si se guarda, si desea más información acudir con el administrador del sistema."; 
        	$conexion=2;
        	$valida=true; 
        }

        $datos = array('valid' => $valida,
        			   'msj' => $mensaje,
        			   'row' =>  $numregistro,
        			   'cone' =>  $conexion,
        			  );

        oci_free_statement($stmt);//libera todos los recursos asociados con la instrucción o el cursor
        unset($row); //eliminamos la fila para evitar sobrecargar la memoria
        //echo json_encode($datos);
        return $datos; 
	}


	//obtener informacion del centro de trabajo que se le pasa por parametro 
	//el anio se validara bueno si se desea realizar un historial podria validar si se necesita 
	public function getInfoConexCT($cveCentro,$anio){
		$concvect= array();
		$verifica =$this->getExisteCentroTrabajoAdqui($cveCentro); 
		
		//print_r($verifica);
		if($verifica['valid']){//exite el centro de trabajo # en la tabla de adquisiciones
			$this->mensaje=$verifica['msj'];
			$this->conexbase=$verifica['cone'];
			$this->existen=$verifica['row'];
		}else{
			/**/
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
            //$concvect = array('cone' => $conex);
            oci_free_statement($stmt);//libera todos los recursos asociados con la instrucción o el cursor
            unset($row); //eliminamos la fila para evitar sobrecargar la memoria
            //echo json_encode($concvect);
		}
		$this->imprimirJsonData(); 										//IMPRIME INFORMACION
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
		,TO_CHAR (TO_DATE(CE.CONTFECHCAP,'DD/MM/RR'), 'DD/MM/RR') CONTFECHCAP
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
			//$formFecha= $this->formatearFechaDiaMesAnio($row->CONTFECHCAP);  //'CONTFECHCAP' => "'".$formFecha."'",
			$numRando= $this->randondigitos(); 
			$datoAlta[$i]= array(
							 'ID' =>$numRando,
							 'CONTCT' => (int)$row->CONTCT,
							 'CONTNUM' => (int)$row->CONTNUM,
							 'CONTCC' => (int)$row->CONTCC,
							 'CONTSSC' => (int)$row->CONTSSC,
							 'CONTSSSC' => (int)$row->CONTSSSC,
							 'ACTNUMERO' => "'".str_replace("'",'"',$row->ACTNUMERO)."'",
							 'CONTDES' => "'".str_replace("'",'"',$row->CONTDES)."'",
							 'CONTMARCA' => "'".str_replace("'",'"',$row->CONTMARCA)."'",
							 'CONTMODELO' => "'".str_replace("'",'"',$row->CONTMODELO)."'",
							 'CONTSERIE' => "'".str_replace("'",'"',$row->CONTSERIE)."'",							
							 'CONTFECHCAP' => "'".str_replace("'",'"',$row->CONTFECHCAP)."'",
							 'CONTFACTURA' => "'".str_replace("'",'"',$row->CONTFACTURA)."'",
							 'CONTCOSTO' => floatval($row->CONTCOSTO),
							 'CONTDEPACUM' => floatval($row->CONTDEPACUM),
							 'TIPOMOV' => 1,
							 'CTDESCRIP' => "'".str_replace("'","'",$row->CTDESCRIP)."'",
							 'CCDES' => "'".str_replace("'","'",$row->CCDES)."'"
							 );
		}

		$stmt = null;//cerrar consulta
		$conn = null;//cerrar  conexion
		//ver informacion del json
		//echo json_encode($datoAlta); 
		$this->altasAqui= sizeof($datoAlta);
		$this->insertarTablaTemporal($datoAlta,1); 
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
							 'ID' =>$numRando,
							 'CONTCT' => (int)$row['CONTCT'],
							 'CONTNUM' => (int)$row['CONTNUM'],
							 'CONTCC' => (int)$row['CONTCC'],
							 'CONTSSC' => (int)$row['CONTSSC'],
							 'CONTSSSC' => (int)$row['CONTSSSC'],
							 'HBNUMERO' => "'".str_replace("'",'"',$row['HBNUMERO'])."'",
							 'CONTDES' => "'".str_replace("'",'"',$row['CONTDES'])."'",
							 'CONTMARCA' => "'".str_replace("'",'"',$row['CONTMARCA'])."'",
							 'CONTMODELO' => "'".str_replace("'",'"',$row['CONTMODELO'])."'",
							 'CONTSERIE' => "'".str_replace("'",'"',$row['CONTSERIE'])."'",
							 'CONTFECHCAP' => "'".str_replace("'",'"',$row['CONTFECHCAP'])."'",
							 'CONTFACTURA' => "'".str_replace("'",'"',$row['CONTFACTURA'])."'",
							 'CONTABONO' => floatval($row['CONTABONO']),
							 'CONTBAJADEP' => floatval($row['CONTBAJADEP']),
							 'TIPOMOV' => 2,
							 'CTDESCRIP' => "'".str_replace("'",'"',$row['CTDESCRIP'])."'",
							 'CCDES' => "'".str_replace("'",'"',$row['CCDES'])."'"
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
				VALUES(
				".$item[$i]['ID'].",
				".$item[$i]['CONTCT'].",
				".$item[$i]['CONTNUM'].",
				".$item[$i]['CONTCC'].",
				".$item[$i]['CONTSSC'].",
				".$item[$i]['CONTSSSC'].",
				".$item[$i]['ACTNUMERO'].", 
				".$item[$i]['CONTDES'].",
				".$item[$i]['CONTMARCA'].",
				".$item[$i]['CONTMODELO'].",
				".$item[$i]['CONTSERIE'].",
				".$item[$i]['CONTFECHCAP'].",
				".$item[$i]['CONTFACTURA'].",
				".$item[$i]['CONTCOSTO'].",
				".$item[$i]['CONTDEPACUM'].",
				".$item[$i]['TIPOMOV'].",
				".$item[$i]['CTDESCRIP'].",".$item[$i]['CCDES'].")";
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
				".$item[$i]['ID'].",
				".$item[$i]['CONTCT'].",
				".$item[$i]['CONTNUM'].",
				".$item[$i]['CONTCC'].",
				".$item[$i]['CONTSSC'].",
				".$item[$i]['CONTSSSC'].",
				".$item[$i]['HBNUMERO'].", 
				".$item[$i]['CONTDES'].",
				".$item[$i]['CONTMARCA'].",
				".$item[$i]['CONTMODELO'].",
				".$item[$i]['CONTSERIE'].",
				".$item[$i]['CONTFECHCAP'].",
				".$item[$i]['CONTFACTURA'].",
				".$item[$i]['CONTABONO'].",
				".$item[$i]['CONTBAJADEP'].",
				".$item[$i]['TIPOMOV'].",
				".$item[$i]['CTDESCRIP'].",".$item[$i]['CCDES'].")";
				
				//echo "$sql <br><br><br>";
				$stid = oci_parse($this->con2,$sql);
				oci_execute($stid);
				oci_free_statement($stid); 
			}
			oci_commit($this->con2);  // consolida todos los nuevos valores: 1, 2, 3, 4, 5
		}
	}


	public function eliminarDatosTablaAltasBajas(){
		$elimino=0; 
		$mensaje="<strong>!Error</strong> No se pudo eliminar la tabla de altas y bajas de adquisiciones. Solicite ayuda con el administrador."; 
		$sql= "DELETE FROM TAB_ALTASYBAJAS";
		$stmt = oci_parse($this->con2, $sql);
        $ok = oci_execute($stmt);
		oci_free_statement($stmt);//libera todos los recursos asociados con la instrucción o el cursor

		if($ok){
			$elimino=1; 
			$mensaje="<strong>!Éxito</strong> el contenido de la tabla altas y bajas adquisiciones fue eliminado satisfactoriamente. ";
		}
		echo json_encode(
				array('elim' => $elimino,
					  'mesj' => $mensaje)
			);

	}


	public function imprimirJsonData(){
		$info= array();

		$info = array('cone' => $this->conexbase,
					  'alta' => $this->altasAqui,
					  'baja' => $this->bajasAqui,
					  'nomb' => $this->nomcentrotrabajo, 
					  'msje' => $this->mensaje,
					  'exit' => $this->existen
					);
	
		echo json_encode($info);
		unset($info); //eliminamos la fila para evitar sobrecargar la memoria

	}


}//myClassEnd
	if(isset($_POST['anio'])){
		$anio=$_POST['anio']; 
	}else{
		$anio=2017; 
	}
		
	$ob = new Adquisiciones($anio);
	//$ob->getCuentas(); 
	switch ($_POST['opcion']) {
		case 'cargaListaCentroTrabajo':
			$ob->getListaCT();
			break;

		case 'informacionCentroTrabajo':
			$ob->getInfoConexCT($_POST['cvect'],$_POST['anio']);
			break;

		case 'eliminarDatosTabla':
			$ob->eliminarDatosTablaAltasBajas(); 
			break;

		default:
			echo "La opcion no se encuentra definida en la clase!: "._POST['opcion'];
			break;
	}/**/
	$ob->cerrarConexion2();
 ?>

