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
	
	//DIRECCIONES DE AREAS 
	private $tamAreas=0; 
	private $NomDirec = array();

	//DIRECCIONES DE CUENTAS
	private $tamCuent=0;
	private $infCuent= array();


	function __construct(){
		parent::__construct();
	}

	private function ConsultasObtDirecciones(){
		$this->fesha = date("d-m-Y");

		$indi=0;
		for ($i=100; $i <=900; $i=$i+100) { 
			//echo "el valor de i es: ".$i."<br>";
			$sql="SELECT CCDESCRIP,CCCENCOS FROM CENTROS_DE_COSTO WHERE CCCENCOS = $i AND CTCENTRAB = 101"; 
			$stmt = oci_parse($this->con2, $sql);
			oci_execute($stmt);
			$row = oci_fetch_array($stmt, OCI_BOTH);
			//echo $row['CCDESCRIP'];
			$this->NomDirec[$indi]= array('desc' =>$row['CCDESCRIP'],
					'cosin'=> (int)$row[CCCENCOS],
					'cosfn'=> $row[CCCENCOS]+99
					 );/**/
			$indi++; 
		}
		$this->tamAreas=sizeof($this->NomDirec);
		//echo "".$this->tamAreas."";
		//echo json_encode($this->NomDirec);
		//aqui van las consultas
	}


	private function ConsultasObtCuentas(){

		//echo "el valor de i es: ".$i."<br>";
		$sql="SELECT CCNUM, CCDES FROM CUENTAS"; 
		$stmt = oci_parse($this->con2, $sql);
		oci_execute($stmt);
		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
		//echo $row['CCDESCRIP'];
			$this->infCuent[$i]= array('cvecta' => (int)$row['CCNUM'],
									'nomcta' => $row[CCDES]
					 );
		}
		$this->tamCuent=sizeof($this->infCuent);
		//echo "".$this->tamAreas."";
		//echo json_encode($this->infCuent);
		//aqui van las consultas
	}

	private function ObtenCentroT($cvect){

		//echo "el valor de i es: ".$i."<br>";
		$sql="SELECT CTDESCRIP FROM ACTFIJ.CENTROS_DE_TRABAJO WHERE CTCENTRAB=$cvect"; 
		$stmt = oci_parse($this->con2, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt, OCI_BOTH);
			$this->centro = $row['CTDESCRIP'];
		
	}

	private function unicornioazulmoradorosaverdeidiotastodosvallansealdemonio(){
		$costo = array();
		$depre = array();
		$CONTFECHDEP = array();
		$DFECHAFINDEP = array();
		$CONTDEPMEN = array();
		for ($i=0; $i < $this->tamCuent; $i++) { 
			for ($j=0; $j < $this->tamAreas; $j++) { 
				$sql = "SELECT ACTIVOS.CTCENTRAB, ACTIVOS.CCCENCOS,CEDULAS.CONTCC, CEDULAS.CONTCOSTO
						FROM CEDULAS 
						INNER JOIN ACTIVOS 
						ON CEDULAS.CONTCT = ACTIVOS.CONTCT
						AND CEDULAS.CONTNUM = ACTIVOS.CONTNUM
						WHERE ACTIVOS.CTCENTRAB = $this->cvect AND (ACTIVOS.CCCENCOS BETWEEN ".$this->NomDirec[$j]['cosin']." AND ".$this->NomDirec[$j]['cosfn'].") AND CEDULAS.CONTCC = ".$this->infCuent[$i]['cvecta']." AND CEDULAS.CONTFECHMOV  <=TO_DATE('".$this->fecfi."', 'DD/MM/YY') AND 
					(CEDULAS.CONTFECHBAJA is NULL OR CEDULAS.CONTFECHBAJA >= TO_DATE('".$this->fecfi."', 'DD/MM/YY'))";
					
					echo $sql.'<br>';
				$stmt = oci_parse($this->con2, $sql);
				oci_execute($stmt);
				
				//$valor=0; 
				$sqlol = "SELECT CEDULAS.CONTFECHDEP AS FECINIDEP, CEDULAS.CONTMESDEP AS MESDEP, Add_Months(CEDULAS.CONTFECHDEP+3,CEDULAS.CONTMESDEP-1) AS DFECHAFINDEP,
  							 CASE
    							WHEN
  							    CEDULAS.CONTSSSC = 2 OR
  							    CEDULAS.CONTSALXDEP = 0
  							    OR CEDULAS.CONTCOSTO = CEDULAS.CONTABONO
  							  THEN
  							        0
  							  ELSE
  							    CEDULAS.CONTDEPMEN
  							END AS CONTDEPMEN
						FROM
							  CEDULAS
							  INNER JOIN ACTIVOS 
													ON CEDULAS.CONTCT = ACTIVOS.CONTCT
													AND CEDULAS.CONTNUM = ACTIVOS.CONTNUM
							 WHERE ACTIVOS.CTCENTRAB = $this->cvect AND (ACTIVOS.CCCENCOS BETWEEN ".$this->NomDirec[$j]['cosin']." AND ".$this->NomDirec[$j]['cosfn'].") AND CEDULAS.CONTCC = ".$this->infCuent[$i]['cvecta'];
				$stmt2 = oci_parse($this->con2, $sqlol);
				oci_execute($stmt2);

				//echo $sqlol.'<br>';
				for ($k=0; $row2 = oci_fetch_array($stmt2, OCI_BOTH); $k++) { 
					$CONTFECHDEP[$i][$j][$k] = $row2['FECINIDEP'];
					$DFECHAFINDEP[$i][$j][$k] = $row2['DFECHAFINDEP'];
					$CONTDEPMEN[$i][$j][$k] = $row2['CONTDEPMEN'];
				}
				
				

				for ($k=0; $row = oci_fetch_array($stmt, OCI_BOTH); $k++) { 
					$costo[$i][$j][$k] = $row['CONTCOSTO'];
				}
			}
			
		}

		//	$this->tamanoArreglo($costo, $CONTFECHDEP, $DFECHAFINDEP, $CONTDEPMEN);
	}
/*
*el tamaño del arreglo de costos es igual al de depreciacion
*sigui insistiindi qui lis cimintiriis sirvin piri piri virgui
 */
	public function tamanoArreglo($costo, $CONTFECHDEP, $DFECHAFINDEP, $CONTDEPMEN){
		$tam_costo  = array();
		//$tam_depre  = array();
		for ($i=0; $i < $this->tamCuent; $i++) { 
			for ($j=0; $j < $this->tamAreas; $j++) { 
				$tam_costo[$i][$j] = count($costo[$i][$j]);
			}
		}
		//echo json_encode($tam_costo);
		$this->pasaDatosArreglo($costo, $tam_costo, $CONTFECHDEP, $DFECHAFINDEP, $CONTDEPMEN);
		
	}



	public function pasaDatosArreglo($costo, $tamarr, $CONTFECHDEP, $DFECHAFINDEP, $CONTDEPMEN){
		$alm_costos = array();
		$totcostos = array();
		$tTotalInv = 0;
		for ($i=0; $i < $this->tamCuent; $i++) { 
			$totcost = 0;
			for ($j=0; $j < $this->tamAreas; $j++) {
				$sumcos = 0; 
				for ($k=0; $k < $tamarr[$i][$j]; $k++) { 
					$sumcos = $sumcos + $costo[$i][$j][$k];
					$alm_costos[$i][$j] = $this->LibFormatoMoneda($sumcos);
				}
				
				$totcost = $totcost + $sumcos;
			}

			$tTotalInv = $tTotalInv + $totcost;
			$totcostos[$i] = $this->LibFormatoMoneda($totcost);
		}
		$tTotalInv = $this->LibFormatoMoneda($tTotalInv);
		//echo json_encode($alm_costos);
		$this->pasaDepres($tamarr, $CONTFECHDEP, $DFECHAFINDEP, $CONTDEPMEN, $alm_costos, $totcostos, $tTotalInv);
	}

	public function pasaDepres($tamarr, $CONTFECHDEP, $DFECHAFINDEP, $CONTDEPMEN, $alm_costos, $totcostos, $tTotalInv ){
		
		$alm_depres = array();
		$totdepres = array();
		$tTotalDep = 0;
		for ($i=0; $i < $this->tamCuent; $i++) { 
			//$totcost = 0;
			$totdepr = 0;
			for ($j=0; $j < $this->tamAreas; $j++) {
				//$sumcos = 0; 
				$sumdep = 0;
				for ($k=0; $k < $tamarr[$i][$j]; $k++) { 
					if($DFECHAFINDEP[$i][$j][$k]<$this->fecin){
						$sumdep = $sumdep + 0;
					}else{
						$sumdep = $sumdep + $CONTDEPMEN[$i][$j][$k];
					}

					$alm_depres[$i][$j] = $this->LibFormatoMoneda($sumdep);
				}
				
				$totdepr = $totdepr + $sumdep;
				
			}
			$tTotalDep = $tTotalDep + $totdepr;
			$totdepres[$i] = $this->LibFormatoMoneda($totdepr);
		}
		$tTotalDep = $this->LibFormatoMoneda($tTotalDep);
		//echo json_encode($alm_depres);
		$this->Estructura_HTML_PDF_CTL_PAGOS($alm_costos, $alm_depres, $totcostos, $totdepres, $tTotalInv, $tTotalDep);
	}

	public function LibFormatoMoneda($cantidad){
  		$moneda=number_format(($cantidad), 2, '.', ',');
  		return $moneda; 
  	}
	


	public function Estructura_HTML_PDF_CTL_PAGOS($alm_costos, $alm_depres, $totcostos, $totdepres, $tTotalInv, $tTotalDep){
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
				<tbody>
					<tr >
						<td id="tdh">1208</td>
						<td id="tdh" colspan = "4" align="center">MAQUINARIA Y EQUIPO</td>
					</tr>
					';
					for ($i=0; $i < $this->tamAreas; $i++) { 
						if($alm_costos[0][$i]!=''){
				$this->html.= '
					<tr>
						<td id="tdd">'.$this->NomDirec[$i]['cosin'].'</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$i]['desc'].'</td>
						<td id="tdd" align="right">'.$alm_costos[0][$i].'</td>
						<td id="tdd" align="right">'.$alm_depres[0][$i].'</td>
					</tr>	
				';
						}
					}
				$this->html.= '
					<tr>
						<td id="tdr" colspan = "3">TOTAL</td>
						<td id="tdr" align="right">'.$totcostos[0].'</td>
						<td id="tdr" align="right">'.$totdepres[0].'</td>
					</tr>	
				';
			$this->html.='
					<tr>
						<td id="tdh">1212</td>
						<td id="tdh" colspan = "4" align="center">MOBILIARIO Y EQUIPO DE OFICINA</td>
					</tr>';
					for ($i=0; $i < $this->tamAreas; $i++) { 
						if($alm_costos[1][$i]!=''){
			$this->html.= '
					<tr>
						<td id="tdd">'.$this->NomDirec[$i]['cosin'].'</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$i]['desc'].'</td>
						<td id="tdd" align="right">'.$alm_costos[1][$i].'</td>
						<td id="tdd" align="right">'.$alm_depres[1][$i].'</td>
					</tr>	
			';
						}
					}
			$this->html.= '
					<tr>
						<td id="tdr" colspan = "3">TOTAL</td>
						<td id="tdr" align="right">'.$totcostos[1].'</td>
						<td id="tdr" align="right">'.$totdepres[1].'</td>
					</tr>	
				';
					
			$this->html.='
					<tr>
						<td id="tdh">1216</td>
						<td id="tdh" colspan = "4" align="center">EQUIPO DE TRANSPORTE</td>
					</tr>
					';
					for ($i=0; $i < $this->tamAreas; $i++) { 
						if($alm_costos[2][$i]!=''){
			$this->html.= '
					<tr>
						<td id="tdd">'.$this->NomDirec[$i]['cosin'].'</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$i]['desc'].'</td>
						<td id="tdd" align="right">'.$alm_costos[2][$i].'</td>
						<td id="tdd" align="right">'.$alm_depres[2][$i].'</td>
					</tr>	
			';		
						}
					}
			$this->html.= '
					<tr>
						<td id="tdr" colspan = "3">TOTAL</td>
						<td id="tdr" align="right">'.$totcostos[2].'</td>
						<td id="tdr" align="right">'.$totdepres[2].'</td>
					</tr>	
				';
					
			$this->html.='
					<tr>
						<td id="tdh">1220</td>
						<td id="tdh" colspan = "4" align="center">EQUIPO DE TRANSPORTE</td>
					</tr>
					';
					for ($i=0; $i < $this->tamAreas; $i++) { 
						if($alm_costos[3][$i]!=''){
			$this->html.= '
					<tr>
						<td id="tdd">'.$this->NomDirec[$i]['cosin'].'</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$i]['desc'].'</td>
						<td id="tdd" align="right">'.$alm_costos[3][$i].'</td>
						<td id="tdd" align="right">'.$alm_depres[3][$i].'</td>
					</tr>	
			';
						}
					}
						$this->html.= '
					<tr>
						<td id="tdr" colspan = "3">TOTAL</td>
						<td id="tdr" align="right">'.$totcostos[3].'</td>
						<td id="tdr" align="right">'.$totdepres[3].'</td>
					</tr>	
				';
					
			$this->html.='
					<tr>
						<td id="tdh">1228</td>
						<td id="tdh" colspan = "4" align="center">SOFTWARE</td>
					</tr>
					';
					for ($i=0; $i < $this->tamAreas; $i++) { 
						if($alm_costos[4][$i]!=''){
			$this->html.= '
					<tr>
						<td id="tdd">'.$this->NomDirec[$i]['cosin'].'</td>
						<td id="tdd" colspan = "2">'.$this->NomDirec[$i]['desc'].'</td>
						<td id="tdd" align="right">'.$alm_costos[4][$i].'</td>
						<td id="tdd" align="right">'.$alm_depres[4][$i].'</td>
					</tr>	
			';
						}
					}
						$this->html.= '
					<tr>
						<td id="tdr" colspan = "3">TOTAL</td>
						<td id="tdr" align="right">'.$totcostos[4].'</td>
						<td id="tdr" align="right">'.$totdepres[4].'</td>
					</tr>	
				';
					
			$this->html.='
					<tr>
						<td id="tdTot" align="center" colspan = "3">T O T A L</td>
						<td id="tdTot" align="right">'.$tTotalInv.'</td>
						<td id="tdTot" align="right">'.$tTotalDep.'</td>
					</tr>	
				</tbody>
			</table>
		</div>
		';

		echo $this->html;
	}


	public function ImprimirMPDF(){
		$mpdf = new mPDF('c','A4','','',15,15,45,15,10,10);
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->writeHTML($this->html);
		$mpdf->Output('SaldosInvDpreCtaCont.pdf','I');
	}

	public function MetodoDeAccesoParaIniciar($ct, $fi,$ff){
		$this->cvect = $ct; 
		$datei = date_create($fi);//fechas iniciales
		$fechai = date_format($datei, 'd/m/Y');
		$this->fecin = $fechai;
		$datef = date_create($ff);//fechas finales
		$fechaf = date_format($datef, 'd/m/Y');
		$this->fecfi = $fechaf;
		$this->ObtenCentroT($this->cvect);
		$this->ConsultasObtDirecciones();
		$this->ConsultasObtCuentas();
		$this->unicornioazulmoradorosaverdeidiotastodosvallansealdemonio();
		//$this->Cons
		//$this->Estructura_HTML_PDF_CTL_PAGOS(); //19Y04K22V9Y
		//$this->ImprimirMPDF(); 
	}


}//endclass

	$ob = new InvDpreCtaCont(); 
	$ob->MetodoDeAccesoParaIniciar(101,'2019-05-01', '2019-06-11');//$_REQUEST['ct'],  $_REQUEST['fi'], $_REQUEST['ff']);


 ?>

