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
				

$verb = $_SERVER["REQUEST_METHOD"];

	$id = $_POST["ID"];
	echo $_POST["ID"];
	$C101 = $_POST["C101"];
    $C204 = $_POST["C204"];
    $C209 = $_POST["C209"];
    $C210 = $_POST["C210"];
    $C301 = $_POST["C301"];
	$C303 = $_POST["C303"];
    $C304 = $_POST["C304"];
    $C305 = $_POST["C305"];
    $C309 = $_POST["C309"];
    $C310 = $_POST["C310"];
    $C311 = $_POST["C311"];
    $C312 = $_POST["C312"];
    $C313 = $_POST["C313"];
    $C315 = $_POST["C315"];
    $C316 = $_POST["C316"];
    $C317 = $_POST["C317"];
    $C318 = $_POST["C318"];
    $C319 = $_POST["C319"];
    $C320 = $_POST["C320"];
    $C321 = $_POST["C321"];
    $C322 = $_POST["C322"];
    $C323 = $_POST["C323"];
    $C324 = $_POST["C324"];
    $C325 = $_POST["C325"];
    $C328 = $_POST["C328"];
    $C330 = $_POST["C330"];
	$C332 = $_POST["C332"];
    $C333 = $_POST["C333"];
    $C334 = $_POST["C334"];
	if ($C334 == '')
	{
		$C334 = 0;
		}
    $C335 = $_POST["C335"];
    $C336 = $_POST["C336"];
    $C401 = $_POST["C401"];
    $C402 = $_POST["C402"];
    $C408 = $_POST["C408"];
    $C600 = $_POST["C600"];
    $C930 = $_POST["C930"];
    $C940 = $_POST["C940"];
	$C950 = $_POST["C950"];
    $C960 = $_POST["C960"];
    $C999 = $_POST["C999"];	
	if ($C999 == '')
	{
		$C999 = 0;
		}
	
	
/*$C101 = 120;
    $C204 = 150;
    $C209 = 100;
    $C210 = 100;
    $C303 = 100;
    $C304 = 304;
    $C305 = 305;
    $C309 = 309;
    $C310 = 310;
    $C311 = 311;
    $C312 = 312;
    $C313 = 313;
    $C315 =315;
    $C316 = 316;
    $C317 = 317;
    $C318 = 318;
    $C319 = 319;
    $C320 = 320;
    $C321 = 321;
    $C322 =322;
    $C323 = 323;
    $C324 = 324;
    $C325 = 325;
    $C328 = 328;
    $C330 = 330;
	$C332 = 332;
    $C333 = 333;
    $C334 = 334;
    $C335 = 335;
    $C336 = 336;
    $C401 = 401;
    $C402 = 402;
    $C408 = 408;
    $C600 = 600;
    $C930 = 930;
    $C940 = 940;
	$C950 = 950;
    $C960 = 960;
    $C999 = 999;*/		
			
$sql_cv = "UPDATE REP_FLUJOEFECTIVO SET C101 = " .$C101 .",
                             C204 = " .$C204 .",
                             C209 = " .$C209 .",
                             C210 = " .$C210 .",
                             C301 = " .$C301 .",
							 C303 = " .$C303 .",
                             C304 = " .$C304 .",
                             C305 = " .$C305 .",
                             C309 = " .$C309 .",
                             C310 = " .$C310 .",
                             C311 = " .$C311 .",
                             C312 = " .$C312 .",
                             C313 = " .$C313 .",
                             C315 = " .$C315 .",
			     C316 = " .$C316 .",
                             C317 = " .$C317 .",
                             C318 = " .$C318 .",
                             C319 = " .$C319 .",
                             C320 = " .$C320 .",
                             C321 = " .$C321 .",
                             C322 = " .$C322 .",
                             C323 = " .$C323 .",
                             C324 = " .$C324 .",
                             C325 = " .$C325 .",
                             C328 = " .$C328 .",
                             C330 = " .$C330 .",
			     C332 = " .$C332 .",
                             C333 = " .$C333 .",
                             C334 = " .$C334 .",
                             C335 = " .$C335 .",
                             C336 = " .$C336 .",
                             C401 = " .$C401 .",
                             C402 = " .$C402 .",
                             C408 = " .$C408 .",
                             C600 = " .$C600 .",
                             C930 = " .$C930 .",
                             C940 = " .$C940 .",
			     C950 = " .$C950 .",
                             C960 = " .$C960 .",
                             C999 = " .$C999 .",
							 STATUS = 1, 
                               TOTAL =  (nvl(".$C101. ",0) + nvl(".$C204.",0) + nvl(".$C209.",0) + nvl(".$C210. ",0)
							         + nvl(".$C301. ",0) + nvl(".$C303.",0) + nvl(".$C304.",0) + nvl(".$C305.",0)
									 + nvl(".$C309. ",0) + nvl(".$C310.",0) + nvl(".$C311.",0) + nvl(".$C312.",0)
									 + nvl(".$C313. ",0) + nvl(".$C315.",0) + nvl(".$C316.",0) + nvl(".$C317.",0)
									 + nvl(".$C318. ",0) + nvl(".$C319.",0) + nvl(".$C320.",0) + nvl(".$C321.",0)
									 + nvl(".$C322. ",0) + nvl(".$C323.",0) + nvl(".$C324.",0) + nvl(".$C325.",0) 
									 + nvl(".$C328. ",0) + nvl(".$C330.",0) + nvl(".$C332.",0) + nvl(".$C333.",0)
									 + nvl(".$C334. ",0) + nvl(".$C335.",0) + nvl(".$C336.",0) + nvl(".$C401.",0)
									 + nvl(".$C402. ",0) + nvl(".$C408.",0) + nvl(".$C600.",0) + nvl(".$C930.",0) 
									 + nvl(".$C940. ",0) + nvl(".$C950.",0) + nvl(".$C960.",0) + nvl(".$C999.",0)) 
				WHERE ID = ". $id ."";
//echo  $sql_cv;
$stid = oci_parse($conn, $sql_cv);
$r = oci_execute($stid);
echo $sql_cv;
// Fetch each row in an associative array
//print '<table border="1">';
/*if ($sql_cv) {
		echo json_encode($sql_cv);
	}
	else {
		header("HTTP/1.1 500 Internal Server Error");
		//echo "No se pudo Insertar: " .$id;
		echo "No se pudo Insertar: ";
	}*/


				
				oci_free_statement($stid);
			    oci_close ($conn);
				
		}				
		 catch(Exception $ex)
		 {
		  echo $ex -> getMessage() . 'ERROR!!!';
		 }	
		 
		 
    
   ?> 