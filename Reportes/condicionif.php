<?php 
	//($this->reg[$i][$j][$x]['cc']>=0 && $this->reg[$i][$j][$x]['cc']<=199)
	//
	//
	/**
	 * 
	 */
	class CentroCosto{
		public $x=54;
		

		
		function __construct()
		{
			
		}


	public function getCentrosCosto($x){
		$status1=false;
		$status2=false;
		$status3=false;
		$status4=false;
		$status5=false;
		$status6=false;
		$status7=false;
		$status8=false;
		$status9=false;

		$longit=sizeof($x); 
		for ($i=0; $i <$longit; $i++) { 
			# code...
		}
			if($x[$i]['ccs']>=0 && $x<=199){
				$cosini=0;
				$cosfin=199; 
				//echo "$x esta dentro de este rango[$cosini,$cosfin]";
				$status1=true; 
			}elseif($x>=200 && $x<=299){
				$cosini=200;
				$cosfin=299;
				//echo "$x esta dentro de este rango[$cosini,$cosfin]";
				$status2=true; 
			}elseif($x>=300 && $x<=399){
				$cosini=300;
				$cosfin=399;
				//echo "$x esta dentro de este rango[$cosini,$cosfin]";
				$status3=true; 
			}else{
				//echo "no esta dentro del rango $x";
			}

			$data = array(
				array('status' =>$status1,
					  'cosini' =>$cosini,
					  'cosfin' =>$cosfin,
					  'nombre' =>$x[$i]['nom')
				,$status2,$status3,$status4,$status5,$status6,$status7,$status8,$status9 );
			
			echo json_encode($data);
			
	}

}

	$ob= new CentroCosto(); 
	$ob->getCentrosCosto(53); 
	

 ?>
