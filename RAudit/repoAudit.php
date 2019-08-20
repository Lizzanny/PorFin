<?php
/**
 * 	Autor: Ing.Elias Alejandro Morales Macera
 *	Fecha inicio: 08/08/2019 12:44 
 *	Fecha  Final: 
 * 	Descripcion: 
 *  Modificacion: 
 *	
 */
include_once '../Libs/ConexionOracle.php'; 
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class repoteAditoria extends ConexionOracle{
	//atributos 
	private $numfilaaltas=0;
	

	//construtor 
	function __construct(){
		parent::__construct();
	}

	
	private function obtenerInformacionAltas(){
	$conn=$this->IniciarConexion2PDO(); //realizo llamada a metodo de conexion pdo oracle //print_r($conn); 
	$altas=array(); 
	$sql= "SELECT CUENTA, CENTRO_TRABAJO, CEDULA, ACTIVO, CONTCC, CONTSC, CONTSSC, CONTSSSC, CONTDES, CONTFECHADQ, CONTFACTURA, CONTCOSTO,CONTORIGBIEN, CONTASADEP, CONTFECHCAP, CONTFECHDEP, CONTPOLIZA, CONTREFALTAS, CONTREFBAJAS, CONTABONO, CONTFECHMOV, CONTDEPMEN, CONTDEPANUAL, CONTDEPACUM, CONTSALXDEP, CONTBAJADEP, CONTMESDEP, CONTFECHDETDEP, CONTFECHBAJA FROM INFOAUDITORIA";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

		for ($i=0; $row = $stmt->fetch(PDO::FETCH_ASSOC); $i++) {
        	$altas[$i] =array(	$row['CUENTA'], 
								$row['CENTRO_TRABAJO'], 
								$row['CEDULA'], 
								$row['ACTIVO'], 
								$row['CONTCC'], 
								$row['CONTSC'], 
								$row['CONTSSC'], 
								$row['CONTSSSC'], 
								$row['CONTDES'], 
								$row['CONTFECHADQ'], 
								$row['CONTFACTURA'], 
								$row['CONTCOSTO'], 
								$row['CONTORIGBIEN'], 
								$row['CONTASADEP'], 
								$row['CONTFECHCAP'], 
								$row['CONTFECHDEP'], 
								$row['CONTPOLIZA'], 
								$row['CONTREFALTAS'], 
								$row['CONTREFBAJAS'], 
								$row['CONTABONO'], 
								$row['CONTFECHMOV'], 
								$row['CONTDEPMEN'], 
								$row['CONTDEPANUAL'], 
								$row['CONTDEPACUM'], 
								$row['CONTSALXDEP'], 
								$row['CONTBAJADEP'], 
								$row['CONTMESDEP'], 
								$row['CONTFECHDETDEP'], 
								$row['CONTFECHBAJA']        		
							);
        	unset($row); //eliminamos la fila para evitar sobrecargar la memoria
        }

        // Ya se ha terminado; se cierra
        $stmt = null;//cerrar consulta
		$conn = null;//cerrar conexion
        //echo json_encode($altas);
        $this->numfilaaltas=sizeof($altas); 
        return $altas;
        	//print_r($altas);
        unset($altas);	
	}		

	//metodo de acceso 
	public function generarRepoterAquisiciones(){
		$this->descargaReporte();//
	}

	private function descargaReporte(){
		//ini_set(“memory_limit”,”16M“);
		ini_set("memory_limit","1024M");
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
		 
		$nombreDelDocumento = "IntegracionContableAuditores.xlsx";
		/**
		 * Los siguientes encabezados son necesarios para que
		 * el navegador entienda que no le estamos mandando
		 * simple HTML
		 * Por cierto: no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
		 */

		$titCol = array( "CUENTA", "CENTRO_TRABAJO", "CEDULA", "ACTIVO", "CONTCC", "CONTSC", "CONTSSC", "CONTSSSC", "CONTDES", "CONTFECHADQ", "CONTFACTURA", "CONTCOSTO", "CONTORIGBIEN", "CONTASADEP", "CONTFECHCAP", "CONTFECHDEP", "CONTPOLIZA", "CONTREFALTAS", "CONTREFBAJAS", "CONTABONO", "CONTFECHMOV", "CONTDEPMEN", "CONTDEPANUAL", "CONTDEPACUM", "CONTSALXDEP", "CONTBAJADEP", "CONTMESDEP", "CONTFECHDETDEP", "CONTFECHBAJA");

		$tamTitle= sizeof($titCol); 

		$hoja = $documento->getActiveSheet();
		$hoja->setTitle('datos de informacion');

			//encabezados 
			for ($i=0; $i <$tamTitle; $i++) { 
				$hoja->setCellValueByColumnAndRow(($i+1), 1,$titCol[$i]);
			} 
/**/
		$conn=$this->IniciarConexion2PDO(); //realizo llamada a metodo de conexion pdo oracle //print_r($conn); 

		//informacion 
			$sql= "SELECT CUENTA, CENTRO_TRABAJO, CEDULA, ACTIVO, CONTCC, CONTSC, CONTSSC, CONTSSSC, CONTDES, CONTFECHADQ, CONTFACTURA, CONTCOSTO,CONTORIGBIEN, CONTASADEP, CONTFECHCAP, CONTFECHDEP, CONTPOLIZA, CONTREFALTAS, CONTREFBAJAS, CONTABONO, CONTFECHMOV, CONTDEPMEN, CONTDEPANUAL, CONTDEPACUM, CONTSALXDEP, CONTBAJADEP, CONTMESDEP, CONTFECHDETDEP, CONTFECHBAJA FROM INFOAUDITORIA";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

		for ($i=0; $row = $stmt->fetch(PDO::FETCH_ASSOC); $i++) {
			for ($j=0; $j <29 ; $j++) { 
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CUENTA']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CENTRO_TRABAJO']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CEDULA']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['ACTIVO']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTCC']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTSC']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTSSC']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTSSSC']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTDES']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTFECHADQ']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTFACTURA']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTCOSTO']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTORIGBIEN']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTASADEP']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTFECHCAP']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTFECHDEP']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTPOLIZA']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTREFALTAS']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTREFBAJAS']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTABONO']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTFECHMOV']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTDEPMEN']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTDEPANUAL']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTDEPACUM']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTSALXDEP']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTBAJADEP']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTMESDEP']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTFECHDETDEP']);
				$hoja->setCellValueByColumnAndRow(($j+1), ($i+2),$row['CONTFECHBAJA']);
			}
			unset($row); //eliminamos la fila para evitar sobrecargar la memoria
		}

		
        $stmt = null;//cerrar consulta
		$conn = null;//cerrar conexion
    /* */

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
	$ob = new repoteAditoria(); 
	
	$ob->generarRepoterAquisiciones(); 
	$ob->cerrarConexion2(); 
 ?>




