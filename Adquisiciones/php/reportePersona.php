<?php 

	/**
	 * Autor: Elias Alejandro 
	 * Fecha: 5/Nov/2019
	 */

	//include 'clasePersona.php';
	require_once('../../vendor/autoload.php');
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	class reportePersona {
		public $estructuraHtml= "";
		public $tituloDocumento="ListaPersonas"; 
		public $totalRegistros=0; 
		
		//function __construct(argument){}
		
		public function getListaCompletaPersonas(){
			$arraydata=array();
			$sql="SELECT p.idpersona, p.cvepersona, p.nombre,p.apellidoP,p.apellidoM ,p.cveSexo,p.fechaNaci,p.curp,p.rfc,p.cveCivil,p.email,p.rutaFoto,p.registrado,p.cveStatus,p.cve_usuario FROM pre0_personas AS p";
			$stmt=$this->connect()->prepare($sql);
			$stmt->execute();
			if($stmt->rowCount()){
				for ($i=0; $row = $stmt->fetch(PDO::FETCH_OBJ); $i++) {
					
					$arraydata[] = array(
						$row->idpersona, 
						$row->cvepersona,
	                    $row->nombre,
	                    $row->apellidoP,
	                  	$row->apellidoM,
	                  	$row->cveSexo,
	                  	$row->fechaNaci,
	                  	$row->curp,
	                  	$row->rfc,
	                  	$row->cveCivil,
	                  	$row->email,
	                  	$row->rutaFoto,
	                  	$row->registrado,
	                  	$row->cveStatus,
	                  	$row->cve_usuario
                  );
				}
			
			}
			$stmt=null;
			//return $arraydata;
			return $arraydata;
		}

		public  function downloadFileExcel(){
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
			 
			$nombreDelDocumento = "Mi primer archivo.xlsx";

			$titCol = array("ID","CT.","CEDULA NUM.","CTA.","SSC","SSSC","ACTIVO NÚMERO","DESCRIPCIÓN","MARCA","MODELO","SERIE","FECHA DE ADQUISICIÓN","FACTURA","VALOR DE ADQUIISICIÓN","DEPRECIACIÓN ACUMULADA", "TIPOMOV", "CENTRO TRABAJO", "DESCRIPCIÓN DE CEDULA");
			$tamTitle= sizeof($titCol); 

			$hoja = $documento->getActiveSheet();
			$hoja->setTitle('listaPersonass');
			/**
			 * Los siguientes encabezados son necesarios para que
			 * el navegador entienda que no le estamos mandando
			 * simple HTML
			 * Por cierto: no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
			 */
				//encabezados 
			for ($i=0; $i <$tamTitle; $i++) { 
				$hoja->setCellValueByColumnAndRow(($i+1), 1,$titCol[$i]);
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



	}


	$ob = new reportePersona(); 
	$ob->downloadFileExcel(); 
 ?>