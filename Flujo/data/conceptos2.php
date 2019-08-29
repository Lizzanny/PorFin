<?php 
 	
  
 /* $link = mysqli_connect('127.0.0.1','root','') or die ( "No se puede conectar al servidor de base de datos"); 
  mysqli_select_db ($link,"sispali" ) or die ( "No se puede conectar a sispali" ); 
   
   $arr = array (); 
   $rs = mysqli_query ( "SELECT EmployeeID, LastName, FirstName FROM employees" ); 
*/   

/*$usuarioOracle = "sicoa";
     $claveOracle = "sicoa";
	 $hostOracle = "172.30.10.98";
	 $dbaseOracle = "scaoc";*/
	 
	/*$usuarioOracle = "sicop101";
     $claveOracle = "tor222-17";
	 $hostOracle = "172.30.10.98";
	 $dbaseOracle = "dbcpbsicop";*/
	 
	 $usuarioOracle = "PORFINAN";
     $claveOracle = "porfinan1234";
	 $hostOracle = "172.30.10.98";
	 $dbaseOracle = "dbcpbsicop";
	 
header('Content-Type: text/html; charset=utf-8');
	 
header("Content-type: application/json");	 

 $mes = $_REQUEST['mesdesde'];
 $axo = $_REQUEST['axo'];
// echo "concepto " .$mes;
 //echo " axo 1 " .$axo;
$registro = false;
	  try
	  {
				$conn = oci_connect($usuarioOracle, $claveOracle, $hostOracle . '/' . $dbaseOracle);
				mb_internal_encoding("UTF-8");
				/* en caso de que no se conecte a la base se pone esta instruccion $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.30.10.98)(PORT = 1521)))(CONNECT_DATA=(SID=cpbsicop)))";
				$conn = ocilogon("sicop101","tor222-17",$db);*/ 

				//$conn = oci_connect("PORFINAN", "porfinan1234", "172.30.10.98" . '/' . "cpbsicop");
				//echo "hola 1";
		   if(!$conn)
		    {
			  $e = oci_error();
			  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
				
			
			
$query = "SELECT ID, CG, CGDES, SUBCTA, SUBCTADES, PARTIDA, PARTIDADES, CAPITULO, CAPITDESC, C101,
			               C204, C209, C210, C301, C303, C304, C305, C309, C310, C311, C312, C313, C315,
						   C316, C317, C318, C319, C320, C321, C322, C323, C324, C325, C328, C330,
						   C332, C333, C334, C335, C336, C401, C402, C408, C600,  C930, C940,
						   C950, C960,NVL(C999,0) AS C999, TOTAL
			        FROM REP_FLUJOEFECTIVO
					WHERE MES = '$mes'
					  AND EJERCICIO = $axo";
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);
//echo $query;
// Fetch each row in an associative array
//print '<table border="1">';
$arr  = array();
$cont = 0;
for  ( $i = 0; $fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS); $i++) {
   
   
     
	$arr[$i] = array("ID"=>$fila["ID"],
	                 "CG"=>$fila["CG"],
	                 "CGDES"=>  mb_convert_encoding($fila["CGDES"], "UTF-8"),
					 "SUBCTA"=>  $fila["SUBCTA"],
					 "SUBCTADES"=>  mb_convert_encoding($fila["SUBCTADES"], "UTF-8"),
					 "PARTIDA"=>  $fila["PARTIDA"],
					 "PARTIDADES"=>  mb_convert_encoding($fila["PARTIDADES"], "UTF-8"),
					 "CAPITULO"=>  $fila["CAPITULO"],
					 "CAPITDESC"=>  mb_convert_encoding($fila["CAPITDESC"], "UTF-8"),
					 "C101"=>  $fila["C101"],
					 "C204"=>  $fila["C204"],
					 "C209"=>  $fila["C209"],
					 "C210"=>  $fila["C210"],
					 "C301"=>  $fila["C301"],
					 "C303"=>  $fila["C303"],
					  "C304"=>  $fila["C304"],
					 "C305"=>  $fila["C305"],
					 "C309"=>  $fila["C309"],
					 "C310"=>  $fila["C310"],
					 "C311"=>  $fila["C311"],
					  "C312"=>  $fila["C312"],
					 "C313"=>  $fila["C313"],
					 "C315"=>  $fila["C315"],
					 "C316"=>  $fila["C316"],
					 "C317"=>  $fila["C317"],
					  "C318"=>  $fila["C318"],
					 "C319"=>  $fila["C319"],
					 "C320"=>  $fila["C320"],
					 "C321"=>  $fila["C321"],
					 "C322"=>  $fila["C322"],
					 "C323"=>  $fila["C323"],
					 "C324"=>  $fila["C324"],
					 "C325"=>  $fila["C325"],
					 "C328"=>  $fila["C328"],
					 "C330"=>  $fila["C330"],
					  "C332"=>  $fila["C332"],
					 "C333"=>  $fila["C333"],
					  "C334"=>  $fila["C334"],
					 "C335"=>  $fila["C335"],
					 "C336"=>  $fila["C336"],
					 "C401"=>  $fila["C401"],
					  "C402"=>  $fila["C402"],
					 "C408"=>  $fila["C408"],
					 "C600"=>  $fila["C600"],
					 "C930"=>  $fila["C930"],
					 "C940"=>  $fila["C940"],
					  "C950"=>  $fila["C950"],
					 "C960"=>  $fila["C960"],
					 "C999"=>  $fila["C999"],
					 "TOTAL"=>  $fila["TOTAL"]
					 
					 ); 
	 //echo "fila: ". $fila["CGDES"];
	// echo "fila: ". mb_convert_encoding($fila["CGDES"], "UTF-8");
	                   
					 
    
  $cont ++;  
}




				
				oci_free_statement($stid);
			    oci_close ($conn);
				
		}				
		 catch(Exception $ex)
		 {
		  echo $ex -> getMessage() . 'ERROR!!!';
		 }	
		 
		 //return $registro;
		 
		
	 	//Lo convertimos en un arreglo para HTML
        // $respuesta = array("row" => $arr);

       //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    //	header('Content-type: application/json; charset=utf-8');
        //Imprimimos el resultado
	  // echo json_encode($respuesta);
	   //echo json_encode($res);
	 //  echo json_encode($rows);
	 // echo json_encode($registro);
	 header('Content-type: application/json; charset=utf-8');
	//echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	echo "{\"data\":" .json_encode($arr, JSON_UNESCAPED_UNICODE). "}";
	
	//json_encode( $text, JSON_UNESCAPED_UNICODE );
    
   ?> 