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
        CEDULAS.CONTORIGBIEN ,
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
            $inf[$i] = $fila = array('cuenta' => $row['CUENTA'],
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
    }
    public function hojaExecel(){
    }
}
$ob = new Cedulas();
$ob->getconexionremota();  
$ob->cerrarConexion2(); 
?>