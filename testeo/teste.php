<?php
/*Autor: Elias Alejandro
  Fecha Inicio:  Miercoles 10/Julio/2019
  Fecha Termino:  Viernes 12/Julio/2019
  Descripcion: 
    Este metodo realiza el testeo de las base de datos remotas alas que se quiere conectar
    esto con el fin de comprobar la conexion y generar un reporte
*/
include_once '../Libs/ConexionOracle.php'; 
class ClaseTesteo extends ConexionOracle
{
    //atributo 
    private $cnx= array(); //informacion de conexion

    function __construct(){
		parent::__construct();
	}

    //metodo para obtener la informacion de las bases de datos remotas
    private function getDatosConexionesRemotas()
    {
        $sql= "SELECT * FROM C_DBLINKS";
        $stmt = oci_parse($this->con2, $sql);
        oci_execute($stmt);
       /*  */

    
		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
            
            //llamar al metodo comprobar conexion de las base de datos remotos
            $host= trim($row["IP"]);
            $base= trim($row["SID"]);
            $user= trim($row["USUARIO"]);
            $pass= trim($row["CLAVE"]);
            $nomb= trim($row["DB_INSTANCE"]);
            $dblink= trim($row["DB_NAME"]);
            
                $conex= 0;//$this->ProbarConexionBaseRemota($host,$base,$user,$pass);
                $this->cnx[$i]= $valor =  array('clve' => $row['CT_CLAVE'],
                                                 'nomb' => $row['DB_INSTANCE'],
                                                 'host' => $row['IP'],
                                                 'base' => $row['SID'],
                                                 'user' => $row['USUARIO'],
                                                 'pass' => $row['CLAVE'],
                                                 'cone' => $conex
                                                );  
        }
        //$this->loteprimer(); 
    }


    //metodo privado para testing de las bases de datos remotas 
    private function ProbarConexionBaseRemota($host,$daba,$user,$pass)
    {
        $checar=0; 
        try{    
            $base= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
            $checar=1;
            $this->getInformacionCedulas($base); 
        }catch(PDOException $e){
             //echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
             $checar=0;
        }
        return $checar; 
    }

    public function getconexionremota(){
        //echo $this->cnx[0]['host']; 
        $co = oci_connect($this->cnx[0]['user'], $this->cnx[0]['pass'], "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->cnx[0]['host']." )(PORT = 1521)) (CONNECT_DATA =  (SID =".$this->cnx[0]['base'].")))");
            // Seleccion de la base de datos 
            if(!$co){
                $error = oci_error();
                trigger_error(htmlentities($error['message'], ENT_QUOTES), E_USER_ERROR);
               echo 'u.u   xdxxx';
            }else{
                $this->getInformacionCedulas($co); 
               echo "conexion exitosa de php a oracle <br> xxsss";
            }
    }

    public function getInformacionCedulas($co){
        $inf=array(); 
        $sql="SELECT
        CUENTAS.CCDES CUENTA,
        CEDULAS.CONTCT CENTRO_TRABAJO,
        CEDULAS.CONTNUM CEDULA,
        GetNumActivoxCed(CEDULAS.CONTCT,CEDULAS.CONTNUM),
        CEDULAS.CONTCC,
        CEDULAS.CONTSC,
        CEDULAS.CONTSSC,
        CEDULAS.CONTSSSC,
        CEDULAS.CONTDES,
        CEDULAS.CONTFECHADQ,
        CEDULAS.CONTFACTURA,
        CEDULAS.CONTCOSTO,
        CEDULAS.CONTORIGBIEN,
        CEDULAS.CONTASADEP,
        CEDULAS.CONTFECHCAP,
        CEDULAS.CONTFECHDEP,
        CEDULAS.CONTPOLIZA,
        CEDULAS.CONTREFALTAS,
        CEDULAS.CONTREFBAJAS,
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
            $inf=array('cuenta'=> $row['CUENTA'],
                        'centro' => $row['CENTRO_TRABAJO']);
        }
        oci_free_statement($stmt);
        oci_close($co);

        echo json_encode($inf);
    }








    //metodo publico de acceso para llamar a metodo privados
    public function getMetodoAcceso(){
        $this->getDatosConexionesRemotas(); 
        $this->getconexionremota();
        //echo json_encode($this->cnx); 
    }

}//endmyClass

    $ob = new ClaseTesteo();
    $ob->getMetodoAcceso();  
    $ob->cerrarConexion2(); 
?>