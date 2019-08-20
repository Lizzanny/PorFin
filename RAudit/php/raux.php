<?php 

include_once '../../Libs/conexionOracle.php';

class RaUx extends ConexionOracle{

	function __construct(){
		parent::__construct();
	}

	public function obtnerDatosUsuari(){
		$uploaddir="/home/desarrollo/web/portalfinanciero.liconsa.gob.mx/public_html/docutmp/"; 
		$nombre_fichero_tmp = tempnam($uploaddir, "FOO");

		$query = 'SELECT * FROM ACTFIJ.INFOAUDITORIA ORDER BY CENTRO_TRABAJO, CUENTA, CEDULA ASC';
		$stid = oci_parse($this->con2, $query);
		oci_execute($stid);
		
		$myfile=fopen($nombre_fichero_tmp,"w") or die("Unable to open File");
		
		$columns_total = oci_num_fields($stid);
		$output = "";
		for ($i = 1; $i <= $columns_total; $i++) {
		
		   $heading = oci_field_name($stid, $i);
		   $output .= '"'.$heading.'",';
		}
		$output .="\n";
		while(($row=oci_fetch_array($stid,OCI_BOTH))!=false)
		{
		
		  for ($i = 0; $i < $columns_total; $i++) {
		    $output .= '"'.$row[$i].'",';
		
		 }
		 $output .="\n";
		}
		oci_free_statement($stid);
		oci_close($this->con2);
		$filename = "IntegracionContableAuditores.csv";
		header('Content-type: application/excel');
		header('Content-Disposition:attachment; filename='.$filename);
		echo $output;
		exit;

		//fwrite($myfile, $output);
		//echo "Data successfully exported";
		//fclose($myfile);
	}

	
   


}//end class

	$ob = new RaUx(); 
	$ob->obtnerDatosUsuari();
	

 ?>
