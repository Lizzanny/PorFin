<?php
/**
 * 	Autor: Ing.Elias Alejandro Morales Macera
 *	Fecha inicio: 08/08/2019 12:44 
 *	Fecha  Final: 
 * 	Descripcion: 
 *  Modificacion: 
 *	
 */
include_once '../../Libs/ConexionOracle.php'; 
require_once('../../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class repoteAdquisiciones extends ConexionOracle{
	//atributos 
	private $nomCedula=''; 
	private $numfilaaltas=0;
	private $numfilabaja=0;
	private $totalregist=0; 

	//construtor 
	function __construct(){
		parent::__construct();
	}

	//TIPO MOVIMIENTO (TIPOMOV)1 ALTA ! 2 BAJA
	private function obtenerInformacionAltas($cvecedula){
	$conn=$this->IniciarConexion2PDO(); //realizo llamada a metodo de conexion pdo oracle //print_r($conn); 
	$altas=array(); 
	$sql= "SELECT ID,CONTCT,CONTNUM,CONTCC,CONTSSC,CONTSSSC,HBNUMERO,CONTDES,CONTMARCA,CONTMODELO,CONTSERIE,CONTFECHCAP,CONTFACTURA,CONTABONO,CONTBAJADEP,TIPOMOV,CTDESCRIP,CCDES FROM TAB_ALTASYBAJAS WHERE CONTCC=$cvecedula AND TIPOMOV=1 ORDER BY CONTCT";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

		for ($i=0; $row = $stmt->fetch(PDO::FETCH_ASSOC); $i++) {
        	$altas[$i] =array(	$row['ID'], 
								$row['CONTCT'], 
								$row['CONTNUM'], 
								$row['CONTCC'], 
								$row['CONTSSC'], 
								$row['CONTSSSC'], 
								$row['HBNUMERO'], 
								$row['CONTDES'], 
								$row['CONTMARCA'], 
								$row['CONTMODELO'], 
								$row['CONTSERIE'], 
								$row['CONTFECHCAP'], 
								$row['CONTFACTURA'], 
								$row['CONTABONO'], 
								$row['CONTBAJADEP'], 
								$row['TIPOMOV'], 
								$row['CTDESCRIP'], 
								$row['CCDES']        		
							);
        	unset($row); //eliminamos la fila para evitar sobrecargar la memoria
        }
        $altas[]= array('*****','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','*****');
        // Ya se ha terminado; se cierra
        $stmt = null;//cerrar consulta
		$conn = null;//cerrar conexion
        //echo json_encode($altas);
        $this->numfilaaltas=sizeof($altas); 
        return $altas;
        unset($altas);	
	}		

	//Tipo MOVIMIENTO 1 ALTA ! 2 BAJA
	private function obtenerInformacionBajas($cvecedula){
	$conn=$this->IniciarConexion2PDO(); //realizo llamada a metodo de conexion pdo oracle //print_r($conn); 
	$bajas=array(); 
	$sql= "SELECT ID,CONTCT,CONTNUM,CONTCC,CONTSSC,CONTSSSC,HBNUMERO,CONTDES,CONTMARCA,CONTMODELO,CONTSERIE,CONTFECHCAP,CONTFACTURA,CONTABONO,CONTBAJADEP,TIPOMOV,CTDESCRIP,CCDES FROM TAB_ALTASYBAJAS WHERE CONTCC=$cvecedula AND TIPOMOV=2 ORDER BY CONTCT";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

		for ($i=0; $row = $stmt->fetch(PDO::FETCH_ASSOC); $i++) {
        	$bajas[$i] =array(	$row['ID'], 
								$row['CONTCT'], 
								$row['CONTNUM'], 
								$row['CONTCC'], 
								$row['CONTSSC'], 
								$row['CONTSSSC'], 
								$row['HBNUMERO'], 
								$row['CONTDES'], 
								$row['CONTMARCA'], 
								$row['CONTMODELO'], 
								$row['CONTSERIE'], 
								$row['CONTFECHCAP'], 
								$row['CONTFACTURA'], 
								$row['CONTABONO'], 
								$row['CONTBAJADEP'], 
								$row['TIPOMOV'], 
								$row['CTDESCRIP'], 
								$row['CCDES']        		
							);
        	unset($row); //eliminamos la fila para evitar sobrecargar la memoria
        }
       $bajas[]= array('*****','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','-----','*****');
        // Ya se ha terminado; se cierra
        $stmt = null;//cerrar consulta
		$conn = null;//cerrar conexion
        //echo json_encode($bajas);
        $this->numfilabaja=sizeof($bajas); 
        return $bajas;
        unset($bajas);
	}

	private function unirInformacionAltasBajas($altas, $bajas){
		$total = array();
		for ($i=0; $i <$this->numfilaaltas ; $i++) { //filas
				$total[$i]= $altas[$i];
		}
		for ($i=0; $i <$this->numfilabaja ; $i++) { //filas
				$total[]=$bajas[$i];
		}
		//print_r($total);
		//for ($i=0; $i <$tamanio ; $i++) { //filas
		//	echo $total[$i][$j];
		//}
		return $total;
		unset($total);  
	}


	//metodo de acceso 
	public function generarRepoterAquisiciones($clave, $nombre){
		$this->nomCedula=$nombre; 
		$dataalta=$this->obtenerInformacionAltas($clave);
		$databaja=$this->obtenerInformacionBajas($clave); 
		$this->totalregist= ($this->numfilaaltas+$this->numfilabaja); //suma a+b = total de registros
		$totalrow= $this->unirInformacionAltasBajas($dataalta,$databaja);
		$this->descargaReporte($totalrow);
		unset($dataalta,$databaja,$totalrow);// destruir más de una variable 
	}


	private function descargaReporte($dt){


		$documento = new Spreadsheet();
		$documento
		    ->getProperties()
		    ->setCreator("Aquí va el creador, como cadena")
		    ->setLastModifiedBy('Parzibyte') // última vez modificado por
		    ->setTitle('Mi primer documento creado con PhpSpreadSheet')
		    ->setSubject('El asunto')
		    ->setDescription('Este documento fue generado para parzibyte.me')
		    ->setKeywords('etiquetas o palabras clave separadas por espacios')
		    ->setCategory('La categoría');
		 
		$nombreDelDocumento = "".$this->nomCedula.".xlsx";
		/**
		 * Los siguientes encabezados son necesarios para que
		 * el navegador entienda que no le estamos mandando
		 * simple HTML
		 * Por cierto: no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
		 */


		$titCol = array("ID","CT.","CEDULA NUM.","CTA.","SSC","SSSC","ACTIVO NÚMERO","DESCRIPCIÓN","MARCA","MODELO","SERIE","FECHA DE ADQUISICIÓN","FACTURA","VALOR DE ADQUIISICIÓN","DEPRECIACIÓN ACUMULADA", "TIPOMOV", "CENTRO TRABAJO", "DESCRIPCIÓN DE CEDULA");
		$tamTitle= sizeof($titCol); 

		$hoja = $documento->getActiveSheet();
		$hoja->setTitle($this->nomCedula);

			//encabezados 
			for ($i=0; $i <$tamTitle; $i++) { 
				$hoja->setCellValueByColumnAndRow(($i+1), 1,$titCol[$i]);
			} 
			//informacion 
			for ($i=0; $i <$this->totalregist; $i++) {//filas 
				for ($j=0; $j <18; $j++) { //columnas
					$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$dt[$i][$j]);
				}
			}
		 
		$writer = new Xlsx($documento);
		 
		//Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
		header('Cache-Control: max-age=0');
		
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		 
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0
		 
		$writer = IOFactory::createWriter($documento, 'Xlsx');
		$writer->save('php://output');
		
		exit;
	}

}//myClassEnd
	$ob = new repoteAdquisiciones(); 
	
	$ob->generarRepoterAquisiciones($_GET['clave'],$_GET['nombre']); 
	$ob->cerrarConexion2(); 
 ?>




