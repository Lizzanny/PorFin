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
  
    private function getconexionremota(){
    $inf=array();         $ct0=array();  $ct6=array();   $ct12=array();  $ct18=array(); $ct25=array(); $ct31=array();
    $numregistros=0;      $ct1=array();  $ct7=array();   $ct13=array();  $ct19=array(); $ct26=array(); $ct32=array();
    $datacompleto=array();$ct2=array();  $ct8=array();   $ct14=array();  $ct20=array(); $ct27=array(); $ct33=array();
                          $ct3=array();  $ct9=array();   $ct15=array();  $ct22=array(); $ct28=array(); $ct34=array();
                          $ct4=array();  $ct10=array();  $ct16=array();  $ct23=array(); $ct29=array();
                          $ct5=array();  $ct11=array();  $ct17=array();  $ct24=array(); $ct30=array();
        /* calcular el numero de filas que contiene cada centro de trabajo  */
        $tamct0=0; $tamct6=0;  $tamct12=0;  $tamct18=0; $tamct24=0; $tamct30=0;
        $tamct1=0; $tamct7=0;  $tamct13=0;  $tamct19=0; $tamct25=0; $tamct31=0;
        $tamct2=0; $tamct8=0;  $tamct14=0;  $tamct20=0; $tamct26=0; $tamct32=0;
        $tamct3=0; $tamct9=0;  $tamct15=0;  $tamct21=0; $tamct27=0; $tamct33=0;
        $tamct4=0; $tamct10=0; $tamct16=0;  $tamct22=0; $tamct28=0; $tamct34=0;
        $tamct5=0; $tamct11=0; $tamct17=0;  $tamct23=0; $tamct29=0;
        
        for($i=0; $i<=10; $i++){
            if($this->cnx[$i]['cone']!=0){
                $co = oci_connect($this->cnx[$i]['user'], $this->cnx[$i]['pass'], "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->cnx[$i]['host']." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$this->cnx[$i]['base'].")))");
                if(!$co){
                    $error = oci_error();
                    trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
                }else{
                    if($i==0){
                        $ct0=$this->getInformacionCedulas($co); //Baja California Sur
                        $tamct0=sizeof($ct0);
                    }
                    if($i==1){
                        $ct1=$this->getInformacionCedulas($co);//Campeche"
                        $tamct1=sizeof($ct1);
                    }
                    if($i==2){
                        $ct2=$this->getInformacionCedulas($co);//Chiapas
                        $tamct2=sizeof($ct2); 
                    }
                    if($i==3){
                        $ct3=$this->getInformacionCedulas($co);//Chihuahua
                        $tamct3=sizeof($ct3); 
                    }
                    if($i==4){
                        $ct4=$this->getInformacionCedulas($co);//Coahuila
                        $tamct4=sizeof($ct4); 
                    }
                    if($i==5){
                        $ct5=$this->getInformacionCedulas($co);//Colima
                        $tamct5=sizeof($ct5); 
                    }
                    if($i==6){
                        $ct6=$this->getInformacionCedulas($co);//Durango
                        $tamct6=sizeof($ct6); 
                    }
                    if($i==7){
                        $ct7=$this->getInformacionCedulas($co);//Guanajuato
                        $tamct7=sizeof($ct7); 
                    }
                    if($i==8){
                        $ct8=$this->getInformacionCedulas($co);//Guerrero
                        $tamct8=sizeof($ct8); 
                    }
                    if($i==9){
                        $ct9=$this->getInformacionCedulas($co);//Hidalgo
                        $tamct9=sizeof($ct9); 
                    }
                    if($i==10){
                        $ct10=$this->getInformacionCedulas($co);//Jalisco 
                        $tamct10=sizeof($ct10); 
                    }
                    if($i==11){
                        $ct11=$this->getInformacionCedulas($co);//Metropolitana Norte
                        $tamct11=sizeof($ct11); 
                    }
                    if($i==12){
                        $ct12=$this->getInformacionCedulas($co);//Metropolitana Sur
                        $tamct12=sizeof($ct12); 
                    }
                    if($i==13){
                        $ct13=$this->getInformacionCedulas($co);//Michoacan 
                        $tamct13=sizeof($ct13); 
                    }
                    if($i==14){
                        $ct14=$this->getInformacionCedulas($co);//Morelos 
                        $tamct14=sizeof($ct14); 
                    }
                    if($i==15){
                        $ct15=$this->getInformacionCedulas($co);//Nayarit 
                        $tamct15=sizeof($ct15); 
                    }
                    if($i==16){
                        $ct16=$this->getInformacionCedulas($co);//Nuevo Leon 
                        $tamct16=sizeof($ct16); 
                    }
                    if($i==17){
                        $ct17=$this->getInformacionCedulas($co);//Oaxaca 
                        $tamct17=sizeof($ct17); 
                    }
                    if($i==18){
                        $ct18=$this->getInformacionCedulas($co);//Oficina Central
                        $tamct18=sizeof($ct18); 
                    }
                    if($i==19){
                        $ct19=$this->getInformacionCedulas($co);//Puebla
                        $tamct19=sizeof($ct19); 
                    }
                    if($i==20){
                        $ct20=$this->getInformacionCedulas($co);//Queretaro 
                        $tamct20=sizeof($ct20); 
                    }
                    if($i==21){
                        $ct21=$this->getInformacionCedulas($co);//Quintana Roo 
                        $tamct21=sizeof($ct21); 
                    }
                    if($i==22){
                        $ct22=$this->getInformacionCedulas($co);//San Luis Potosi 
                        $tamct22=sizeof($ct22); 
                    }
                    if($i==23){
                        $ct23=$this->getInformacionCedulas($co);//Sinaloa 
                        $tamct23=sizeof($ct23); 
                    }
                    if($i==24){
                        $ct24=$this->getInformacionCedulas($co);//Sonora 
                        $tamct24=sizeof($ct24); 
                    }
                    if($i==25){
                        $ct25=$this->getInformacionCedulas($co);//Tabasco 
                        $tamct25=sizeof($ct25); 
                    }
                    if($i==26){
                        $ct26=$this->getInformacionCedulas($co);//Tamaulipas 
                        $tamct26=sizeof($ct26); 
                    }
                    if($i==27){
                        $ct27=$this->getInformacionCedulas($co);//Tlaxcala 
                        $tamct27=sizeof($ct27); 
                    }
                    if($i==28){
                        $ct28=$this->getInformacionCedulas($co);//Valle de Toluca 
                        $tamct28=sizeof($ct28); 
                    }
                    if($i==29){
                        $ct29=$this->getInformacionCedulas($co);//Veracruz 
                        $tamct29=sizeof($ct29); 
                    }
                    if($i==30){
                        $ct30=$this->getInformacionCedulas($co);//Yucatan 
                        $tamct30=sizeof($ct30); 
                    }
                    if($i==31){
                        $ct31=$this->getInformacionCedulas($co);//Zacatecas 
                        $tamct31=sizeof($ct31); 
                    }
                    if($i==32){
                        $ct32=$this->getInformacionCedulas($co);//Baja California N
                        $tamct32=sizeof($ct32); 
                    }
                    if($i==33){
                        $ct33=$this->getInformacionCedulas($co);//Aguascalientes 
                        $tamct33=sizeof($ct33); 
                    }
                    if($i==34){
                        $ct34=$this->getInformacionCedulas($co);// ????
                        $tamct34=sizeof($ct34); 
                    }
                }
            }
           
        }
            $tam=array($tamct0,$tamct1,$tamct2,$tamct3,$tamct4,$tamct5,$tamct6,$tamct7,$tamct8,$tamct9,$tamct10,$tamct11,$tamct12,$tamct13,$tamct14,$tamct15,$tamct16,$tamct17,$tamct18,$tamct19,$tamct20,$tamct21,$tamct22,$tamct23,$tamct24,$tamct25,$tamct26,$tamct27,$tamct28,$tamct29,$tamct30,$tamct31,$tamct32,$tamct33,$tamct34      
            );
            $inf=array($ct0,$ct1,$ct2,$ct3,$ct4,$ct5,$ct6,$ct7,$ct8,$ct9,$ct10,$ct11,$ct12,$ct13,$ct14,$ct15,$ct16,$ct17,$ct18,$ct19,$ct20,$ct22,$ct23,$ct24,$ct25,$ct26,$ct27,$ct28,$ct29,$ct30,$ct31,$ct32,$ct33,$ct34); 
        $conta=0; 
        for ($i=0; $i <=10; $i++)//centro trabajo 
        {   
            //eliminar de memoria ram el registro para liberar memoria 
            //memory_get_peak_usage();
            for ($j=0; $j <$tam[$i] ; $j++) //numero de registros por centro de trabajo
            { 
                $conta++; 
                //echo "cuenta ct: $i , tamanio: $j -". $inf[$i][$j]['ccuenta']." contador: ".($conta-1)."<br>";
               /**/
                $datacompleto[$conta-1]= $f = array(
                                        $inf[$i][$j]['ccuenta'],
                                        $inf[$i][$j]['ccentro'],
                                        $inf[$i][$j]['ccedula'],
                                        $inf[$i][$j]['numacti'],
                                        $inf[$i][$j]['cccosto'],
                                        $inf[$i][$j]['ccontsc'],
                                        $inf[$i][$j]['contssc'],
                                        $inf[$i][$j]['cntsssc'],
                                        $inf[$i][$j]['contdes'],
                                        $inf[$i][$j]['FECHADQ'],
                                        $inf[$i][$j]['factuer'],
                                        $inf[$i][$j]['cncosto'],
                                        $inf[$i][$j]['rigbien'],
                                        $inf[$i][$j]['TASADEP'],
                                        $inf[$i][$j]['FECHCAP'],
                                        $inf[$i][$j]['FECHDEP'],
                                        $inf[$i][$j]['TPOLIZA'],
                                        $inf[$i][$j]['REFALTA'],
                                        $inf[$i][$j]['REFBAJA'],
                                        $inf[$i][$j]['NTABONO'],
                                        $inf[$i][$j]['FECHMOV'],
                                        $inf[$i][$j]['TDEPMEN'],
                                        $inf[$i][$j]['DEPANUA'],
                                        $inf[$i][$j]['DEPACUM'],
                                        $inf[$i][$j]['SALXDEP'],
                                        $inf[$i][$j]['BAJADEP'],
                                        $inf[$i][$j]['TMESDEP'],
                                        $inf[$i][$j]['HDETDEP'],
                                        $inf[$i][$j]['FECHBAJ']
                                    ); 
            } 
        }
            
        //echo "tota de registros: " .$sumatam=array_sum($tam); //sumar el total de registros de cada centro de trabajo
        $numregistros=array_sum($tam); //sumar el total de registros de cada centro de trabajo
        //echo json_encode($tam); //imprimir en formato json todos los registros 
        //echo json_encode($inf); //imprimir los datos 
        //
        //echo json_encode($datacompleto); //imprimir los datos datacompleto
        //
        //AQUI DEBE IR LO DE LA BUSQUEDA, NUMERO DE REGISTROS Y PAGINACION
        
        $this->mandarInformacionServidor($numregistros,$datacompleto);
        unset($numregistros);//nos permite eliminar variables en PHP
        unset($datacompleto);//nos permite eliminar variables en PHP
    }
    public function mandarInformacionServidor($num,$datos){
        $datos = array( "draw" => intval(15),
                        "recordsTotal"=>intval($num),
                        "recordsFiltered"=>intval($num),
                        "data"=>$datos
                     );
        echo json_encode($datos);
    }
    private function getInformacionCedulas($co){
        $inf=array();  
    $sql="SELECT 
        CUENTAS.CCDES CUENTA,
        CEDULAS.CONTCT CENTRO_TRABAJO,
        CEDULAS.CONTNUM CEDULA,
        NVL(GetNumActivoxCed(CEDULAS.CONTCT,CEDULAS.CONTNUM),'----') AS NUMACTIVO,
        CEDULAS.CONTCC,
        CEDULAS.CONTSC,
        CEDULAS.CONTSSC,
        CEDULAS.CONTSSSC,
        NVL(CEDULAS.CONTDES, '----') AS CONTDES,
        CEDULAS.CONTFECHADQ,
        CEDULAS.CONTFACTURA,
        CEDULAS.CONTCOSTO,
        NVL(CEDULAS.CONTORIGBIEN, '----') AS CONTORIGBIEN,
        NVL(CEDULAS.CONTASADEP, 0)AS CONTASADEP,
        CEDULAS.CONTFECHCAP,
        CEDULAS.CONTFECHDEP,
        NVL(CEDULAS.CONTPOLIZA, '----') AS CONTPOLIZA,
        NVL(CEDULAS.CONTREFALTAS, '----') AS CONTREFALTAS,
        NVL(CEDULAS.CONTREFBAJAS, '----') AS CONTREFBAJAS,
        NVL(CEDULAS.CONTABONO, '0') AS CONTABONO,
        CEDULAS.CONTFECHMOV,
        CEDULAS.CONTDEPMEN,
        CEDULAS.CONTDEPANUAL,
        CEDULAS.CONTDEPACUM,
        CEDULAS.CONTSALXDEP,
        CEDULAS.CONTBAJADEP,
        CEDULAS.CONTMESDEP,
        CEDULAS.CONTFECHDETDEP,
        CEDULAS.CONTFECHBAJA
        FROM CEDULAS,CUENTAS
        WHERE CEDULAS.CONTCC=CUENTAS.CCNUM AND CEDULAS.CONTFECHMOV <= TO_DATE('31122018','DDMMYYYY')
        ORDER BY 2,3"; 
        $stmt = oci_parse($co, $sql);
        oci_execute($stmt);
        for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
            if(!isset($row["CONTFECHADQ"])){
                $FECHADQ=null;
            }else{
                $FECHADQ=$row["CONTFECHADQ"];
            }
            if(!isset($row["CONTFECHDETDEP"])){
                $HDETDEP=null;
            }else{
                $HDETDEP=$row["CONTFECHDETDEP"];
            }
            if(!isset($row['CONTFECHBAJA'])){
                $FECHBAJ=null;
            }else{
                $FECHBAJ=$row['CONTFECHBAJA'];
            }
            $inf[$i]= $fila = array('ccuenta' =>$row['CUENTA'],
                                    'ccentro' =>$row['CENTRO_TRABAJO'],
                                    'ccedula' =>$row['CEDULA'],
                                    'numacti'=>$row['NUMACTIVO'],
                                    'cccosto' =>$row['CONTCC'],
                                    'ccontsc' =>$row['CONTSC'],
                                    'contssc'=>$row['CONTSSC'],
                                    'cntsssc'=>$row['CONTSSSC'],
                                    'contdes'=>$row['CONTDES'],
                                    'FECHADQ'=>$FECHADQ,
                                    'factuer'=>$row['CONTFACTURA'],
                                    'cncosto'=>$row['CONTCOSTO'],
                                    'rigbien'=>$row['CONTORIGBIEN'],
                                    'TASADEP'=>$row['CONTASADEP'],
                                    'FECHCAP'=>$row['CONTFECHCAP'],
                                    'FECHDEP'=>$row['CONTFECHDEP'],
                                    'TPOLIZA'=>$row['CONTPOLIZA'],
                                    'REFALTA'=>$row['CONTREFALTAS'],
                                    'REFBAJA'=>$row['CONTREFBAJAS'],
                                    'NTABONO'=>$row['CONTABONO'],
                                    'FECHMOV'=>$row['CONTFECHMOV'],
                                    'TDEPMEN'=>$row['CONTDEPMEN'],
                                    'DEPANUA'=>$row['CONTDEPANUAL'],
                                    'DEPACUM'=>$row['CONTDEPACUM'],
                                    'SALXDEP'=>$row['CONTSALXDEP'],
                                    'BAJADEP'=>$row['CONTBAJADEP'],
                                    'TMESDEP'=>$row['CONTMESDEP'],
                                    'HDETDEP'=>$HDETDEP,
                                    'FECHBAJ'=>$FECHBAJ
                                );
                               /**/
        }
        oci_free_statement($stmt);
        
        oci_close($co);
        //echo json_encode($inf);
        return $inf; 
        //$this->hojaExecel($inf); 
    }
    public function numeroColumnas(){
        $columnas=array();
        $columnas = array(
             0 => 'ccuenta',
             1 => 'ccentro',
             2 => 'ccedula',
             3 => 'numacti',
             4 => 'cccosto',
             5 => 'ccontsc',
             6 => 'contssc',
             7 => 'cntsssc',
             8 => 'contdes',
             9 => 'FECHADQ',
            10 => 'factuer',
            11 => 'cncosto',
            12 => 'rigbien',
            13 => 'TASADEP',
            14 => 'FECHCAP',
            15 => 'FECHDEP',
            16 => 'TPOLIZA',
            17 => 'REFALTA',
            18 => 'REFBAJA',
            19 => 'NTABONO',
            20 => 'FECHMOV',
            21 => 'TDEPMEN',
            22 => 'DEPANUA',
            23 => 'DEPACUM',
            24 => 'SALXDEP',
            25 => 'BAJADEP',
            26 => 'TMESDEP',
            27 => 'HDETDEP',
            28 => 'FECHBAJ'
            );
    }
    public function metodoAccesoCedula(){
        $this->getconexionremota(); 
    }
    public function hojaExecel(){ //
    }
    
}
$ob = new Cedulas();
$ob->metodoAccesoCedula(); 
$ob->cerrarConexion2(); 
?>