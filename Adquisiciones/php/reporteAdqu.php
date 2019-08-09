<?php
require "../../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
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
/**
 * Los siguientes encabezados son necesarios para que
 * el navegador entienda que no le estamos mandando
 * simple HTML
 * Por cierto: no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
 */

$titCol = array("CT.","CEDULA NUM.","CTA.","SSC","SSSC","ACTIVO NÚMERO","DESCRIPCIÓN","MARCA","MODELO","SERIE","FECHA DE ADQUISICIÓN","FACTURA","VALOR DE ADQUIISICIÓN","DEPRECIACIÓN ACUMULADA");
		
		$hoja = $documento->getActiveSheet();
		$hoja->setTitle('ejemplo');

		$hoja->setCellValueByColumnAndRow(1, 1,"".$titCol[0]."");
		$hoja->setCellValueByColumnAndRow(1, 2,"".$titCol[1]."");

		$hoja->setCellValue("B2", "Este va en B2");
		$hoja->setCellValue("A3", "Parzibyte");
		 
		$writer = new Xlsx($documento);
 

 // Redirect output to a client’s web browser (Xlsx)
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