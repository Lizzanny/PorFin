<?php 
/**
 * Autor: ISC. Lizeth Viviana Martínez Gómez
 * Fecha inicio: 13/06/2019 09:50 AM  
 * Descripcion: 
 * 
 */
include ('../Libs/conexionOracle.php');
require_once('../Libs/pdf/mpdf/mpdf.php');

class InvDpreCtaCont extends ConexionOracle{

	//
	private $cvect = 0;//////////////////////////////////
	private $centro = '';
	private $fecin = '';
	private $fecfi = '';/////////////////////////

	private $html = '';
	private $fesha = '';
	private $cuentas= array();
	private $reg = array();
	private $tam = array();

	////////variables para mi generacion de reporte de ct
	//private $tsoh;
	//private $abad;
	//private $resu;
	//private $ssap;
	private $conn;
	private $name;
	///
	
	
	//DIRECCIONES DE AREAS 
	private $tamAreas=0; 
	private $NomDirec = array();

	//DIRECCIONES DE CUENTAS
	private $tamCuent=0;
	private $infCuent= array();

	private $arreInverciones = array();
	private $arreDepreciaciones = array();
	private $alm_depres = array();
	private $totdepres = array();
	private $totinvent = array();


	function __construct(){
		parent::__construct();
	}

	private function ConsultasObtDirecciones(){
		//LA FUNCION OBTIENE TODOS LOS CENTROS DE COSTO PARA EL CENTRO DE TRABAJO EN CUESTION.
		$this->fesha = date("d-m-Y");

		$indi=0;
		for ($i=100; $i <=900; $i=$i+100) { 
			//echo "el valor de i es: ".$i."<br>";
			$sql="SELECT CCDESCRIP,CCCENCOS FROM CENTROS_DE_COSTO@$this->name WHERE CCCENCOS = $i"; 

			$stmt = oci_parse($this->con2, $sql);
			oci_execute($stmt);
			$row = oci_fetch_array($stmt, OCI_BOTH);

			$valorx= $row['CCCENCOS']; 

			if($valorx=){

			}

			if($i==100){
				$this->NomDirec[$indi]= array('desc' =>$row['CCDESCRIP'],
					'cosin'=> 0,
					'cosfn'=> 199
			);
			}else if($i>=200 && $i<=900){
				$this->NomDirec[$indi]= array('desc' =>$row['CCDESCRIP'],
					'cosin'=> (int)$row['CCCENCOS'],
					'cosfn'=> $row['CCCENCOS']+99
					 );
			}//else{
				$this->NomDirec[]= array('desc' =>'SIN CENTRO DE COSTO',
					'cosin'=> 1000,
					'cosfn'=> 1000
					 );/**/
			//}
			//
			
			
			
			$indi++; 
		}
		echo json_encode( $this->NomDirec);
		$this->tamAreas=sizeof($this->NomDirec);
		//$stmt = null;
		//echo "".$this->tamAreas."";
		//echo json_encode($this->NomDirec);
		//aqui van las consultas
	}


	private function ConsultasObtCuentas(){

		//echo "el valor de i es: ".$i."<br>";
		$sql="SELECT CCNUM, CCDES FROM CUENTAS@$this->name"; 
		/*$stmt = $this->conn->prepare($sql);
        	$stmt->execute();
        	$row = $stmt->fetch(PDO::FETCH_OBJ);*/
		$stmt = oci_parse($this->con2, $sql);
		oci_execute($stmt);

		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
		//echo $row['CCDESCRIP'];
			$this->infCuent[$i]= array('cvecta' => (int)$row['CCNUM'],
									'nomcta' => $row['CCDES']
					 );
		}
		$this->tamCuent=sizeof($this->infCuent);
		//$stmt = null;
		//echo "".$this->tamAreas."";
		//echo json_encode($this->infCuent);
		//aqui van las consultas
	}

	private function ObtenCentroT($cvect){

		//echo "el valor de i es: ".$i."<br>";
		$sql="SELECT CTDESCRIP FROM ACTFIJ.CENTROS_DE_TRABAJO WHERE CTCENTRAB = $cvect"; 
		$stmt = oci_parse($this->con2, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt, OCI_BOTH);
		$this->centro = $row['CTDESCRIP'];
		
	}

	private function obtenerCedulas(){
		for ($i=0; $i < $this->tamCuent; $i++) { 
			$sql="SELECT CEDULAS.CONTNUM, CEDULAS.CONTCC
                FROM CEDULAS@$this->name
                    LEFT JOIN ACTIVOS ON CEDULAS.CONTCT = ACTIVOS.CONTCT AND CEDULAS.CONTNUM = ACTIVOS.CONTNUM
                    INNER JOIN CUENTAS ON CUENTAS.CCNUM = CEDULAS.CONTCC
                     WHERE CEDULAS.CONTCT = $this->cvect AND CEDULAS.CONTCC = ".$this->infCuent[$i]['cvecta']." AND CEDULAS.CONTFECHMOV  <=TO_DATE('".$this->fecfi."', 'DD/MM/YY') AND 
					(CEDULAS.CONTFECHBAJA is NULL OR CEDULAS.CONTFECHBAJA > TO_DATE('".$this->fecfi."', 'DD/MM/YY'))
                    GROUP BY CEDULAS.CONTNUM, CEDULAS.CONTCC
                    ORDER BY CEDULAS.CONTNUM";

                    /*$stmt = $this->conn->prepare($sql);
        			$stmt->execute();*/
			$stmt = oci_parse($this->con2, $sql);
			oci_execute($stmt);

			for($j=0;$row = oci_fetch_array($stmt, OCI_BOTH); $j++){
				$this->cuentas[$i][$j] = array('cedula'=>$row['CONTNUM'],
												'cuenta'=>$row['CONTCC']);
				$lenght[$i] = count($this->cuentas[$i]);
			}
		}
		//echo $this->cuentas[0][0]['cedula'];

		$this->obtenxCuenta($lenght);
		//$stmt = null;
	}


	public function obtenxCuenta($tam){
		$this->tam = $tam;
		$inversiones = 0;
		$depreciaciones = 0;
		for ($i=0; $i < $this->tamCuent; $i++) { 
					$suma1 = 0;
					$suma2 = 0;
					$suma3 = 0;
					$suma4 = 0;
					$suma5 = 0;
					$suma6 = 0;
					$suma7 = 0;
					$suma8 = 0;
					$suma9 = 0;
					$sumax = 0 ;
					$depre1 = 0;
					$depre2 = 0;
					$depre3 = 0;
					$depre4 = 0;
					$depre5 = 0;
					$depre6 = 0;
					$depre7 = 0;
					$depre8 = 0;
					$depre9 = 0;
					$deprex = 0;

			for($j=0; $j<$this->tam[$i]; $j++){

				$sql = "SELECT CEDULAS.CONTCT, NVL(ACTIVOS.CCCENCOS, 1000) as CCCENCOS,CEDULAS.CONTCC, CEDULAS.CONTNUM, CEDULAS.CONTCOSTO, getDepMensual(
						CEDULAS.CONTSSSC,
						CEDULAS.CONTSALXDEP,
						CEDULAS.CONTCOSTO,
						CEDULAS.CONTABONO,
						CEDULAS.CONTFECHDEP,
						CEDULAS.CONTDEPMEN,
						CEDULAS.CONTMESDEP,
						TO_DATE('".$this->fecfi."', 'DD/MM/YY')) as IMPDEP
    					FROM CEDULAS@$this->name
						LEFT JOIN ACTIVOS 
						ON CEDULAS.CONTCT = ACTIVOS.CONTCT
						AND CEDULAS.CONTNUM = ACTIVOS.CONTNUM
                        WHERE CEDULAS.CONTCT = $this->cvect AND CEDULAS.CONTCC = ".$this->infCuent[$i]['cvecta']." AND CEDULAS.CONTFECHMOV  <=TO_DATE('".$this->fecfi."', 'DD/MM/YY') AND 
					(CEDULAS.CONTFECHBAJA is NULL OR CEDULAS.CONTFECHBAJA > TO_DATE('".$this->fecfi."', 'DD/MM/YY')) AND CEDULAS.CONTNUM=".$this->cuentas[$i][$j]['cedula']."AND ROWNUM=1"
					;
				   /* ESTOY LIMITANDO A UNO EL NUMERO DE REGISTROS. PARA EVITAR QUE SE DUPLIQUEN LOS NUMEROS. DE CEDULA
					*
					* 
					*/
					

            	$stmt = oci_parse($this->con2, $sql);
				oci_execute($stmt);
				/*$stmt = $this->conn->prepare($sql);
        		$stmt->execute();*/

        		
				for($x=0; $rowx = oci_fetch_array($stmt, OCI_BOTH); $x++){
					$this->reg[$i][$j][$x] = array('ct' => $rowx['CONTCT'], 
											 'cc' => $rowx['CCCENCOS'], 
											 'cu' => $rowx['CONTCC'], 
											 'ce' => $rowx['CONTNUM'], 
											 'ca' => $rowx['CONTCOSTO'],
											 'de' => $rowx['IMPDEP']
											);


					if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=0 && $this->reg[$i][$j][$x]['cc']<=199)){
						$suma1 +=  $this->reg[$i][$j][$x]['ca'];
						$depre1 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=200 && $this->reg[$i][$j][$x]['cc']<=299)){
						$suma2 +=  $this->reg[$i][$j][$x]['ca'];
						$depre2 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=300 && $this->reg[$i][$j][$x]['cc']<=399)){
						$suma3 +=  $this->reg[$i][$j][$x]['ca'];
						$depre3 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=400 && $this->reg[$i][$j][$x]['cc']<=499)){
						$suma4 +=  $this->reg[$i][$j][$x]['ca'];
						$depre4 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=500 && $this->reg[$i][$j][$x]['cc']<=599)){
						$suma5 +=  $this->reg[$i][$j][$x]['ca'];
						$depre5 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=600 && $this->reg[$i][$j][$x]['cc']<=699)){
						$suma6 +=  $this->reg[$i][$j][$x]['ca'];
						$depre6 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=700 && $this->reg[$i][$j][$x]['cc']<=799)){
						$suma7 +=  $this->reg[$i][$j][$x]['ca'];
						$depre7 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=800 && $this->reg[$i][$j][$x]['cc']<=899)){
						$suma8 +=  $this->reg[$i][$j][$x]['ca'];
						$depre8 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc']>=900 && $this->reg[$i][$j][$x]['cc']<=999)){
						$suma9 +=  $this->reg[$i][$j][$x]['ca'];
						$depre9 += $this->reg[$i][$j][$x]['de'];
					}else if($this->reg[$i][$j][$x]['cu']==$this->infCuent[$i]['cvecta'] && ($this->reg[$i][$j][$x]['cc'] == 1000 )){
						$sumax +=  $this->reg[$i][$j][$x]['ca'];
						$deprex += $this->reg[$i][$j][$x]['de'];
					}

				}    


				$inversiones = $suma1 + $suma2 + $suma3 + $suma4 + $suma5 + $suma6 + $suma7 + $suma8 + $suma9 + $sumax;
				$depreciaciones = $depre1 + $depre2 + $depre3 + $depre4 + $depre5 + $depre6 + $depre7 + $depre8 + $depre9 + $deprex;

				$this->arreInverciones[$i] = array(
									  $this->LibFormatoMoneda($suma1),
							  		  $this->LibFormatoMoneda($suma2),
							  		  $this->LibFormatoMoneda($suma3),
							  		  $this->LibFormatoMoneda($suma4),
							  		  $this->LibFormatoMoneda($suma5),
							  		  $this->LibFormatoMoneda($suma6),
							  		  $this->LibFormatoMoneda($suma7),
							  		  $this->LibFormatoMoneda($suma8),
							  		  $this->LibFormatoMoneda($suma9),
							  		  $this->LibFormatoMoneda($sumax)
								);

				$this->arreDepreciaciones[$i] = array(
										   $this->LibFormatoMoneda($depre1),
							  			   $this->LibFormatoMoneda($depre2),
							  			   $this->LibFormatoMoneda($depre3),
							  			   $this->LibFormatoMoneda($depre4),
							  			   $this->LibFormatoMoneda($depre5),
							  			   $this->LibFormatoMoneda($depre6),
							  			   $this->LibFormatoMoneda($depre7),
							  			   $this->LibFormatoMoneda($depre8),
							  			   $this->LibFormatoMoneda($depre9),
							  			   $this->LibFormatoMoneda($deprex)
										 );

			}

			$this->totinvent[$i] = $this->LibFormatoMoneda($inversiones);
			$this->totdepres[$i] = $this->LibFormatoMoneda($depreciaciones);

		//	var_dump($this->arreInverciones[$i]);
        }
        
    //    echo json_encode($this->arreInverciones);
    //  
    //$stmt = null;
    // $conn = null;  
	}/**/


	public function LibFormatoMoneda($cantidad){
  		$moneda=number_format(($cantidad), 2, '.', ',');
  		return $moneda; 
  	}
	


	public function Estructura_HTML_PDF_CTL_PAGOS(){
		$this->html = '
		<style>
	@font-face {
  		font-family: Montserrat-Bold;
  		src: url("../Libs/fonts/Montserrat/Montserrat-Bold.ttf"); 
	}
	@font-face {
  		font-family: Montserrat-Regular;
  		src: url("../Libs/fonts/Montserrat/Montserrat-Regular.ttf"); 
	}
	@font-face {
  		font-family: Montserrat-Medium;
  		src: url("../Libs/fonts/Montserrat/Montserrat-Medium.ttf"); 
	}
	*{
		font-family:Montserrat-Regular;
	}
		#mini{
			font-size:8px;
		}
	


		#cabe{
			background:#f2f1ef;
			color:black;
			font-size:18px;
		}

		#izquierda{
			text-align:left;
		}
		#centro{
			text-align:center;
		}
		#derecha{
			text-align:right;
		}
		#cab{
			font-family:Montserrat-Bold;
			background:white;
			text-align: center;
			color: #621132;
			width:100%;
			height:5px;
			border: 3px groove #621132;
			border-radius: 10px 0px 10px 0px;
			height:1px;
		}
		table{
			border-collapse: collapse;
		}

		#datos {
  			width: 100%;
  			text-align: center;
  			border-collapse: collapse;
		}
		#datos td {
		  	border: 1px solid #D4C19C;
		  	padding: 2px 2px;
		}
		 #tdh {
			background-color: #621132;
		  	font-size: 13px;
		  	font-weight: bold;
		  	color: #EAD4A8;
		  	
		}
		 #tdd {
			background-color: #fff;
		  	font-size: 13px;
		  	font-weight: bold;
		  	color: black;
		  	
		}
		#tdr{
			background-color:#ffefd1;

			font-size: 14px;
		  	font-weight: bold;
		  	color: black;
		}

		#tdTot{
			background-color:#BEECDF;

			font-size: 14px;
		  	font-weight: bold;
		  	color: black;
		}

		#datos thead {
		  	background: #FFFFFF;
		  	border-bottom: 0px solid #621132;
		}
		#datos thead th {
		  	font-size: 15px;
		  	font-weight: bold;
		  	color: #000000;
		  	text-align: center;
		}
		#datos tfoot {
		  	font-size: 13px;
		  	font-weight: bold;
		  	color: #000000;
		  	background: #621132;
		  	border-top: 2px solid #D4C19C;
		}
		#datos tfoot td {
		  	font-size: 13px;
		}
		

	</style>
		<htmlpageheader name="cabecera">
		<div>
			<table width="100%">
				<tr>
					<td id="izquierda">
						<p id="mini">ACTFIJ</p>
						<h5>FECHA: '.$this->fesha.'</h5>
						<h5>'.$this->cvect.' '.$this->centro.'</h5>
					</td>
					<td id="centro">
						<p>L I C O N S A,  S. A., DE  C. V.</p>
						<p>SISTEMA DE ACTIVO FIJO</p>
					</td>
					<td id="derecha">
						<h5>PERIODO: DEL '.$this->fecin.' AL '.$this->fecfi.'</h5>
						<h5>HOJA:{PAGENO}/{nbpg}</h5>
					</td>
				</tr>
			</table>
		</div>
		<div id="cab">
			<p><strong>SALDOS DE INVERSIÓN Y DEPRECIACIÓN POR CUENTA CONTABLE </strong></p>
		</div>
	
		<div>
			<p align="center"><u>SALDOS POR CUENTA CONTABLE</u></p>
		</div>
		
		</htmlpageheader>

		<pagefooter name="pie" content-left="PORTAL DE INFORMACIÓN FINANCIERA" footer-style="color: #0b2938; font-style: italic;"/>

		<sethtmlpageheader name="cabecera" value="on" show-this-page="1" />
		<setpagefooter name="pie" page="O" value="on" />
		<br>
		<br>
		<div id="datos">
			<table width="100%" >
				<thead>
					<tr>
						<th colspan = "3"></th>
						<th>INVERSIÓN</th>
						<th>DEPRECIACIÓN</th>
					</tr>
				</thead>
				<tbody>';
	for ($i = 0; $i < $this->tamCuent; $i++) { 
		$this->html.='
					<tr>
						<th id="tdh">'.$this->infCuent[$i]['cvecta'].'</th>
						<th colspan="5" id="tdh">'.$this->infCuent[$i]['nomcta'].'</th>
					</tr>';
		for($j=0; $j<=$this->tamAreas; $j++){

			if($this->arreInverciones[$i][$j]!='0.0' && $this->arreInverciones[$i][$j]!=''){
				if($this->NomDirec[$j]['cosin']==0){
				$this->html.='
					<tr>
						<td id="tdd">100</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$j]['desc'].'</td>
						<td id="tdd" align="right">'.$this->arreInverciones[$i][$j].'</td>
						<td id="tdd" align="right">'.$this->arreDepreciaciones[$i][$j].'</td>
					</tr>';
				}else if($this->NomDirec[$j]['cosin']==1000){
				$this->html.='
					<tr>
						<td id="tdd">----</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$j]['desc'].'</td>
						<td id="tdd" align="right">'.$this->arreInverciones[$i][$j].'</td>
						<td id="tdd" align="right">'.$this->arreDepreciaciones[$i][$j].'</td>
					</tr>';
				}else{
				$this->html.='
					<tr>
						<td id="tdd">'.$this->NomDirec[$j]['cosin'].'</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$j]['desc'].'</td>
						<td id="tdd" align="right">'.$this->arreInverciones[$i][$j].'</td>
						<td id="tdd" align="right">'.$this->arreDepreciaciones[$i][$j].'</td>
					</tr>';
				}
			
		
			}
		}						
		
	$this->html.='
					<tr>
						<td id="tdTot" align="center" colspan = "3">T O T A L</td>
						<td id="tdTot" align="right">'.$this->totinvent[$i].'</td>
						<td id="tdTot" align="right">'.$this->totdepres[$i].'</td>
					</tr>
					';
	}
 $this->html.='</tbody>
			</table>
		</div>
		';

	//	echo $this->html;
	}


	public function ImprimirMPDF(){
		$mpdf = new mPDF('c','A4','','',15,15,45,15,10,10);
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->writeHTML($this->html);
		$mpdf->Output('SaldosInvDpreCtaCont.pdf','I');
	}

	public function MetodoDeAccesoParaIniciar($ct, $fi,$ff){
		$sqldet = "SELECT USUARIO, CLAVE, IP, SID, DB_NAME FROM C_DBLINKS WHERE CT_CLAVE = $ct";
		$stmtdt = oci_parse($this->con2, $sqldet);
		oci_execute($stmtdt);
		$row = oci_fetch_array($stmtdt, OCI_BOTH);

        //$resu = $row['USUARIO'];
		//$ssap = $row['CLAVE'];
		//$tsoh = $row['IP'];
		//$abad = $row['SID'];
		$this->name = $row['DB_NAME'];

		//$this->conn =  new PDO("oci:dbname=$tsoh/$abad;charset=utf8" ,$resu ,$ssap);

		$this->cvect = $ct; 
		$datei = date_create($fi);//fechas iniciales
		$fechai = date_format($datei, 'd/m/Y');
		$this->fecin = $fechai;
		$datef = date_create($ff);//fechas finales
		$fechaf = date_format($datef, 'd/m/Y');
		$this->fecfi = $fechaf;
		$this->ObtenCentroT($this->cvect);
		
		$this->ConsultasObtDirecciones();

	//	$this->ConsultasObtCuentas();
	//	$this->obtenerCedulas();
////
		//$this->Estructura_HTML_PDF_CTL_PAGOS(); //19Y04K22V9Y
		//$this->ImprimirMPDF(); 
	}


}//endclass

	$ob = new InvDpreCtaCont(); 
	$ob->MetodoDeAccesoParaIniciar($_REQUEST['ct'],  $_REQUEST['fi'], $_REQUEST['ff']);


 ?>

