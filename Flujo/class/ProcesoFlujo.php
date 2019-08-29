<?php
	
	header("Content-Type: text/html; charset=utf-8");
	include("funcionesFlujo.php");
	/*echo $_POST['fecha_desde'];*/
	$mes = '';
	
	if($_POST['fecha_desde'] != '')
        {
            list($axodesde, $mesdesde, $diadesde) = explode('-', $_POST['fecha_desde']);
            $fecha_desde = $diadesde ."-". $mesdesde ."-". $axodesde;
			$mes_desde = $mesdesde;
        }
	if($_POST['fecha_hasta'] != '')
        {
            list($axohasta, $meshasta, $diahasta) = explode('-', $_POST['fecha_hasta']);
            $fecha_hasta = $diahasta ."-". $meshasta ."-". $axohasta;
			$mes_hasta = $meshasta;
        }
	$axo = $_POST['ejercicio'];
	/*echo $fecha_desde;
	echo $fecha_hasta;
	echo "mes desde : " . 	$mes_desde;
	echo "mes hasta : " . 	$mes_hasta;*/
	if ($mes_desde == $mes_hasta)
	{
		if ($mes_desde == '01')
		  {
			$mes = 'ENERO';  
		  }
		 if ($mes_desde == '02')
		  {
			$mes = 'FEBRERO';  
		  }
		  if ($mes_desde == '03')
		  {
			$mes = 'MARZO';  
		  }
		  if ($mes_desde == '04')
		  {
			$mes = 'ABRIL';  
		  }
		  if ($mes_desde == '05')
		  {
			$mes = 'MAYO';  
		  }
		  if ($mes_desde == '06')
		  {
			$mes = 'JUNIO';  
		  }
		  if ($mes_desde == '07')
		  {
			$mes = 'JULIO';  
		  }
		  if ($mes_desde == '08')
		  {
			$mes = 'AGOSTO';  
		  }
		  if ($mes_desde == '09')
		  {
			$mes = 'SEPTIEMBRE';  
		  }if ($mes_desde == '10')
		  {
			$mes = 'OCTUBRE';  
		  }
		  if ($mes_desde == '11')
		  {
			$mes = 'NOVIEMBRE';  
		  }
		  if ($mes_desde == '12')
		  {
			$mes = 'DICIEMBRE';  
		  } 
		
		$funcOracle = new funcionesFlujo();
	$funcOracle -> Flujoproceso($axo, $fecha_desde, $fecha_hasta);
	//echo "HOLA";
	/*echo "<script type=\"text/javascript\" language=\"javascript\" charset=\"UTF-8\">alert('El Proceso concluyó se procederá a mostrar el Flujo de Efectivo')";
	 
	" var mes = ' $mes  '";
	"location.href='../flujo.php?mesdesde='+mes";
	"alert (mes)";
	"</script>";*/
	
	
    
	}
	echo json_encode($mes);
    
?>