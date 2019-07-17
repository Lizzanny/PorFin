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
        $inf=array();  $ct0=array(); $ct1=array(); $ct2=array(); $ct3=array(); $ct4=array(); $ct5=array();
        for($i=0; $i<=5; $i++){
            if($this->cnx[$i]['cone']!=0){
                $co = oci_connect($this->cnx[$i]['user'], $this->cnx[$i]['pass'], "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->cnx[$i]['host']." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$this->cnx[$i]['base'].")))");
                if(!$co){
                    $error = oci_error();
                    trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
                }else{
                    if($i==0){
                        $ct0=$this->getInformacionCedulas($co); 
                    }
                    if($i==1){
                        $ct1=$this->getInformacionCedulas($co); 
                    }
                    if($i==2){
                        $ct2=$this->getInformacionCedulas($co); 
                    }
                    if($i==3){
                        $ct3=$this->getInformacionCedulas($co); 
                    }
                    if($i==4){
                        $ct4=$this->getInformacionCedulas($co); 
                    }
                    if($i==5){
                        $ct5=$this->getInformacionCedulas($co); 
                    }
                }
            }
           
        }
        $inf=array('ct0'=> $ct0,
                   'ct1'=> $ct1,
                   'ct2'=> $ct2,
                   'ct3'=> $ct3,
                   'ct4'=> $ct4,
                   'ct5'=> $ct5,

                ); 

        echo json_encode($inf);
       
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
        CEDULAS.CONTASADEP,
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