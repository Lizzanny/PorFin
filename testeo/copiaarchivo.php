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
    public $tama = 0;

    public function getconexionremota(){
$this->tama = sizeof($this->cnx);
        for($i = 0; $i < $this->tama; $i++){
            $co[$i] = oci_connect($this->cnx[$i]['user'], $this->cnx[$i]['pass'], "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->cnx[$i]['host']." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$this->cnx[$i]['base'].")))");
            // Seleccion de la base de datos 
            if(!$co){
                $error = oci_error();
                trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
               //echo 'u.u   xdxxx';
               echo $i.'0 <br>';
            }else{
              //  $this->getInformacionCedulas($co); 
               //echo "conexion exitosa de php a oracle <br> xxsss";
               echo $i.'1 <br>';
            }
        }
        
    }

    public function getInformacionCedulas($co){
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
        CEDULAS.CONTDES,
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
        CEDULAS.CONTABONO,
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
           //if($row["CONTFECHDETDEP"]==null){
           //    echo "CONTFECHDETDEP esta indefinido <br>"; 
           //}
           //var_dump($row["CONTFECHDETDEP"]);
          //$HDETDEP = '';
           if(!isset($row["CONTFECHDETDEP"])){
                $HDETDEP=null;
           }else{
                $HDETDEP=$row["CONTFECHDETDEP"]; 
           }
           /* */
            $inf[$i]= $fila = array('cuenta' =>$row['CUENTA'],
                                    'centro' =>$row['CENTRO_TRABAJO'],
                                    'cedula' =>$row['CEDULA'],
                                    'ccosto' =>$row['CONTCC'],
                                    'contsc' =>$row['CONTSC'],
                                    'contssc'=>$row['CONTSSC'],
                                    'cntsssc'=>$row['CONTSSSC'],
                                    'contdes'=>$row['CONTDES'],
                                    'fechadq'=>$row['CONTFECHADQ'],
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
                                    

                                );
                               
        }
        oci_free_statement($stmt);
        oci_close($co);

      //-  echo json_encode($inf);
        //
        //$this->hojaExecel($inf); 
    }

    public function hojaExecel(){
        ///



    }
    



}

$ob = new Cedulas();
$ob->getconexionremota();  
$ob->cerrarConexion2(); 
?>