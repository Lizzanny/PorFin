<?php
/*Autor: Elias Alejandro
  Fecha Inicio:  Miercoles 10/Julio/2019
  Fecha Termino:  Viernes 12/Julio/2019
  Descripcion: 
    Este metodo realiza el testeo de las base de datos remotas alas que se quiere conectar
    esto con el fin de comprobar la conexion y generar un reporte
*/
include_once '../Libs/ConexionOracle.php'; 
include_once 'teste.php';
//excel 
class Cedulas extends ClaseTesteo{

  
    public function getconexionremota(){
        //echo $this->cnx[0]['host']; 
        $co = oci_connect($this->cnx[0]['user'], $this->cnx[0]['pass'], "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->cnx[0]['host']." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$this->cnx[0]['base'].")))");
            // Seleccion de la base de datos 
            if(!$co){
                $error = oci_error();
                trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
               //echo 'u.u   xdxxx';
            }else{
                $this->getInformacionCedulas($co); 
               //echo "conexion exitosa de php a oracle <br> xxsss";
            }
    }

    public function getInformacionCedulas($co){
        $inf=array(); 
        $sql="SELECT
        CUENTAS.CCDES CUENTA,
        CEDULAS.CONTCT CENTRO_TRABAJO,
        CEDULAS.CONTNUM CEDULA,
        NVL((GetNumActivoxCed(CEDULAS.CONTCT,CEDULAS.CONTNUM)),'----') AS NUMACT,
        CEDULAS.CONTCC,
        CEDULAS.CONTSC,
        CEDULAS.CONTSSC,
        CEDULAS.CONTSSSC,
        NVL(CEDULAS.CONTDES,'----') AS CONTDES,
        NVL(CEDULAS.CONTFECHADQ,'----') AS CONTFECHADQ,
        CEDULAS.CONTFACTURA,
        CEDULAS.CONTCOSTO,
        NVL(CEDULAS.CONTORIGBIEN, '----') AS CONTORIGBIEN,
        CEDULAS.CONTASADEP,
        CEDULAS.CONTFECHCAP,
        CEDULAS.CONTFECHDEP,
        NVL(CEDULAS.CONTPOLIZA, '----') AS CONTPOLIZA,
        NVL(CEDULAS.CONTREFALTAS, '----') AS CONTREFALTAS,
        NVL(CEDULAS.CONTREFBAJAS, '----') AS CONTREFBAJAS,
        NVL(CEDULAS.CONTABONO,'----') AS CONTABONO,
        CEDULAS.CONTFECHMOV,
        CEDULAS.CONTDEPMEN,
        CEDULAS.CONTDEPANUAL,
        CEDULAS.CONTDEPACUM,
        CEDULAS.CONTSALXDEP,
        CEDULAS.CONTBAJADEP,
        CEDULAS.CONTMESDEP,
        NVL(CEDULAS.CONTFECHDETDEP,'----') AS CONTFECHDETDEP,
        CEDULAS.CONTFECHBAJA
        FROM CEDULAS,CUENTAS
        WHERE CEDULAS.CONTCC=CUENTAS.CCNUM AND CEDULAS.CONTFECHMOV <= TO_DATE('31122018','DDMMYYYY')
        ORDER BY 2,3"; 

        $stmt = oci_parse($co, $sql);
        oci_execute($stmt);

        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
            $inf[$i] = array('cuenta' => $row['CUENTA'],
                             'centro' => $row['CENTRO_TRABAJO'],
                             'cedula' => $row['CEDULA'],
                             'numact' => $row['NUMACT'],
                             'contcc' => $row['CONTCC'],
                             'contsc' => $row['CONTSC'],
                             'contssc' => $row['CONTSSC'],
                             'contsssc' => $row['CONTSSSC'],
                             'contdes' => $row['CONTDES'],
                             'contfechadq' => $row['CONTFECHADQ'],
                             'contfactura' => $row['CONTFACTURA'],
                             'contcosto' => $row['CONTCOSTO'],
                             'contorigbien' => $row['CONTORIGBIEN'],
                             'contasadep' => $row['CONTASADEP'],
                             'contfechcap' => $row['CONTFECHCAP'],
                             'contfechdep' => $row['CONTFECHDEP'],
                             'contpoliza' => $row['CONTPOLIZA'],
                             'contrefaltas' => $row['CONTREFALTAS'],
                             'contrefbajas' => $row['CONTREFBAJAS'],
                             'contabono' => $row['CONTABONO'],
                             'contfechmov' => $row['CONTFECHMOV'],
                             'contdepmen' => $row['CONTDEPMEN'],
                             'contdepanual' => $row['CONTDEPANUAL'],
                             'contdepacum' => $row['CONTDEPACUM'],
                             'contsalxdep' => $row['CONTSALXDEP'],
                             'contbajadep' => $row['CONTBAJADEP'],
                             'contmesdep' => $row['CONTMESDEP'],
                             'contfechdetdep' => $row['CONTFECHDETDEP'],
                             'contfechbaja' => $row['CONTFECHBAJA']);
        }
        oci_free_statement($stmt);
        oci_close($co);

        echo json_encode($inf);
        //
      //  $this->hojaExecel($inf); 
    }

    public function hojaExecel(){
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('America/Mexico_City');

        //comprueba si se está accediento al archivo vía HTTP
        if (PHP_SAPI == 'cli')
        die('Este ejemplo sólo se puede ejecutar desde un navegador Web');   
        //Se inicia con el proceso de creación del reporte en excel
        require_once dirname(__FILE__) . '../Libs/PHPExcel.php';
        //include '../publico/PHPExcel.php';
        // include '../publico/PHPExcel/Calculation.php';
        // include '../publico/PHPExcel/Cell.php';
        
    // Cambia estos valores para seleccionar la biblioteca de renderizado que deseas usar
    // y su ubicación de directorio en su servidor
    $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
    $rendererLibrary = 'mpdf';
    $rendererLibraryPath = dirname(__FILE__).'./publico/' . $rendererLibrary;

    $objPHPExcel = new PHPExcel();

  // Colocamos la propiedades del documento
    $objPHPExcel->getProperties()
       ->setCreator("Elias Alejandro Morales Mancera")//Nombre del autor
       ->setLastModifiedBy("EAMM")//Ultimo usuario que lo modificó
       ->setTitle("Inventario de Medicamentos")//Titulo
       ->setSubject("Medicementos")//Asunto
       ->setDescription("Documento para generar el excel")//Descripcion
       ->setKeywords("inventario de medicamentos")//Etiquetas
       ->setCategory("Medicamentos");//Categorias 

//Crearemos los encabezados que contendrá el reporte
   $tituloReporte = "Inventarios De Medicamentos";
   $tit_colum = array('Clave','Clave Sicop', 'Descripcion', 'Bioequivalencia','Sicop Sustancias Activas','Cantidad Cajas','Cucop','Fecha de Caducidad','Maximo_Requerido','Stock','Cantidad adquirir','Indicacion','Estatus');

// Combino las celdas desde A1 hasta M1
    $objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:M1');
    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue('A1', $tituloReporte)   // Titulo del reporte
     ->setCellValue('A3', $tit_colum[0])    //Titulo de las columnas
     ->setCellValue('B3', $tit_colum[1])
     ->setCellValue('C3', $tit_colum[2])
     ->setCellValue('D3', $tit_colum[3])
     ->setCellValue('E3', $tit_colum[4])
     ->setCellValue('F3', $tit_colum[5])
     ->setCellValue('G3', $tit_colum[6])
     ->setCellValue('H3', $tit_colum[7])
     ->setCellValue('I3', $tit_colum[8])
     ->setCellValue('J3', $tit_colum[9])
     ->setCellValue('K3', $tit_colum[10])
     ->setCellValue('L3', $tit_colum[11])
     ->setCellValue('M3', $tit_colum[12]);

 $x=0;
  for ($i=4; $i <$this->contmax; $i++) { 
      //echo "---------> $i<br>";
   $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A'.$i,$this->cvemed[$x])
      ->setCellValue('B'.$i,$this->cvesic[$x])
      ->setCellValue('C'.$i,$this->descri[$x])
      ->setCellValue('D'.$i,$this->bioequ[$x])
      ->setCellValue('E'.$i,$this->cveact[$x])
      ->setCellValue('F'.$i,$this->cantca[$x])
      ->setCellValue('G'.$i,$this->cucopm[$x])
      ->setCellValue('H'.$i,$this->feccad[$x])
      ->setCellValue('I'.$i,$this->maximo[$x])
      ->setCellValue('J'.$i,$this->stockm[$x])
      ->setCellValue('K'.$i,$this->cantaq[$x])
      ->setCellValue('L'.$i,$this->indica[$x])
      ->setCellValue('M'.$i,$this->cvestu[$x]);
      $x++;
 }
// -----------------ESTILOS-----------
$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>18,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
  'rotation'   => 90,
        'startcolor' => array(
            'rgb' => 'c47cf2'
        ),
        'endcolor' => array(
            'argb' => 'FF431a5d'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));


    //Definir las los estilos de los encabezados
    $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);

  for($i = 'A'; $i <= 'M'; $i++){       
     $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
  }

    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('MEDICAMENTOS');
    
    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
   $objPHPExcel->setActiveSheetIndex(0);
   //Establece la propiedad adjunta mostrar líneas de grilla.
   $objPHPExcel->getActiveSheet()->setShowGridLines(true);

  if (!PHPExcel_Settings::setPdfRenderer(
      $rendererName,
      $rendererLibraryPath
    )) {
    die(
      'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
      '<br />' .
      'at the top of this script as appropriate for your directory structure'
    );
  }


   
   // Redirect output to a client’s web browser (PDF)
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="01simple.pdf"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
    $objWriter->save('php://output');
    exit;

        

    }
    



}

$ob = new Cedulas();
$ob->getconexionremota();  
$ob->cerrarConexion2(); 
?>