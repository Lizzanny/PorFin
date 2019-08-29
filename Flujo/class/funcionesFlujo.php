<?php
	class funcionesFlujo
	{
		//BASE DE DATOS LOCAL DE MI COMPUtadora
		/*var $usuario = "root";
		var	$clave = "";
		var	$host = "127.0.0.1";
		var	$dbase = "sicoas";
		var	$puerto = "3306";*/
				
		
		
		//BASE DE DATOS DE ORACLE SICOP
		var $usuarioOracle = "PORFINAN";
		var	$claveOracle = "porfinan1234";
		var	$hostOracle = "172.30.10.98";
		var	$dbaseOracle = "dbcpbsicop";
		
		
		
		
		function Flujoproceso($axo = 0,$fecha_desde = '', $fecha_hasta = '')
		{
			try
			{
				$conn = oci_connect($this -> usuarioOracle, $this -> claveOracle, $this -> hostOracle . '/' . $this -> dbaseOracle);
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				
				$stid = oci_parse($conn, "BEGIN sicop101.RepFlujoEfectivo(" .$axo. ", to_date('" . $fecha_desde . "','dd-mm-yyyy'),
				                                    to_date('". $fecha_hasta . "','dd-mm.yyyy')); END;");
				
				if(!oci_execute($stid))
				{
					$e = oci_error($stid);
					//trigger_error(htmlentities($e['message']), E_USER_ERROR);
					echo $e['message'];
				}
				
				oci_free_statement($stid);
				oci_close($conn);
				
			}
			catch(Exception $e)
			{
				echo $e -> getMessage();
			}
		}
		
		
		
		
	}

?>